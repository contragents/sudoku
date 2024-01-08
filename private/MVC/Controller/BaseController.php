<?php

class BaseController
{
    public static $Request;
    public $Action;

    const VIEW_PATH = __DIR__ . '/../View/';
    const DEFAULT_ACTION='index';

    public function __construct($action, array $request)
    {
        static::$Request = $request;

        $this->Action = $action . 'Action';
    }

    public function Run()
    {
        if (is_callable([$this,$this->Action])) {
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
}
