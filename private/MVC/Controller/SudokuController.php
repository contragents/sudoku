<?php

use classes\StateMachine;
use classes\SudokuGame;

class SudokuController extends BaseController
{
    const TITLE = "Sudoku online";
    const URL = "https://xn--d1aiwkc2d.club/sudoku/";
    const SITE_NAME = "5-5.su/sudoku";
    const DESCRIPTION ='In Sudoku, the objective is to fill a 9 × 9 grid with digits so that each column, each row, and each of the nine 3 × 3 subgrids that compose the grid (also called \"boxes\", \"blocks\", or \"regions\") contains all of the digits from 1 to 9. The puzzle setter provides a partially completed grid, which for a well-posed puzzle has a single solution.';
    const FB_IMG_URL = "https://xn--d1aiwkc2d.club/img/share/hor_640_360.png";

    const VIEW_PATH = parent::VIEW_PATH . 'Sudoku/';

    const COOKIE_KEY = 'sudoku_player_id';

    public function __construct($action, array $request)
    {
        BaseController::$SM = new StateMachine(self::COOKIE_KEY, SudokuGame::GAME_NAME);

        parent::__construct($action, $request);

        $this->Game = new SudokuGame();
    }

    public function Run()
    {
        return parent::Run();
    }
}