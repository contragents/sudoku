<?php

use classes\FrontResourceSudoku;
use classes\StateMachine;
use classes\SudokuGame;

class SudokuController extends BaseController
{
    const COMMON_URL = parent::COMMON_URL;

    const TITLE = 'Sudoku online';
    const URL = self::BASE_URL . "sudoku/";
    const SITE_NAME = self::URL;
    const DESCRIPTION ='In Sudoku, the objective is to fill a 9 × 9 grid with digits so that each column, each row, and each of the nine 3 × 3 subgrids that compose the grid (also called \"boxes\", \"blocks\", or \"regions\") contains all of the digits from 1 to 9. The puzzle setter provides a partially completed grid, which for a well-posed puzzle has a single solution.';
    const FB_IMG_URL = "https://xn--d1aiwkc2d.club/img/share/hor_640_360.png";

    const VIEW_PATH = parent::VIEW_PATH . 'Sudoku/';

    public function __construct($action, array $request)
    {
        BaseController::$SM = new StateMachine(self::COOKIE_KEY, SudokuGame::GAME_NAME);
        BaseController::$FR = new FrontResourceSudoku();

        parent::__construct($action, $request);

        $this->Game = new SudokuGame();
    }

    public function Run(): string
    {
        return parent::Run();
    }
}