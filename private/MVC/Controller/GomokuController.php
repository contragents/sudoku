<?php

use classes\Config;
use classes\FrontResource;
use classes\FrontResourceGomoku;
use classes\StateMachine;
use classes\GomokuGame;

class GomokuController extends BaseController
{
    // todo привести в соответствие с SudokuController

    const GAME_URL = Config::BASE_URL . GomokuGame::GAME_NAME . '/';

    const VIEW_PATH = parent::VIEW_PATH . 'Gomoku/';

    public function __construct($action, array $request)
    {
        BaseController::$SM = new StateMachine( GomokuGame::GAME_NAME);
        BaseController::$FR = new FrontResourceGomoku();

        parent::__construct($action, $request);

        $this->Game = new GomokuGame();
    }

    public function Run()
    {
        return parent::Run();
    }
}