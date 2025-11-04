<?php
/**
 * @var $title
 * @var $url
 * @var $siteName
 * @var $description
 * @var $fbImgUrl
 */

use classes\T;
use BaseController as BC;

?>
<!DOCTYPE html>
<html lang="<?= T::HTML_LANG[T::$lang] ?>">
<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <link rel="stylesheet" type="text/css" href="js/bootstrap_4.5.2/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/<?= BC::$instance::CSS_FILE ?>">
    <link rel="stylesheet" type="text/css" href="css/tg_app_tuning.css">

    <meta property="og:locale" content="ru_RU">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= $title ?>">
    <meta property="og:site_name" content="<?= $siteName ?>">
    <meta property="og:url" content="<?= $url ?>">
    <meta property="og:description" content="<?= $description ?>">
    <meta property="og:image" content="<?= $fbImgUrl ?>">

    <meta name="description" content="<?= $description ?>" />

    <!-- TG web -->
    <script src="js/t-web-app.js"></script>
    
    <script src="js/phaser_3.87/phaser.min.js"></script>

    <!-- JS dependencies -->
    <script src="js/jquery_1.12.4/jquery.min.js"></script>
    <!-- Bootstrap 4 dependency -->
    <script src="js/popper_2.4.4/popper.min.js"></script>
    <script src="js/bootstrap_4.5.2/bootstrap.min.js"></script>

    <!-- bootbox code -->
    <script src="js/bootbox_5.4.0/bootbox.min.js"></script>
    <script src="js/bootbox_5.4.0/bootbox.locales.min.js"></script>

</head>

<body style="overscroll-behavior-y: none;" oncontextmenu="return false" onselectstart="return false" onselect="return false" oncopy="return false">
<div id="game_block"></div>
<script>
    var loader = loader || {}
    loader.importJS = function (uri) {
        let script = document.createElement('script');
        let head = document.getElementsByTagName('head')[0];
        script.type = 'text/javascript';
        script.src = uri;
        head.appendChild(script);
    }

    loader.importJS('<?= BC::$instance::GAME_URL() ?>mainScript?ver=' + Date.now());
</script>
<div id="ss" style="display:none;"></div>
</body>
</html>
