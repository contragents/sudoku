<?php

namespace classes;

class DeskSudoku extends Desk
{
    const NUM_COLS = 9;
    const NUM_ROWS = 9;

    public function __construct()
    {
        parent::__construct();

        $sudoku = new SudokuGenerator;
        $sudoku->sudoku(9);
        $this->desk = $sudoku->generate();
    }

}
