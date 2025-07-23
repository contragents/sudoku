<?php


namespace classes;


class Hints
{
    public static function isMobileDevice()
    {
        return preg_match(
            "/(android|avantgo|blackberry|bolt|boost|cricket|docomo
|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i"
            ,
            $_SERVER["HTTP_USER_AGENT"]
        );
    }

    public static function isDesktopDevice()
    {
        return !self::isMobileDevice();
    }

    public static function IsNotAndroidApp()
    {
        return !self::isAndroidApp();
    }

    public static function isAndroidApp()
    {
        if (isset($_COOKIE['DEVICE']) && $_COOKIE['DEVICE'] == 'Android') {
            return true;
        }

        if (isset($_COOKIE['PRODUCT']) && $_COOKIE['PRODUCT'] == 'RocketWeb') {
            return true;
        }

        if (strpos($_SERVER['HTTP_REFERER'] ?? '', 'app=1')) {
            return true;
        }

        return false;
    }

    public static function isVkApp()
    {
        if (isset($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'], 'api.vk.com') !== false)) {
            return true;
        }

        return false;
    }
}

