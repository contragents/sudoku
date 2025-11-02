<?php

use classes\Config;
use classes\Cookie;
use classes\Game;
use classes\MonetizationService;
use classes\Steam;
use classes\T;
use BaseController as BC;
use classes\Tg;

class PlayersController extends BaseSubController
{
    const HIDE_PARAM = 'hide'; // hide/show

    const SIGN_PARAM = 'sign';
    const REF_TG_ID_PARAM = 'ref_tg_id';
    const ADD_REF_PARAMS_ORDER = [self::COMMON_ID_PARAM, self::REF_TG_ID_PARAM];
    const SECRET_PARAM = 'secret';
    const NAME_PARAM = 'name';

    const PARAM_VALUES = [
        self::HIDE_PARAM => [self::HIDE, self::SHOW],
    ];

    const HIDE = 'hide';
    const SHOW = 'show';

    const MAX_UPLOAD_SIZE = 2 * 1024 * 1024;
    const UPLOAD_DIR = '/img/upload/';
    const ENABLE_UPLOAD_EXT = [
        'jpg' => 'jpg',
        'jpeg' => 'jpeg',
        'png' => 'png',
        'gif' => 'gif',
        'svg' => 'svg',
        'ico' => 'ico',
        'bmp' => 'bmp'
    ];
    const NICKNAME_PARAM = 'nickname';
    const COUNTER_PARAM = 'counter';
    const URL_PARAM = 'url';
    const SVG_EMPTY_TPL = '<svg></svg>';

    const IMAGE_FORMATS = ['.png' => 'png', '.jpg' => 'jpeg', '.gif' => 'gif', '.svg' => 'svg+xml', '.jpeg' => 'jpeg'];


    public function avatarAction(): string
    {
        if (self::$Request[self::URL_PARAM] ?? false) {
            $projectRootDir = __DIR__ . '/../../../';
            $cacheDir = $projectRootDir . 'img/upload/';

            try {
                $filenameHash = md5(self::$Request[self::URL_PARAM]);
                if (file_exists($cacheDir . $filenameHash)) {
                    header('Content-type: image/' . self::getImgFormatFromUrl(self::$Request[self::URL_PARAM]));
                    readfile($cacheDir . $filenameHash);

                    return '';
                }

                $res = file_get_contents(self::$Request[self::URL_PARAM]);

                file_put_contents($cacheDir . $filenameHash, $res);

                foreach ($http_response_header as $header) {
                    header($header);
                }

                return $res;
            } catch (Throwable $e) {
                header('Content-type: image/jpeg');

                return file_get_contents(
                    $projectRootDir . StatsController::ANONYM_AVATAR_FILEPATH
                );
            }
        }
    }

    public function svgcounterAction(): string
    {
        header('Content-type: image/svg+xml');

        try {
            $svg = file_get_contents(__DIR__ . '/../../../img/skipbo/card_counter_v3.svg');
            return str_replace(
                '{{}}',
                self::$Request[self::COUNTER_PARAM],
                $svg
            );
        } catch (Throwable $e) {
            return self::SVG_EMPTY_TPL;
        }
    }

    public function svgnicknameAction(): string
    {
        header('Content-type: image/svg+xml');

        $fontSize = ceil(6 * 18 / mb_strlen(self::$Request[self::NICKNAME_PARAM], 'UTF-8'));
        if ($fontSize > 14) {
            $fontSize = 14;
        }

        try {
            $svg = file_get_contents(__DIR__ . '/../../../img/otjat/player_nickname.svg');
            return str_replace(
                ['{{}}', '[[]]'],
                [
                    self::$Request[self::NICKNAME_PARAM],
                    $fontSize
                ],
                $svg
            );
        } catch (Throwable $e) {
            return self::SVG_EMPTY_TPL;
        }
    }

    public static function avatarUploadAction(): string
    {
        try {
            $files = $_FILES;
            $cookie = Tg::$tgUser['user']['id'] ?? $_COOKIE[Cookie::COOKIE_NAME];

            $status = 'error';

            $parts = explode(".", $files['url']['name']);
            $extension = strtolower(end($parts));
            $filename = $cookie . '.' . $extension;
            if (isset(self::ENABLE_UPLOAD_EXT[$extension]) && $files['url']['size'] < self::MAX_UPLOAD_SIZE) {
                if (move_uploaded_file(
                    $files['url']['tmp_name'],
                    $_SERVER['DOCUMENT_ROOT']
                    . '/../'
                    . (in_array(Config::DOMAIN(), Steam::PROD_DOMAINS) ? 'sudoku' : 'erudit.club')
                    . self::UPLOAD_DIR
                    . $filename
                )) {
                    $avatarAddRes = self::addUserAvatarUrl(
                        self::getBaseUploadFileURL() . $filename,
                        BC::$commonId
                    );

                    return $avatarAddRes;
                }
            }

            return json_encode(
                [
                    'result' => $status,
                    'message' => T::S(
                            '<strong>File upload error!</strong><br /> Please review:<br /> <ul><li>file size (no more than <strong>'
                        )
                        . round(
                            self::MAX_UPLOAD_SIZE / 1024 / 1024,
                            1
                        )
                        . T::S('MB</strong>)</li><li>extension -<strong>')
                        . implode(T::S('</strong> or <strong>'), self::ENABLE_UPLOAD_EXT)
                        . '</strong></li></ul>'
                ]
            );
        } catch (Throwable $e) {
            return json_encode(
                [
                    'result' => 'error',
                    'message' => $e->__toString()
                ],
                JSON_UNESCAPED_UNICODE
            );
        }
    }

    public static function addUserAvatarUrl($url, $commonID): string
    {
        $url = trim($url);
        $url = lcfirst($url);

        if (!preg_match('/^https?:\/\//', $url)) {
            return json_encode(
                [
                    'result' => 'error',
                    'message' => T::S('Invalid URL format! <br />It must begin with <strong>http(s)://</strong>'),
                ]
            );
        }

        $updateRes = UserModel::updateUrl($commonID, $url);

        if ($updateRes) {
            return json_encode(
                [
                    'result' => 'saved',
                    'message' => T::S('Avatar updated'),
                    'url' => UserModel::getOne($commonID)[UserModel::AVATAR_URL_FIELD],
                    'common_id' => $commonID
                ],
                JSON_UNESCAPED_UNICODE
            );
        } else {
            return json_encode(
                [
                    'result' => 'error',
                    'message' => T::S('Error saving new URL'),
                ],
                JSON_UNESCAPED_UNICODE
            );
        }
    }

    public static function getBaseUploadFileURL()
    {
        return Config::BASE_URL() . Game::GAME_NAME . self::UPLOAD_DIR; // один адрес для всех аватаров игр - sudoku
    }

    public function saveUserNameAction()
    {
        $name = self::$Request[self::NAME_PARAM];
        $commonId = self::$Request[self::COMMON_ID_PARAM] ?? null;

        if (!BC::$instance->Game->checkCommonIdUnsafe($commonId)) {
            return self::unauthorized();
        }

        $name = trim($name, "'\"");

        $res = UserModel::updateNickname($commonId, $name);

        return json_encode(
            [
                'result' => $res ? 'saved' : 'error',
                'message' => $res ? T::S('Nickname updated') : T::S('Error saving Nick change')
            ],
            JSON_UNESCAPED_UNICODE
        );
    }

    public function mergeAction()
    {
        $commonId = PlayerModel::getPlayerCommonId(self::$Request[self::TG_ID_PARAM]);
        if (!$commonId) {
            return ['result' => 'error', 'message' => T::S('Player not found')];
        }

        return $this->mergeTheIDs(self::$Request[self::SECRET_PARAM], $commonId);
    }

    public function addRefAction(): string
    {
        $salt = Config::$config['SALT'];
        $method = 'addRef';

        $sign = md5(
            $salt . $method . implode(
                '',
                array_map(fn($key) => $key . self::$Request[$key] ?? '', self::ADD_REF_PARAMS_ORDER)
            )
        );
        $res = ['result' => 'error'];

        if ($sign !== self::$Request[self::SIGN_PARAM]) {
            return json_encode($res);
        }

        /**
         * @var ?RefModel $ref
         */
        $ref = RefModel::getCustomO(
            RefModel::REF_TG_ID_FIELD,
            '=',
            self::$Request[self::REF_TG_ID_PARAM],
            true
        )[0] ?? null;

        if (!$ref) {
            return json_encode($res);
        }

        if (BalanceModel::changeBalance(
            self::$Request[self::COMMON_ID_PARAM],
            MonetizationService::REWARD[AchievesModel::DAY_PERIOD],
            'Referral bonus for ' . $ref->_name,
            BalanceHistoryModel::TYPE_IDS[BalanceHistoryModel::MOTIVATION_TYPE]
        )) {
            $res['result'] = 'success';
        }

        return json_encode($res);
    }

    public function hideBalanceAction(): string
    {
        $res = [];
        $res['message'] = T::S('Error changing settings. Try again later');

        $hide = self::$Request[self::HIDE_PARAM] ?? false;

        $commonId = self::$Request[self::COMMON_ID_PARAM] ?? false;

        if ($commonId && PlayerModel::validateCommonIdByCookie(
                $commonId,
                $_COOKIE[Cookie::COOKIE_NAME] ?? 'aaabbbccc'
            )) {
            if (in_array($hide, self::PARAM_VALUES[self::HIDE_PARAM])) {
                $user = UserModel::getOneO($commonId, true);

                $user->_is_balance_hidden = $hide === self::HIDE;

                if ($user->save()) {
                    $balance = BalanceModel::getBalanceFormatted($user->_id);
                    $res['balance'] = $user->_is_balance_hidden
                        ? "**$balance**"
                        : $balance;
                    $res[UserModel::BALANCE_HIDDEN_FIELD] = (bool)($user->_is_balance_hidden ?? false);
                    unset($res['message']);
                }
            }
        }

        return json_encode(
            $res,
            JSON_UNESCAPED_UNICODE
        );
    }

    public function infoAction(): string
    {
        // todo проверять куки на соответствие common_id

        $gameId = self::$Request[BaseSubController::GAME_ID_PARAM] ?? false;
        $commonId = self::$Request[self::COMMON_ID_PARAM] ?? false;
        $res = [];

        // SUD-9 todo переделать на классы GameStatus
        if ($gameId && $gameId > 0 && $commonId) {
            $gameStatus = BC::$instance->Game->gameStatus;


            if ($gameStatus && is_array($gameStatus->users)) {
                foreach ($gameStatus->users as $numUser => $user) {
                    $res[$numUser]['common_id'] = $user->common_id ?? 0;
                    $res[$numUser]['you'] = $res[$numUser]['common_id'] == $commonId;

                    if ($res[$numUser]['common_id'] == 0) {
                        continue;
                    }

                    $thisUser = UserModel::getOneO($res[$numUser]['common_id'], true);

                    $res[$numUser]['nickname'] = $thisUser->_name
                        ?: PlayerModel::getPlayerName($user);

                    $res[$numUser]['avatar_url'] = $thisUser->_avatar_url
                        ?? PlayerModel::getAvatarUrl($thisUser->_id, true);

                    $res[$numUser]['stats_url'] = '/' . StatsController::getUrl(
                            'viewV2',
                            [StatsController::COMMON_ID_PARAM => $thisUser->_id]
                        );

                    $res[$numUser][UserModel::BALANCE_HIDDEN_FIELD] = ($thisUser->_is_balance_hidden ?? false);

                    $balance = BalanceModel::getBalanceFormatted($thisUser->_id);
                    $res[$numUser]['balance'] = !($thisUser->_is_balance_hidden ?? false)
                        ? $balance
                        : (
                        $res[$numUser]['you']
                            ? "**$balance**"
                            : BalanceModel::HIDDEN_BALANCE_REPLACEMENT
                        );

                    $res[$numUser]['rating'] = CommonIdRatingModel::getRating($thisUser->_id, BC::gameName());
                    $res[$numUser]['rating_position'] = CommonIdRatingModel::getTopByRating(
                        $res[$numUser]['rating'],
                        BC::gameName()
                    );

                    $res[$numUser]['games_played'] = RatingHistoryModel::getNumGamesPlayed(
                        $thisUser->_id,
                        BC::gameName()
                    );

                    if ($res[$numUser]['rating_position'] <= 10) {
                        $res[$numUser]['top_bage_url'] = 'img/prizes/top_'
                            . ($res[$numUser]['rating_position'] <= 3 ? $res[$numUser]['rating_position'] : '10')
                            . '.svg';
                    }

                    $achieves = AchievesModel::getCurrentAchievesByCommonId($thisUser->_id);
                    if (!empty($achieves)) {
                        StatsController::addTranslationsToAchieves($achieves);
                        $res[$numUser]['achieves'] = $achieves;
                    }
                }
            }
        }

        return json_encode(
            $res,
            JSON_UNESCAPED_UNICODE
        );
    }

    private function mergeTheIDs($encryptedMessage, $commonID, $secretKey = '')
    {
        $secretKey = $secretKey ?: Config::$config['SALT'];
        $method = 'AES-128-CBC';
        $iv = base64_decode(Config::$config['IV'] . '==');
        $decrypted_message = openssl_decrypt($encryptedMessage, $method, $secretKey, 0, $iv);

        if (!is_numeric($decrypted_message)) {
            return
                [
                    'result' => 'error_decryption' . ' ' . $decrypted_message,
                    'message' => T::S('Key transcription error')
                ];
        }

        $oldCommonID = UserModel::getCustom(
            'id',
            '=',
            $decrypted_message,
            false,
            false,
            ['id']
        )[0]['id'] ?? false;

        if ($oldCommonID === false) {
            return
                [
                    'result' => 'error_query_oldID',
                    'message' => T::S("Player's ID NOT found by key")
                ];
        }

        if (PlayerModel::setParamMass(
            'common_id',
            $oldCommonID,
            [
                'field_name' => 'common_id',
                'condition' => '=',
                'value' => $commonID,
                'raw' => true
            ]
        )
        ) {
            return
                [
                    'result' => 'save',
                    'message' => T::S('Accounts linked')
                ];
        } else {
            return
                [
                    'result' => 'error_update ' . $oldCommonID . '->' . $commonID,
                    'message' => T::S('Accounts are already linked')
                ];
        }
    }

    private static function getImgFormatFromUrl(mixed $url): string
    {
        foreach (self::IMAGE_FORMATS as $ext => $format) {
            if (str_contains($url, $ext)) {
                return $format;
            }
        }

        return '';
    }

}