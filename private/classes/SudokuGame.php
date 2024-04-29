<?php

namespace classes;

use BaseController;
use PlayerModel;

class SudokuGame extends Game
{
    public function __construct()
    {

        $this->User = BaseController::$User;
        $this->Queue = new Queue($this->User, $this, BaseController::$Request);

        // Если не удалось дождаться лока по текущему игроку, то посылаем ошибку и выходим
        if(!Cache::waitLock($this->User)) {
            BadRequest::sendBadRequest(
                ['err_msg' => 'lock error'],
                $this->isBot()
            );
        }

        $this->currentGame = $this->getCurrentGame();

        if (!$this->currentGame) {
            $this->currentGame = false;

            return;
        } else {
            $this->currentGameUsers = $this->getGameUsers();

            if (!Cache::waitMultiLock(['game' => $this->currentGame] + $this->currentGameUsers)) {
                //Вышли с Десинком, если не смогли получить Лок
                return $this->desync();
            }

            $this->gameStatus = $this->getGameStatus();
            //Забрали статус игры из кэша

            try {
                if (!isset($this->gameStatus->$this->User)) {
                    print $this->newGame();

                    exit();
                }

                $this->numUser = $this->gameStatus->$this->User;
                //Номер пользователя по порядку

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

    public function newGame() // todo проверить, кто вызывает этот метод
    {
        /** todo
         * Нужно доделать - уведомление остальных игроков,
         * поражение пользователю,
         * игра идет без ушедшего пользователя
         */

        $this->Queue::cleanUp($this->User);

        Cache::del($this->Queue::GET_GAME_KEY . $this->User);
        //Удалили указатель на текущую игру для пользователя

        if ($this->currentGame && (in_array($_REQUEST['gameState'] ?? '', self::INIT_STATES))) {
            return $this->checkGameStatus();
            //Пользователь думает, что находится в подборе игры, но игра уже началась
        }

        if ($this->currentGame) {
            $this->gameStatus->users[$this->numUser]->isActive = false;
            //Игрок стал неактивен
            $this->addToLog("покинул игру", $this->numUser);
        }

        return ['gameState' => 'chooseGame', 'gameSubState' => 'choosing'];
    }


    /*public function makeGame(string $User, string $numPlayers, array $Request = [])
    {
        $this->currentGame = self::getNewGameId();
        $this->storeGameStatus(false);

        $this->gameStatus['desk'] = false;
        //Создали состояние доски

        $gameUsers = [];
        $this->currentGameUsers = [];
        $waitingPlayers = Cache::hgetall(self::getCacheKey(Queue::TWO_PLAYERS_WAITERS_QUEUE));
        $prefs = $this->Queue->getUserPrefs($User);

        if (!isset($waitingPlayers[$User])) {
            $options = isset($Request[Queue::TURN_TIME_PARAM_NAME])
                ? $Request
                : ($prefs ?: false);
        } else {
            $waitingPlayers[$User] = unserialize($waitingPlayers[$User]);

            $options = isset($waitingPlayers[$User]['options'][Queue::TURN_TIME_PARAM_NAME])
                ? $waitingPlayers[$User]['options']
                : ($prefs ?: false);

            unset($waitingPlayers[$User]);
        }

        // Прописываем текущему юзеру - добавление в игру,  номер игры, удаляем из очереди ждунов
        $gameUsers[] = ['userCookie' => $User, 'options' => $options];
        $this->Queue::cleanUp($User);
        $this->storeGameStatus();
        Cache::setex(self::getCacheKey(self::GET_GAME_KEY . $User), self::CACHE_TIMEOUT, $this->currentGame);

        $this->currentGameUsers[] = $User;
        $numUsers = 1;

        foreach ($waitingPlayers as $player => $data) {
            $prefs = $this->Queue->getUserPrefs($player);
            $data = unserialize($data);

            //Прописываем юзерам - удаление из очереди и номер игры
            Cache::hdel(self::getCacheKey(Queue::QUEUES['2players_waiters']), $player);
            Cache::setex(
                self::getCacheKey(self::GET_GAME_KEY . $player),
                self::CACHE_TIMEOUT,
                $this->currentGame
            );

            $options = isset($data['options'][Queue::TURN_TIME_PARAM_NAME])
                ? $data['options']
                : ($prefs ?: false);
            $gameUsers[] = ['userCookie' => $player, 'options' => $options];

            //Заполняем массив игроков
            $this->currentGameUsers[] = $player;

            $numUsers++;
            if ($numUsers == 2) {
                break;
            }
        }

        foreach ($gameUsers as $num => $user) {
            $this->gameStatus['users'][$num] = [
                'ID' => $user['userCookie'],
                'status' => 'startGame',
                'isActive' => true,
                'score' => 0,
                'username' => 'Игрок' . ($num + 1),
                'avatarUrl' => false,
            ];
            //Прописали игроков в состояние игры

            if ($user['options'] !== false) {
                $this->gameStatus['users'][$num]['wishTurnTime'] = $user['options'][Queue::TURN_TIME_PARAM_NAME];
                //Заполнили пожелания игроков к времени хода
            }

            $this->gameStatus[$user['userCookie']] = $num;
            // Заполнили массив нормеров игроков

            // todo этот метод меняет статус игроков через стейт-машину + статусы в игре - как это совместить?
            StateMachine::setPlayerStatus(StateMachine::STATE_OTHER_TURN, $user['userCookie']);
            // Назначили статусы всем игрокам
        }

        // Сохраняем список игроков в игре
        Cache::setex(
            self::getCacheKey(self::GAME_USERS_KEY . $this->currentGame),
            self::CACHE_TIMEOUT,
            $this->currentGameUsers
        );

        return $this->gameStarted(true);
    }*/

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
            $this->updateUserStatus(StateMachine::STATE_MY_TURN, $this->currentGameUsers[$firstTurnUser]);
            //Назначили ход случайному юзеру

            $ost = ($firstTurnUser - 1) % count($this->gameStatus->users);
            if ($ost >= 0) {
                $preMyTurnUser = $ost;
            } else {
                $preMyTurnUser = count($this->gameStatus->users) + $ost;
            }
            $this->updateUserStatus(StateMachine::STATE_PRE_MY_TURN, $this->currentGameUsers[$preMyTurnUser]);
            //Вычислили игрока, идущего за первым и дали ему статус преМайТерн

            foreach ($this->gameStatus->users as $num => $user) {
                $this->gameStatus->users[$num]->lostTurns = 0;
                $this->gameStatus->users[$num]->inactiveTurn = 1000;
                //Сделали невозможным значение терна инактив

                $userRating = PlayerModel::getRatingByCookie($user['ID']);
                $this->gameStatus->users[$num]->rating = $userRating ?: 'new_player';
                $this->gameStatus->users[$num]->common_id = PlayerModel::getPlayerCommonId($user['ID'], true);
                //Прописали рейтинг и common_id игрока в статусе игры - только для games_statistic.php
            }

            $this->addToLog(
                'Новая игра начата! <br />Набери <strong>как можно больше</strong> очков'
            );
        }

        return ['gameState' => StateMachine::GAME_STATE_START_GAME];
    }

    public function noop() {
        return StateMachine::STATE_WAITING;
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

    private function desync($queryNumber = false)
    {
        $this->updateUserStatus(StateMachine::STATE_WAITING);
        $arr = ['gameState' => StateMachine::STATE_WAITING, 'noDialog' => true];

        if ($queryNumber) {
            $arr['queryNumber'] = $queryNumber;
        }

        return $arr;
    }

    public function updateUserStatus($newStatus, $user = false)
    {
        $user = $user ?: $this->User;
        $newStatus = StateMachine::setPlayerStatus($newStatus, $user);

        if ($newStatus == StateMachine::STATE_MY_TURN) {
            $this->gameStatus->activeUser = $this->gameStatus->$user;
        }
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
}

