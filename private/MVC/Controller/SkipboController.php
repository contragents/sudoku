<?php

use classes\Config;
use classes\FrontResourceSkipbo;
use classes\GameSkipbo;
use classes\StateMachine;

class SkipboController extends BaseController
{
    const VIEW_PATH = parent::VIEW_PATH . 'Skipbo/';
    const TITLE = 'Skip-Bo';

    public static function FB_IMG_URL(): string
    {
        return 'https://' . Config::DOMAIN() . '/'. GameSkipbo::GAME_NAME . '/img/share/sudoku_640_360.png';
    }

    public static function SITE_NAME(): string
    {
        return self::GAME_URL();
    }

    public static function GAME_URL(): string
    {
        return Config::BASE_URL() . GameSkipbo::GAME_NAME . '/';
    }

    public function __construct($action, array $request)
    {
        BaseController::$SM = new StateMachine(GameSkipbo::GAME_NAME);
        BaseController::$FR = new FrontResourceSkipbo();

        parent::__construct($action, $request);
    }

    public function Run()
    {
        $this->Game = new GameSkipbo();

        return parent::Run();
    }

    /*public function mainScriptAction()
    {
        include self::VIEW_PATH . 'mainScript/main.js';
    }*/
}