<?php

use classes\Config;
use classes\FrontResource;
use classes\FrontResourceGomoku;
use classes\StateMachine;
use classes\GameGomoku;

class GomokuController extends BaseController
{
    // todo привести в соответствие с SudokuController

    const VIEW_PATH = parent::VIEW_PATH . 'Gomoku/';

    public static function SITE_NAME(): string
    {
        return self::GAME_URL();
    }

    public static function GAME_URL(): string
    {
        return Config::BASE_URL() . GameGomoku::GAME_NAME . '/';
    }

    public function __construct($action, array $request)
    {
        BaseController::$SM = new StateMachine(GameGomoku::GAME_NAME);
        BaseController::$FR = new FrontResourceGomoku();

        parent::__construct($action, $request);

        $this->Game = new GameGomoku();
    }

    public function Run()
    {
        return parent::Run();
    }
}