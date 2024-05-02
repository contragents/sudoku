<?php

use classes\Queue;
use classes\Response;
use classes\SudokuGame;
use classes\StateMachine;

class SudokuController extends BaseController
{
    const VIEW_PATH = parent::VIEW_PATH . 'Sudoku/';

    const COOKIE_KEY = 'sudoku_player_id';

    public function Run()
    {
        $this->Game = new SudokuGame();
        $this->SM = $this->Game->SM;

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

    public function initGameAction()
    {
        $newPlayerStatus = $this->SM::setPlayerStatus($this->SM::STATE_INIT_GAME, null, true);

        if ($newPlayerStatus == $this->SM::STATE_INIT_GAME) {
            $res = (new Queue(BaseController::$User, $this->Game, self::$Request, true))->doSomethingWithThisStuff();
        } else {$res = Response::state($newPlayerStatus);}

        return Response::jsonResp($res);
    }

    public function newGameAction()
    {
        // Ставим статус NoGame, т.к. игра сама перезагрузится при запросе новой игры
        // todo произвести очистку статуса, очередей, текущей игры

        return Response::jsonResp($this->Game->newGame());
    }

    public function statusCheckerAction()
    {
        return Response::jsonResp($this->Game->checkGameStatus());
    }
}