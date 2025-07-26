<?php


namespace classes;


use DeepL\DeepLClient;
use DeepL\TranslatorOptions;

class Deepl
{
    const API_KEY = 'ef949778-e0eb-45e1-897d-adc134219acb:fx';
    const KAVYCHKA = '&#42;'; // Заменяем одинарную кавычку

    public static function translateTClass(string $lang): string
    {
        $classLang = '<?php

namespace classes;


use PaymentModel;
use UserModel;

class T_' . $lang
            . '{
    const PHRASES = ';

        $res = [];
        $deeplClient = new DeepLClient(self::API_KEY,[TranslatorOptions::SERVER_URL => 'https://api-free.deepl.com']);


        foreach (T::PHRASES as $key => $phraseArr) {
            if (is_array($phraseArr) && isset($phraseArr[T::EN_LANG])) {
                $sourcePhrase = $phraseArr[T::EN_LANG];
            } else {
                $sourcePhrase = $key;
            }

            $res[$key] = $deeplClient->translateText($sourcePhrase, 'en', strtolower($lang));
        }

        return '<pre>'.$classLang . var_export($res, true) . ';}'.'</pre>';
    }


}