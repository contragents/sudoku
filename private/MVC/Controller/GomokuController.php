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

    const TITLE = "Gomoku online | X-0";
    const DESCRIPTION ='Gomoku, also called Five in a Row, is an abstract strategy board game. It is traditionally played with Go pieces (black and white stones) on a 15×15 Go board. Because pieces are typically not moved or removed from the board, gomoku may also be played as a paper-and-pencil game.';

    const VIEW_PATH = parent::VIEW_PATH . 'Gomoku/';

    public function __construct($action, array $request)
    {
        BaseController::$SM = new StateMachine( GomokuGame::GAME_NAME);
        BaseController::$FR = new FrontResourceGomoku();

        parent::__construct($action, $request);

        $this->Game = new GomokuGame();
    }

    public function Run(): string
    {
        return parent::Run();
    }
}