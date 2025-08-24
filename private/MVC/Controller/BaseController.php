<?php

use classes\Cache;
use classes\Config;
use classes\Cookie;
use classes\FrontResource;
use classes\Game;
use classes\Response;
use classes\StateMachine;
use classes\Steam;
use classes\SudokuGame;
use classes\T;
use classes\Tg;
use classes\UserProfile;
use classes\ViewHelper;
use classes\Yandex;

/**
 * @property string $gameName // Название текущей игры __get()..
 */
class BaseController
{
    const FORCE_ACTIONS = [
        self::GAME_STATE_PARAM . 'Action',
        'mainScript' . 'Action',
        'index' . 'Action',
    ];

    const MAX_UPLOAD_SIZE = 2 * 1024 * 1024;
    const GAME_STATE_PARAM = 'gameState';
    const MESSAGE_PARAM = 'messageText';
    const CHAT_TO_PARAM = 'chatTo';
    const GAME_ID_PARAM = 'game_id';
    const COMMON_ID_HASH_PARAM = 'common_id_hash';
    const LANG_PARAM = 'lang';
    const REF_LANG_PARAM = 'l';
    const VERSION_PARAM = 'version';
    const USER_LANGUAGE_KEY = 'user.language_storage';

    const VERSION_DEFAULT_YANDEX = '1.0.0.3'; //Версия для яндекса для совместимости до модерации
    const VERSION_DEFAULT = '1.0.0.3'; // Версия для остальных
    const APP_PARAM = 'app';
    const PAGE_HIDDEN_PARAM = 'page_hidden'; // = 'true' - значит вкладки скрыта/закрыта
    const PAGE_HIDDEN_SLEEP_TIME = 10; // Если страница скрыта (невидна), мы ждем 10 секунд и отдаем норамльный ответ

    public static ?BaseController $instance = null;
    public Game $Game;
    public static StateMachine $SM;
    public static FrontResource $FR;

    public static $Request;
    public static $Referer;
    public static string $version = self::VERSION_DEFAULT;

    const SUB_ACTION_PARAM = 'sub_action';

    const TG_ID_PARAM = 'tg_id';
    const COMMON_ID_PARAM = 'common_id';
    const CELLS_PARAM = 'cells';
    const JSON_DECODE_PARAMS = [self::CELLS_PARAM => true];

    public string $Action; // action . 'Action'
    public string $ActionRaw; // action - используется в BaseSubController::getUrl

    public static ?string $User = null;
    public static ?int $commonId = null;

    const VIEW_PATH = __DIR__ . '/../View/';
    const DEFAULT_ACTION = 'index';
    const DEFAULT_CONTROLLER = SudokuController::class;

    const SLEEP_ACTIONS = ['statusHiddenChecker' => 10];

    const COOKIE_KEY = 'erudit_user_session_ID'; // один cookie на все игры

    public function __construct($action, array $request)
    {
        self::cors();

        static::$Request = $request;


        self::$Referer = self::decodeRefererQuery();

        self::$version = self::$Request[self::VERSION_PARAM]
            ?? (self::$Referer[self::VERSION_PARAM]
                ?? (
                Yandex::isYandexApp()
                    ? self::VERSION_DEFAULT_YANDEX
                    : self::VERSION_DEFAULT
                )
            );

        self::$User = $this->checkCookie();

        self::$commonId = Steam::$commonId // авторизован через Steam или...
            ?? (Tg::$commonId // авторизован через Телеграм или...
            ?? (Yandex::$commonId // авторизован через Яндекс или...
                ?? PlayerModel::getPlayerCommonId(self::$User, true)));

        self::$instance = $this;

        $this->Action = $action . 'Action';
        $this->ActionRaw = $action;

        sleep(self::SLEEP_ACTIONS[$action] ?? 0);
    }

    public static function saveGameStatus()
    {
        self::$instance->Game->storeGameStatus();
    }

    private static function decodeRefererQuery(): array
    {
        $refererParams = [];
        parse_str(parse_url(urldecode($_SERVER['HTTP_REFERER'] ?? ''), PHP_URL_QUERY) ?? '', $refererParams);

        return $refererParams;
    }

    public static function FB_IMG_URL(): string
    {
        return 'https://' . Config::DOMAIN(
            ) . '/' . SudokuGame::GAME_NAME . '/img/share/hor_640_360.png'; // todo Подставить имя игры
    }

    public static function GAME_URL(): string
    {
        return Config::BASE_URL() . "game_name/"; // Используются только константы наследников
    }

    public static function SITE_NAME(): string
    {
        return Config::DOMAIN();
    }

    public function Run()
    {
        foreach (self::$Request as $param => $value) {
            if (isset(self::JSON_DECODE_PARAMS[$param])) {
                self::$Request[$param] = json_decode($value, true);
            }

            // отфильтруем NULL-значения параметров
            if ($value === 'NULL') {
                unset(self::$Request[$param]);
            }
        }

        T::$lang = self::setLanguage();

        if (self::$User === null) {
            // todo переделать на json-ответ
            return $this->forbiddenAction();
        }

        // Response получен в процессе Game->__construct() - выводим сразу без Action
        if ($this->Game->Response !== null && !in_array($this->Action, static::FORCE_ACTIONS)) {
            return Response::jsonResp($this->Game->Response);
        }

        if (is_callable([$this, $this->Action])) {
            $res = $this->{$this->Action}();
            //return is_array($res) ? Response::jsonResp($res, $this->Game) : (string)$res;
            return $res;
        } else {
            return $this->forbiddenAction();
        }
    }

    public function payAction()
    {
        return $this->callSubController(
            'PayController',
            self::$Request[self::SUB_ACTION_PARAM] ?: ''
        );
    }

    public
    function playersAction()
    {
        return $this->callSubController(
            'PlayersController',
            self::$Request[self::SUB_ACTION_PARAM] ?: PlayersController::DEFAULT_ACTION
        );
    }

    public function faqAction()
    {
        return $this->callSubController(
            'FaqController',
            self::$Request[self::SUB_ACTION_PARAM] ?: FaqController::DEFAULT_ACTION
        );
    }

    public function statsAction()
    {
        return $this->callSubController(
            'StatsController',
            self::$Request[self::SUB_ACTION_PARAM] ?: StatsController::DEFAULT_ACTION
        );
    }

    private function callSubController(
        string $controller,
        string $action
    ): string {
        return (new $controller($action, $_REQUEST))->Run();
    }

    public function forbiddenAction(): string
    {
        header('HTTP/1.0 403 Forbidden');
        echo T::S('Forbidden');

        exit;
    }

    private function checkCookie(): ?string
    {
        if (Steam::authorize()) {
            if (Steam::$steamUser) {
                return Steam::$steamUser;
            }
        }

        if (Tg::authorize()) {
            if (Tg::$tgUser) {
                return Tg::$tgUser['user']['id'];
            }
        }

        if (Yandex::authorize()) {
            if (Yandex::$yandexUser) {
                return Yandex::$yandexUser;
            }
        }


        if (!isset($_COOKIE[Cookie::COOKIE_NAME])) {
            $_COOKIE = Cookie::setGetCook(null, Cookie::COOKIE_NAME);
        } elseif (rand(1, 100) <= 2) {
            $_COOKIE = Cookie::setGetCook($_COOKIE[Cookie::COOKIE_NAME], Cookie::COOKIE_NAME);
        }

        if (($_COOKIE[Cookie::COOKIE_NAME] ?? null) && isset(self::$Request[self::COMMON_ID_PARAM]) && isset(self::$Request[self::COMMON_ID_HASH_PARAM])) {
            if (PayController::checkCommonIdHash(
                self::$Request[self::COMMON_ID_PARAM],
                self::$Request[self::COMMON_ID_HASH_PARAM]
            )) {
                $commonId = PlayerModel::getPlayerCommonId($_COOKIE[Cookie::COOKIE_NAME]);

                // Привязываем куки к common_id только если пользователь еще не заходил в игру
                if (!$commonId) {
                    $cookie = $_COOKIE[Cookie::COOKIE_NAME];
                    $added = PlayerModel::add(
                        [
                            PlayerModel::COMMON_ID_FIELD => self::$Request[self::COMMON_ID_PARAM],
                            PlayerModel::COOKIE_FIELD => $cookie,
                        ]
                    );

                    // Cache::hset('sudoku_button_test', $_COOKIE[Cookie::COOKIE_NAME], ['added' => $added, self::$Request[self::COMMON_ID_PARAM], $cookie]);

                    return $_COOKIE[Cookie::COOKIE_NAME];
                }
            } else {
                // Cache::hset('sudoku_button_test', $_COOKIE[Cookie::COOKIE_NAME], ['check_failed', self::$Request[self::COMMON_ID_PARAM], self::$Request[self::COMMON_ID_HASH_PARAM]]);
            }
        }

        return $_COOKIE[Cookie::COOKIE_NAME] ?? null;
    }

    public function mainScriptAction()
    {
        include static::VIEW_PATH . 'mainScript/main.js';
    }

    public static function TITLE(): string
    {
        return T::S('game_title');
    }

    public function indexAction()
    {
        $title = T::S(static::TITLE());
        $url = static::GAME_URL();
        $siteName = static::SITE_NAME();
        $description = strip_tags(T::S('faq_rules'));
        $fbImgUrl = static::FB_IMG_URL();

        include(self::VIEW_PATH
            . (Steam::isSteamApp()
                ? 'index_steam.html.php'
                : 'index.html.php'
            ));
    }

    public function initGameAction(): string
    {
        $newPlayerStatus = BaseController::$SM::setPlayerStatus(self::$SM::STATE_INIT_GAME);

        if ($newPlayerStatus == BaseController::$SM::STATE_INIT_GAME) {
            $this->Game->Queue::cleanUp($this->Game->User);
            $this->Game->clearUserGameNumber();
            $this->Game->Queue->init();
            $res = $this->Game->Queue->doSomethingWithThisStuff();
        } else {
            $res = Response::state($newPlayerStatus);
        }

        return Response::jsonResp($res, $this->Game);
    }

    public function newGameAction(): string
    {
        return Response::jsonResp($this->Game->newGame(), $this->Game);
    }

    public function inviteToNewGameAction()
    {
        // Если в игре остаются игроки, то ничего не делать
        if ($this->Game->getActiveUsersCount() > 2) {
            return ['message' => T::S('Request denied. Game is still ongoing')];
        }

        $this->Game->gameStatus->isInviteGame = false; // Отменяем признак игы на реванш, чтобы не путать со следующей игрой

        // Если игрок решил сдаться и отправить вызов на реванш
        if (in_array(self::$SM::getPlayerStatus(self::$User), self::$SM::IN_GAME_STATES)) {
            $this->Game->storeGameResults($this->Game->lost3TurnsWinner($this->Game->numUser, true));
        }

        $this->Game->gameStatus->invite_accepted_users[self::$User] = self::$User;

        if (!isset($this->Game->gameStatus->invite)) {
            $this->Game->gameStatus->invite = self::$User;
            $message = T::S('New game request sent');
        } elseif ($this->Game->gameStatus->invite === self::$User) {
            $message = T::S('Your new game request awaits players response');
        } else {
            $message = T::S('Request was aproved! Starting new game');
            $this->Game->gameStatus->invite = self::$SM::NEW_INVITE_GAME_STARTED_STATE;

            // Если игрок подтверждает приглашение, то его отключают от игры, дают статус InitGame, помещают в очередь инвайта
            $this->Game->exitGame($this->Game->numUser);

            // Удаляем из игры пригласившего игрока
            if (isset($this->Game->gameStatus->{$this->Game->gameStatus->invite})) {
                $this->Game->exitGame($this->Game->gameStatus->{$this->Game->gameStatus->invite});
            }

            $this->Game->Queue->storePlayerToInviteQueue(self::$User);
        }

        return ['message' => $message, 'inviteStatus' => $this->Game->gameStatus->invite];
    }

    function sendChatMessageAction(): array
    {
        $resp = ['message' => T::S('Error sending message')];

        if (!empty(self::$Request[self::MESSAGE_PARAM])) {
            $resp = $this->Game->addToChat(
                self::$Request[self::MESSAGE_PARAM],
                self::$Request[self::CHAT_TO_PARAM] ?? null
            );
        }

        return $resp;
    }

    public function complainAction()
    {
        $resp = ['message' => T::S('Error sending complaint<br><br>Choose opponent')];

        if (isset(self::$Request[self::CHAT_TO_PARAM]) && is_numeric(self::$Request[self::CHAT_TO_PARAM])) {
            $resp = $this->Game->addComplain((int)self::$Request[self::CHAT_TO_PARAM]);
        }

        return $resp;
    }

    /**
     * Вызывается в момент закрытия вкладки в браузере
     * @return string
     */
    public function setInactiveAction(): string
    {
        $gameStatus = $this->Game->gameStatus;
        unset($gameStatus->users[$this->Game->numUser]->lastActiveTime);
        $gameStatus->users[$this->Game->numUser]->inactiveTurn = $gameStatus->turnNumber;

        foreach (T::SUPPORTED_LANGS as $lang) {
            $this->Game->addToLog(T::S('Closed game window', null, $lang), $lang, $this->Game->numUser);
        }


        return Response::jsonResp([], $this->Game);
    }

    public function statusHiddenCheckerAction(): string
    {
        sleep(10);

        return $this->statusCheckerAction();
    }

    public function playerCabinetAction(): string
    {
        return Response::jsonResp(UserProfile::playerCabinetInfo($this->Game), $this->Game);
    }

    public function statusCheckerAction(): string
    {
        if (self::$Request[self::PAGE_HIDDEN_PARAM] ?? false === 'true') {
            sleep(self::PAGE_HIDDEN_SLEEP_TIME);
        }

        return Response::jsonResp($this->Game->checkGameStatus(), $this->Game);
    }

    public function turnSubmitterAction(): string
    {
        return Response::jsonResp($this->Game->submitTurn(), $this->Game);
    }

    public function gameStateAction(): string
    {
        $gameStatus = $this->Game->getGameStatus(self::$Request[self::GAME_ID_PARAM] ?? null);

        if ($gameStatus->gameNumber === null) {
            return 'Game not found';
        }

        $res = [];
        foreach ($gameStatus->users as $user) {
            $res['users'][$user->ID]['state'] = BaseController::$SM::getPlayerStatus($user->ID);
        }

        return ViewHelper::tag(
            'pre',
            Response::jsonResp($res)
            . Response::jsonObjectResp($gameStatus),
        );
    }

    private static function setLanguage(): string
    {
        // Главный приоритет выбора языка - параметр "l" в адресе браузера (реферере)
        if (!empty(self::$Referer[self::REF_LANG_PARAM])
            && in_array(strtoupper(self::$Referer[self::REF_LANG_PARAM]), T::SUPPORTED_LANGS)) {
            return strtoupper(self::$Referer[self::REF_LANG_PARAM]);
        }

        // При отдаче indexView ищем параметр в Реквесте, а не в Реферере
        if (!empty(self::$Request[self::REF_LANG_PARAM])
            && in_array(strtoupper(self::$Request[self::REF_LANG_PARAM]), T::SUPPORTED_LANGS)) {
            return strtoupper(self::$Request[self::REF_LANG_PARAM]);
        }

        // Определение языка для Яндекс.игр - присылаем параметр lang из браузера
        if (isset(self::$Request[self::LANG_PARAM]) && in_array(
                strtoupper(self::$Request[self::LANG_PARAM]),
                T::SUPPORTED_LANGS
            )) {
            if (Yandex::isYandexApp()) {
                Cache::hset(self::USER_LANGUAGE_KEY, self::$User, strtoupper(self::$Request[self::LANG_PARAM]));

                if (isset($_COOKIE[Cookie::COOKIE_NAME])) {
                    Cache::hset(
                        self::USER_LANGUAGE_KEY,
                        $_COOKIE[Cookie::COOKIE_NAME],
                        strtoupper(self::$Request[self::LANG_PARAM])
                    );
                }
            }

            return strtoupper(self::$Request[self::LANG_PARAM]);
        }

        // Для Я.игр ищем язык пользователя в кеше
        if (Yandex::isYandexApp() && $lang = Cache::hget(self::USER_LANGUAGE_KEY, self::$User)) {
            return $lang;
        }

        if (Yandex::isYandexApp()
            && isset($_COOKIE[Cookie::COOKIE_NAME])
            && $lang = Cache::hget(
                self::USER_LANGUAGE_KEY,
                $_COOKIE[Cookie::COOKIE_NAME]
            )) {
            return $lang;
        }


        $preferredLangPos = [];
        foreach (T::SUPPORTED_LANGS as $lang) {
            $langPos = strpos($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '', strtolower($lang));
            if ($langPos !== false) {
                $preferredLangPos[$lang] = $langPos;
            }
        }

        if (count($preferredLangPos)) {
            asort($preferredLangPos);

            return strtoupper(key($preferredLangPos));
        }

        return (stripos($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '', 'ru') !== false)
            ? T::RU_LANG
            : T::EN_LANG;
    }

    public function __get(
        $attr
    ) {
        if (is_callable([$this, $attr])) {
            return $this->{$attr}();
        }

        return null;
    }

    public static function gameName(): ?string
    {
        return self::$instance
            ? self::$instance->Game::GAME_NAME
            : null;
    }

    public static function isAjaxRequest(): bool
    {
        return (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
    }

    public static function getUrl(
        string $action,
        array $params = [],
        array $excludedParams = []
    ) {
        return static::GAME_URL()
            . $action . '/'
            . (!empty($params)
                ? ('?' . implode(
                        '&',
                        array_filter(
                            array_map(
                                fn($param, $value) => !in_array($param, $excludedParams) ? "$param=$value" : null,
                                array_keys($params),
                                $params
                            )
                        )
                    )
                )
                : '');
    }

    private static function cors()
    {
        if (isset($_SERVER['HTTP_ORIGIN']) && $_SERVER['HTTP_ORIGIN'] != '') {
            header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
            header('Access-Control-Allow-Credentials: true');
        }
    }

    public function debugAction(): array
    {
        return [
            'Game' => var_export($this->Game, true)
        ];
    }

    public function translateAction(): string
    {
        print \classes\Deepl::translateTClass(T::ES_LANG);

        exit;
    }

    function testAction(): string
    {

        print_r(\classes\ApcuCache::exists(76561199869241805));
        print_r( \classes\ApcuCache::get(76561199869241805));
        print_r(apcu_cache_info());

        return '0';
    }
}
