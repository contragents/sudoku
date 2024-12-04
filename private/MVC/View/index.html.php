<?php
/**
 * @var $title
 * @var $url
 * @var $siteName
 * @var $description
 * @var $fbImgUrl
 */
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="js/bootstrap_4.5.2/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/choose_css_new9.css">
    <link rel="stylesheet" type="text/css" href="css/knopki.css">

    <meta property="og:locale" content="ru_RU">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= $title ?>">
    <meta property="og:site_name" content="<?= $siteName ?>">
    <meta property="og:url" content="<?= $url ?>">
    <meta property="og:description" content="<?= $description ?>">
    <meta property="og:image" content="<?= $fbImgUrl ?>">

    <meta name="description" content="<?= $description ?>" />
    
    <script src="js/phaser_35/phaser.min.js"></script>

    <!-- JS dependencies -->
    <script src="js/jquery_1.12.4/jquery.min.js"></script>
    <!-- Bootstrap 4 dependency -->
    <script src="js/popper_2.4.4/popper.min.js"></script>
    <script src="js/bootstrap_4.5.2/bootstrap.min.js"></script>

    <!-- bootbox code -->
    <script src="js/bootbox_5.4.0/bootbox.min.js"></script>
    <script src="js/bootbox_5.4.0/bootbox.locales.min.js"></script>

</head>

<body>
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

    loader.importJS('mainScript?ver=' + Date.now());
</script>
<div id="ss" style="display:none;"></div>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (m, e, t, r, i, k, a) {
        m[i] = m[i] || function () {
            (m[i].a = m[i].a || []).push(arguments)
        };
        m[i].l = 1 * new Date();
        k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
    })
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(66170950, "init", {
        clickmap: true,
        trackLinks: true,
        accurateTrackBounce: true
    });
</script>
<noscript>
    <div><img src="https://mc.yandex.ru/watch/66170950" style="position:absolute; left:-9999px;" alt=""/></div>
</noscript>
<!-- /Yandex.Metrika counter -->

<div style="display:none">
    <iframe id="beeper" src="" width="0" height="0">
    </iframe>
</div>

</body>
</html>
