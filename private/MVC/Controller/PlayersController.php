<?php

use classes\Cache;
use classes\Config;
use classes\Game;
use classes\T;

class PlayersController extends BaseSubController
{
    const GAME_ID_PARAM = 'game_id';
    const HIDE_PARAM = 'hide'; // hide/show

    const SIGN_PARAM = 'sign';
    const REF_TG_ID_PARAM = 'ref_tg_id';
    const ADD_REF_PARAMS_ORDER = [self::COMMON_ID_PARAM, self::REF_TG_ID_PARAM];
    const SECRET_PARAM = 'secret';

    const PARAM_VALUES = [
        self::HIDE_PARAM => [self::HIDE, self::SHOW],
    ];

    const COMMON_URL = 'players/';
    const HIDE = 'hide';
    const SHOW = 'show';
    const DEFAULT_ACTION = 'index';

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
        $salt = Config::$envConfig['SALT'];
        $method = 'addRef';

        $sign = md5($salt . $method . implode('', array_map(fn($key) => $key . self::$Request[$key] ?? '', self::ADD_REF_PARAMS_ORDER)));
        $res = ['result' => 'error'];

        if($sign !== self::$Request[self::SIGN_PARAM]) {
            return json_encode($res);
        }

        /**
         * @var ?RefModel $ref
         */
        $ref = RefModel::getCustomO(RefModel::REF_TG_ID_FIELD, '=', self::$Request[self::REF_TG_ID_PARAM], true)[0] ?? null;

        if (!$ref) {
            return json_encode($res);
        }

        if (BalanceModel::changeBalance(self::$Request[self::COMMON_ID_PARAM], MonetizationService::REWARD[AchievesModel::DAY_PERIOD], 'Referral bonus for ' . $ref->_name, BalanceHistoryModel::TYPE_IDS[BalanceHistoryModel::MOTIVATION_TYPE])) {
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

        if($commonId && PlayerModel::validateCommonIdByCookie($commonId, $_COOKIE[Cookie::COOKIE_NAME] ?? 'aaabbbccc')) {
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

        $gameId = self::$Request[self::GAME_ID_PARAM] ?? false;
        $commonId = self::$Request[self::COMMON_ID_PARAM] ?? false;
        $res = [];

        // SUD-15 todo переделать на классы GameStatus
        if ($gameId && $gameId > 0 && $commonId) {
            $gameStatus = Cache::get(Game::GAME_STATUS_KEY . $gameId);

            if (is_array($gameStatus)) {
                foreach ($gameStatus['users'] ?? [] as $numUser => $user) {
                    $res[$numUser]['common_id'] = $user['common_id'] ?? 0;
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

                    $res[$numUser]['rating'] = CommonIdRatingModel::getRating($thisUser->_id, Game::$gameName);
                    $res[$numUser]['rating_position'] = CommonIdRatingModel::getTopByRating(
                        $res[$numUser]['rating'],
                        Game::GAME_NAME
                    );

                    $res[$numUser]['games_played'] = RatingHistoryModel::getNumGamesPlayed(
                        $thisUser->_id,
                        Game::GAME_NAME
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
        $secretKey = $secretKey ?: Config::$envConfig['SALT'];
        $method = 'AES-128-CBC';
        $iv = base64_decode(Config::$envConfig['IV'] . '==');
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
}