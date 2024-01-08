<?php


namespace classes;


use CandleModel;

class AbstractFinamApi
{
    // todo перенести токен в env, парсинг '=' в конце??
    const FINAM_TOKEN = 'CAEQj+xNGhguyV/pzyCdfGb6vQZXScUFjQVceQXeUSo=';
    const FINAM_URL = 'https://trade-api.finam.ru/';

    public const MARKET_OPENING_TIME = '07:00:00';
    const MARKET_HALF_DAY_TIME = '13:00:00';

    public const END_MARKET_HOUR = 16;

    public const TIME_FRAMES = ['M1' => 'M1', 'M5' => 'M5', 'M15' => 'M15', 'H1' => 'H1', 'D1' => 'D1', 'W1' => 'W1'];
    const MARKET_CLOSING_TIME = [
        self::TIME_FRAMES['M1'] => '15:59:00',
        self::TIME_FRAMES['M5'] => '15:55:00',
        self::TIME_FRAMES['M15'] => '15:45:00',
        self::TIME_FRAMES['H1'] => '15:00:00',
    ];

    // todo fill other lengths
    const STR_LENGTH = [
        self::TIME_FRAMES['M1'] => 0,
        self::TIME_FRAMES['M5'] => 0,
        self::TIME_FRAMES['M15'] => 0,
        self::TIME_FRAMES['H1'] => 0,
        self::TIME_FRAMES['D1'] => 10,
    ];

    const ERROR_CODES = ['NOT_FOUND' => 'NOT_FOUND', 'TOO_MANY_REQUESTS' => 'TOO_MANY_REQUESTS'];

    public const DEFAULT_BOARD = 'TQBR';

    public const SLEEP = 5;
    const BAN_PREFIX = 'BANNED_EMITENTS_';
    const BAN_TTL = 24 * 60 * 60;


    public ?array $response = null;
    public ?array $params = null;

    const TICKERS = [
        'ABRD',
        'ACKO',
        'ARSA',
        'ASSB',
        'AVAN',
        'BANE',
        'BANEP',
        'BISVP',
        'BLNG',
        'BRZL',
        'BSPBP',
        'CARM',
        'CHGZ',
        'CHKZ',
        'CHMK',
        'CNTL',
        'CNTLP',
        'DIOD',
        'DVEC',
        'DZRD',
        'DZRDP',
        'EELT',
        'ELTZ',
        'GAZA',
        'GAZAP',
        'GAZC',
        'GAZS',
        'GAZT',
        'GCHE',
        'GECO',
        'GEMA',
        'GTRK',
        'HIMCP',
        'IGST',
        'IGSTP',
        'INGR',
        'IRKT',
        'JNOS',
        'JNOSP',
        'KAZT',
        'KAZTP',
        'KBSB',
        'KCHE',
        'KCHEP',
        'KGKC',
        'KGKCP',
        'KLSB',
        'KMEZ',
        'KMTZ',
        'KOGK',
        'KRKN',
        'KRKNP',
        'KRKOP',
        'KROT',
        'KROTP',
        'KRSB',
        'KRSBP',
        'KTSB',
        'KTSBP',
        'KUBE',
        'KUZB',
        'KZOS',
        'KZOSP',
        'LIFE',
        'LNZL',
        'LNZLP',
        'LSNG',
        'LSNGP',
        'LVHK',
        'MAGE',
        'MAGEP',
        'MFGS',
        'MFGSP',
        'MGNT',
        'MGNZ',
        'MGTS',
        'MGTSP',
        'MISB',
        'MISBP',
        'MRKK',
        'MRKY',
        'MRSB',
        'MSTT',
        'NAUK',
        'NFAZ',
        'NKHP',
        'NKNC',
        'NKNCP',
        'NKSH',
        'NMTP',
        'NNSB',
        'NNSBP',
        'NSVZ',
        'OMZZP',
        'PAZA',
        'PMSB',
        'PMSBP',
        'PRFN',
        'PRMB',
        'RBCM',
        'RDRB',
        'RGSS',
        'RKKE',
        'ROLO',
        'ROSB',
        'ROST',
        'RTGZ',
        'RTSB',
        'RTSBP',
        'RUSI',
        'RZSB',
        'SAGO',
        'SAGOP',
        'SARE',
        'SAREP',
        'SIBN',
        'SLEN',
        'SPBE',
        'STSB',
        'STSBP',
        'SVET',
        'TASB',
        'TASBP',
        'TGKB',
        'TGKBP',
        'TNSE',
        'TORS',
        'TORSP',
        'TTLK',
        'TUZA',
        'UCSS',
        'UKUZ',
        'UNAC',
        'UNKL',
        'URKZ',
        'USBN',
        'UTAR',
        'VGSB',
        'VGSBP',
        'VJGZ',
        'VJGZP',
        'VLHZ',
        'VRSB',
        'VRSBP',
        'VSYD',
        'VSYDP',
        'WTCM',
        'WTCMP',
        'YAKG',
        'YKEN',
        'YKENP',
        'YRSB',
        'YRSBP',
        'ZILL',
        'ZVEZ'
    ];

    public static function banEmitent(string $ticker, string $board = self::DEFAULT_BOARD): void
    {
        Cache::setex(self::BAN_PREFIX . $board . ':' . $ticker, self::BAN_TTL, 1);
    }

    public static function isBanned(string $ticker, string $board = self::DEFAULT_BOARD): bool
    {
        return Cache::exists(self::BAN_PREFIX . $board . ':' . $ticker);
    }

    public static function compareTimestamps(
        string $needleTimestamp,
        $haystackTimestamp,
        string $frame = self::TIME_FRAMES['D1']
    ): bool {
        $needle = substr($needleTimestamp, 0, self::STR_LENGTH[$frame]);

        if (is_array($haystackTimestamp)) {
            $haystack = array_map(
                fn($timestamp) => substr($timestamp, 0, self::STR_LENGTH[$frame]),
                $haystackTimestamp
            );
            return in_array($needle, $haystack);
        } else {
            $haystack = substr($haystackTimestamp, 0, self::STR_LENGTH[$frame]);

            return $needle == $haystack;
        }
    }

    public static function decTimestamp(string $timestamp, string $frame = self::TIME_FRAMES['D1']): string
    {
        if (!self::validateTimestamp($timestamp)) {
            return '';
        }

        $timestampParts = self::parseTimestamp($timestamp);

        switch ($frame) {
            case self::TIME_FRAMES['D1']:
                return self::openMarketTimestamp(
                    date(
                        'Y-m-d',
                        strtotime(
                            '-1 day',
                            strtotime(
                                implode(
                                    '-',
                                    [
                                        $timestampParts['year'],
                                        $timestampParts['month'],
                                        $timestampParts['day']
                                    ]
                                )
                            )
                        )
                    )
                );
        }
    }

    public static function incTimestamp(string $timestamp, string $frame = self::TIME_FRAMES['M1']): string
    {
        if (!self::validateTimestamp($timestamp)) {
            return '';
        }

        $timestampParts = self::parseTimestamp($timestamp);

        switch ($frame) {
            case self::TIME_FRAMES['M1']:
                $timestampParts['minute'] += 1;
                if ($timestampParts['minute'] == 60) {
                    $timestampParts['minute'] = 0;
                    $timestampParts['hour']++;
                    if ($timestampParts['hour'] == self::END_MARKET_HOUR) {
                        return self::closeMarketTimestamp(
                            implode('-', [$timestampParts['year'], $timestampParts['month'], $timestampParts['day'],])
                        );
                    } // todo не возвращается $timestampParts
                }

                break;
            case self::TIME_FRAMES['M5']:
                $timestampParts['minute'] += 5;
                if ($timestampParts['minute'] >= 60) {
                    $timestampParts['minute'] = 0;
                    $timestampParts['hour']++;
                    if ($timestampParts['hour'] == self::END_MARKET_HOUR) {
                        return self::closeMarketTimestamp(
                            implode('-', [$timestampParts['year'], $timestampParts['month'], $timestampParts['day'],])
                        );
                    }
                }

                break;
            case self::TIME_FRAMES['M15']:
                $timestampParts['minute'] += 15;
                if ($timestampParts['minute'] >= 60) {
                    $timestampParts['minute'] = 0;
                    $timestampParts['hour']++;
                    if ($timestampParts['hour'] == self::END_MARKET_HOUR) {
                        return self::closeMarketTimestamp(
                            implode('-', [$timestampParts['year'], $timestampParts['month'], $timestampParts['day'],])
                        );
                    }
                }

                break;
            case self::TIME_FRAMES['H1']:
                $timestampParts['hour'] += 1;
                if ($timestampParts['hour'] >= self::END_MARKET_HOUR) {
                    return self::closeMarketTimestamp(
                        implode('-', [$timestampParts['year'], $timestampParts['month'], $timestampParts['day'],])
                    );
                }

                break;
            case self::TIME_FRAMES['D1']:
                return self::openMarketTimestamp(
                    date(
                        'Y-m-d',
                        strtotime(
                            '+1 day',
                            strtotime(
                                implode(
                                    '-',
                                    [
                                        $timestampParts['year'],
                                        $timestampParts['month'],
                                        $timestampParts['day']
                                    ]
                                )
                            )
                        )
                    )
                );
            case self::TIME_FRAMES['W1']:
                return self::openMarketTimestamp(
                    date(
                        'Y-m-d',
                        strtotime(
                            '+7 day',
                            strtotime(
                                implode(
                                    '-',
                                    [
                                        $timestampParts['year'],
                                        $timestampParts['month'],
                                        $timestampParts['day']
                                    ]
                                )
                            )
                        )
                    )
                );
        }
    }

    public static function closeMarketTimestamp(
        string $date = null,
        string $frame = self::TIME_FRAMES['M1']
    ): string {
        return ($date ?: date('Y-m-d')) . 'T' . self::MARKET_CLOSING_TIME[$frame] . 'Z';
    }

    public static function halfMarketDayTimestamp(string $date = null): string
    {
        return ($date ? substr($date, 0, 10) : date('Y-m-d')) . 'T' . self::MARKET_HALF_DAY_TIME . 'Z';
    }

    public static function openMarketTimestamp(string $date = null): string
    {
        return ($date ? substr($date, 0, 10) : date('Y-m-d')) . 'T' . self::MARKET_OPENING_TIME . 'Z';
    }

    public function __construct(array $params = [])
    {
        foreach (static::REQUIRED_PARAMS ?? [] as $param) {
            if (!empty($params[$param])) {
                $this->params[$param] = $params[$param];
            } else {
                $this->params = null;
                return;
            }
        }

        foreach (static::ADDITIONAL_PARAMS ?? [] as $addParam) {
            if (!empty($params[$addParam])) {
                $this->params[$addParam] = $params[$addParam];
            }
        }
    }

    private static function validateTimestamp(string $timestamp): bool
    {
        if (strlen($timestamp) <> 20) {
            return false;
        }

        if (!preg_match('/^20[2-3][0-9]-[0-1][0-9]-[0-3][0-9]T[0-2][0-9]:[0-5][0-9]:[0-5][0-9]Z$/', $timestamp)) {
            return false;
        }

        return true;
    }

    private static function parseTimestamp(string $timestamp): array
    {
        $res = [];

        [$date, $timeZ] = explode('T', $timestamp);
        $time = trim($timeZ, 'Z');

        [$res['year'], $res['month'], $res['day']] = explode('-', $date);
        [$res['hour'], $res['minute'], $res['second']] = explode(':', $time);

        return $res;
    }

    public function makeRequest(string $apiMethod, array $params = []): bool
    {
        $ch = curl_init();

        $URL = self::FINAM_URL
            . $apiMethod
            . (
            !empty($params)
                ? ('?' . implode(
                    '&',
                    array_map(
                        fn($key, $value) => "$key=" . urlencode($value),
                        array_keys($params),
                        $params
                    )
                ))
                : ''
            );

        curl_setopt(
            $ch,
            CURLOPT_URL,
            $URL
        );

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        //curl_setopt($ch, CURLOPT_POST, 1);

        $headers = array();
        $headers[] = "Content-Type: application/json";
        $headers[] = "Accept: text/plain";
        $headers[] = "X-Api-Key: " . self::FINAM_TOKEN;

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
            curl_close($ch);

            $this->response = null;

            return false;
        }

        curl_close($ch);

        $this->response = json_decode($result, true);

        return true;
    }

}