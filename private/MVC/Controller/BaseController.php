<?php

use classes\Config;
use classes\Cookie;
use classes\FrontResource;
use classes\Game;
use classes\Response;
use classes\StateMachine;
use classes\T;
use classes\Tg;
use classes\UserProfile;
use classes\ViewHelper;

/**
 * @property string $gameName // Название текущей игры __get()..
 */

class BaseController
{
    const TITLE = "Game";
    const GAME_URL = Config::BASE_URL . "game_name/"; // Используются только константы наследников
    const SITE_NAME = Config::DOMAIN;


    const DESCRIPTION = 'In Game, the objective is to WIN!';
    const FB_IMG_URL = 'https://' . Config::ERUDIT_DOMAIN . '/img/share/hor_640_360.png';
    const FORCE_ACTIONS = [
        self::GAME_STATE_PARAM . 'Action',
        'mainScript' . 'Action',
        'index' . 'Action',
    ];
    const MAX_UPLOAD_SIZE = 2 * 1024 * 1024;
    const GAME_STATE_PARAM = 'gameState';

    public static ?BaseController $instance = null;
    public Game $Game;
    public static StateMachine $SM;
    public static FrontResource $FR;

    public static $Request;
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

    const SLEEP_ACTIONS = ['statusHiddenChecker' => 10];

    const COOKIE_KEY = 'erudit_user_session_ID'; // один cookie на все игры

    public function __construct($action, array $request)
    {
        static::$Request = $request;
        self::$User = $this->checkCookie();

        self::$commonId = Tg::$commonId // авторизован через Телеграм или...
            ?? PlayerModel::getPlayerCommonId(self::$User, true);

        self::$instance = $this;

        $this->Action = $action . 'Action';
        $this->ActionRaw = $action;

        sleep(self::SLEEP_ACTIONS[$action] ?? 0);
    }

    public static function saveGameStatus()
    {
        self::$instance->Game->storeGameStatus();
    }

    public function Run(): string
    {
        self::cors();

        foreach (self::$Request as $param => $value) {
            if (isset(self::JSON_DECODE_PARAMS[$param])) {
                //print self::$Request[$param];
                self::$Request[$param] = json_decode($value, true);
                //print_r(self::$Request[$param]);
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
            return is_array($res) ? Response::jsonResp($this->Game->submitTurn(), $this->Game) : (string)$res;
            //return $this->{$this->Action}();
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

    public function playersAction()
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

    private function callSubController(string $controller, string $action): string
    {
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
        if (Tg::authorize()) {
            if (Tg::$tgUser) {
                return Tg::$tgUser['user']['id'];
            }
        }

        /**
         * @var string $cookieKey
         */

        if (!isset($_COOKIE[Cookie::COOKIE_NAME])) {
            $_COOKIE = Cookie::setGetCook(null, Cookie::COOKIE_NAME);
        } elseif (rand(1, 100) <= 2) {
            $_COOKIE = Cookie::setGetCook($_COOKIE[Cookie::COOKIE_NAME], Cookie::COOKIE_NAME);
        }

        return $_COOKIE[Cookie::COOKIE_NAME] ?? null;
    }

    public function mainScriptAction()
    {
        include static::VIEW_PATH . 'mainScript/main.js';
    }

    public function indexAction()
    {
        $title = T::S(static::TITLE);
        $url = static::GAME_URL;
        $siteName = static::SITE_NAME;
        $description = static::DESCRIPTION;
        $fbImgUrl = static::FB_IMG_URL;

        include self::VIEW_PATH . 'index.html.php';
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
        return Response::jsonResp($this->Game->checkGameStatus(), $this->Game);
    }

    public function turnSubmitterAction(): string
    {
        return Response::jsonResp($this->Game->submitTurn(), $this->Game);
    }

    public function gameStateAction(): string
    {
        $gameStatus = $this->Game->getGameStatus(self::$Request['game_id'] ?? null);

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
        return (stripos($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '', 'ru') !== false)
            ? T::RU_LANG
            : T::EN_LANG;
    }

    public function __get($attr)
    {
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

    public static function getUrl(string $action, array $params = [], array $excludedParams = [])
    {
        return static::GAME_URL
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
}
