<?php

namespace classes;

use BaseController;
use PlayerModel;
use SudokuController;

class SudokuGame extends Game
{
    public function __construct()
    {
        parent::__construct();

        $this->User = BaseController::$User;
        $this->Queue = new Queue($this->User, $this, BaseController::$Request);
        $this->SM = new StateMachine(SudokuController::COOKIE_KEY, self::GAME_NAME);

        // Если не удалось дождаться лока по текущему игроку, то посылаем ошибку и выходим
        if(!Cache::waitLock($this->User, true)) {
            BadRequest::sendBadRequest(
                ['err_msg' => 'lock error'],
                $this->isBot()
            );
        }

        $this->currentGame = $this->getCurrentGameNumber();

        if (!$this->currentGame) {
            $this->currentGame = false;

            return $this;
        } else {
            $this->currentGameUsers = $this->getGameUsers();

            if (!Cache::waitMultiLock(['game' => $this->currentGame] + $this->currentGameUsers, true)) {
                //Вышли с Десинком, если не смогли получить Лок
                return $this->desync();
            }

            $this->gameStatus = $this->getGameStatus();
            //Забрали статус игры из кэша

            // Проверим, правильно ли загрузилась игра
            if ($this->gameStatus->gameNumber !== $this->currentGame) {
                $this->clearUserGameNumber($this->User);
                $this->currentGameUsers = $this->clearGameUsers();
                $this->currentGame = false;

                return $this;
            }

            try {
                if ($this->gameStatus->{$this->User} === null) {
                    print Response::jsonResp($this->newGame());
                    $this->numUser = ''; // todo ?
                    exit();
                }

                //Номер пользователя по порядку
                $this->numUser = $this->gameStatus->{$this->User};


                if (isset($_GET['page_hidden']) && $_GET['page_hidden'] == 'true') {
                    if (isset($_GET['queryNumber']) && $_GET['queryNumber'] < ($this->gameStatus->users[$this->numUser]->lastRequestNum ?? 0)) {
                        throw new BadRequest('Num packet error when returned from page_hidden state');
                    }
                }
            } catch (BadRequest $e) {
                BadRequest::sendBadRequest(
                    [
                        'err_msg' => $e->getMessage(),
                        'err_file' => $e->getFile(),
                        'err_line' => $e->getLine(),
                        'err_context' => $e->getTrace(),
                    ],
                    $this->isBot()
                );
            }

            $this->gameStatus->users[$this->numUser]->lastRequestNum
                =
                $_GET['queryNumber'] ?? $this->gameStatus->users[$this->numUser]->lastRequestNum;


            if (!(isset($_GET['page_hidden']) && $_GET['page_hidden'] == 'true')) {
                $this->gameStatus->users[$this->numUser]->lastActiveTime = date('U');
                $this->gameStatus->users[$this->numUser]->inactiveTurn = 1000;
                //Обновили время активности, если это не закрытие вкладки
            }
        }
    }

    public function newGame(): array // todo проверить, кто вызывает этот метод
    {
        $this->Queue::cleanUp($this->User);

        if ($this->currentGame && ($_REQUEST['gameState'] ?? '') == $this->SM::STATE_INIT_GAME) {
            return $this->checkGameStatus();
            //Пользователь думает, что находится в подборе игры, но игра уже началась
        }

        // Удалили указатель на текущую игру для пользователя
        $this->clearUserGameNumber($this->User);

        if ($this->currentGame && ($this->numUser ?? false)) {
            $this->gameStatus->users[$this->numUser]->isActive = false;
            //Игрок стал неактивен
            $this->addToLog("покинул игру", $this->numUser);
        }

        $this->SM::setPlayerStatus($this->SM::STATE_NEW_GAME);
        return Response::state($this->SM::setPlayerStatus($this->SM::STATE_CHOOSE_GAME))
            + ['gameSubState' => 'choosing'];
    }

    public function startGame()
    {
        if ($this->currentGame && is_array($this->currentGameUsers)) {
            return $this->gameStarted(false);
            //Вернули статус начатой игры без обновления статусов в кеше
        }

        return $this->Queue->doSomethingWithThisStuff();
    }

    public function checkGameStatus(): array
    {
        if (!$this->currentGame) {
            if ($this->Queue::isUserInQueue($this->User)) {
                return $this->startGame();
            }

            $chooseGameParams = [
                'gameState' => 'chooseGame',
                'gameSubState' => 'choosing',
                'players' => $this->onlinePlayers(),
                'prefs' => Cache::get($this->Queue::PREFS_KEY . $this->User)
            ];

            return $chooseGameParams;
        }

        if ($this->activeGameUsers() < 2) {
            if (!isset($this->gameStatus['results'])) {
                $this->storeGameResults($this->User);
                $this->addToLog('остался в игре один - Победа!', $this->numUser);
                //Пользователь остался в игре один и выиграл
            } else {
                $this->addToLog('остался в игре один! Начните новую игру', $this->numUser);
            }
        }

        $desk = $this->gameStatus->desk ? $this->gameStatus->desk->desk : false;

        if ($this->SM::getPlayerStatus($this->User) == $this->SM::STATE_GAME_RESULTS) {
            if (isset($this->gameStatus->results['winner'])) {
                return $this->resultsResponse();
            } 
        }

        //Поставим коррекцию времени начала хода для учета периодичности запросов пользователей
        if (
            $this->SM::getPlayerStatus($this->User) == $this->SM::STATE_MY_TURN
            &&
            !$this->gameStatus->aquiringTimes[$this->gameStatus->turnNumber]
        ) {
            if ((date('U') - $this->gameStatus->turnBeginTime) < static::TURN_DELTA_TIME) {
                $this->gameStatus->aquiringTimes[$this->gameStatus->turnNumber] = date('U');
            } else {
                $this->gameStatus->aquiringTimes[$this->gameStatus->turnNumber] = $this->gameStatus->turnBeginTime;
            }
        }

        if ((date('U') - $this->gameStatus->turnBeginTime) > ($this->gameStatus->turnTime + static::TURN_DELTA_TIME)) {
            $this->addToLog('Время хода истекло', $this->gameStatus->activeUser);

            $this->gameStatus->users[$this->gameStatus->activeUser]->lostTurns++;
            $this->gameStatus->users[$this->gameStatus->activeUser]->inactiveTurn = $this->gameStatus->turnNumber;
            unset($this->gameStatus->users[$this->gameStatus->activeUser]->lastActiveTime);
            //Помечаем игрока неактивным

            if ($this->gameStatus->users[$this->gameStatus->activeUser]->lostTurns >= 3) {
                $this->storeGameResults($this->lost3TurnsWinner($this->gameStatus->activeUser));

                
                if (isset($this->gameStatus->results['winner'])) {
                    return $this->resultsResponse();
                }
            } else {
                $this->nextTurn();
            }
        }

        $userStatus = $this->SM::getPlayerStatus($this->User);

        return Response::state($userStatus) + ($desk ? ['desk' => $desk, 'current_game' => $this->currentGame, $this->numUser => $this->gameStatus->{$this->User}] : []);
    }

    protected function storeGameResults($winnerUser)
    {
        $results = [];

        foreach ($this->gameStatus->users as $user) {
            if ($user->ID == $winnerUser) {
                $results['winner'] = $winnerUser;
            } else {
                $results['lostUsers'][] = $user->ID;
            }
        }

        $this->gameStatus->results = $results;
        // Новая версия

        foreach ($this->gameStatus->users as $num => $user) {
            $this->updateUserStatus($this->SM::STATE_GAME_RESULTS, $user->ID);

            if (
                !empty($user->ID)
                && !empty($this->gameStatus->users[$num]->last_request_num)
                && $this->gameStatus->users[$num]->last_request_num > 10
            ) {
                Cache::setex(
                    $this->SM::CHECK_STATUS_RESULTS_KEY . $user->ID,
                    $this->SM::CHECK_STATUS_RESULTS_KEY_TTL,
                    $this->gameStatus->users[$num]->last_request_num
                );
            }
        }
    }

    public function gameStarted($statusUpdateNeeded = false): array
    {
        if ($statusUpdateNeeded) {
            $firstTurnUser = rand(0, count($this->currentGameUsers) - 1);
            $this->gameStatus->gameNumber = $this->currentGame;
            $this->gameStatus->activeUser = $firstTurnUser;
            $this->gameStatus->gameBeginTime = date('U');
            $this->gameStatus->turnBeginTime = $this->gameStatus->gameBeginTime;
            $this->gameStatus->turnNumber = 1;
            $this->gameStatus->firstTurnUser = $firstTurnUser;
            $this->gameStatus->turnTime = 120;
            $this->gameStatus->aquiringTimes[$this->gameStatus->turnNumber] = false;
            $this->updateUserStatus($this->SM::STATE_MY_TURN, $this->currentGameUsers[$firstTurnUser]);
            //Назначили ход случайному юзеру

            $ost = ($firstTurnUser - 1) % count($this->gameStatus->users);
            if ($ost >= 0) {
                $preMyTurnUser = $ost;
            } else {
                $preMyTurnUser = count($this->gameStatus->users) + $ost;
            }
            $this->updateUserStatus($this->SM::STATE_PRE_MY_TURN, $this->currentGameUsers[$preMyTurnUser]);
            //Вычислили игрока, идущего за первым и дали ему статус преМайТерн

            foreach ($this->gameStatus->users as $num => $user) {
                // Заполнили массив нормеров игроков
                $this->gameStatus->{$user->ID} = $num;

                // Сделали невозможным значение терна инактив
                // $this->gameStatus->users[$num]->lostTurns = 0;
                // $this->gameStatus->users[$num]->inactiveTurn = 1000;


                // Прописали рейтинг и common_id игрока в статусе игры - только для games_statistic.php
                $userRating = PlayerModel::getRatingByCookie($user->ID);
                $this->gameStatus->users[$num]->rating = $userRating ?: 0;
                $this->gameStatus->users[$num]->common_id = PlayerModel::getPlayerCommonId($user->ID, true);
            }

            //Номер пользователя по порядку
            $this->numUser = $this->gameStatus->{$this->User};

            $this->addToLog(
                'Новая игра начата! <br />Набери <strong>как можно больше</strong> очков'
            );
        }

        return Response::state($this->SM::GAME_STATE_START_GAME);
    }

    public function noop() {
        return $this->SM::STATE_WAITING;
    }

    protected function makeWishWinscore()
    {
        return 300;
    }

    protected function makeWishTime()
    {
        return 120;
    }

    private function isBot(): bool
    {
        return false;
    }

    private function desync($queryNumber = false): array
    {
        $this->updateUserStatus($this->SM::STATE_WAITING, $this->User, true);

        $arr = Response::state($this->SM::STATE_WAITING);
        $arr['noDialog'] = true;

        if ($queryNumber) {
            $arr['queryNumber'] = $queryNumber;
        }

        return $arr;
    }

    public function makeResponse(array $arr): array
    {
        return $arr;
    }

    protected function addToLog($message, $numUser = false)
    {
        $this->gameStatus->gameLog[] = [$numUser, $message];
        foreach ($this->gameStatus->users as $num => $User) {
            $this->gameStatus->users[$num]->logStack[] = [$numUser, $message];
        }
    }

    protected function activeGameUsers(): int
    {
        $numActive = 0;
        foreach ($this->gameStatus->users as $user) {
            if ($user->isActive) {
                $numActive++;
            }
        }

        return $numActive;
    }

    protected function lost3TurnsWinner($numLostUser, bool $pass = false): string
    {
        $maxres = 0;
        $userWinner = 0;
        if ($this->gameStatus->users[$numLostUser]->score === 0) {
            $this->gameStatus->users[$numLostUser]->isActive = false;
        }

        foreach ($this->gameStatus->users as $num => $user) {
            if (($maxres <= $user->score) && $user->isActive && !($pass && $num == $numLostUser)) {
                $maxres = $user->score;
                $userWinner = $num;
            }
        }

        $this->addToLog(
            $pass
                ? 'сдался'
                : 'пропустил 3 хода! Победитель - ' . $this->gameStatus->users[$userWinner]->username . ' со счетом ' . $this->gameStatus->users[$userWinner]->score,
            $numLostUser
        );

        return $this->gameStatus->users[$userWinner]->ID;
    }

    public function initGame()
    {
        return $this->Queue->doSomethingWithThisStuff();
    }

    private function resultsResponse(): array
    {
        $desk = $this->gameStatus->desk;
        return [
            'gameState' => $this->SM::STATE_GAME_RESULTS,
            'comments' => $this->gameStatus->results['winner'] == $this->User
                ? "<strong style=\"color:green;\">Вы выиграли!</strong><br/>Начните новую игру"
                : "<strong style=\"color:red;\">Вы проиграли!</strong><br/>Начните новую игру",
            ($desk ? 'desk' : 'nothing') => $desk
        ];
    }

    protected function nextTurn()
    {
        foreach ($this->gameStatus->users as $numUser => $user) {
            // Дали всем игрокам статус - другойХодит
            $this->updateUserStatus($this->SM::STATE_OTHER_TURN, $user->ID);
        }

        $isActiveUserFound = false;

        $i = 0;

        while (!$isActiveUserFound && is_array($this->gameStatus->users) && count($this->gameStatus->users) > $i) {
            $nextActiveUser = ($this->gameStatus->activeUser + 1) % count($this->gameStatus->users);
            $this->gameStatus->activeUser = $nextActiveUser;
            if ($this->gameStatus->users[$nextActiveUser]->isActive) {
                $isActiveUserFound = true;
            }

            $i++;
        }

        if (!$isActiveUserFound) {
            if (count($this->gameStatus->users ?? [])) {
                $nextActiveUser = $this->numUser;
                $this->gameStatus->activeUser = $nextActiveUser;
            } else {
                $this->storeGameResults($this->User);
                $this->addToLog('остался в игре один - Победа!', $this->numUser);

                return; // todo что делать если нет ни одного юзера - заканчиваем игру
            }
        }

        $this->updateUserStatus($this->SM::STATE_MY_TURN, $this->gameStatus->users[$nextActiveUser]->ID);
        //Прописали статус новому активному пользователю

        $nextPreMyTurnUser = ($nextActiveUser + 1) % count($this->gameStatus->users);

        $this->updateUserStatus($this->SM::STATE_PRE_MY_TURN, $this->gameStatus->users[$nextPreMyTurnUser]->ID);
        //Прописали статус следующему преМайТерн-юзеру

        $this->gameStatus->turnNumber++;

        $this->gameStatus->turnBeginTime = date('U');
        $this->gameStatus->aquiringTimes[$this->gameStatus->turnNumber] = false;
    }
}

