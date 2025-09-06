<?php

namespace classes;

use PlayerModel;
use UserModel;
use BaseController as BC;

class Steam
{
    const USER_ID_PARAM = 'steamId64';
    const PLAYER_NAME_PARAM = 'playerName';
    const GREETING_BONUS = 1000;
    const APCU_TTL = 3600;

    public static ?string $steamUser = null;
    public static ?int $commonId = null;

    public static function authorize(): bool
    {
        if (!self::isSteamApp()) {
            return false;
        }

        $refererParams = [];
        parse_str(
            parse_url(urldecode($_SERVER['HTTP_REFERER'] ?: ($_SERVER['REQUEST_URI'] ?? '')), PHP_URL_QUERY) ?? '',
            $refererParams
        );

        if (!empty($refererParams[self::USER_ID_PARAM])) {
            if (self::cached($refererParams[self::USER_ID_PARAM])) {
                [self::$steamUser, self::$commonId] = self::getCachedUserData($refererParams[self::USER_ID_PARAM]);

                return true;
            }

            self::$steamUser = md5($refererParams[self::USER_ID_PARAM] . Config::$config['SALT']);

            // Создаем плеера и юзера для данного steamId
            self::$commonId = (int)PlayerModel::getPlayerCommonId(self::$steamUser, true);
            self::refreshAvatar(
                self::$commonId,
                $refererParams[self::USER_ID_PARAM],
                $refererParams[self::PLAYER_NAME_PARAM] ?? ''
            );

            self::cacheUserData($refererParams[self::USER_ID_PARAM], self::$steamUser, self::$commonId);

            return true;
        }

        return false;
    }

    public
    static function isSteamApp(): bool
    {
        if (($_GET[BC::APP_PARAM] ?? false) === 'steam') {
            return true;
        }

        return isset($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'], 'app=steam') !== false);
    }

    private
    static function getAvatarUrlFromApi(
        string $userId
    ): string {
        $response = file_get_contents(
            'https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key='
            . Config::$config['STEAM_API_KEY']
            . '&steamids=' . $userId
        );

        $urls = json_decode($response ?: '{}', true);

        return $urls["response"]["players"][0]["avatarfull"] ?? '';
    }

    private
    static function cached(
        $userId64
    ): bool {
        return ApcuCache::exists((string)$userId64);
    }

    private
    static function getCachedUserData(
        $userId64
    ): array {
        return ApcuCache::get((string)$userId64);
    }

    private
    static function cacheUserData(
        $userId64,
        string $steamUser,
        int $commonId
    ): bool {
        return ApcuCache::set((string)$userId64, [$steamUser, $commonId], self::APCU_TTL);
    }

    /**
     * Создает запись юзера Steam, либо только обновляет аватар (если задан только commonId)
     * @param int $commonId
     * @param int|null $steamUserId
     * @param string|null $playerName
     * @return bool
     */
    private static function refreshAvatar(int $commonId, ?int $steamUserId = null, ?string $playerName = null): bool
    {
        try {
            // Все параметры заданы - получаем модель или создаем новую запись
            if ($steamUserId && isset($playerName)) {
                $userModel = UserModel::getOneO($commonId)
                    ?: UserModel::new(
                        [
                            UserModel::ID_FIELD => self::$commonId,
                            UserModel::TYPE_ID => UserModel::STEAM_TYPE_ID,
                            UserModel::TG_ID_FIELD => $steamUserId,
                            UserModel::NAME_FIELD => $playerName ?: null,
                        ]
                    );

                // Обновляем ник Стим-юзера, если он прислан и изменился
                if ($playerName && $userModel->_name !== $playerName) {
                    $userModel->_name = $playerName;
                }
            } else {
                $userModel = UserModel::getOneO(self::$commonId);

                if (!$userModel) {
                    return false;
                }
            }

            // Обновляем аватар
            $userModel->_avatar_url = self::getAvatarUrlFromApi($userModel->_tg_id);

            return $userModel->save();
        } catch (\Throwable $e) {
            Cache::setex('sudoku.error', 600, $e->__toString());

            return false;
        }
    }
}