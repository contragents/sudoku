<?php

/**
 * Это воркер Реббита!!!! Visit
 **/

use classes\AbstractFinamApi;
use classes\Candle;
use classes\Command;

include_once __DIR__ . '/../../autoload.php';

class RetrospectiveWorker extends Command
{
    static $timeFrame = AbstractFinamApi::TIME_FRAMES['M5'];
    const DEFAULT_EXEC_TIME = 60 * 60;                                // Время исполнения скрипта по умолчанию
    const COMMAND_KEY_PREFIX = parent::COMMAND_KEY_PREFIX . __CLASS__; // Ключ для отслеживания запущенного скрипта

    public function run()
    {
        exit;
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        $_REQUEST['cli_mode'] = true;
        $defaultBaseDate = date('Y-m-d');
        $goalDate = '2022-11-06';
        mp('start here', '!!!', __METHOD__);
        $noCandles = false;

        while (!$noCandles) {
            $noCandles = true;

            foreach (AbstractFinamApi::TICKERS as $ticker) {
                mp($ticker, 'Ticker', __METHOD__);

                try {
                    if (AbstractFinamApi::isBanned($ticker)) {
                        mp($ticker, 'Banned', __METHOD__);
                        continue;
                    }

                    $baseDate = CandleModel::getTickerDeepestScanDate(
                            $ticker,
                            self::$timeFrame
                        ) ?? Candle::openMarketTimestamp(
                            $defaultBaseDate
                        );
                    $preBaseDate = Candle::decTimestamp($baseDate);
                } catch (Throwable $e) {
                    print $e->__toString();
                }

                mp(
                    ['base_date' => $baseDate, 'pre_base_date' => $preBaseDate],
                    'Даты обработки эмитента ' . $ticker,
                    __METHOD__
                );

                $decreasingCount = 0;
                while (true) {
                    if ($preBaseDate < $goalDate) {
                        break;
                    }

                    if ($decreasingCount > 10) {
                        AbstractFinamApi::banEmitent($ticker);
                        break;
                    }

                    $candles = new Candle(
                        [
                            'SecurityBoard' => AbstractFinamApi::DEFAULT_BOARD,
                            'SecurityCode' => $ticker,
                            'TimeFrame' => self::$timeFrame,
                            'Interval.From' => Candle::openMarketTimestamp($preBaseDate),
                            'Interval.Count' => Candle::DAILY_FRAME_COUNTS[self::$timeFrame],
                        ]
                    );

                    if (empty($candles->params)) {
                        mp(
                            [
                                'SecurityBoard' => AbstractFinamApi::DEFAULT_BOARD,
                                'SecurityCode' => $ticker,
                                'TimeFrame' => self::$timeFrame,
                                'Interval.From' => Candle::openMarketTimestamp($preBaseDate),
                                'Interval.Count' => Candle::DAILY_FRAME_COUNTS[self::$timeFrame],
                            ],
                            "Error in Candles Params!",
                            __METHOD__
                        );

                        break;
                    }

                    if ($candles->makeRequest(Candle::API_METHOD, $candles->params)) {
                        mp(
                            count($candles->response['data']['candles'] ?? []) ?: $candles->response,
                            'Response received',
                            __METHOD__
                        );
                        if (count($candles->response['data']['candles'] ?? []) === 0
                            &&
                            !empty($candles->response['error'])) {
                            mp($candles->response['error'], "Error received!!", __METHOD__);

                            if ($candles->response['error']['code'] === AbstractFinamApi::ERROR_CODES['NOT_FOUND']) {
                                AbstractFinamApi::banEmitent($ticker);
                            } elseif ($candles->response['error']['code'] === AbstractFinamApi::ERROR_CODES['TOO_MANY_REQUESTS']) {
                                sleep(AbstractFinamApi::SLEEP * 10);
                            }

                            sleep(AbstractFinamApi::SLEEP);
                            break;
                        }

                        if (Candle::compareTimestamps(
                            $preBaseDate,
                            array_map(
                                fn($candle) => $candle['timestamp'],
                                $candles->response['data']['candles'] ?? []
                            )
                        )) {
                            mp($preBaseDate, 'Data collected successfully', __METHOD__);
                            $noCandles = false;


                            CandleModel::save($candles);
                            unset($candles);

                            break;
                        } else {
                            mp($preBaseDate, 'Data NOT collected!!! Decreasing date', __METHOD__);

                            $decreasingCount++;
                            sleep(ceil(AbstractFinamApi::SLEEP / 5));

                            $preBaseDate = Candle::decTimestamp($preBaseDate);
                            unset($candles);

                            continue;
                        }
                    }
                }
            }
        }
    }
}

(new RetrospectiveWorker(__FILE__))->run();