<?php

class SudokuController extends BaseController
{
    const VIEW_PATH = parent::VIEW_PATH . 'Sudoku/';

    public function Run()
    {
        return parent::Run();
    }

    public function mainScriptAction()
    {
        include self::VIEW_PATH . 'mainScript/main.js';
    }

    public function indexAction()
    {
        include self::VIEW_PATH . 'index.html';
    }

    public function statusCheckerAction()
    {
        return json_encode(['gameState' => 'chooseGame'], JSON_UNESCAPED_UNICODE);
    }
}