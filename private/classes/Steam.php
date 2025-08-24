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

    public static ?string $steamUser = null;
    public static ?int $commonId = null;

    public static function authorize(): bool
    {
        $refererParams = [];
        parse_str(parse_url(urldecode($_SERVER['HTTP_REFERER'] ?? ''), PHP_URL_QUERY) ?? '', $refererParams);

        if (!empty($refererParams[self::USER_ID_PARAM]) && self::isSteamApp()) {
            if (self::cached($refererParams[self::USER_ID_PARAM])) {
                [self::$steamUser, self::$commonId] = self::getCachedUserData($refererParams[self::USER_ID_PARAM]);

                return true;
            }

            if (isset($_COOKIE[Cookie::COOKIE_NAME])) {
                if ($commonId = (int)PlayerModel::getPlayerCommonId($_COOKIE[Cookie::COOKIE_NAME])) {
                    $steamUser = PlayerModel::getFirstCommonIdRecordO(
                            $commonId,
                            $_COOKIE[Cookie::COOKIE_NAME]
                        )->_cookie ?? null;
                    self::$commonId = $commonId;

                    if ($steamUser) {
                        self::$steamUser = $steamUser;

                        self::cacheUserData($refererParams[self::USER_ID_PARAM], self::$steamUser, self::$commonId);

                        return true;
                    } else {
                        self::$steamUser = md5($refererParams[self::USER_ID_PARAM]);
                        $playerModel = PlayerModel::new(
                            [
                                PlayerModel::COMMON_ID_FIELD => self::$commonId,
                                PlayerModel::COOKIE_FIELD => self::$steamUser,
                            ]
                        );

                        if ($playerModel->save()) {
                            try {
                                $userModel = UserModel::getOneO(self::$commonId)
                                    ?: UserModel::new([UserModel::ID_FIELD => self::$commonId,]);
                                $userModel->_name = $refererParams[self::PLAYER_NAME_PARAM] ?? '';
                                $userModel->_avatar_url = self::getAvatarFromApi($refererParams[self::USER_ID_PARAM]);
                                $userModel->save();
                            } catch (\Throwable $e) {
                                Cache::setex('sudoku.error', 600, $e->__toString());
                            }

                            self::cacheUserData($refererParams[self::USER_ID_PARAM], self::$steamUser, self::$commonId);

                            return true;
                        }
                    }
                }
            }

            self::$steamUser = md5($refererParams[self::USER_ID_PARAM]);
            self::$commonId = (int)PlayerModel::getPlayerCommonId(self::$steamUser, true);

            self::cacheUserData($refererParams[self::USER_ID_PARAM], self::$steamUser, self::$commonId);

            return true;
        }

        return false;
    }

    public static function isSteamApp(): bool
    {
        if (($_GET[BC::APP_PARAM] ?? false) === 'steam') {
            return true;
        }

        return isset($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'], 'app=steam') !== false);
    }

    private static function getAvatarFromApi(string $userId): string
    {
        $response = file_get_contents(
            'https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key='
            . Config::$config['STEAM_API_KEY']
            . '&steamids=' . $userId
        );

        Cache::setex('sudoku.error', 600, $response);
        $urls = json_decode(

            $response ?: '{}'
            ,
            true
        );

        return $urls["response"]["players"][0]["avatarfull"] ?? '';
    }

    private static function cached($userId64): bool
    {
        return ApcuCache::exists((string)$userId64);
    }

    private static function getCachedUserData($userId64): array
    {
        return ApcuCache::get((string)$userId64);
    }

    private static function cacheUserData($userId64, string $steamUser, int $commonId): bool
    {
        return ApcuCache::set((string)$userId64, [$steamUser, $commonId]);
    }
}