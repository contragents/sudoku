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
    <link rel="stylesheet" type="text/css" href="css/choose_css_new_10.css">


    <meta property="og:locale" content="ru_RU">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= $title ?>">
    <meta property="og:site_name" content="<?= $siteName ?>">
    <meta property="og:url" content="<?= $url ?>">
    <meta property="og:description" content="<?= $description ?>">
    <meta property="og:image" content="<?= $fbImgUrl ?>">

    <meta name="description" content="<?= $description ?>"/>


    <script>
        window.electronAPI.getScript('page_reload_event', () => {
            return true
        });

        var dataMapping = {
            path_rules: {
                1: '(img/alarm/.*)$',
                2: '(img/inactive/.*)$',
                3: '(img/najatie/.*)$',
                4: '(img/navedenie/.*)$',
                5: '(img/otjat/.*)$',
                6: '(img/sudoku/.*)$',
                7: '(js/.*.js)$',
                8: '(js/bootstrap_4.5.2/bootstrap.min.css)$',
                9: '(css/tg_app_tuning.css)$',
            },
            exceptions: {
                1: 'bank',
            },
            scripts_asked: {},
            scripts_received: {},
        };

        var loader = loader || {}
        loader.importCSS = function (uri, data = null) {
            if (data) {
                if (uri in dataMapping.scripts_received) {
                    return;
                } else {
                    dataMapping.scripts_received[uri] = true;
                }

                let styleElement = document.createElement('style');
                let head = document.getElementsByTagName('head')[0];
                styleElement.innerHTML = data;
                head.appendChild(styleElement);

                return;
            }

            if (data !== '') {
                mainLoop: for (let ruleNumber in dataMapping.path_rules) {
                    const matches = uri.match(dataMapping.path_rules[ruleNumber]);
                    if (matches && (1 in matches)) {
                        for (let exptNumber in dataMapping.exceptions) {
                            const exMatches = matches[1].match(dataMapping.exceptions[exptNumber]);
                            if (exMatches) {
                                continue mainLoop;
                            }
                        }

                        let filePath = matches[1];
                        if (filePath in dataMapping.scripts_asked) {
                            return;
                        }

                        window.electronAPI.getStyle(filePath, this.importCSS);
                        dataMapping.scripts_asked[filePath] = true;

                        return;
                    }
                }
            }

            let head = document.getElementsByTagName('head')[0];
            let link = document.createElement('link');
            link.rel = 'stylesheet';
            link.type = 'text/css';
            link.href = 'uri';
            link.media = 'all';
            head.appendChild(link);
        };

        loader.importJS = function (uri, data = null) {
            if (data) {
                if (uri in dataMapping.scripts_received) {
                    return;
                } else {
                    dataMapping.scripts_received[uri] = true;
                }

                let script = document.createElement('script');
                let head = document.getElementsByTagName('head')[0];
                script.type = 'text/javascript';
                script.text = data;
                head.appendChild(script);

                return;
            }

            if (data !== '') {
                mainLoop: for (let ruleNumber in dataMapping.path_rules) {
                    const matches = uri.match(dataMapping.path_rules[ruleNumber]);
                    if (matches && (1 in matches)) {
                        for (let exptNumber in dataMapping.exceptions) {
                            const exMatches = matches[1].match(dataMapping.exceptions[exptNumber]);
                            if (exMatches) {
                                continue mainLoop;
                            }
                        }

                        let filePath = matches[1];
                        if (filePath in dataMapping.scripts_asked) {
                            return;
                        }

                        window.electronAPI.getScript(filePath, this.importJS);
                        dataMapping.scripts_asked[filePath] = true;

                        return;
                    }
                }
            }

            let script = document.createElement('script');
            let head = document.getElementsByTagName('head')[0];
            script.type = 'text/javascript';
            script.src = uri;
            head.appendChild(script);
        }
    </script>


    <!--<link rel="stylesheet" type="text/css" href="js/bootstrap_4.5.2/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/tg_app_tuning.css">-->
    <script>
        loader.importCSS('js/bootstrap_4.5.2/bootstrap.min.css');
        loader.importCSS('css/tg_app_tuning.css');
    </script>

    <!--<script src="js/phaser_3.87/phaser.min.js"></script>-->
    <script>
        loader.importJS('js/phaser_3.87/phaser.min.js');
        loader.importJS('js/common_functions/wav.js');
    </script>

    <!-- JS dependencies -->
    <!--<script src="js/jquery_1.12.4/jquery.min.js"></script>-->
    <script>
        loader.importJS('js/jquery_1.12.4/jquery.min.js');
    </script>

    <!-- Bootstrap 4 dependency -->
    <!--<script src="js/popper_2.4.4/popper.min.js"></script>
    <script src="js/bootstrap_4.5.2/bootstrap.min.js"></script>-->
    <script>
        loader.importJS('js/popper_2.4.4/popper.min.js');
        loader.importJS('js/bootstrap_4.5.2/bootstrap.min.js');
    </script>

    <!-- bootbox code -->
    <!--<script src="js/bootbox_5.4.0/bootbox.min.js"></script>
    <script src="js/bootbox_5.4.0/bootbox.locales.min.js"></script>-->
    <script>
        loader.importJS('js/bootbox_5.4.0/bootbox.min.js');
        loader.importJS('js/bootbox_5.4.0/bootbox.locales.min.js');
    </script>

</head>

<body style="overscroll-behavior-y: none;" oncontextmenu="return false" onselectstart="return false"
      onselect="return false" oncopy="return false">
<div id="game_block"></div>
<script>
    loader.importJS('<?= BC::$instance::GAME_URL() ?>mainScript?ver=' + Date.now());
</script>
<div id="ss" style="display:none;"></div>
</body>
</html>
