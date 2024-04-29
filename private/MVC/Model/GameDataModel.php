<?php

use classes\DB;
use classes\ORM;

class GameDataModel extends BaseModel
{
    const TABLE_NAME = 'game_data';
    const ID_FIELD = 'id';
    const GAME_ID_FIELD = 'game_id';
    const GAME_NAME_FIELD = 'game_name';

    public static function getLastGameId(string $gameName)
    {
        $query = ORM::select([ORM::agg(ORM::MAX, self::GAME_ID_FIELD)], self::TABLE_NAME)
            . ORM::where(self::GAME_NAME_FIELD, '=', $gameName);

        return DB::queryValue($query) ?: 0;
    }
}