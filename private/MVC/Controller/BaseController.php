<?php

use classes\Cookie;
use classes\FrontResource;
use classes\Game;
use classes\Response;
use classes\StateMachine;
use classes\T;
use classes\ViewHelper;

class BaseController
{
    const TITLE = "Game";
    const URL = "https://xn--d1aiwkc2d.club/game/";
    const SITE_NAME = "5-5.su/game";
    const DESCRIPTION = 'In Game, the objective is to WIN!';
    const FB_IMG_URL = "https://xn--d1aiwkc2d.club/img/share/hor_640_360.png";
    const FORCE_ACTIONS = [
        'gameState' . 'Action',
        'mainScript' . 'Action',
        'index' . 'Action',
    ];

    public static ?BaseController $instance = null;
    public Game $Game;
    public static StateMachine $SM;
    public static FrontResource $FR;

    public static $Request;
    public $Action;
    public static ?string $User = null;

    const VIEW_PATH = __DIR__ . '/../View/';
    const DEFAULT_ACTION = 'index';

    const SLEEP_ACTIONS = ['statusHiddenChecker' => 10];

    public function __construct($action, array $request)
    {
        static::$Request = $request;
        self::$User = $this->checkCookie();
        self::$instance = $this;

        $this->Action = $action . 'Action';

        sleep(self::SLEEP_ACTIONS[$action] ?? 0);
    }

    public static function saveGameStatus()
    {
        self::$instance->Game->storeGameStatus();
    }

    public function Run()
    {
        T::$lang = self::setLanguage();

        if (self::$User === null) {
            // todo переделать на json-ответ
            return $this->forbiddenAction();
        }

        if ($this->Game->Response !== null && !in_array($this->Action, static::FORCE_ACTIONS)) {
            return Response::jsonResp($this->Game->Response);
        }

        if (is_callable([$this, $this->Action])) {
            return $this->{$this->Action}();
        } else {
            return $this->forbiddenAction();
        }
    }

    private function forbiddenAction(): string
    {
        header('HTTP/1.0 403 Forbidden');

        echo 'Доступ запрещен';
        exit();
    }

    private function checkCookie(): ?string
    {
        if (!isset($_COOKIE[self::$SM::$cookieKey])) {
            $_COOKIE = Cookie::setGetCook(null, self::$SM::$cookieKey);
        } elseif (rand(1, 100) <= 2) {
            $_COOKIE = Cookie::setGetCook($_COOKIE[self::$SM::$cookieKey], self::$SM::$cookieKey);
        }

        return $_COOKIE[self::$SM::$cookieKey] ?? null;
    }

    public function lanAction(): string
    {
        return T::$lang;
    }

    public function mainScriptAction()
    {
        include static::VIEW_PATH . 'mainScript/main.js';
    }

    public function indexAction()
    {
        $title = static::TITLE;
        $url = static::URL;
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
        foreach($gameStatus->users as $user) {
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
}
