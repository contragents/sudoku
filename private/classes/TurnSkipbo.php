<?php

namespace classes;

/**
 * @property string $entity Название позиции карты, которую переместили (handCard, bankCard, goalCard))
 * @property int $entityNum Номер карты (1 для HandCard1, false для goalCard)
 * @property int $entityValue Достоинство перемещенной карты
 * @property string $newPositionName Название позиции, на которую переместили карту
 * @property int $newPositionNum Номер позиции (1 для bankCard1, для commonCard1)
 */

class TurnSkipbo
{
    const TURN_DATA_PARAM = 'turn_data';

    const TURN_RESPONSE_OK = 'ok';
    const TURN_RESPONSE_ERROR = 'error';

    public ?string $entityName = null;
    public ?int $entityNum = null;
    public ?int $entityValue = null;
    public ?string $newPositionName = null;
    public ?int $newPositionNum = null;

    /**
     * @param array $turnData
     */
    public function __construct(array $turnData)
    {
        $this->entityName = $turnData['entity'];
        $this->entityNum = $turnData['entity_num'];
        $this->entityValue = $turnData['entity_value'];
        $this->newPositionName = $turnData['new_position'];
        $this->newPositionNum = $turnData['new_position_num'];
    }
}