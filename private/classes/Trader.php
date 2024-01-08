<?php


namespace classes;


use CandleModel;

class Trader
{
    const PUMP_GROW_GOAL = 0.15;

    public static function getTikersGrowing(string $date = null): array
    {
        $date = $date ?? date('Y-m-d');
        $nextDate = substr(AbstractFinamApi::incTimestamp(AbstractFinamApi::openMarketTimestamp($date), 'D1'), 0, 10);
        $growRate = self::PUMP_GROW_GOAL;

        $query = <<<QUERY
select (max(high_price) - min(open_price)) / min(open_price) as grow, c.* from candle c
where `timestamp` > '$date'
    and `timestamp` < '$nextDate'
    and time_frame = 'M1'
GROUP BY emitent_code
having grow > $growRate
ORDER BY grow DESC
QUERY;
        $res = DB::queryArray($query) ?: [];

        return $res;
    }
}