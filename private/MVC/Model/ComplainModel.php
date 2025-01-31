<?php

use classes\DB;

class ComplainModel
{
    const TABLE_NAME = 'complains';
    const COMPLAINS_PER_DAY = 5;

    public static function add(int $fromCommonId, int $toCommonId, array $chatLog): bool
    {
        // todo рефактор на моделях объектных
        $numComplains = DB::queryValue(
            "SELECT count(1) "
            . "FROM " . self::TABLE_NAME . " "
            . "WHERE "
            . "date_uniq = '" . date('Y-m-d') . "' "
            . "AND "
            . "from_common_id = $fromCommonId "
        ) ?: 0;
        if ($numComplains >= self::COMPLAINS_PER_DAY) {
            return false;
        }

        if (DB::queryInsert(
            "INSERT INTO " . self::TABLE_NAME . " "
            . "SET "
            . "from_common_id = $fromCommonId, "
            . "to_common_id = $toCommonId, "
            . "date_uniq = '" . date('Y-m-d') . "', "
            . "chat_log = compress('" . DB::escapeString(serialize($chatLog)) . "') "
        )) {
            return BanModel::ban($toCommonId, $fromCommonId);
        } else {
            return false;
        }
    }
}