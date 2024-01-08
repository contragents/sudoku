<?php

namespace classes;

class StateMachine
{
    const STATE_NO_GAME = 'noGame'; // Статус, в котором ничего не происходит. Ждем пока юзер нажмет Новая игра
    const STATE_CHOOSE_GAME = 'chooseGame'; // Выбор режима игры (время на ход и т.д.)
    const STATE_INIT_GAME = 'initGame'; // Статус подбора игры, ждем соперника
    const STATE_NEW_GAME = 'newGame'; // Когда с сервера прилетает этот статус, начинаем новую игру
    const STATE_START_GAME = 'startGame'; // Игра началась
    const STATE_PRE_MY_TURN = 'preMyTurn'; // Мой ход следующий
    const STATE_MY_TURN = 'myTurn'; // Мой ход
    const STATE_OTHER_TURN = 'otherTurn'; // Ход не мой и мой ход не следующий
    const STATE_GAME_RESULTS = 'gameResults'; // Игра закончена, смортим результаты

    const STATE_MACHINE = [
        self::STATE_CHOOSE_GAME => [
            self::STATE_INIT_GAME,
            self::STATE_NEW_GAME,
        ],
        self::STATE_INIT_GAME => [
            self::STATE_START_GAME,
            self::STATE_MY_TURN,
            self::STATE_PRE_MY_TURN,
            self::STATE_NEW_GAME,
        ],
        self::STATE_START_GAME => [
            self::STATE_MY_TURN,
            self::STATE_PRE_MY_TURN,
            self::STATE_OTHER_TURN,
            self::STATE_NEW_GAME,
            self::STATE_GAME_RESULTS,
        ],
        self::STATE_MY_TURN => [
            self::STATE_PRE_MY_TURN,
            self::STATE_OTHER_TURN,
            self::STATE_NEW_GAME,
            self::STATE_GAME_RESULTS,
        ],
        self::STATE_PRE_MY_TURN => [
            self::STATE_MY_TURN,
            self::STATE_OTHER_TURN,
            self::STATE_NEW_GAME,
            self::STATE_GAME_RESULTS,
        ],
        self::STATE_OTHER_TURN => [
            self::STATE_MY_TURN,
            self::STATE_PRE_MY_TURN,
            self::STATE_NEW_GAME,
            self::STATE_GAME_RESULTS,
        ],
        self::STATE_GAME_RESULTS => [
            self::STATE_NO_GAME,
            self::STATE_NEW_GAME,
        ],
        self::STATE_NO_GAME => [
            self::STATE_NEW_GAME,
        ],
        self::STATE_NEW_GAME => [], // Пока просто перезагружаем игру, если прилетел статус NEW_GAME
    ];
}