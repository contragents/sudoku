//
function () {
    var letters = [];
    var atlasTexture = this.textures.get('megaset');

    var frames = atlasTexture.getFrameNames();

    noNetworkImg = this.add.image(200, 200, 'no_network');
    noNetworkImgOpponent = this.add.image(200, 200, 'no_network');

    WebView.postEvent('web_app_set_header_color', false, {
        color: '#2C3C6C',
    });

    /* var ground = this.add.image(385, 375, 'ground');
    ground.setOrigin(0, 0);
    ground.x = game.config.width - ground.width;
    ground.y = screenOrient === HOR
        ? 0
        : topHeight;
    ground.setCrop(16 * 2, 3 * 2, 550 * 2, 550 * 2);
*/
    stepX = 0; //game.config.width - ground.width; // Где начало игрового поля по X
    stepY = (screenOrient === HOR) ? 0 : topHeight; // Где начало игрового поля по Y
    initLotok();

    initCellsGlobal();

    for (let k in buttons) {
        if ('preCalc' in buttons[k])
            buttons[k]['preCalc']();

        buttons[k].svgObject = getSVGButton(buttons[k].x, buttons[k].y, k, this);

        buttons[k].svgObject.on('pointerup', function () {
            let mode = OTJAT_MODE;
            if ('disabled' in buttons[k]) {
                if (gameState in buttons[k].disabled)
                    mode = INACTIVE_MODE;
            }

            if (mode === INACTIVE_MODE && 'setDisabled' in buttons[k]) {
                buttons[k].setDisabled();

                return;
            }

            buttons[k].svgObject.bringToTop(buttons[k].svgObject.getByName(k + mode));

            if (mode === OTJAT_MODE && 'pointerupFunction' in buttons[k])
                buttons[k].pointerupFunction();
        });

        buttons[k].svgObject.on('pointerdown', function () {
            let mode = NAJATO_MODE;
            if ('disabled' in buttons[k]) {
                if (gameState in buttons[k].disabled)
                    mode = INACTIVE_MODE;
            }

            if (mode === INACTIVE_MODE && 'setDisabled' in buttons[k]) {
                buttons[k].setDisabled();

                return;
            }

            buttons[k].svgObject.bringToTop(buttons[k].svgObject.getByName(k + mode));
        });

        buttons[k].svgObject.on('pointerover', function () {
            let mode = NAVEDENO_MODE;
            if (k === 'chatButton') {
                if (buttons.chatButton.svgObject.getByName('chatButton' + ALARM_MODE).getData('alarm') !== true)
                    buttons[k].svgObject.bringToTop(buttons[k].svgObject.getByName(k + mode));

                return;
            }

            if ('disabled' in buttons[k]) {
                if (gameState in buttons[k].disabled)
                    mode = INACTIVE_MODE;
            }

            if (mode === INACTIVE_MODE && 'setDisabled' in buttons[k]) {
                buttons[k].setDisabled();

                return;
            }

            buttons[k].svgObject.bringToTop(buttons[k].svgObject.getByName(k + mode));
        });

        buttons[k].svgObject.on('pointerout', function () {
            let mode = OTJAT_MODE;
            if (k === 'chatButton') {
                if (buttons.chatButton.svgObject.getByName('chatButton' + ALARM_MODE).getData('alarm') !== true)
                    buttons[k].svgObject.bringToTop(buttons[k].svgObject.getByName(k + mode));

                return;
            }

            if ('disabled' in buttons[k]) {
                if (gameState in buttons[k].disabled)
                    mode = INACTIVE_MODE;
            }

            if (mode === INACTIVE_MODE && 'setDisabled' in buttons[k]) {
                buttons[k].setDisabled();

                return;
            }

            buttons[k].svgObject.bringToTop(buttons[k].svgObject.getByName(k + mode));
        });
    }

    let numTopButtons = 0;
    let sumWidth = 0;
    for (let tbK in topButtons) {
        numTopButtons++;
        topButtons[tbK].displayWidth = buttons[tbK].svgObject.displayWidth;
        sumWidth += topButtons[tbK].displayWidth;
    }
    let stepXTopButtons = (knopkiWidth - sumWidth) / (numTopButtons + 1);

    let currentWidth = 0;
    for (let tbK in topButtons) {
        buttons[tbK].svgObject.x = stepXTopButtons + currentWidth + buttons[tbK].svgObject.displayWidth / 2;
        currentWidth += stepXTopButtons + buttons[tbK].svgObject.displayWidth;
    }

    if (buttons.submitButton.svgObject !== false) {
        buttons.submitButton.setDisabled();
    }

    for (let k in players) {
        if ('preload' in players[k] && !players[k].preload) {
            continue;
        }

        players[k].svgObject = getSVGBlockGlobal(players[k]['x'], players[k]['y'], k, this, players[k].scalable, 'numbers' in players[k]);
        players[k].svgObject.bringToTop(players[k].svgObject.getByName(k + OTJAT_MODE));
        players[k].svgObject.getByName(k + ALARM_MODE).setVisible(false);
    }

//    <?php include('create/fishkaDragEvents.js')?>

//    <?php include(ROOT_DIR . '/js/common_functions/getSVGButtonFunction.js')?>

    faserObject = this;

    reportGameIsReadyYandex();
}