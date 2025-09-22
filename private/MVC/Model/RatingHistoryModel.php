<?php

use classes\ApcuCache;
use classes\DB;
use classes\Game;
use classes\ORM;

/**
 * @property int $_created_at
 * @property int $game_id
 * @property int $game_name_id
 * @property bool $is_winner
 * @property int $rating_before
 * @property int $rating_after
 **/
class RatingHistoryModel extends BaseModel
{
    const TABLE_NAME = 'rating_history';

    const GAME_ID_FIELD = 'game_id';
    const GAME_NAME_ID_FIELD = 'game_name_id';
    const IS_WINNER_FIELD = 'is_winner';
    const RATING_BEFORE_FIELD = 'rating_before';
    const RATING_AFTER_FIELD = 'rating_after';

    const FIRST_PLAY_TS_KEY = '.first_play_ts.';
    const FIRST_PLAY_TTL = 60 * 60; // кеш на 1 час

    public ?int $_created_at = null;
    public ?int $game_id = null;
    public ?int $game_name_id = null;
    public bool $is_winner = false;
    public ?int $rating_before = null;
    public ?int $rating_after = null;

    public static function addRatingChange(
        int $commonId,
        int $oldRating,
        int $newRating,
        bool $isWinner,
        int $gameId,
        string $gameName = Game::GAME_NAME
    ) {
        return self::add(
            [
                self::COMMON_ID_FIELD => $commonId,
                self::RATING_BEFORE_FIELD => $oldRating,
                self::RATING_AFTER_FIELD => $newRating,
                self::IS_WINNER_FIELD => $isWinner ? 1 : 0,
                self::GAME_ID_FIELD => $gameId,
                self::GAME_NAME_ID_FIELD => self::GAME_IDS[$gameName],
                self::CREATED_AT_FIELD => date('U'),
            ]
        );
    }

    public static function getNumGamesPlayed($commonId, string $gameName = ''): int
    {
        return DB::queryValue(
            ORM::select(['count(1)'], self::TABLE_NAME)
            . ORM::where(self::COMMON_ID_FIELD, '=', $commonId, true)
            . (in_array($gameName, self::GAME_IDS)
                ? ORM::andWhere(self::GAME_NAME_ID_FIELD, '=', self::GAME_IDS[$gameName], true)
                : '')
        ) ?: 0;
    }

    public static function getDeltaRating($commonId, string $gameName): int
    {
        $lastRatingChangeRecord = DB::queryArray(
                self::select(['*'])
                . ORM::where(self::COMMON_ID_FIELD, '=', $commonId, true)
                . ORM::andWhere(self::GAME_NAME_ID_FIELD, '=', self::GAME_IDS[$gameName], true)
                . ORM::orderBy(self::ID_FIELD, false)
                . ORM::limit(1)
            )[0] ?? false;

        if (!$lastRatingChangeRecord) {
            return 0;
        }

        return $lastRatingChangeRecord[self::RATING_AFTER_FIELD] - $lastRatingChangeRecord[self::RATING_BEFORE_FIELD];
    }

    /**
     * @param int $commonId
     * @return int
     */
    public static function getFirstPlayTimestamp(int $commonId): int
    {
        $cacheKey = BaseController::gameName() . self::FIRST_PLAY_TS_KEY . $commonId;
        if ($firstPlayTs = ApcuCache::get($cacheKey)) {
            return $firstPlayTs;
        }

        $firstPlayTs = self::selectO(
                [],
                ORM::where(self::COMMON_ID_FIELD, '=', $commonId)
                . ORM::andWhere(
                    self::GAME_NAME_ID_FIELD,
                    '=',
                    BalanceHistoryModel::GAME_IDS[BaseController::gameName()]
                ),
                ORM::orderBy(self::ID_FIELD)
                . ORM::limit(1)
            )[0]->_created_at ?? 0;

        ApcuCache::set($cacheKey, $firstPlayTs, self::FIRST_PLAY_TTL);

        return $firstPlayTs;
    }
}