<?php

use classes\Cookie;
use classes\Game;
use classes\Response;
use classes\StateMachine;

class BaseController
{
    const TITLE = "Game";
    const URL = "https://xn--d1aiwkc2d.club/game/";
    const SITE_NAME = "5-5.su/game";
    const DESCRIPTION = 'In Game, the objective is to WIN!';
    const FB_IMG_URL = "https://xn--d1aiwkc2d.club/img/share/hor_640_360.png";

    public Game $Game;
    public static StateMachine $SM;

    public static $Request;
    public $Action;
    public static ?string $User = null;

    const VIEW_PATH = __DIR__ . '/../View/';
    const DEFAULT_ACTION = 'index';

    public function __construct($action, array $request)
    {
        static::$Request = $request;
        self::$User = $this->checkCookie();

        $this->Action = $action . 'Action';
    }

    public function Run()
    {
        if (self::$User === null) {
            // todo переделать на json-ответ
            return $this->forbiddenAction();
        }

        if (is_callable([$this, $this->Action])) {
            return $this->{$this->Action}();
        } else {
            return $this->forbiddenAction();
        }
    }

    /**
     * @param string $viewName = 'Index'
     * @return string
     */
    protected function render($viewName = 'Index'): string
    {
        $res = self::include(static::VIEW_PATH . $viewName . 'View.php');
        return nl2br($res);
    }

    private function include($filename)
    {
        if (is_file($filename)) {
            ob_start();
            include $filename;

            return ob_get_clean();
        }

        return '';
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
        $fb_img_url = static::FB_IMG_URL;

        include self::VIEW_PATH . 'index.html.php';
    }

    public function initGameAction(): string
    {
        $newPlayerStatus = BaseController::$SM::setPlayerStatus(self::$SM::STATE_INIT_GAME, null, false);

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
        return Response::jsonResp($this->Game->newGame());
    }

    public function statusCheckerAction(): string
    {
        return Response::jsonResp($this->Game->checkGameStatus(), $this->Game);
    }

    public function turnSubmitterAction(): string
    {
        return Response::jsonResp($this->Game->submitTurn(), $this->Game);
    }
}
