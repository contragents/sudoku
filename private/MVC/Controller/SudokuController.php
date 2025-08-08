<?php

use classes\Config;
use classes\FrontResourceSudoku;
use classes\StateMachine;
use classes\SudokuGame;
use classes\T;

class SudokuController extends BaseController
{
    const VIEW_PATH = parent::VIEW_PATH . 'Sudoku/';
    const TITLE = 'Sudoku Online with friends';

    public static function FB_IMG_URL(): string
    {
        return 'https://' . Config::DOMAIN() . '/'. SudokuGame::GAME_NAME . '/img/share/sudoku_640_360.png';
    }

    public static function SITE_NAME(): string
    {
        return self::GAME_URL();
    }

    public static function GAME_URL(): string
    {
        return Config::BASE_URL() . SudokuGame::GAME_NAME . '/';
    }

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