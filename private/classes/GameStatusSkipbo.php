<?php


namespace classes;


use BaseController as BC;

/**
 * @property PlayerCards[] $playersCards массив карт игроков (карты на руках, стек, банк 4 кучки)
 */
class GameStatusSkipbo extends GameStatus
{
    /** @var DeskSkipbo|null */
    public ?Desk $desk = null;
    const HAND_CARD = 'handCard';
    const BANK_CARD = 'bankCard';
    const GOAL_CARD = 'goalCard';
    const COMMON_AREA = 'commonArea';
    const BANK_AREA = 'bankArea';


    /** @var PlayerCards[] $playersCards массив карт игроков (карты на руках, стек, банк 4 кучки) */
    public array $playersCards = [];

    /**
     * @param int $cardNumUp 1-12, 1000
     * @param false|int $cardNumDown false, 1-12, 1000, 1001-1012
     * @return bool
     */
    public static function checkCardOnCard(int $cardNumUp, $cardNumDown): bool
    {
        // Учитываем SKIPBO + номер карты для карты в commonArea
        if ($cardNumDown) {
            if ($cardNumUp === DeskSkipbo::SKIPBO_CARD && $cardNumDown < DeskSkipbo::SKIPBO_CARD) {
                return true;
            } else {
                if ($cardNumUp - ($cardNumDown % DeskSkipbo::SKIPBO_CARD) === 1) {
                    return true;
                }
            }
        } else {
            if ($cardNumUp === 1 || $cardNumUp === DeskSkipbo::SKIPBO_CARD) {
                return true;
            }
        }

        return false;
    }

    /**
     * Возвращает открытые для текущего (чей запрос) игрока карты
     * @return array
     */
    public function openDesk(): array
    {
        // Adding players' open goal cards & bank cards
        $res = array_map(
            fn($playerCards) => [
                'goal' => end($playerCards->goalStack),
                'goal_count' => count($playerCards->goalStack),
                'bank' => $playerCards->bank,
            ],
            $this->playersCards
        );

        // Add common cards
        $res['common_cards'] = $this->desk->desk;

        // Add cards on hand for current player
        $res['you_hand_cards'] = $this->playersCards[BC::$instance->Game->numUser]->hand;

        return $res;
    }

    /**
     * Проверяет корректность присланной карты,
     * корректнсть ее перемещения,
     * двигает карты в соответствующих стопках
     * начисляет очки за goalCard
     * выдает новые 5 карт на руки, если они кончились в этом ходу
     * @param TurnSkipbo $turn
     * @return bool
     */
    public function validateTurn(TurnSkipbo $turn, ?int $numUser = null): bool
    {
        if ($numUser === null) {
            $numUser = BC::$instance->Game->numUser;
        }
        switch ($turn->entityName) {
            case self::HAND_CARD:
            {
                if ((int)$turn->entityValue !== $this->playersCards[$numUser]->hand[$turn->entityNum]) {
                    return false;
                }

                switch ($turn->newPositionName) {
                    case self::BANK_AREA:
                    {
                        // Добавляем карту в банк
                        array_push($this->playersCards[$numUser]->bank[$turn->newPositionNum], $turn->entityValue);
                        // Убираем карту с руки игрока..
                        $this->delHandCard($turn->entityNum, $numUser);
                        // Дораздать карты до 5ти
                        $this->fillHand($numUser);

                        return true;
                    }

                    case self::COMMON_AREA:
                    {
                        if (self::checkCardOnCard($turn->entityValue, end($this->desk->desk[$turn->newPositionNum]))) {
                            // Добавлем карту на общую ячейку
                            $this->pushCardToCommonArea($turn->entityValue, $turn->newPositionNum);

                            // Убираем карту с руки игрока
                            $this->delHandCard($turn->entityNum, $numUser);
                            // Проверим, вдруг все карты с руки потрачены - нужно дораздать 5 карт и продолжить ход
                            if (array_values($this->playersCards[$numUser]->hand) === array_values(
                                    [false, false, false, false, false]
                                )) {
                                $this->fillHand($numUser);
                                // todo Добавить время на ход?
                            }

                            return true;
                        } else {
                            return false;
                        }
                    }
                }

                break;
            }

            case self::BANK_CARD:
            {
                // Проверяем присланную карту банка на значение на сервере
                if ((int)$turn->entityValue !== end($this->playersCards[$numUser]->bank[$turn->entityNum])) {
                    return false;
                }

                // Проверяем, куда положили карту с банка (валиден только вариант commonArea)
                switch ($turn->newPositionName) {
                    case self::COMMON_AREA:
                    {
                        if (self::checkCardOnCard($turn->entityValue, end($this->desk->desk[$turn->newPositionNum]))) {
                            // Добавлем карту на общую ячейку
                            $this->pushCardToCommonArea($turn->entityValue, $turn->newPositionNum);

                            // Убираем карту сверху из ячейки банка игрока
                            $this->delBankCard($turn->entityNum, $numUser);

                            return true;
                        } else {
                            return false;
                        }
                    }
                }

                break;
            }

            case self::GOAL_CARD:
            {
                // Проверяем присланную карту goalCard на значение на сервере
                if ((int)$turn->entityValue !== end($this->playersCards[$numUser]->goalStack)) {
                    return false;
                }

                // Проверяем, куда положили goalCard (валиден только вариант commonArea)
                switch ($turn->newPositionName) {
                    case self::COMMON_AREA:
                    {
                        if (self::checkCardOnCard($turn->entityValue, end($this->desk->desk[$turn->newPositionNum]))) {
                            // Добавлем карту на общую ячейку
                            $this->pushCardToCommonArea($turn->entityValue, $turn->newPositionNum);

                            // Убираем карту сверху из колоды goalCard игрока
                            $this->delGoalCard($numUser);
                            $this->users[$numUser]->score++;
                            // todo добавить в лог, что игрок увеличил счет

                            return true;
                        } else {
                            return false;
                        }
                    }
                }

                break;
            }

            default:
                return false;
        }

        return false;
    }

    public function delBankCard(mixed $entityNum, int $numUser)
    {
        array_pop($this->playersCards[$numUser]->bank[$entityNum]);
    }

    /**
     * Удаляем карту № $entityNum с руки у игрока $numUser
     * @param int $entityNum
     * @param int $numUser
     * @return void
     */
    public function delHandCard(int $entityNum, int $numUser): void
    {
        $this->playersCards[$numUser]->hand[$entityNum] = false;
    }

    public function delGoalCard(int $numUser)
    {
        array_pop($this->playersCards[$numUser]->goalStack);
    }

    public function fillHand($numUser): void
    {
        foreach ($this->playersCards[$numUser]->hand as &$cardValue) {
            if ($cardValue === false) {
                [$cardValue] = $this->desk->getCardsFromKoloda(1);
            }
        }
    }

    private function pushCardToCommonArea(int $cardValue, int $commonPositionNum): void
    {
        $this->desk->desk[$commonPositionNum][] =
            $cardValue === DeskSkipbo::SKIPBO_CARD
                ? (end($this->desk->desk[$commonPositionNum]) ?: 0) + 1 + DeskSkipbo::SKIPBO_CARD
                : $cardValue;

        // Проверяем, что последняя карта 12 - убираем кучку во временную колоду
        if (end($this->desk->desk[$commonPositionNum]) % DeskSkipbo::SKIPBO_CARD === 12) {
            $this->desk->pushCardsToTmpKoloda($this->desk->desk[$commonPositionNum]);
            $this->desk->desk[$commonPositionNum] = [];
        }
    }
}