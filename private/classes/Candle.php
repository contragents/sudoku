<?php

namespace classes;

use CandleModel;

class Candle extends AbstractFinamApi
{
    const API_METHOD = 'api/v1/intraday-candles';
    const REQUIRED_PARAMS = [
        'SecurityBoard',
        'SecurityCode',
        'TimeFrame',
        'Interval.From',
        'Interval.Count',
    ];
    const ADDITIONAL_PARAMS = [];

    const DAILY_FRAME_COUNTS = [
        AbstractFinamApi::TIME_FRAMES['M1'] => 500,
        AbstractFinamApi::TIME_FRAMES['M5'] => 108
    ];

}