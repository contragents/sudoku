<?php

use classes\AbstractFinamApi;
use classes\Candle;
use classes\Command;

include_once __DIR__ . '/../../autoload.php';

class TodayWorker extends Command
{
    const DEFAULT_EXEC_TIME = 10 * 60;                                // Время исполнения скрипта по умолчанию
    const COMMAND_KEY_PREFIX = parent::COMMAND_KEY_PREFIX . __CLASS__; // Ключ для отслеживания запущенного скрипта

    public function run()
    {
        exit;
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        $_REQUEST['cli_mode'] = true;
        $baseDate = $this->params['date'] ?? date('Y-m-d');
        mp($baseDate, 'Parsing date', __METHOD__);

        foreach (AbstractFinamApi::TICKERS as $ticker) {
            if (AbstractFinamApi::isBanned($ticker)) {
                continue;
            }

            $candles = new Candle(
                [
                    'SecurityBoard' => AbstractFinamApi::DEFAULT_BOARD,
                    'SecurityCode' => $ticker,
                    'TimeFrame' => AbstractFinamApi::TIME_FRAMES['M1'],
                    'Interval.From' => Candle::openMarketTimestamp($baseDate),
                    'Interval.Count' => Candle::DAILY_FRAME_COUNTS[AbstractFinamApi::TIME_FRAMES['M1']],
                ]
            );

            if (empty($candles->params)) {
                mp('', "Error in Params!", __METHOD__);

                continue;
            }

            if ($candles->makeRequest(Candle::API_METHOD, $candles->params)) {
                mp(
                    ['count' => count($candles->response['data']['candles'] ?? []), 'ticker' => $ticker],
                    'Number of candles received',
                    __METHOD__
                );

                if (!empty($candles->response['error'])) {
                    mp($candles->response['error'], "Error received!!", __METHOD__);

                    if ($candles->response['error']['code'] === AbstractFinamApi::ERROR_CODES['NOT_FOUND']) {
                        AbstractFinamApi::banEmitent($ticker);
                    } elseif ($candles->response['error']['code'] === AbstractFinamApi::ERROR_CODES['TOO_MANY_REQUESTS']) {
                        sleep(AbstractFinamApi::SLEEP * 10);
                    }

                    sleep(AbstractFinamApi::SLEEP);

                    continue;
                }

                if(!count($candles->response['data']['candles'] ?? [])) {
                    sleep(AbstractFinamApi::SLEEP);

                    continue;
                }

                CandleModel::save($candles);
                unset($candles);
            } else {
                sleep(AbstractFinamApi::SLEEP);

                continue;
            }

            // Повторяем для свечей 13:00+
            // todo вынести в метод
            $candles = new Candle(
                [
                    'SecurityBoard' => AbstractFinamApi::DEFAULT_BOARD,
                    'SecurityCode' => $ticker,
                    'TimeFrame' => AbstractFinamApi::TIME_FRAMES['M1'],
                    'Interval.From' => Candle::halfMarketDayTimestamp($baseDate),
                    'Interval.Count' => Candle::DAILY_FRAME_COUNTS[AbstractFinamApi::TIME_FRAMES['M1']],
                ]
            );

            if (empty($candles->params)) {
                mp('', "Error in Params!", __METHOD__);

                continue;
            }

            if ($candles->makeRequest(Candle::API_METHOD, $candles->params)) {
                mp(
                    ['count' => count($candles->response['data']['candles'] ?? []), 'ticker' => $ticker],
                    'Number of candles received',
                    __METHOD__
                );

                if (!empty($candles->response['error'])) {
                    mp($candles->response['error'], "Error received!!", __METHOD__);
                    sleep(AbstractFinamApi::SLEEP);

                    continue;
                }

                CandleModel::save($candles);
                unset($candles);
            }
        }
    }
}

(new TodayWorker(__FILE__))->run();