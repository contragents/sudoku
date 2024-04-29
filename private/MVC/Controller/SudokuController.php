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
        new StateMachine(self::COOKIE_KEY, SudokuGame::GAME_NAME);

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

    public function startGameAction()
    {
        $newPlayerStatus = StateMachine::setPlayerStatus(StateMachine::STATE_INIT_GAME);

        if ($newPlayerStatus == StateMachine::STATE_INIT_GAME) {
            $res = (new Queue(BaseController::$User, new SudokuGame(), self::$Request))->doSomethingWithThisStuff();
        }

        return json_encode($res, JSON_UNESCAPED_UNICODE);
    }

    public function newGameAction()
    {
        // Ставим статус NoGame, т.к. игра сама перезагрузится при запросе новой игры
        // todo произвести очистку статуса, очередей, текущей игры
        $newPlayerStatus = StateMachine::setPlayerStatus(StateMachine::STATE_NO_GAME);

        return Response::jsonResp(['gameState' => $newPlayerStatus]);
    }

    public function statusCheckerAction()
    {
        $newStatus = StateMachine::getPlayerStatus();

        if ((self::$Request['queryNumber'] ?? 0) == 1) {
            $newStatus = StateMachine::setPlayerStatus(StateMachine::STATE_CHOOSE_GAME);
        }

        Response::jsonResp(['gameState' => $newStatus]);
    }
}