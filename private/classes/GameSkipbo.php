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

    const RESPONSE_PARAMS = ['desk' => ['gameStatus' => 'openDesk']] + parent::RESPONSE_PARAMS;

    const DEFAUTL_TURN_TIME = 120;

    /** @var GameStatusSkipbo|null */
    public ?GameStatus $gameStatus = null;

    public function __construct()
    {
        parent::__construct(QueueSkipbo::class);
    }

    private function makeBotMove(): array
    {
        return $this->gameStatus->desk->desk;
    }

    public function submitTurn(): array
    {
        if (!$this->checkIsMyTurnAndLog()) {
            return parent::submitTurn();
        }

        $turn = new TurnSkipbo(BC::$Request[TurnSkipbo::TURN_DATA_PARAM]);
        if ($this->gameStatus->validateTurn($turn)) {
            // todo вернуть ОК клиенту вместе с новым состоянием открытой данному игроку клиенту доски
        }

        return parent::submitTurn();
    }

    // todo fully refactor
    public function makeBotTurn(int $botUserNum)
    {
        //Обновили время активности бота
        $this->gameStatus->users[$botUserNum]->lastActiveTime = date('U');
        $this->gameStatus->users[$botUserNum]->inactiveTurn = 1000;

        $newDesk = $this->makeBotMove();

        if ($this->gameStatus->desk->checkNewDesc($newDesk)) {
            // todo SB-8
        }

        $this->nextTurn();
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

        foreach ($this->gameStatus->users as $userNum => $user) {
            $this->gameStatus->playersCards[$userNum] = new PlayerCards();
            $this->gameStatus->playersCards[$userNum]->stack =
                $this->gameStatus->desk->getCardsFromKoloda($this->gameStatus->gameGoal);
            $this->gameStatus->fillHand($userNum);
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

    public function getGameStatus(?int $gameNumber = null): GameStatus
    {
        try {
            $gameStatus = @Cache::get(
                self::getCacheKey(self::GAME_DATA_KEY . ($gameNumber ?? $this->currentGame))
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
