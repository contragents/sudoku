<?php

use classes\Response;
use classes\T;
use BaseController as BC;

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
            return BC::$instance->forbiddenAction();
        }
    }

    protected static function unauthorized()
    {
        return json_encode(
            [
                'result' => 'error',
                'message' => T::S('Authorization error')
            ],
            JSON_UNESCAPED_UNICODE
        );
    }
}
