<?php

namespace classes;

use PlayerModel;

class Yandex
{
    private const USER_ID_PARAM = 'yandex_user_id';
    private const YANDEX_AUTHORIZED_PARAM = 'yandex_authorized';

    public static ?string $yandexUser = null;
    public static ?int $commonId = null;

    public static function authorize(): bool
    {


        if (!empty($_REQUEST[self::USER_ID_PARAM])) {

            // IL-33 - задача создалась в другом проекте
            if(!($_REQUEST[self::YANDEX_AUTHORIZED_PARAM] ?? true)) {
                if (isset($_COOKIE[Cookie::COOKIE_NAME])) {
                    if ($commonId = (int)PlayerModel::getPlayerCommonId($_COOKIE[Cookie::COOKIE_NAME])) {
                        $yandexUser = PlayerModel::getFirstCommonIdRecordO($commonId, $_COOKIE[Cookie::COOKIE_NAME])->_cookie ?? null;
                        self::$commonId = $commonId;

                        if ($yandexUser) {
                            self::$yandexUser = $yandexUser;

                            return true;
                        } else {
                            self::$yandexUser = md5($_REQUEST[self::USER_ID_PARAM]);
                            $playerModel = PlayerModel::new(
                                [
                                    PlayerModel::COMMON_ID_FIELD => self::$commonId,
                                    PlayerModel::COOKIE_FIELD => self::$yandexUser,
                                ]
                            );

                            if ($playerModel->save()) {return true;}
                        }
                    }
                }
            }

            self::$yandexUser = md5($_REQUEST[self::USER_ID_PARAM]); // Ключ яндекса длиннее 32
            self::$commonId = (int)PlayerModel::getPlayerCommonId(self::$yandexUser, true);

            if(isset($_COOKIE[Cookie::COOKIE_NAME]) && !($_REQUEST[self::YANDEX_AUTHORIZED_PARAM] ?? true)) {
                $playerModel = PlayerModel::new(
                    [
                        PlayerModel::COMMON_ID_FIELD => self::$commonId,
                        PlayerModel::COOKIE_FIELD => $_COOKIE[Cookie::COOKIE_NAME],
                    ]
                );

                $playerModel->save();
            }

            return true;
        }

        return false;
    }
}