<?php

use classes\T;

class FaqController extends BaseSubController
{
    const NO_STONE_PARAM = 'no_stone';
    const NO_BRONZE_PARAM = 'no_bronze';
    const NO_SILVER_PARAM = 'no_silver';
    const NO_GOLD_PARAM = 'no_gold';
    const FILTER_PLAYER_PARAM = 'opponent_id';

    public function getAllAction(): string
    {
        return json_encode(
            [
                'faq_rules' => T::S('faq_rules'),
                'faq_rating' => T::S('faq_rating'),
                'faq_rewards' => T::S('faq_rewards'),
                'faq_coins' => T::S('faq_coins'),
            ],
            JSON_UNESCAPED_UNICODE
        );
    }
}