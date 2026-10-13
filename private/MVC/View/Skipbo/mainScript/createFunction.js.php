<?php
use classes\Config;
?>
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

        players[k].svgObject = getSVGBlockGlobal(players[k].x, players[k].y, k, this, players[k].scalable, 'numbers' in players[k]);
        players[k].svgObject.bringToTop(players[k].svgObject.getByName(k + OTJAT_MODE));
        players[k].svgObject.getByName(k + ALARM_MODE).setVisible(false);
    }

    players.timerBlock.svgObject.setAlpha(1);
    players.youBlock.svgObject.setAlpha(1);
    players.kolodaCounterBlock.svgObject.setAlpha(1);

    for (let k in cards) {
        if ('preload' in cards[k] && cards[k].preload === false) {
            continue;
        }

        cards[k].svgObject = getSVGCardBlockGlobal(
            cards[k].x,
            cards[k].y,
            k,
            this,
            'scalable' in cards[k] && cards[k].scalable,
            'props' in cards[k] ? cards[k].props : false,
            'dragStartFunction' in cards[k]
        );
    }

    coordinates.commonArea1 = {x: cards.commonArea1.svgObject.x, y: cards.commonArea1.svgObject.y};
    coordinates.commonArea2 = {x: cards.commonArea2.svgObject.x, y: cards.commonArea2.svgObject.y};
    coordinates.commonArea3 = {x: cards.commonArea3.svgObject.x, y: cards.commonArea3.svgObject.y};
    coordinates.commonArea4 = {x: cards.commonArea4.svgObject.x, y: cards.commonArea4.svgObject.y};
    coordinates.kolodaCard = {x: cards.kolodaCard3.svgObject.x, y: cards.kolodaCard3.svgObject.y};

    coordinates.you = {};
    coordinates.you.goalCard = {x: cards.goalCard.x, y: cards.goalCard.y};
    coordinates.you.cardCounter = {
        x: coordinates.you.goalCard.x,
        y: coordinates.you.goalCard.y - cardWidth * cardSideFactor / 2 - 70 / 90 * entities.cardCounterYou.width / 2
    };

    coordinates.you.handCard1 = {x: cards.handCard1.svgObject.x, y: cards.handCard1.svgObject.y};
    coordinates.you.handCard2 = {x: cards.handCard2.svgObject.x, y: cards.handCard2.svgObject.y};
    coordinates.you.handCard3 = {x: cards.handCard3.svgObject.x, y: cards.handCard3.svgObject.y};
    coordinates.you.handCard4 = {x: cards.handCard4.svgObject.x, y: cards.handCard4.svgObject.y};
    coordinates.you.handCard5 = {x: cards.handCard5.svgObject.x, y: cards.handCard5.svgObject.y};

    for (let i = 1; i <= 4; i++) {
        coordinates.you['bankCard' + i] = {x: cards['bankArea' + i].svgObject.x, y: cards['bankArea' + i].svgObject.y};
        cards['activeFrameYouBank' + i].svgObject = getSVGCardBlockGlobal(
            coordinates.you['bankCard' + i].x,
            coordinates.you['bankCard' + i].y,
            'activeFrameYouBank' + i,
            this
        );
    }

    // Выводим счетчик карт над целевой картой Игрока
    /*
    getContainerFromSVG(
        coordinates.you.cardCounter.x,
        coordinates.you.cardCounter.y,
        'cardCounterYou',
        winScore - (playerScores['youBlock'].digit2 * 10 + playerScores['youBlock'].digit3)
    );
    */

    // сгенерим URL случайных аватаров
    let avatars = [];
    // Аатар последнего игрока (вертикальный для теста)
    avatars.push('https://xn--d1aiwkc2d.club/img/upload/3f8dd6efb0492cd1394ac4e0f85e10a5.jpg?ver=1741674943');
    avatars.push(BASE_IMG_URL + '<?= AvatarModel::find([])->where([AvatarModel::NOT_LOADED_FIELD => false]
    )->order('rand()')->limit(1)->one()?->_mini_url ?? '' ?>');
    avatars.push(BASE_IMG_URL + '<?= AvatarModel::find([])->where([AvatarModel::NOT_LOADED_FIELD => false]
    )->order('rand()')->limit(1)->one()?->_mini_url ?? '' ?>');
    // Аватар текущего игрока 123
    avatars.push(BASE_IMG_URL + '/img/sudoku-coin.png');

    // Выводим аватар Игрока
    loadAvatarContainer(
        entities.avatarYou.x,
        entities.avatarYou.y,
        'avatarYou',
        avatars.pop(),
    );

    // Расставляем соперников по плашкам
    // todo (оформить в виде функции)
    for (let player in playersMap) {
        if (playersMap[player] !== YOU) {
            let playerContainer = players['player' + player + 'Block'].svgObject;
            let backplateContainer = cards[playersMap[player]].svgObject; // Контейнер плашки соперника

            playerContainer.x = backplateContainer.x + backplateContainer.displayWidth / 2 - playerContainer.width / 2 - cardStep;
            playerContainer.y = backplateContainer.y - backplateContainer.displayHeight / 2 + playerContainer.displayHeight / 4 + cardStep;
            playerContainer.setAlpha(1);
            faserObject.children.bringToTop(playerContainer); // Поднять созданный ранее контейнер

            // Всем ставим 0 очков счета
            displayScoreGlobal(0, 'player' + player + 'Block', true);

            // Получаем никнеймы соперников
            getContainerFromSVG(
                backplateContainer.x - backplateContainer.displayWidth / 2 + playerContainer.width / 2 + cardStep,
                backplateContainer.y - backplateContainer.displayHeight / 2 + playerContainer.displayHeight / 4 + cardStep,
                'nicknameBlockPlayer' + player,
                'Nick' + player + '🙃'
            );

            // Выводим аватар соперника
            loadAvatarContainer(
                backplateContainer.x - backplateContainer.displayWidth / 2 + playerContainer.width / 2 + cardStep,
                backplateContainer.y - backplateContainer.displayHeight / 6 - smallCardWidth * cardSideFactor / 2 + entities['avatarPlayer' + player].height / 2,
                'avatarPlayer' + player,
                avatars.pop(),
            );

            coordinates[player] = {};

            // Получаем подложки под банк-карты соперников
            for (let i = 1; i <= 4; i++) {
                coordinates[player]['bankCard' + i] = {
                    x: backplateContainer.x - backplateContainer.displayWidth / 2 + (mediumCardWidth / 2 + 2 * cardStep) + (i - 1) * (mediumCardWidth + cardStep),
                    y: backplateContainer.y + backplateContainer.displayHeight / 2 - mediumCardWidth
                };
                getContainerFromSVG(
                    coordinates[player]['bankCard' + i].x,
                    coordinates[player]['bankCard' + i].y,
                    'bankAreaMediumPlayer' + player + 'Pos' + i,
                );
            }

            // Выводим очередную целевую карту
            coordinates[player].goalCard = {
                x: backplateContainer.x + backplateContainer.displayWidth / 2 - (mediumCardWidth / 2 + 2 * cardStep),
                y: backplateContainer.y + backplateContainer.displayHeight / 2 - cardWidth
            };
            /*getContainerFromSVG(
                coordinates[player].goalCard.x,
                coordinates[player].goalCard.y,
                'goalCardPlayer' + player,
                getCardImgName(player * 2),
                {cardValue: player * 2}
            );*/

            // Координаты счетчика карт над целевой картой противника
            coordinates[player].cardCounter = {
                x: coordinates[player].goalCard.x,
                y: backplateContainer.y + backplateContainer.displayHeight / 2 - cardWidth - mediumCardWidth * cardSideFactor + 70 / 90 * entities['cardCounterPlayer' + player].width / 2
            };
            // Выводим счетчик карт над целевой картой противника
            /*
            getContainerFromSVG(
                coordinates[player].cardCounter.x,
                coordinates[player].cardCounter.y,
                'cardCounterPlayer' + player,
                winScore - (playerScores['player' + player + 'Block'].digit2 * 10 + playerScores['player' + player + 'Block'].digit3)
            );
             */

            // Выводим карты на руках противника рубашкой кверху
            for (let i = 1; i <= HAND_CARDS_NUM; i++) {
                coordinates[player]['handCard' + i] = {
                    x: backplateContainer.x + (i - 1) * (smallCardWidth - cardStep * 2),
                    y: backplateContainer.y - backplateContainer.displayHeight / 6
                };
                getContainerFromSVG(
                    coordinates[player]['handCard' + i].x,
                    coordinates[player]['handCard' + i].y,
                    'handCardPlayer' + player + 'Pos' + i,
                );
            }
        }
    }

    switchOffFrames();

//    <?php include('create/fishkaDragEvents.js.php')?>

//    <?php include(ROOT_DIR . '/js/common_functions/getSVGButtonFunction.js')?>

    reportGameIsReadyYandex();
}