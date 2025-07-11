//
<?php
use classes\T;
?>

function initNewGameVarsGlobal() {
    gameLog = [];
    isInviteGameWaiting = false;
    tWaiting = 0;
    isUserBlockActive = false;
    isOpponentBlockActive = false;
    winScore = false;
    gameBid = false;

    playerScores = {
        youBlock: {mode: OTJAT_MODE, digit3: 0, digit2: 0, digit1: 0},
        player1Block: {mode: OTJAT_MODE, digit3: 0, digit2: 0, digit1: 0},
        player2Block: {mode: OTJAT_MODE, digit3: 0, digit2: 0, digit1: 0},
    };
    initScoresGlobal();

    clearContainerVarsGlobal();
}

function activateFullScreenForMobiles() {
    if(isYandexAppGlobal()) {
        return;
    }

    if (isIOSDevice()) {
        return;
    }

    if (gameWidth < gameHeight) {
        document.body.requestFullscreen();
    }
}

document.addEventListener("fullscreenchange", function() {
    if (isYandexAppGlobal()) {
        return;
    }

    if (!document.fullscreenElement) {
        bootbox.confirm({
            size: 'small',
            message: '<?= T::S('Return to fullscreen mode?') ?>',
            locale: '<?= strtolower(T::$lang) ?>',
            callback: function(result) {
                if(result) {
                    document.body.requestFullscreen();
                }
            }
        });
    }
});

async function mobileShare() {
    thisUrl = window.location.href;
    thisTitle = document.title;
    shareObj = {
        title: thisTitle,
        url: thisUrl,
    }

    try {
        await navigator.share(shareObj);
    } catch (err) {
        console.log('share ERROR! ' + err);
    }
}

function genDivGlobal(i, isChange = false) {
    if (i <= 31) {
        return '<div class="letter_' + i + '"></div>';
    }

    let coords = {
        32: {x: 526, y: 640},
        33: {x: 182, y: 24},
        34: {x: 507, y: 259},
        35: {x: 598, y: 259},
        36: {x: 691, y: 259},
        37: {x: 786, y: 259},
        38: {x: 881, y: 259},
        39: {x: 964, y: 259},
        40: {x: 3, y: 385},
        41: {x: 101, y: 385},
        42: {x: 186, y: 385},
        43: {x: 247, y: 396},
        44: {x: 324, y: 385},
        45: {x: 411, y: 385},
        46: {x: 503, y: 380},
        47: {x: 612, y: 385},
        48: {x: 714, y: 385},
        49: {x: 812, y: 385},
        50: {x: 908, y: 384},
        51: {x: 1001, y: 385},
        52: {x: 1080, y: 385},
        53: {x: 1, y: 507},
        54: {x: 92, y: 507},
        55: {x: 186, y: 507},
        56: {x: 295, y: 507},
        57: {x: 408, y: 507},
        58: {x: 502, y: 507},
        59: {x: 592, y: 507}
    };
    let koef = 44 / 76;
    let imgWidth = Math.round(1187 * koef);
    let styleBeg = 'display: inline-block; background: url(/img/letters_english.png); background-color:grey;background-position:-';
    let divTpl = '<div onmouseover="this.style.backgroundColor=\'green\';" onmouseout="this.style.backgroundColor=\'grey\';" style="display: inline-block; background: url(/img/letters_english.png); background-color:grey;background-position:-';
    let styleEnd = ' background-size: ' + imgWidth + 'px;'
        + ' width: 44px;'
        + ' height: 54px;'
        + ' border-radius: 5px;';
    let divEnd = ' background-size: ' + imgWidth + 'px;'
        + ' width: 44px;'
        + ' height: 54px;'
        + ' border-radius: 5px;'
        + '"></div>';

    if (i == 53) {
        return (isChange ? styleBeg : divTpl)
            + Math.round(coords[i].x * koef) + 'px -'
            + Math.round(coords[i].y * koef) + 'px; '
            + (isChange ? styleEnd : divEnd);
    } else if (i == 43) {
        return (isChange ? styleBeg : divTpl)
            + Math.round(coords[i]['x'] * koef) + 'px -'
            + Math.round((coords[i]['y'] - 8) * koef) + 'px; '
            + (isChange ? styleEnd : divEnd);
    } else if (i == 46) {
        return (isChange ? styleBeg : divTpl)
            + Math.round(coords[i]['x'] * koef) + 'px -'
            + Math.round((coords[i]['y'] + 6) * koef) + 'px; '
            + (isChange ? styleEnd : divEnd);
    } else if (i == 40) {
        return (isChange ? styleBeg : divTpl)
            + Math.round(coords[i]['x'] * koef) + 'px -'
            + Math.round((coords[i]['y'] - 2) * koef) + 'px; '
            + (isChange ? styleEnd : divEnd);
    } else if (i == 56) {
        return (isChange ? styleBeg : divTpl)
            + Math.round(coords[i]['x'] * koef * 0.9) + 'px -'
            + Math.round((coords[i]['y'] - 2) * koef * 0.9) + 'px;'
            + ' background-size: ' + Math.round(imgWidth * 0.9) + 'px;'
            + ' width: 44px;'
            + ' height: 54px;'
            + ' border-radius: 5px;'
            + (isChange ? '' : '"></div>');
    }

    return ((isChange ? styleBeg : divTpl)
        + Math.round((coords[i]['x'] + 3) * koef) + 'px -'
        + Math.round(coords[i]['y'] * koef) + 'px; '
        + (isChange ? styleEnd : divEnd));

}

document.addEventListener("visibilitychange", function () {
    pageActive = document.visibilityState;

    onVisibilityChange();
});

function onVisibilityChange() {
    reportVisibilityChangeYandex();

    if (gameState == 'myTurn'
        || gameState == 'preMyTurn'
        || gameState == 'otherTurn'
        || gameState == 'initGame'
        || gameState == 'initRatingGame') {
        if (pageActive === 'hidden') {
            fetchGlobal(STATUS_CHECKER_SCRIPT)
                .then((data) => {
                    commonCallback(data);
                });
        }
    }
}

function showFullImage(idImg, width, oldWidth = 198) {
    if ($('#' + idImg).width() < width) {
        if (fullImgID !== false) {
            $('#' + fullImgID).css('z-index', '50');
            $('#' + fullImgID).css('top', '0px');
            $('#' + fullImgID).css('left', '0px');
            $('#' + fullImgID).css('position', 'relative');
            $('#' + fullImgID).width(fullImgWidth);
        }
        fullImgID = idImg;
        fullImgWidth = oldWidth;
        $('#' + idImg).css('position', 'fixed');
        $('#' + idImg).css('top', (Math.round(window.innerHeight - width / 16 * 9) / 3) + 'px');
        $('#' + idImg).css('left', (Math.round(window.innerWidth - width) / 2) + 'px');
        $('#' + idImg).width(width);
        $('#' + idImg).css('z-index', '100');
    } else {
        fullImgID = false;
        fullImgWidth = 0;
        $('#' + idImg).css('z-index', '50');
        $('#' + idImg).css('top', '0px');
        $('#' + idImg).css('left', '0px');
        $('#' + idImg).css('position', 'relative');
        $('#' + idImg).width(oldWidth);
    }
}

function mergeTheIDs(oldKey, commonID) {
    if (oldKey.trim() == '') {
        let resp = {result: 'error', message: '<?= T::S('Empty value is forbidden') ?>'};
        showCabinetActionResult(resp);

        return;
    }

    fetchGlobal(MERGE_IDS_SCRIPT, '', 'oldKey=' + btoa(oldKey) + '&commonID=' + commonID)
        .then((resp) => {
            showCabinetActionResult(resp);
        });
}

function showCabinetActionResult(response) {
    if ('message' in response) {
        cabinetAlert = bootbox.alert({
            message: response['message'],
            className: 'modal-settings modal-profile text-white',
            locale: 'ru',
            size: 'small',
            closeButton: false,
            centerVertical: true
        });
    }
}

function copyKeyForID(key, commonID = '') {
    $('#key_for_id').select();
    document.execCommand("copy");
}

function savePlayerName(name, commonID = '') {
    if (name.trim() == '') {
        let resp = {result: 'error', message: '<?= T::S('Empty value is forbidden') ?>'};
        showCabinetActionResult(resp);

        return;
    }

    fetchGlobal(SET_PLAYER_NAME_SCRIPT, '', 'name=' + encodeURIComponent(name) + (commonID != '' ? '&common_id=' + commonID : ''))
        .then((resp) => {
            if (resp['result'] == 'saved') {
                $('#playersNikname').text(name);
            }
            showCabinetActionResult(resp);
        });
}

function savePlayerAvatar() {
    $('#file_upload_action_button').attr('disabled','disabled');

    // складируем форму в ......форму))
    const checkElement = document.getElementById("player_avatar_file");
    if (!checkElement.checkValidity()) {
        showCabinetActionResult({
            result: 'error',
            message: '<?= T::S('Error! Choose image file with the size not more than') ?> <?= round(PlayersController::MAX_UPLOAD_SIZE / 1024 / 1024, 2); ?>MB'
        });

        return false;
    }

    var formData = new FormData($('#superForm')[0]);

    if (pageActive != 'hidden') {
        requestSended = true;
        requestTimestamp = (new Date()).getTime();
    }

    // todo cooki url-parameters for yandex browser in yandex game
    let URL = BASE_URL + AVATAR_UPLOAD_SCRIPT
        + '?'
        + commonParams()
    ;

    $.ajax({
        url: URL,
        xhrFields: { withCredentials: true },
        type: 'POST',
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function (returndata) {
            console.log(returndata);
            resp = JSON.parse(returndata);

            if (resp['result'] === 'saved') {
                $('#playersAvatar').html('<img class="main-info-image" src="' + resp['url'] + '" alt="" />');
            }

            showCabinetActionResult(resp);


            return false;
        }
    });

    return false;
}

function refreshId(element_id, url) {
    let respMessage = STATS_GET_ERROR;

    $.ajax({
        url: url,
        type: 'GET',
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function (returndata) {
            resp = JSON.parse(returndata);
            $('#' + element_id).html(resp.message + resp.pagination);
        }
    });
}

function version(firstKey = false) {
    return (firstKey ? '?' : '&') + 'ver=' + Math.floor(Date.now());
}

function langParam(firstKey = false) {
    return (firstKey ? '?' : '&') + 'lang=' + lang;
}

async function getStatPageGlobal(userId = commonId) {
    let url = BASE_URL + STATS_URL + '?common_id=' + userId + version() + langParam();
    let respMessage = STATS_GET_ERROR;

    if (userId) {
        try {
            const response = await fetch(url, {
                method: 'GET',
                mode: 'cors', // no-cors, *cors, same-origin
                cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
                credentials: 'include',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
            });

            // Проверяем успешность запроса
            if (!response.ok) {
                throw new Error(`Error: ${response.status}`);
            }

            const returndata = await response.json();
            // Получаем JSON

            const s = StatsPage({
                json: returndata,
                BASE_URL: ''
            });
            const message = await s.buildHtml();

            return {
                message,
                onLoad: s.onLoad,
            };
        } catch (error) {
            console.error(STATS_GET_ERROR, error.message);
            return {
                message: respMessage,
            };
        }
    } else {
        return {
            message: '<?= T::S('Play at least one game to view statistics') ?>'
        };
    }
}

function savePlayerAvatarUrl(url, commonID) {
    if (url.trim() == '') {
        let resp = {result: 'error', message: '<?= T::S('Empty value is forbidden') ?>'};
        showCabinetActionResult(resp);

        return;
    }

    fetchGlobal(SET_AVATAR_SCRIPT, '', 'avatar=' + encodeURIComponent(url) + '&commonID=' + commonID)
        .then((resp) => {
            if (resp['result'] == 'saved')
                $('#playersAvatar').html('<img src="' + url + '" width="100px" max-height = "100px"/>');
            showCabinetActionResult(resp);
        });
}

function initLotok() {
    for (var i = 0; i < lotokCapacityY; i++) {
        lotokCells[i] = [];
        for (var j = 0; j < lotokCapacityX; j++)
            lotokCells[i][j] = false;
    }
}

function lotokFindSlotXY() {
    let XY = [];
    outer:
        for (var i = 0; i < lotokCapacityY; i++)
            for (var j = 0; j < lotokCapacityX; j++)
                if (lotokCells[i][j] === false) {
                    XY[0] = j;
                    XY[1] = i;
                    lotokCells[i][j] = true;
                    break outer;
                }
    return XY;
}

function lotokFindSlotReverseXY() {
    let XY = [];
    outer:
        for (var i = lotokCapacityY - 1; i >= 0; i--)
            for (var j = lotokCapacityX - 1; j >= 0; j--)
                if (lotokCells[i][j] === false) {
                    XY[0] = j;
                    XY[1] = i;
                    lotokCells[i][j] = true;
                    break outer;
                }
    return XY;
}

function lotokGetX(X, Y) {
    if (buttonHeightKoef == 1) {
        return lotokX + lotokCellStep * fishkaScale * X;
    } else
        return lotokX + lotokCellStep * X;
}

function lotokGetY(X, Y) {
    return lotokY + lotokCellStepY * Y;
}

function lotokFreeXY(X, Y) {
    lotokCells[Y][X] = false;
}

function placeToLotok(fishka) {
    var slotXY = lotokFindSlotXY();

    fishka.setData('cellX', false);
    fishka.setData('cellY', false);
    fishka.setData('lotokX', slotXY[0]);
    fishka.setData('lotokY', slotXY[1]);
    fishka.x = lotokGetX(slotXY[0], slotXY[1]);
    fishka.y = lotokGetY(slotXY[0], slotXY[1]);
}

function disableButtons() {
    for (let k in buttons) {
        if (buttons[k].svgObject !== false)
            buttons[k].svgObject.disableInteractive();
    }
}

function enableButtons() {
    //if (bootBoxIsOpenedGlobal()) return;
    for (let k in buttons) {
        if ('enabled' in buttons[k]) {
            if (gameState in buttons[k].enabled) {
                if (buttons[k].svgObject !== false) {
                    buttons[k].svgObject.setInteractive();
                    buttons[k].svgObject.bringToTop(buttons[k].svgObject.getByName(k + OTJAT_MODE));
                }

            } else {
                if (buttons[k].svgObject !== false) {
                    buttons[k].svgObject.disableInteractive();
                    buttons[k].svgObject.bringToTop(buttons[k].svgObject.getByName(k + INACTIVE_MODE));
                }

            }
        } else {
            if (buttons[k].svgObject !== false)
                buttons[k].svgObject.setInteractive();
        }
    }
}


function placeFishki() {
    let maxI = 0;
    let n = 9;

    for (var i in container) {
        if (i > maxI)
            maxI = i;

        if (container[i].getData('cellX')) {
            cells[container[i].getData('cellX')][container[i].getData('cellY')][0] = false;
            cells[container[i].getData('cellX')][container[i].getData('cellY')][1] = false;
        }

        if ((container[i].getData('lotokX') !== false) && (container[i].getData('lotokY') !== false)) {
            lotokFreeXY(container[i].getData('lotokX'), container[i].getData('lotokY'));
            container[i].setData('lotokX', false);
            container[i].setData('lotokY', false);
        }

        container[i].destroy();
    }

    for (let i = maxI; i >= 0; i--)
        if (i in container)
            container.splice(i, 1);

    for (let i = 1; i <= n; i++) {
        let lotokXY = lotokFindSlotXY();

        container.push(getFishkaGlobal(i, lotokGetX(lotokXY[0], lotokXY[1]), lotokGetY(lotokXY[0], lotokXY[1]), this.game.scene.scenes[gameScene], true).setData('lotokX', lotokXY[0]).setData('lotokY', lotokXY[1]));
    }
}

function getSVGBlockGlobal(X, Y, buttonName, _this, scalable, hasDigits = false) {
    let elements = [];
    let elementNumber = 0;

    for (let mode in playerBlockModes) {
        elements[elementNumber] = _this.add.image(0, 0, buttonName + playerBlockModes[mode])
            .setName(buttonName + playerBlockModes[mode]);
        if(scalable) {
            elements[elementNumber].setScale(1, buttonHeightKoef);
        }
        elementNumber++;
    }

    if (hasDigits) {
        let imgName = 'numbersX3' in players[buttonName] ? 'timer_' : 'player_';
        let y = 'numbersY' in players[buttonName] ? players[buttonName].numbersY : 0;
        let x3 = 'numbersX3' in players[buttonName] ? players[buttonName].numbersX3 : elements[0].displayWidth * 0.75 * 0.5;
        let x2 = 'numbersX2' in players[buttonName] ? players[buttonName].numbersX2: elements[0].displayWidth * 0.6 * 0.5;
        let x1 = 'numbersX1' in players[buttonName] ? players[buttonName].numbersX1 : elements[0].displayWidth * 0.45 * 0.5;

        playerBlockModes.forEach(mode => {
            if ('dvoetochX' in players[buttonName]) {
                elements[elementNumber] = _this.add.image(
                    players[buttonName].dvoetochX
                    , y
                    , mode + '_' + 'dvoetoch')
                    .setName(mode + '_' + 'dvoetoch')
                    .setVisible(false);

                elementNumber++;
            }

            for (let k in digits.playerDigits[mode]) {
                elements[elementNumber] = _this.add.image(
                    x3
                    , y
                    , mode + '_' + imgName + k)
                    .setName(mode + '_' + k.replace('digit_', '') + '_3')
                    .setVisible(false);

                elementNumber++;
            }
        });

        playerBlockModes.forEach(mode => {
            for (let k in digits.playerDigits[mode]) {
                elements[elementNumber] = _this.add.image(
                    x2
                    , y
                    , mode + '_' + imgName + k)
                    .setName(mode + '_' + k.replace('digit_', '') + '_2')
                    .setVisible(false);

                if(scalable) {
                    elements[elementNumber].setScale(buttonHeightKoef, buttonHeightKoef);
                }

                elementNumber++;
            }
        });

        playerBlockModes.forEach(mode => {
            for (let k in digits.playerDigits[mode]) {
                elements[elementNumber] = _this.add.image(
                    x1
                    , y
                    , mode + '_' + imgName + k)
                    .setName(mode + '_' + k.replace('digit_', '') + '_1')
                    .setVisible(false);

                if(scalable) {
                    elements[elementNumber].setScale(buttonHeightKoef, buttonHeightKoef);
                }

                elementNumber++;
            }
        });
    }

    let container = _this.add.container(X, Y, elements);
    container.setSize(elements[0].displayWidth, elements[0].displayHeight);

    if (hasDigits) {
        container.setAlpha(INACTIVE_USER_ALPHA);
    }

    return container;
}

function clearContainerVarsGlobal() {
    dontBlink = true;

    while (errorsToBlink.length) {
        errorsToBlink.pop();
    }

    while (prevErrors.length) {
        prevErrors.pop();
    }

    while (sudokuMistakesContainer.length) {
        sudokuMistakesContainer.pop().destroy();
    }

    blinkErrorsCounter = 0;

    prevCellsOpened = {};

    while (cellsToBlink.length) {
        cellsToBlink.pop();
    }

    blinkCellsCounter = 0;

    while(container.length) {
        container.pop().destroy();
    }

    for (let i = 0; i <= 8; i++) {
        for (let j = 0; j <= 8; j++) {
            if (i in sudokuChecksContainer && j in sudokuChecksContainer[i]) {
                while (sudokuChecksContainer[i][j].length) {
                    sudokuChecksContainer[i][j].pop().destroy();
                }
            }
        }
    }
}

//<?php include('globals/getFishkaGlobalFunction.js')?>
//<?php include('globals/buttonGlobalFunctions_2.js.php')?>

//<?php include('globals/verstkaFunctions.js.php') ?>

//<?php include(ROOT_DIR . '/js/common_functions/ajaxGetGlobalFunction.js.php')?>
//<?php include('globals/parseDeskGlobalFunction.js.php')?>
//<?php include('globals/initCellsGlobalFunction.js')?>
//<?php include('globals/findPlaceGlobalFunction.js')?>
//<?php include('globals/changeFishkiGlobalFunction.js')?>
//<?php include(ROOT_DIR . '/js/common_functions/bootBoxIsOpenedGlobalFunction.js.php')?>
//<?php include(ROOT_DIR . '/js/common_functions/gadgetTypeFunctions.js.php')?>


