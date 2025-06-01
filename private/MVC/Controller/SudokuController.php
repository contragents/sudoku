<?php

use classes\Config;
use classes\FrontResourceSudoku;
use classes\StateMachine;
use classes\SudokuGame;

class SudokuController extends BaseController
{
    const GAME_URL = Config::BASE_URL . SudokuGame::GAME_NAME . '/';

    const SITE_NAME = self::GAME_URL;

    const VIEW_PATH = parent::VIEW_PATH . 'Sudoku/';

    public function __construct($action, array $request)
    {
        BaseController::$SM = new StateMachine(SudokuGame::GAME_NAME);
        BaseController::$FR = new FrontResourceSudoku();

        parent::__construct($action, $request);
    }

    public function Run()
    {
        $this->Game = new SudokuGame();

        return parent::Run();
    }
}