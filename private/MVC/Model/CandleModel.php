<?php


use classes\Candle;
use classes\DB;
use classes\ORM;

class CandleModel extends BaseModel
{
    const TABLE_NAME = 'candle';

    const EMITENT_CODE_FIELD = 'emitent_code';
    const PRICE_LOW_FIELD = 'low_price';
    const PRICE_HI_FIELD = 'high_price';
    const PRICE_OPEN_FIELD = 'open_price';
    const PRICE_CLOSE_FIELD = 'close_price';
    const TIME_FIELD = 'timestamp';
    const VOLUME_FIELD = 'volume';
    const TIME_FRAME_FIELD = 'time_frame';
    const BOARD_FIELD = 'board';

    const MARKET_1M_CLOSING_TIME = '15:49:00';
    const MARKET_5M_CLOSING_TIME = '15:45:00';
    const DATE_FORMAT = 'Y-m-d';
    const TIME_FORMAT = 'H:i:s';
    const DATE_TIME_FILLER = 'T';
    const TIME_ENDING = 'Z';
    const MOSCOW_UTC_HOURS_DELTA = -3;

    public static function save(Candle $candleObject): bool
    {
        $res = true;

        foreach ($candleObject->response['data']['candles'] as $candle) {
            $insertQuery = ORM::insert(self::TABLE_NAME)
                . ORM::insertFieldsRawValues(
                    [
                        self::EMITENT_CODE_FIELD => DB::escapeString($candleObject->params['SecurityCode']),
                        self::BOARD_FIELD => DB::escapeString($candleObject->params['SecurityBoard']),
                        self::TIME_FRAME_FIELD => DB::escapeString($candleObject->params['TimeFrame']),
                        self::TIME_FIELD => DB::escapeString($candle['timestamp']),
                        self::VOLUME_FIELD => $candle['volume'],
                        self::PRICE_LOW_FIELD => $candle['low']['num'] / (10 ** $candle['low']['scale']),
                        self::PRICE_HI_FIELD => $candle['high']['num'] / (10 ** $candle['high']['scale']),
                        self::PRICE_OPEN_FIELD => $candle['open']['num'] / (10 ** $candle['open']['scale']),
                        self::PRICE_CLOSE_FIELD => $candle['close']['num'] / (10 ** $candle['close']['scale']),
                    ]
                );

            if (DB::queryInsert($insertQuery)) {
                print DB::insertID();
            } else {
                // print $insertQuery . '<br>';

                $res = false;
            }
        }

        return $res;
    }

    /**
     * @param string $ticker
     * @param string $timeFrame
     * @return string|null
     */
    public static function getTickerDeepestScanDate(string $ticker, string $timeFrame): ?string
    {
        $query = ORM::select([ORM::agg(ORM::MIN, self::TIME_FIELD, self::TIME_FIELD)], self::TABLE_NAME)
        . ORM::where(self::EMITENT_CODE_FIELD, '=', $ticker)
        . ORM::andWhere(self::TIME_FRAME_FIELD, '=', $timeFrame);

       return DB::queryValue($query) ?: null;
    }
}
