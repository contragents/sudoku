<?php

namespace classes;

use BaseController as BC;
use classes\ViewHelper as VH;

class GameSkipbo extends Game
{
    public const GAME_NAME = 'skipbo';

    const DEFAULT_STACK_LEN = 30; // сколько карт в стеке

    const NUM_RATING_PLAYERS_KEY = self::GAME_NAME . parent::NUM_RATING_PLAYERS_KEY; // Список игроков онлайн
    const NUM_COINS_PLAYERS_KEY = self::GAME_NAME . '.num_coins_players';

    const RESPONSE_PARAMS = parent::RESPONSE_PARAMS + [];

    const DEFAUTL_TURN_TIME = 120;

    public function __construct()
    {
        parent::__construct(QueueSkipbo::class);
    }

    private function makeBotMove(): array
    {
    }

    public function submitTurn(): array
    {
        if (!$this->checkIsMyTurnAndLog()) {
            return parent::submitTurn();
        }

        $numCellsSolved = 0;
        $numKeysSolved = 0;

        /** @var DeskSudoku $desk */
        if ($this->gameStatus->desk->checkNewDesc(BC::$Request[BC::CELLS_PARAM])) {
            $turnRes = $this->gameStatus->desk->checkNewDigit($numCellsSolved);

            if ($turnRes === $this->gameStatus->desk::KEY_SOLVED_RESPONSE) {
                $this->gameStatus->users[$this->numUser]->score += self::KEY_OPEN_POINTS;
                $numKeysSolved++;
                while ($this->gameStatus->desk->newSolvedKey($numCellsSolved)) {
                    $this->gameStatus->users[$this->numUser]->score += self::KEY_OPEN_POINTS;
                    $numKeysSolved++;
                }
            }
        }

        if ($numCellsSolved) {
            $this->gameStatus->users[$this->numUser]->score += $numCellsSolved * self::CELL_OPEN_POINTS;
            foreach (T::SUPPORTED_LANGS as $lang) {
                $this->addToLog(
                    T::S(
                        "[[Player]] opened [[number]] [[cell]]",
                        [$this->numUser + 1, $numKeysSolved + $numCellsSolved, $numKeysSolved + $numCellsSolved],
                        $lang
                    )
                    . ($numKeysSolved
                        ? T::S(" (including [[number]] [[key]])", [$numKeysSolved, $numKeysSolved], $lang)
                        : ''),
                    $lang
                );
            }
        } else {
            foreach (T::SUPPORTED_LANGS as $lang) {
                $this->addToLog(
                    t::S('[[Player]] made a mistake', [$this->numUser + 1], $lang),
                    $lang
                );
            }

            foreach (T::SUPPORTED_LANGS as $lang) {
                $this->gameStatus->users[$this->numUser]->addComment(T::S('You made a mistake!', null, $lang), $lang);
                $this->gameStatus->users[($this->numUser + 1) % 2]->addComment(
                    T::S('Your opponent made a mistake', null, $lang),
                    $lang
                );
            }
        }

        $numPointsObtained = $numKeysSolved * self::KEY_OPEN_POINTS + $numCellsSolved * self::CELL_OPEN_POINTS;

        if ($numPointsObtained) {
            foreach (T::SUPPORTED_LANGS as $lang) {
                $this->addToLog(
                    t::S(
                        '[[Player]] gets [[number]] [[point]]',
                        [$this->numUser + 1, $numPointsObtained, $numPointsObtained],
                        $lang
                    ),
                    $lang
                );
            }

            foreach (T::SUPPORTED_LANGS as $lang) {
                $this->gameStatus->users[$this->numUser]->addComment(
                    T::S('You got [[number]] [[point]]', [$numPointsObtained, $numPointsObtained], $lang),
                    $lang
                );
                $this->gameStatus->users[($this->numUser + 1) % 2]->addComment(
                    T::S('Your opponent got [[number]] [[point]]', [$numPointsObtained, $numPointsObtained], $lang),
                    $lang
                );
            }
        }

        if ($this->gameStatus->users[$this->numUser]->score >= $this->gameStatus->gameGoal) {
            $this->storeGameResults($this->User);
        } elseif ($this->gameStatus->desk->hasUnopenedCells()) {
            $this->nextTurn();
        } else // Больше не осталось закрытых клеток - определяем победителя по очкам
        {
            if ($this->gameStatus->users[$this->numUser]->score >= $this->gameStatus->users[($this->numUser + 1) % 2]->score) {
                $winner = $this->User;
            } else {
                $winner = $this->gameStatus->users[($this->numUser + 1) % 2]->ID;
            }

            $this->storeGameResults($winner);
        }

        return parent::submitTurn();
    }

    public function makeBotTurn(int $botUserNum)
    {
        //Обновили время активности бота
        $this->gameStatus->users[$botUserNum]->lastActiveTime = date('U');
        $this->gameStatus->users[$botUserNum]->inactiveTurn = 1000;

        $numCellsSolved = 0;
        $numKeysSolved = 0;
        $newDesk = $this->makeBotMove();

        if ($this->gameStatus->desk->checkNewDesc($newDesk)) {
            $turnRes = $this->gameStatus->desk->checkNewDigit($numCellsSolved);

            if ($turnRes === $this->gameStatus->desk::KEY_SOLVED_RESPONSE) {
                $this->gameStatus->users[$botUserNum]->score += self::KEY_OPEN_POINTS;
                $numKeysSolved++;
                while ($this->gameStatus->desk->newSolvedKey($numCellsSolved)) {
                    $this->gameStatus->users[$botUserNum]->score += self::KEY_OPEN_POINTS;
                    $numKeysSolved++;
                }
            }
        }

        if ($numCellsSolved) {
            $this->gameStatus->users[$botUserNum]->score += $numCellsSolved * self::CELL_OPEN_POINTS;
            foreach (T::SUPPORTED_LANGS as $lang) {
                $this->addToLog(
                    T::S(
                        "[[Player]] opened [[number]] [[cell]]",
                        [$botUserNum + 1, $numKeysSolved + $numCellsSolved, $numKeysSolved + $numCellsSolved],
                        $lang
                    )
                    . ($numKeysSolved
                        ? T::S(" (including [[number]] [[key]])", [$numKeysSolved, $numKeysSolved], $lang)
                        : ''),
                    $lang
                );
            }
        } else {
            foreach (T::SUPPORTED_LANGS as $lang) {
                $this->addToLog(T::S('[[Player]] made a mistake', [$botUserNum + 1], $lang), $lang);
            }

            foreach (T::SUPPORTED_LANGS as $lang) {
                $this->gameStatus->users[($botUserNum + 1) % 2]->addComment(
                    T::S('Your opponent made a mistake', null, $lang),
                    $lang
                );
            }
        }

        $numPointsObtained = $numKeysSolved * self::KEY_OPEN_POINTS + $numCellsSolved * self::CELL_OPEN_POINTS;

        if ($numPointsObtained) {
            foreach (T::SUPPORTED_LANGS as $lang) {
                $this->addToLog(
                    T::S(
                        '[[Player]] gets [[number]] [[point]]',
                        [$botUserNum + 1, $numPointsObtained, $numPointsObtained],
                        $lang
                    ),
                    $lang
                );
            }


            foreach (T::SUPPORTED_LANGS as $lang) {
                $this->gameStatus->users[($botUserNum + 1) % 2]->addComment(
                    T::S('Your opponent got [[number]] [[point]]', [$numPointsObtained, $numPointsObtained], $lang),
                    $lang
                );
            }
        }

        if ($this->gameStatus->users[$botUserNum]->score >= $this->gameStatus->gameGoal) {
            $this->storeGameResults($this->gameStatus->users[$botUserNum]->ID);
        } elseif ($this->gameStatus->desk->hasUnopenedCells()) {
            $this->nextTurn();
        } else // Больше не осталось закрытых клеток - определяем победителя по очкам
        {
            if ($this->gameStatus->users[$botUserNum]->score >= $this->gameStatus->users[($botUserNum + 1) % 2]->score) {
                $winner = $this->gameStatus->users[$botUserNum]->ID;
            } else {
                $winner = $this->User;
            }

            $this->storeGameResults($winner);
        }
    }

    /**
     * СУДОКУ!
     * Один метод для пропустивших 3 хода и для сдавшихся.
     * Пропустил 3 хода - проиграл!
     * @param int $numLostUser Номер проигравшего (с 0)
     * @param bool $pass Сдался
     * @return string
     */
    public function lost3TurnsWinner(int $numLostUser, bool $pass = false): string
    {
        if ($this->gameStatus->users[$numLostUser]->score === 0) {
            $this->gameStatus->users[$numLostUser]->isActive = false;
        }

        $userWinner = ($numLostUser + 1) % 2;

        foreach (T::SUPPORTED_LANGS as $lang) {
            $this->addToLog(
                ($pass
                    ? T::S('gave up! Winner - ', null, $lang)
                    : T::S('skipped 3 turns! Winner - ', null, $lang)
                )
                . $this->gameStatus->users[$userWinner]->usernameLangArray[$lang]
                . T::S(' with score ', null, $lang)
                . $this->gameStatus->users[$userWinner]->score,
                $lang,
                $numLostUser
            );
        }

        return $this->gameStatus->users[$userWinner]->ID;
    }

    private function getBriefRules(?string $lang = null): string
    {
        return '';
    }

    public function gameStarted($statusUpdateNeeded = false): array
    {
        $res = parent::gameStarted($statusUpdateNeeded);

        // Особенности создания конкретной игры | начало

        // Число очков для победы - количество карт в стеке (30)
        $this->gameStatus->gameGoal = self::DEFAULT_STACK_LEN;

        foreach($this->gameStatus->users as $userNum => $user) {
            $this->gameStatus->playersCards[$userNum] = new PlayerCards();
            $this->gameStatus->playersCards[$userNum]->stack = $this->gameStatus->desk->getCardsFromKoloda($this->gameStatus->gameGoal);
            $this->gameStatus->playersCards[$userNum]->hand = $this->gameStatus->desk->getCardsFromKoloda(5);
        }

        // Добавляем в лог стартовый коммент без рейтинга
        foreach (T::SUPPORTED_LANGS as $lang) {
            $this->addToLog($this->getStartComment(null, $lang), $lang);
        }

        foreach ($this->gameStatus->users as $num => $user) {
            foreach (T::SUPPORTED_LANGS as $lang) {
                $user->addComment(
                    VH::strong(
                        $num === $this->gameStatus->activeUser
                            ? T::S('Your turn!', null, $lang)
                            : T::S('Your turn is next - get ready!', null, $lang)
                    )
                    . VH::div($this->getStartComment($num, $lang)) // Стартовый коммент с указанием рейтинга игрока
                    . $this->getBriefRules($lang),
                    // правила игры вкратце - потом вынести в фак, не выводить бывалым игрокам
                    $lang
                );
            }
        }
        // Особенности создания конкретной игры | конец

        return $res;
    }

    public function newDesk(): Desk
    {
        return new DeskSkipbo;
    }

    public function getGameStatus(int $gameNumber = null): GameStatus
    {
        try {
            $gameStatus = @Cache::get(
                self::getCacheKey(self::GAME_DATA_KEY . ($gameNumber ?: $this->currentGame))
            );
        } catch (\Throwable $e) {
            $gameStatus = null;
        }

        if (!($gameStatus instanceof GameStatus)) {
            $gameStatus = new GameStatusSkipbo();
        }

        return $gameStatus;
    }
}
