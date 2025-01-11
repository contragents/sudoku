<?php

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
 * @property string $gameName // Название текущей игры
 */

class BaseSubController
{
    public static $Request;

    const COMMON_ID_PARAM = BaseController::COMMON_ID_PARAM;
    const TG_ID_PARAM = BaseController::TG_ID_PARAM;

    public $Action;

    public function __construct($action, array $request)
    {
        static::$Request = $request;

        $this->Action = $action . 'Action';
    }

    public function Run(): string
    {
        if (is_callable([$this, $this->Action])) {
            $res = $this->{$this->Action}();
            return  is_array($res) ? Response::jsonResp($res) : (string)$res;

        } else {
            return $this->forbiddenAction();
        }
    }

    private function forbiddenAction(): string
    {
        header('HTTP/1.0 403 Forbidden');
        echo T::S('Доступ запрещен');

        exit;
    }
}
