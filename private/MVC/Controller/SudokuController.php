<?php

use classes\StateMachine;

class SudokuController extends BaseController
{
    const VIEW_PATH = parent::VIEW_PATH . 'Sudoku/';

    const COOKIE_KEY = 'sudoku_player_id';
    const GAME_NAME = 'sudoku';

    public function Run()
    {
        new StateMachine(self::COOKIE_KEY, self::GAME_NAME);

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

        return json_encode(['gameState' => $newPlayerStatus], JSON_UNESCAPED_UNICODE);
    }

    public function newGameAction()
    {
        // Ставим статус NoGame, т.к. игра сама перезагрузится при запросе новой игры
        // todo произвести очистку статуса, очередей, текущей игры
        $newPlayerStatus = StateMachine::setPlayerStatus(StateMachine::STATE_NO_GAME);

        return json_encode(['gameState' => $newPlayerStatus], JSON_UNESCAPED_UNICODE);
    }

    public function statusCheckerAction()
    {
        $newStatus = StateMachine::getPlayerStatus();

        if ((self::$Request['queryNumber'] ?? 0) == 1) {
            $newStatus = StateMachine::setPlayerStatus(StateMachine::STATE_CHOOSE_GAME);
        }

        return json_encode(['gameState' => $newStatus], JSON_UNESCAPED_UNICODE);
    }
}