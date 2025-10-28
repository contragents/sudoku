//
function () {

    var progressBar = this.add.graphics();
    var progressBox = this.add.graphics();
    progressBox.fillStyle(0x222222, 0.3);
    progressBox.fillRect(gameWidth / 2 - 320 / 2, gameHeight / 2 - 50 / 5, 320, 50);

    var showCaution = false;

    var textWidth = this.cameras.main.width;
    var textHeight = this.cameras.main.height;
    var loadingText = this.make.text({
        x: textWidth / 2,
        y: textHeight / 2 - 50,
        text: LOADING_TEXT,
        style: {
            font: '20px monospace',
            fill: '#000000'
        }
    });
    loadingText.setOrigin(0.5, 0.5);

    this.load.on('progress', function (value) {
        progressBar.clear();
        progressBar.fillStyle(0xffffff, 1);
        progressBar.fillRect(gameWidth / 2 + 10 - 320 / 2, gameHeight / 2 - 30 / 2 + 15, 300 * value, 30);
    });

    this.load.on('complete', function () {
        progressBar.destroy();
        progressBox.destroy();
        loadingText.destroy();
        if (showCaution) {
            androidText1.destroy();
            androidText2.destroy();
        }
    });

    preloaderObject = this;

    <?php foreach (BaseController::$FR::getImgsPreload() as $name => $resourceArr) { ?>
    this.load.<?= $resourceArr['type'] ?>('<?= $name ?>', '<?= $resourceArr['url'] ?>'
    <?= ($resourceArr['options'] ?? false) ? (', ' . $resourceArr['options']) : '' ?>);
    <?php } ?>

    for (let k in buttons) {
        let mods = 'modes' in buttons[k]
            ? buttons[k].modes
            : modes;

        mods.forEach(mode => this.load.svg(k + mode, 'img/' + mode.toLowerCase() + '/' + buttons[k]['filename'] + '.svg',
            'width' in buttons[k]
                ? {
                    'width': buttons[k]['width'],
                    'height': 'height' in buttons[k] ? buttons[k].height : buttonHeight,
                }
                : {
                    'height': 'height' in buttons[k] ? buttons[k].height : buttonHeight,
                }
        ));

        /*
        if ('modes' in buttons[k])
            buttons[k]['modes'].forEach(mode => this.load.svg(k + mode, 'img/' + mode.toLowerCase() + '/' + buttons[k]['filename'] + '.svg',
                'width' in buttons[k]
                    ? {
                        'width': buttons[k]['width'],
                        'height': 'height' in buttons[k] ? buttons[k].height : buttonHeight,
                    }
                    : {
                        'height': 'height' in buttons[k] ? buttons[k].height : buttonHeight,
                    }
            ));
        else
            modes.forEach(mode => this.load.svg(k + mode, 'img/' + mode.toLowerCase() + '/' + buttons[k]['filename'] + '.svg',
                'width' in buttons[k]
                    ? {
                        'width': buttons[k]['width'],
                        'height': 'height' in buttons[k] ? buttons[k].height : buttonHeight,
                    }
                    : {
                        'height': 'height' in buttons[k] ? buttons[k].height : buttonHeight,
                    }
            ));*/
    }

    for (let k in players) {
        if ('preload' in players[k] && !players[k].preload) {
            continue;
        }

        let mods = 'modes' in players[k]
            ? players[k].modes
            : playerBlockModes;
        mods.forEach(mode => this.load.svg(k + mode, 'img/' + mode.toLowerCase() + '/' + players[k].filename + '.svg',
            'width' in players[k]
                ? {
                    'width': players[k].width,
                    'height': 'height' in players[k] ? players[k].height : buttonHeight,
                }
                : {
                    'height': 'height' in players[k] ? players[k].height : buttonHeight,
                }
        ));

        /*if ('modes' in players[k]) {
            players[k].modes.forEach(mode => this.load.svg(k + mode, 'img/' + mode.toLowerCase() + '/' + players[k].filename + '.svg',
                'width' in players[k]
                    ? {
                        'width': players[k].width,
                        'height': 'height' in players[k] ? players[k].height : buttonHeight,
                    }
                    : {
                        'height': 'height' in players[k] ? players[k].height : buttonHeight,
                    }
            ));
        }
        else {
            playerBlockModes.forEach(mode => this.load.svg(k + mode, 'img/' + mode.toLowerCase() + '/' + players[k]['filename'] + '.svg',
                'width' in players[k]
                    ? {
                        'width': players[k].width,
                        'height': 'height' in players[k] ? players[k].height : buttonHeight,
                    }
                    : {
                        'height': 'height' in players[k] ? players[k].height : buttonHeight,
                    }
            ));
        }*/
    }

    playerBlockModes.forEach(mode => {
        for (let k in digits.playerDigits[mode]) {
            this.load.svg(mode + '_' + 'player_' + k, 'img/' + mode.toLowerCase() + '/' + digits.playerDigits[mode][k]['filename'] + '.svg',
                {'height': buttonHeight * 0.5 / (buttonHeightKoef < 1 ? 0.5 : 1), 'width': buttonHeight * 0.23 * 0.5 / (buttonHeightKoef < 1 ? 0.5 : 1)}
            );

            this.load.svg(mode + '_' + 'timer_' + k, 'img/' + mode.toLowerCase() + '/' + digits.timerDigits[mode][k]['filename'] + '_' + modesColors[mode] + '.svg',
                {'height': timerDigitHeight(), 'width': timerDigitWidth()}
            );
        }

        this.load.svg(mode + '_' + 'dvoetoch', 'img/' + mode.toLowerCase() + '/numbers/' + 'dvoetoch'  + '_' + modesColors[mode]+ '.svg',
            {'height':timerDigitHeight(), 'width': dvoetochWidth()}
        );
    });
}
