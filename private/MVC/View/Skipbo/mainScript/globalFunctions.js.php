//
<?php
use classes\T;
?>

async function copyTextToClipboard(text) {
    try {
        await navigator.clipboard.writeText(text);
    } catch (err) {
        console.error('Error while using buffer:', err);
    }
}

const inviteLink = function () {
    return window.location.href.split('?')[0].split('#')[0] + (commonId ? `?friend=${commonId}` : '');
}

function closeDialogs() {
    bootbox.hideAll();
    canOpenDialog = true;
    canCloseDialog = true;
    dialog = false;
}

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
        player3Block: {mode: OTJAT_MODE, digit3: 0, digit2: 0, digit1: 0},
        player4Block: {mode: OTJAT_MODE, digit3: 0, digit2: 0, digit1: 0},
    };
    initScoresGlobal();

    clearContainerVarsGlobal();
}

function activateFullScreenForMobiles() {
    if (isYandexAppGlobal()) {
        return;
    }

    if (isIOSDevice()) {
        return;
    }

    if (gameWidth < gameHeight) {
        document.body.requestFullscreen();
    }
}

document.addEventListener("fullscreenchange", function () {
    if (isYandexAppGlobal()) {
        return;
    }

    if (!document.fullscreenElement) {
        bootbox.confirm({
            size: 'small',
            message: '<?= T::S('Return to fullscreen mode?') ?>',
            callback: function (result) {
                if (result) {
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
    }
}

if (!isSteamGlobal()) {
    document.addEventListener("visibilitychange", function () {
        if (pageActive !== document.visibilityState) {
            pageActive = document.visibilityState;
            onVisibilityChange("visibilitychange");
        }
    });
}

function newVisibilityStatus(status) {
    if (pageActive !== status) {
        pageActive = status;
        onVisibilityChange('newVisibilityStatus');
    }
}

if (isSteamGlobal()) {
    window.electronAPI.windowFocus(newVisibilityStatus);
}

function onVisibilityChange(caller = '') {
    reportVisibilityChangeYandex();
    if (!requestSended && [MY_TURN_STATE, PRE_MY_TURN_STATE, OTHER_TURN_STATE, INIT_GAME_STATE, INIT_RATING_GAME_STATE].indexOf(gameState) >= 0) {
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
    $('#file_upload_action_button').attr('disabled', 'disabled');

    // складируем форму в ......форму))
    const checkElement = document.getElementById("player_avatar_file");
    if (!checkElement.checkValidity()) {
        showCabinetActionResult({
            result: 'error',
            message: `<?= T::S('Error! Choose image file with the size not more than') ?>
            <?= round(PlayersController::MAX_UPLOAD_SIZE / 1024 / 1024, 2) ?>MB`
        });

        return false;
    }

    var formData = new FormData($('#superForm')[0]);

    if (pageActive === 'hidden') {
        hiddenRequestSended = true;
    }
    requestSended = true;
    requestTimestamp = (new Date()).getTime();

    // todo cooki url-parameters for yandex browser in yandex game
    let URL = BASE_URL + AVATAR_UPLOAD_SCRIPT
        + '?'
        + commonParams()
    ;

    $.ajax({
        url: URL,
        xhrFields: {withCredentials: true},
        type: 'POST',
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function (returndata) {
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

function randVersion(firstKey = false) {
    return (firstKey ? '?' : '&') + 'ver=' + Math.floor(Date.now());
}

function langParam(firstKey = false) {
    return (firstKey ? '?' : '&') + 'lang=' + lang;
}

async function getStatPageGlobal(userId = commonId) {
    let url = BASE_URL + STATS_URL + '?common_id=' + userId + randVersion() + langParam();
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
        for (let i = 0; i < lotokCapacityY; i++)
            for (let j = 0; j < lotokCapacityX; j++)
                if (lotokCells[i][j] === false) {
                    XY[0] = j;
                    XY[1] = i;
                    lotokCells[i][j] = true;

                    break outer;
                }

    return XY;
}


function _lotokFindSlotXY() {
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

function lotokFreeTotal() {
    for (let i = 0; i < lotokCapacityY; i++)
        for (let j = 0; j < lotokCapacityX; j++)
            lotokFreeXY(j, i);
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

function getContainerFromSVG(X, Y, blockName, _this, param = '', props = false) {
    function myCallback(X, Y, resourceName, blockName, props) {
        let element = _this.add.image(0, 0, resourceName);
        let elements = [element];

        if (props && 'isAvatar' in props && props.isAvatar) {
            let frame = faserObject.add.image(0, 0, 'avatar_frame_you');
            frame.setScale(element.width / frame.width, element.height / frame.height);
            elements.push(frame);
        }

        let container = _this.add.container(X, Y, elements);

        if ('width' in entities[blockName]) {
            container.setScale(entities[blockName].width / element.displayWidth, entities[blockName].width / element.displayWidth);
        } else {
            container.setSize(element.displayWidth, element.displayHeight);
        }

        // Проверка по высоте - аватар не должен быть выше height
        if (props && 'isAvatar' in props && props.isAvatar && 'height' in entities[blockName] && container.first.displayHeight > container.first.displayWidth) {
            container.setScale(entities[blockName].height / element.displayHeight, entities[blockName].height / element.displayHeight);
        }

        if (props) {
            for (let prop in props) {
                container[prop] = props[prop];
            }
        }

        if (entities[blockName].svgObject === false) {
            entities[blockName].svgObject = [];
        }

        entities[blockName].svgObject.push(container);
    }


    if ('preloaded' in entities[blockName] && entities[blockName].preloaded) {
        myCallback(X, Y, param ? param : entities[blockName].filename, blockName, props);

        return;
    }

    let resourceName = blockName + param + Date.now();
    let url = entities[blockName].filename + encodeURIComponent(param);
    if (
        url.indexOf('.svg') >= 1
        ||
        url.indexOf(SVG_RESOURCE_MASK) >= 1
    ) {
        preloaderObject.load.svg(resourceName, url,
            {
                ...('width' in entities[blockName] && {
                    'width': entities[blockName].width,
                })
            }
        );
    } else {
        preloaderObject.load.image(resourceName, url,
            {
                ...('width' in entities[blockName] && {
                    'width': entities[blockName].width,
                }),
            }
        );
    }

    preloaderObject.load.start();

    preloaderObject.load.on('complete', () => myCallback(X, Y, resourceName, blockName, props));
}

function getSVGCardBlockGlobal(X, Y, buttonName, _this, scalable = false, props = false, draggable = false) {
    let element = _this.add.image(0, 0, cards[buttonName].imgName)
        .setName(buttonName);
    if (scalable) {
        element.setScale(1, buttonHeightKoef);
    } else if ('width' in cards[buttonName]) {
        element.width = cards[buttonName].width;
    }

    let container = _this.add.container(X, Y, element);
    if ('width' in cards[buttonName]) {
        container.setScale(cards[buttonName].width / element.displayWidth);
        container.setSize(element.displayWidth, element.displayHeight);
    } else {
        container.setSize(element.displayWidth, element.displayHeight);
    }

    if (props) {
        for (let prop in props) {
            container[prop] = props[prop];
        }
    }

    if (draggable) {
        container.setInteractive(
            // new Phaser.Geom.Rectangle(-1 * cardWidth / 2, -1 * cardWidth * cardSideFactor/ 2, cardWidth / 2, cardWidth * cardSideFactor / 2)
            // , Phaser.Geom.Rectangle.Contains
        );
        _this.input.setDraggable(container);
    }

    return container;
}

function getSVGBlockGlobal(X, Y, buttonName, _this, scalable, hasDigits = false) {
    let elements = [];
    let elementNumber = 0;

    for (let mode in playerBlockModes) {
        elements[elementNumber] = _this.add.image(0, 0, buttonName + playerBlockModes[mode])
            .setName(buttonName + playerBlockModes[mode]);
        if (scalable) {
            elements[elementNumber].setScale(1, buttonHeightKoef);
        }
        elementNumber++;
    }

    if (hasDigits) {
        let imgName = 'numbersX3' in players[buttonName] ? 'timer_' : 'player_';
        let y = 'numbersY' in players[buttonName] ? players[buttonName].numbersY() : 0;
        let x3 = 'numbersX3' in players[buttonName] ? players[buttonName].numbersX3() : elements[0].displayWidth * 0.75 * 0.5;
        let x2 = 'numbersX2' in players[buttonName] ? players[buttonName].numbersX2() : elements[0].displayWidth * 0.6 * 0.5;
        let x1 = 'numbersX1' in players[buttonName] ? players[buttonName].numbersX1() : elements[0].displayWidth * 0.45 * 0.5;

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

                if (scalable) {
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

                if (scalable) {
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
}

//<?php include('globals/getFishkaGlobalFunction.js')?>
//<?php include('globals/buttonGlobalFunctions_2.js.php')?>

//<?php include('globals/verstkaFunctions.js.php') ?>

//<?php include(ROOT_DIR . '/js/common_functions/ajaxGetGlobalFunction.js.php')?>
//<?php include('globals/parseDeskGlobalFunction.js.php')?>
//<?php include('globals/initCellsGlobalFunction.js')?>
//<?php include('globals/dragCards.js.php')?>
//<?php include(ROOT_DIR . '/js/common_functions/bootBoxIsOpenedGlobalFunction.js.php')?>
//<?php include(ROOT_DIR . '/js/common_functions/gadgetTypeFunctions.js.php')?>


