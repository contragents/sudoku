<?php

namespace classes;

use BaseController as BC;
use classes\ViewHelper as VH;

class GameSkipbo extends Game
{
    public const GAME_NAME = 'skipbo';

    const NUM_SKIP_TURNS_TO_LOOSE = 5;

    const DEFAULT_STACK_LEN = 10; // сколько карт в стеке

    const NUM_RATING_PLAYERS_KEY = self::GAME_NAME . parent::NUM_RATING_PLAYERS_KEY; // Список игроков онлайн
    const NUM_COINS_PLAYERS_KEY = self::GAME_NAME . '.num_coins_players';

    const RESPONSE_PARAMS = ['desk' => ['gameStatus' => 'openDesk']] + parent::RESPONSE_PARAMS;

    const DEFAUTL_TURN_TIME = 120;
    const MAX_BOT_CYCLES = 50; // Максивальное число циклов на обдумывание хода ботом

    /** @var GameStatusSkipbo|null */
    public ?GameStatus $gameStatus = null;

    public function __construct()
    {
        parent::__construct(QueueSkipbo::class);
    }

    private function makeBotMove(int $numUser): TurnSkipbo
    {
        $continue = true;
        $numCyclesToGo = static::MAX_BOT_CYCLES;
        // Работаем в цикле, обходя карты (целевую, на руках, банк)
        while ($continue && $numCyclesToGo) {
            $continue = false;
            $numCyclesToGo--;

            // Проверяем, можно ли сыграть целевой картой
            $goalCard = end($this->gameStatus->playersCards[$numUser]->goalStack);
            foreach ($this->gameStatus->desk->desk as $pos => &$cardsArr) {
                if ($this->gameStatus->checkCardOnCard($goalCard, end($cardsArr))) {
                    // Нашли место для целевой карты
                    $goalCardTurnObject = new TurnSkipbo();
                    $goalCardTurnObject->entityName = GameStatusSkipbo::GOAL_CARD;
                    $goalCardTurnObject->entityValue = $goalCard;
                    $goalCardTurnObject->entityNum = 1;
                    $goalCardTurnObject->newPositionName = GameStatusSkipbo::COMMON_AREA;
                    $goalCardTurnObject->newPositionNum = $pos;

                    // todo validateTurn должен гдето вести учет набранных очков за ход и добавлять комментарий о наборе очков за ход
                    if ($this->gameStatus->validateTurn($goalCardTurnObject, $numUser)) {
                        // Ставим флаг продолжения цикла
                        $continue = true;

                        continue 2; // Повторяем while
                    }
                }
            }

            // Проверяем, можно ли поставить карту с руки в commonArea
            foreach ($this->gameStatus->playersCards[$numUser]->hand as $handPos => $handCard) {
                if (!$handCard) {
                    continue;
                }

                foreach ($this->gameStatus->desk->desk as $commonPos => &$cardsArr) {
                    if ($this->gameStatus->checkCardOnCard($handCard, end($cardsArr))) {
                        $goalCardTurnObject = new TurnSkipbo();
                        $goalCardTurnObject->entityName = GameStatusSkipbo::HAND_CARD;
                        $goalCardTurnObject->entityValue = $handCard;
                        $goalCardTurnObject->entityNum = $handPos;
                        $goalCardTurnObject->newPositionName = GameStatusSkipbo::COMMON_AREA;
                        $goalCardTurnObject->newPositionNum = $commonPos;

                        if ($this->gameStatus->validateTurn($goalCardTurnObject, $numUser)) {
                            // Ставим флаг продолжения цикла
                            $continue = true;

                            continue 3; // Повторяем while
                        }
                    }
                }
            }

            // Проверяем, можно ли сыграть картой из банка
            foreach ($this->gameStatus->playersCards[$numUser]->bank as $bankPos => &$bankCardsArr) {
                foreach ($this->gameStatus->desk->desk as $commonPos => &$cardsArr) {
                    $bankCard = end($bankCardsArr);
                    if ($bankCard && $this->gameStatus->checkCardOnCard($bankCard, end($cardsArr))) {
                        $goalCardTurnObject = new TurnSkipbo();
                        $goalCardTurnObject->entityName = GameStatusSkipbo::BANK_CARD;
                        $goalCardTurnObject->entityValue = $bankCard;
                        $goalCardTurnObject->entityNum = $bankPos;
                        $goalCardTurnObject->newPositionName = GameStatusSkipbo::COMMON_AREA;
                        $goalCardTurnObject->newPositionNum = $commonPos;

                        if ($this->gameStatus->validateTurn($goalCardTurnObject, $numUser)) {
                            // Ставим флаг продолжения цикла
                            $continue = true;

                            continue 3; // Повторяем while
                        }
                    }
                }
            }
        }

        // todo сбрысываем карту в банк только если не задано макс число карт для хода
        // или если бот положил меньше карт чем макс число карт
        // для имитации думанья в течение всего времени хода
        // Завершаем ход - сбрасываем рандомную карту с руки в банк
        $turnEnd = new TurnSkipbo();
        foreach ($this->gameStatus->playersCards[$numUser]->hand as $pos => $card) {
            if ($card) {
                $turnEnd->entityName = GameStatusSkipbo::HAND_CARD;
                $turnEnd->entityNum = $pos;
                $turnEnd->entityValue = $card;
                $turnEnd->newPositionName = GameStatusSkipbo::BANK_AREA;
                $turnEnd->newPositionNum = mt_rand(1, count($this->gameStatus->playersCards[$numUser]->bank));
            }
        }

        return $turnEnd;
    }

    public function finishTurn(int $numUser): void
    {
        // Проверяем, что на руке не пустая кучка карт
        if ($this->gameStatus->isHandEmpty($numUser)) {
            $this->gameStatus->fillHand($numUser);
        }

        $turn = new TurnSkipbo();

        // Пока только сбрасываем рандомную карту с руки в банк
        foreach ($this->gameStatus->playersCards[$numUser]->hand as $pos => $card) {
            if ($card) {
                $turn->entityName = GameStatusSkipbo::HAND_CARD;
                $turn->entityNum = $pos;
                $turn->entityValue = $card;
                $turn->newPositionName = GameStatusSkipbo::BANK_AREA;
                $turn->newPositionNum = mt_rand(1, count($this->gameStatus->playersCards[$numUser]->bank));
            }
        }

        $this->gameStatus->validateTurn($turn, $numUser);
    }

    public function submitTurn(): array
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        if (!$this->checkIsMyTurnAndLog()) {
            return parent::submitTurn();
        }

        $turn = new TurnSkipbo((json_decode(BC::$Request[TurnSkipbo::TURN_DATA_PARAM], true) ?: []) ?? []);
        if ($this->gameStatus->validateTurn($turn)) {
            $res = ['turn_response' => ['result' => TurnSkipbo::TURN_RESPONSE_OK]];
            // Проверяем, вдруг игрок выиграл
            if ($this->gameStatus->users[$this->numUser]->score >= $this->gameStatus->gameGoal) {
                $this->storeGameResults($this->gameStatus->users[$this->numUser]->ID);
            } elseif ($turn->newPositionName === GameStatusSkipbo::BANK_AREA) {
                // Если игрок положил карту в банк, то это конец его хода
                $this->nextTurn();
            }
        } else {
            $res = ['turn_response' => ['result' => TurnSkipbo::TURN_RESPONSE_ERROR]];
        }

        return $res + parent::submitTurn();
    }

    protected function nextTurn(): void
    {
        // Дораздали карты всем игрокам. На всякий случай
        foreach ($this->gameStatus->users as $num => $nothing) {
            $this->gameStatus->fillHand($num);
        }

        parent::nextTurn();
    }

    public function makeBotTurn(int $botUserNum): void
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        //Обновляем время активности бота
        $this->gameStatus->users[$botUserNum]->lastActiveTime = date('U');
        $this->gameStatus->users[$botUserNum]->inactiveTurn = 1000;

        // todo сделать makeBotMove() с параметром numCardsToPlay - сколько карт сыграть в этот заход, чтобы растянуть ход на несколько запросов
        $turn = $this->makeBotMove($botUserNum);
        if ($this->gameStatus->validateTurn($turn, $botUserNum)) {
            // Проверяем, вдруг бот выиграл
            if ($this->gameStatus->users[$botUserNum]->score >= $this->gameStatus->gameGoal) {
                $this->storeGameResults($this->gameStatus->users[$botUserNum]->ID);

                return;
            }


            // Если игрок положил карту в банк, то это конец его хода
            if ($turn->newPositionName === GameStatusSkipbo::BANK_AREA) {
                $this->nextTurn();

                return;
            }
        } else {
            // todo что делать,если ошибка в ходе бота?
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
            $this->gameStatus->playersCards[$userNum]->goalStack =
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
