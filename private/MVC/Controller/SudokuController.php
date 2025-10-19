<?php

use classes\Config;
use classes\FrontResourceSudoku;
use classes\StateMachine;
use classes\GameSudoku;
use classes\T;

class SudokuController extends BaseController
{
    const VIEW_PATH = parent::VIEW_PATH . 'Sudoku/';
    const TITLE = 'Sudoku Online with friends';

    public static function FB_IMG_URL(): string
    {
        return 'https://' . Config::DOMAIN() . '/'. GameSudoku::GAME_NAME . '/img/share/sudoku_640_360.png';
    }

    public static function SITE_NAME(): string
    {
        return self::GAME_URL();
    }

    public static function GAME_URL(): string
    {
        return Config::BASE_URL() . GameSudoku::GAME_NAME . '/';
    }

    public function __construct($action, array $request)
    {
        BaseController::$SM = new StateMachine(GameSudoku::GAME_NAME);
        BaseController::$FR = new FrontResourceSudoku();

        parent::__construct($action, $request);
    }

    public function Run()
    {
        $this->Game = new GameSudoku();

        return parent::Run();
    }
}