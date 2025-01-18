<?php

use classes\Config;
use classes\Response;
use classes\T;
use BaseController as BC;

class BaseSubController
{
    public static $Request;

    const COMMON_ID_PARAM = BaseController::COMMON_ID_PARAM;
    const TG_ID_PARAM = BaseController::TG_ID_PARAM;

    const DEFAULT_ACTION = 'index';

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

    public static function getUrl(string $action, array $params = [], array $excludedParams = [])
    {
        return BC::$instance::GAME_URL
            . BC::$instance->ActionRaw . '/'
            . $action
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
}
