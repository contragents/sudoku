//
function () {
    faserObject = this;

    var atlasTexture = this.textures.get('megaset');

    var frames = atlasTexture.getFrameNames();

    noNetworkImg = this.add.image(200, 200, 'no_network');
    // noNetworkImgOpponent = this.add.image(200, 200, 'no_network'); // todo переделать на массив по числу соперников

    WebView.postEvent('web_app_set_header_color', false, {
        color: '#2C3C6C',
    });

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

    // Top-Left buttons positioning..
    let numTopLeftButtons = 0;
    let sumLeftWidth = 0;
    for (let tbK in topLeftButtons) {
        numTopLeftButtons++;
        topLeftButtons[tbK].displayWidth = buttons[tbK].svgObject.displayWidth;
        sumLeftWidth += topLeftButtons[tbK].displayWidth;
    }
    let stepXTopLeftButtons = (knopkiLeftWidth - sumLeftWidth) / (numTopLeftButtons + 1);

    let currentLeftWidth = 0;
    for (let tbK in topLeftButtons) {
        buttons[tbK].svgObject.x = stepXTopLeftButtons + currentLeftWidth + buttons[tbK].svgObject.displayWidth / 2;
        currentLeftWidth += stepXTopLeftButtons + buttons[tbK].svgObject.displayWidth;
    }

    // Top-Right buttons positioning

    let numTopRightButtons = 0;
    let sumRightWidth = 0;
    for (let tbK in topRightButtons) {
        numTopRightButtons++;
        topRightButtons[tbK].displayWidth = buttons[tbK].svgObject.displayWidth;
        sumRightWidth += topRightButtons[tbK].displayWidth;
    }
    let stepXTopRightButtons = (knopkiRightWidth - sumRightWidth) / (numTopRightButtons + 1);

    let currentRightWidth = 0;
    for (let tbK in topRightButtons) {
        buttons[tbK].svgObject.x = gameWidth - knopkiRightWidth + stepXTopRightButtons + currentRightWidth + buttons[tbK].svgObject.displayWidth / 2;
        currentRightWidth += stepXTopRightButtons + buttons[tbK].svgObject.displayWidth;
    }

    for (let k in players) {
        if ('preload' in players[k] && !players[k].preload) {
            continue;
        }

        players[k].svgObject = getSVGBlockGlobal(players[k]['x'], players[k]['y'], k, this, players[k].scalable, 'numbers' in players[k]);
        players[k].svgObject.bringToTop(players[k].svgObject.getByName(k + OTJAT_MODE));
        players[k].svgObject.getByName(k + ALARM_MODE).setVisible(false);
    }

    // todo SB-3 this code for testing
    players.timerBlock.svgObject.setAlpha(1);
    displayTimeGlobal(117, true);
    players.youBlock.svgObject.setAlpha(1);
    displayScoreGlobal(25, 'youBlock', true);

    for (let k in cards) {
        if ('preload' in cards[k] && cards[k].preload === false) {
            continue;
        }

        cards[k].svgObject = getSVGCardBlockGlobal(
            cards[k]['x'],
            cards[k]['y'],
            k,
            this,
            'scalable' in cards[k] && cards[k].scalable,
            'props' in cards[k] ? cards[k].props : false,
            'dragStartFunction' in cards[k]
        );
    }

    coordinates.areaCommon1 = {x: cards.areaCommon1.svgObject.x, y: cards.areaCommon1.svgObject.y};
    coordinates.areaCommon2 = {x: cards.areaCommon2.svgObject.x, y: cards.areaCommon2.svgObject.y};
    coordinates.areaCommon3 = {x: cards.areaCommon3.svgObject.x, y: cards.areaCommon3.svgObject.y};
    coordinates.areaCommon4 = {x: cards.areaCommon4.svgObject.x, y: cards.areaCommon4.svgObject.y};
    coordinates.kolodaCard = {x: cards.kolodaCard3.svgObject.x, y: cards.kolodaCard3.svgObject.y};

    coordinates.you = {};
    coordinates.you.goalCard = {x: cards.goalCard.svgObject.x, y: cards.goalCard.svgObject.y};

    coordinates.you.handCard1 = {x: cards.handCard1.svgObject.x, y: cards.handCard1.svgObject.y};
    coordinates.you.handCard2 = {x: cards.handCard2.svgObject.x, y: cards.handCard2.svgObject.y};
    coordinates.you.handCard3 = {x: cards.handCard3.svgObject.x, y: cards.handCard3.svgObject.y};
    coordinates.you.handCard4 = {x: cards.handCard4.svgObject.x, y: cards.handCard4.svgObject.y};
    coordinates.you.handCard5 = {x: cards.handCard5.svgObject.x, y: cards.handCard5.svgObject.y};

    for (let i = 1; i <= 4; i++) {
        coordinates.you['bankCard' + i] = {x: cards['bankCard' + i].svgObject.x, y: cards['bankCard' + i].svgObject.y};
        cards['activeFrameYouBank' + i].svgObject = getSVGCardBlockGlobal(
            coordinates.you['bankCard' + i].x,
            coordinates.you['bankCard' + i].y,
            'activeFrameYouBank' + i,
            this
        );
    }

    // Выводим счетчик карт над целевой картой противника
    getContainerFromSVG(
        cards.goalCard.x,
        cards.goalCard.y - cardWidth * cardSideFactor / 2 - 70 / 90 * entities.cardCounter.width / 2,
        'cardCounter',
        this,
        winScore - (playerScores['youBlock'].digit2 * 10 + playerScores['youBlock'].digit3)
    );

    // Расставляем соперников по плашкам
    // todo (оформить в виде функции)
    for (let player in playersMap) {
        if (playersMap[player] !== YOU) {
            let playerContainer = players['player' + player + 'Block'].svgObject;
            let backplateContainer = cards[playersMap[player]].svgObject; // Контейнер плашки соперника
            console.log(backplateContainer.width);
            playerContainer.x = backplateContainer.x + backplateContainer.displayWidth / 2 - playerContainer.width / 2 - cardStep;
            playerContainer.y = backplateContainer.y - backplateContainer.displayHeight / 2 + playerContainer.displayHeight / 4 + cardStep;
            playerContainer.setAlpha(1);
            faserObject.children.bringToTop(playerContainer); // Поднять созданный ранее контейнер
            displayScoreGlobal(Math.round(Math.random() * 30), 'player' + player + 'Block', true);

            // Получаем никнеймы
            getContainerFromSVG(backplateContainer.x - backplateContainer.displayWidth / 2 + playerContainer.width / 2 + cardStep,
                backplateContainer.y - backplateContainer.displayHeight / 2 + playerContainer.displayHeight / 4 + cardStep,
                'nicknameBlock',
                this,
                'Nick' + player + '🙃'
            );

            coordinates[player] = {};

            // Получаем подложки под банк-карты соперников
            for (let i = 1; i <= 4; i++) {
                coordinates[player]['bankCard' + i] = {
                    x: backplateContainer.x - backplateContainer.displayWidth / 2 + (mediumCardWidth / 2 + cardStep) + (i - 1) * (mediumCardWidth + cardStep),
                    y: backplateContainer.y + backplateContainer.displayHeight / 2 - mediumCardWidth
                };
                getContainerFromSVG(
                    coordinates[player]['bankCard' + i].x,
                    coordinates[player]['bankCard' + i].y,
                    'bankCard',
                    this
                );
            }

            // Выводим очередную целевую карту
            coordinates[player].goalCard = {
                x: backplateContainer.x + backplateContainer.displayWidth / 2 - (mediumCardWidth / 2 + cardStep),
                y: backplateContainer.y + backplateContainer.displayHeight / 2 - cardWidth
            };
            getContainerFromSVG(
                coordinates[player].goalCard.x,
                coordinates[player].goalCard.y,
                'goalCard',
                this,
                'card_' + (player * 2),
                {cardValue: player * 2}
            );
            // Выводим счетчик карт над целевой картой противника
            getContainerFromSVG(
                backplateContainer.x + backplateContainer.displayWidth / 2 - (mediumCardWidth / 2 + cardStep),
                backplateContainer.y + backplateContainer.displayHeight / 2 - cardWidth - mediumCardWidth * cardSideFactor + 70 / 90 * entities.cardCounter.width / 2,
                'cardCounter',
                this,
                winScore - (playerScores['player' + player + 'Block'].digit2 * 10 + playerScores['player' + player + 'Block'].digit3)
            );

            // Выводим карты на руках противника рубашкой кверху
            for (let i = 1; i <= 5; i++) {
                coordinates[player]['handCard' + i] = {
                    x: backplateContainer.x + (i - 1) * (smallCardWidth - cardStep * 2),
                    y: backplateContainer.y - backplateContainer.displayHeight / 6
                };
                getContainerFromSVG(
                    coordinates[player]['handCard' + i].x,
                    coordinates[player]['handCard' + i].y,
                    'handCard',
                    this
                );
            }
        }
    }

    switchOffFrames();

//    <?php include('create/fishkaDragEvents.js')?>

//    <?php include(ROOT_DIR . '/js/common_functions/getSVGButtonFunction.js')?>

    reportGameIsReadyYandex();
}