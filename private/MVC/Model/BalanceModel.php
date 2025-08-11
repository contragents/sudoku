<?php

use classes\DB;
use classes\ORM;
use BaseController as BC;


/**
 * Class BalanceModel
 * @property int $_id Player common_id
 * @property int $_sudoku SUDOKU balance
 */
class BalanceModel extends BaseModel
{
    const TABLE_NAME = 'balance';

    const COMMON_ID_FIELD = self::ID_FIELD;
    const SUDOKU_BALANCE_FIELD = 'sudoku';

    public ?int $_sudoku = null;

    const HIDDEN_BALANCE_REPLACEMENT = '*****';

    const SYSTEM_ID = 0;
    const MIN_TOP_COIN = 500; // До стольки монет выводим в лидербордах

    public static function changeBalance(
        int $commonId,
        float $deltaBalance,
        string $description = '',
        ?int $typeId = null,
        ?int $ref = null
    ): bool {
        if (!self::exists($commonId)) {
            if (!self::createBalance($commonId)) {
                return false;
            }
        }

        // todo в таблицу balance заносим только целые монеты, дроби записываем в income (IncomeModel::changeIncome())
        $deltaBalance = (int)round($deltaBalance);

        DB::transactionStart();

        // 1. В поле sudoku таблицы balance записать значение из поля sudoku + $deltabalance
        if (!self::setParam(
            $commonId,
            self::SUDOKU_BALANCE_FIELD,
            self::SUDOKU_BALANCE_FIELD . ' + ' . $deltaBalance,
            true
        )) {
            DB::transactionRollback();

            return false;
        }

        // 2. Завести запись в историю транзакций о списании/начислении. значения брать из balance.sudoku
        if (!BalanceHistoryModel::addTransaction($commonId, $deltaBalance, $description, $typeId, $ref)) {
            DB::transactionRollback();

            return false;
        }

        DB::transactionCommit();

        return true;
    }

    public static function getBalance(int $commonId): int
    {
        return (int)DB::queryValue(
            ORM::select([self::SUDOKU_BALANCE_FIELD], self::TABLE_NAME)
            . ORM::where(self::COMMON_ID_FIELD, '=', $commonId, true)
        );
    }

    public static function getBalanceFormatted(int $commonId): string
    {
        return number_format(self::getBalance($commonId), 0, '.', ',');
    }

    private static function createBalance(int $commonId): bool
    {
        return (bool)self::add([self::COMMON_ID_FIELD => $commonId]);
    }

    public static function getTopByBalance(int $balance): int
    {
        $topQuery = ORM::select(
            ['count(1) + 1 as top'],
            "("
            . ORM::select(['1 as num'], self::TABLE_NAME)
            . ORM::where(self::SUDOKU_BALANCE_FIELD, '>', $balance, true)
            . ORM::groupBy([self::SUDOKU_BALANCE_FIELD])
            . ") dd"
        );

        return (int)DB::queryValue($topQuery);
    }

    /**
     * @param int $top
     * @param int|null $topMax
     * @return self[][]
     */
    public static function getTopPlayersO(int $top, ?int $topMax = null): array
    {
        $rows1 = self::getTopPlayers($top, $topMax);

        $res = [];

        foreach ($rows1 as $top => $rows2) {
            $res[$top] = [];
            foreach ($rows2 as $row) {
                $res[$top][] = self::arrayToObject($row);
            }
        }

        return $res;
    }

    /**
     * @param int $top Номер в рейтинге балансов - 1,2,3 ...
     * @param int|null $topMax Максимальный номер в рейтинге балансов (для поиска ТОП10 задать 4,10)
     * @return array
     */
    public static function getTopPlayers(int $top, ?int $topMax = null): array
    {
        if ($top >= ($topMax ?? PlayerModel::TOP_10)) {
            return [];
        }

        // Берем только те балансы, которые играли в игру Game::$gameName - рейтинг > 0
        $topBalancesQuery = self::select(
                [
                    self::SUDOKU_BALANCE_FIELD,
                    CommonIdRatingModel::select(
                        ['1'],
                        true,
                        ORM::where(CommonIdRatingModel::RATING_FIELD_PREFIX . BC::gameName(), '>', 0, true)
                        . ORM::andWhere(
                            BalanceModel::getFieldWithTable(BalanceModel::COMMON_ID_FIELD),
                            '=',
                            CommonIdRatingModel::COMMON_ID_FIELD,
                            true
                        )
                        . ORM::limit(1),
                        'odin'
                    )
                ]
            )
            . ORM::where(self::SUDOKU_BALANCE_FIELD, '>=', self::MIN_TOP_COIN, true)
            . ORM::groupBy([self::SUDOKU_BALANCE_FIELD])
            . ORM::orderBy(self::SUDOKU_BALANCE_FIELD . ' * ' . 'odin', false)
            . ORM::limit($topMax ? $topMax - $top + 1 : 1, $top - 1);

        $topBalances = DB::queryArray($topBalancesQuery) ?: [];

        $resultBalances = [];

        for ($i = $top; $i <= $topMax ?: $top; $i++) {
            if (!($topBalances[$i - $top]['odin'] ?? false)) {
                break;
            }

            $currentBalance = $topBalances[$i - $top][self::SUDOKU_BALANCE_FIELD] ?? false;
            if (!$currentBalance) {
                break;
            }

            $resultBalances[$i] = DB::queryArray(
                self::select([self::COMMON_ID_FIELD, self::SUDOKU_BALANCE_FIELD])
                . ORM::where(self::SUDOKU_BALANCE_FIELD, '=', $currentBalance, true)
            ) ?: [];
        }

        return $resultBalances;
    }
}
