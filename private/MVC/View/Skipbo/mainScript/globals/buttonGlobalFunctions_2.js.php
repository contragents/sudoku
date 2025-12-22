//

<?php
use classes\T;
?>

function submitButtonFunction() {
    if (!submitButtonActive()) {
        return;
    }

    if (bootBoxIsOpenedGlobal()) {
        return;
    }

    buttons.submitButton.setDisabled();

    setTimeout(function () {
        fetchGlobal(SUBMIT_SCRIPT, 'cells', cells)
            .then((data) => {
                if ('http_status' in data && (data['http_status'] === BAD_REQUEST || data['http_status'] === PAGE_NOT_FOUND)) {

                    dialog = bootbox.alert({
                        message: ('message' in data && data['message'] !== '')
                            ? (data['message'] + '<br /> <?= T::S('Try sending again') ?>')
                            : '<strong><?= T::S('Error connecting to server!') ?><br /> <?= T::S(
                                'Try sending again'
                            ) ?></strong>',
                        size: 'small',
                        className: 'modal-settings modal-profile text-white',
                    });
                } else {
                    gameState = 'afterSubmit';

                    if ('desk' in data) {
                        parseDeskGlobal(data.desk);
                    }

                    if ('gameState' in data) {
                        commonCallback(data);
                    }

                    if ('comments' in data) {
                        lastComment = data.comments;
                    }
                }
            });
    }, 100);
}


function checkButtonFunction() {
    if (!checkButtonActive()) {
        return;
    }

    if (bootBoxIsOpenedGlobal()) {
        return;
    }

    buttons.checkButton.setDisabled();

    for (let k in container) {
        if (container[k].getData('cellX') !== false && container[k].getData('cellY') !== false) {
            let i = +container[k].getData('cellX');
            let j = +container[k].getData('cellY');
            let number = +container[k].getData('letter');
            let addCheck = true;

            if (i in sudokuChecksContainer && j in sudokuChecksContainer[i]) {
                let tmpArr = [];
                while (sudokuChecksContainer[i][j].length) {
                    let gameObject = sudokuChecksContainer[i][j].pop();

                    if (+(gameObject.getData('letter')) === number) {
                        gameObject.destroy();
                        addCheck = false;
                    } else {
                        tmpArr.push(gameObject);
                    }
                }

                while (tmpArr.length) {
                    sudokuChecksContainer[i][j].push(tmpArr.pop());
                }
            } else {
                if (!(i in sudokuChecksContainer)) {
                    sudokuChecksContainer[i] = [];
                }

                sudokuChecksContainer[i][j] = [];
            }

            if (addCheck) {
                addCheck = !cellHasError(i, j, number);
            }

            if (addCheck) {
                let checkNumberGameObject = getFishkaGlobal(number, 1, 1, this.game.scene.scenes[gameScene], false, 'green').disableInteractive();
                placeErrorSudokuGlobal(checkNumberGameObject, i, j, number);
                sudokuChecksContainer[i][j].push(checkNumberGameObject);
            }
        }
    }

    buttons.checkButton.setEnabled();
}

let cancelCallback = function () {
    buttons.newGameButton.svgObject.setInteractive();

    return true;
};

function newGameButtonFunction(ignoreDialog = false) {
    if (!ignoreDialog && bootBoxIsOpenedGlobal()) {
        return;
    }

    buttons.newGameButton.svgObject.disableInteractive();

    if ([MY_TURN_STATE, PRE_MY_TURN_STATE, OTHER_TURN_STATE, START_GAME_STATE].indexOf(gameState) >= 0) {

        bootbox.hideAll();

        dialog = bootbox.dialog({
            // title: 'Требуется подтверждение',
            message: '<?= T::S('You will lose if you quit the game! CONTINUE?') ?>',
            size: 'medium',
            className: 'modal-settings modal-profile text-white',
            closeButton: false,
            onEscape: function () {
                return cancelCallback();
            },
            buttons: {
                cancel: {
                    label: '<?= T::S('Cancel') ?>',
                    className: 'btn-outline-success',
                    callback: function () {
                        return cancelCallback();
                    }
                },
                confirm: {
                    label: '<?= T::S('Confirm') ?>',
                    className: 'btn-primary',
                    callback: function () {
                        requestToServerEnabled = true;
                        fetchGlobal(NEW_GAME_SCRIPT, '', 'gameState=' + gameState)
                            .then((data) => {
                                commonCallback(data);
                            });

                        return cancelCallback();
                    }
                },
                invite: {
                    label: '<?= T::S('Revenge!') ?>',
                    className: 'btn-info',
                    callback: function () {
                        setTimeout(function () {
                            isInviteGameWaiting = true;

                            fetchGlobal(INVITE_SCRIPT, '', 'gameState=' + gameState)
                                .then((dataInvite) => {
                                    let responseText = '<?= T::S('Request rejected') ?>';
                                    if (dataInvite != '') {
                                        responseText = dataInvite['message'];
                                    }

                                    dialogResponse = bootbox.alert({
                                        message: responseText,
                                        size: 'small',
                                        className: 'modal-settings modal-profile text-white',
                                        callback: function () {
                                            dialogResponse.modal('hide');
                                            gameStates.gameResults.results(dataInvite);
                                        }
                                    });

                                    setTimeout(
                                        function () {
                                            dialogResponse.find(".bootbox-close-button").trigger("click");
                                        }
                                        , 2000
                                    );

                                    buttons.newGameButton.svgObject.setInteractive();

                                });
                        }, 100);

                        return true;
                    }
                },
            }
        });
    } else {
        buttons.newGameButton.svgObject.bringToTop(buttons.newGameButton.svgObject.getByName('newGameButton' + 'Inactive'));

        fetchGlobal(NEW_GAME_SCRIPT, '', 'gameState=' + gameState)
            .then((data) => {
                commonCallback(data);
            });
    }
};

function resetButtonFunction(ignoreBootBox = false) {
    if (ignoreBootBox === false)
        if (bootBoxIsOpenedGlobal())
            return;

    // todo SB-8
}

function chatButtonFunction() {
    if (bootBoxIsOpenedGlobal())
        return;

    canOpenDialog = false;
    canCloseDialog = false;
    let msgSpan = '<span id="msg_span">';
    let message = '<ul style="margin-left:-10px;margin-right:-5px;">' + msgSpan + '</span>';
    let i = 0;
    for (k in chatLog) {
        if (i >= 10) break;
        message = message + '<li>' + chatLog[k] + "</li>";
        i++;
    }

    let noMsgSpan = '<span id="no_msg_span">';
    if (i == 0) {
        message += noMsgSpan + '<?= T::S('No messages yet') ?>' + '</span>';
    } else {
        message += noMsgSpan + '</span>';
    }
    message = message + '</ul>';
    let radioButtons = message + '';

    let isSelectedPlaced = false;
    if (ochki_arr.length > 1) {
        radioButtons += '<div style="font-size: 70%;" class="form-check form-check-inline"><input class="form-check-input" type="radio" id="chatall" name="chatTo" value="NULL" checked> <label class="form-check-label" for="chatall"><?= T::S(
            'For everyone'
        ) ?></label></div>';
        isSelectedPlaced = true;
    }

    for (let k in ochki_arr) {
        if (k != myUserNum) {
            radioButtons += '<div style="font-size: 70%;" class="form-check form-check-inline"><input class="form-check-input" type="radio" id="to_' + (k == 0 ? '0' : k) + '" name="chatTo" value="' + (k == 0 ? '0' : k) + '" ' + (isSelectedPlaced ? '' : ' checked ') + '> <label class="form-check-label" for="to_' + (k == 0 ? '0' : k) + '"><?= T::S(
                'To Player'
            ) ?>' + (parseInt(k, 10) + 1) + '</label></div>';
            isSelectedPlaced = true;
        }
    }

    let textInput = '<div class="input-group input-group-lg">  <div class="input-group-prepend"></div>  <input type="text" id="chattext" class="form-control" name="messageText"></div>';

    bootbox.hideAll();

    dialog = bootbox.dialog({
        title: '</h5>'
            + '<h6>&nbsp;&nbsp;<?= T::S('Player support and chat at') ?> <a target="_blank" title="<?= T::S(
                'Join group'
            ) ?>" href="'
            + '<?= T::S('game_bot_url') ?>'
            + '">Telegram</a> </h6>'
            + '<h5><?= T::S('Send an in-game message') ?>',
        message: '<form onsubmit="return false" id="myChatForm">' + radioButtons + textInput + '</form>',
        size: 'large',
        className: 'modal-settings modal-profile text-white',
        closeButton: false,
        buttons: {
            confirm: {
                label: '<?= T::S('Send') ?>',
                className: 'btn-primary',
                callback: function () {
                    canOpenDialog = true;
                    canCloseDialog = true;

                    buttons.chatButton.svgObject.bringToTop(buttons.chatButton.svgObject.getByName('chatButton' + OTJAT_MODE));
                    buttons.chatButton.svgObject.getByName('chatButton' + ALARM_MODE).setData('alarm', false);

                    if ($(".bootbox-body #chattext").val() != '') {

                        buttons.chatButton.svgObject.disableInteractive();
                        buttons.chatButton.svgObject.bringToTop(buttons.chatButton.svgObject.getByName('chatButton' + 'Inactive'));

                        fetchGlobal(CHAT_SCRIPT, '', $(".bootbox-body #myChatForm").serialize())
                            .then((data) => {
                                    if (data == '')
                                        var responseText = '<?= T::S('Error') ?>';
                                    else {
                                        var responseText = data['message'];

                                        if (data['message'] === '<?= T::S('Message sent') ?>') {
                                            $('#no_msg_span').html('');
                                            $('#msg_span').html('<li>' + $('#chattext').val() + '</li>' + $('#msg_span').html());
                                        }

                                        $('#chattext').val('');
                                    }

                                    if (data['message'] !== '<?= T::S('Message sent') ?>') {
                                        if (data['gameState'] == 'wordQuery') {
                                            $('#no_msg_span').html('');
                                            $('#msg_span').html('<li>' + data['message'] + '</li>');
                                        } else {
                                            dialog2 = bootbox.alert({
                                                message: responseText,
                                                size: 'small',
                                                className: 'modal-settings modal-profile text-white',
                                            });
                                            setTimeout(
                                                function () {
                                                    dialog2.find(".bootbox-close-button").trigger("click");
                                                }
                                                , 2000
                                            );
                                        }
                                    }

                                    buttons['chatButton']['svgObject'].setInteractive();
                                    buttons['chatButton']['svgObject'].bringToTop(buttons['chatButton']['svgObject'].getByName('chatButton' + OTJAT_MODE));
                                    buttons['chatButton']['svgObject'].getByName('chatButton' + ALARM_MODE).setData('alarm', false);
                                }
                            );
                    }

                    return false;
                }
            },
            cancel: {
                label: '<?= T::S('Exit') ?>',
                className: 'ml-5 btn-secondary btn-default bootbox-cancel',
                callback: function () {
                    canOpenDialog = true;
                    canCloseDialog = true;

                    return true;
                }
            },
            complain: {
                label: '<?= T::S('Appeal') ?>',
                className: hasIncomingMessages ? 'btn-danger' : 'btn-light',
                callback: function () {
                    if (hasIncomingMessages) {
                        fetchGlobal(COMPLAIN_SCRIPT, '', $(".bootbox-body #myChatForm").serialize())
                            .then((data) => {
                                if (data == '')
                                    var responseText = '<?= T::S('Error') ?>';
                                else
                                    var responseText = data['message'];
                                dialog2 = bootbox.alert({
                                    message: responseText,
                                    size: 'small',
                                    className: 'modal-settings modal-profile text-white',
                                });
                                setTimeout(
                                    function () {
                                        dialog2.find(".bootbox-close-button").trigger("click");
                                    }
                                    , 5000
                                );
                            });
                    }

                    return false;
                }
            }
        }
    });
}

function logButtonFunction() {
    if (bootBoxIsOpenedGlobal())
        return;

    canOpenDialog = false;
    canCloseDialog = false;

    let message = '<br /><ul style="margin-left:-10px;margin-right:-5px;">';
    let i = 0;
    for (k in gameLog) {
        if (i >= 10) break;
        message = message + '<li>' + gameLog[k] + "</li>";
        i++;
    }
    message = message + '</ul>';
    if (i == 0)
        message = message + '<?= T::S('There are no events yet') ?>';

    bootbox.hideAll();

    notDialog = bootbox.dialog({
        message: message,
        size: 'small',
        className: 'modal-settings modal-profile text-white',
        onEscape: function () {
            activateFullScreenForMobiles();
            canOpenDialog = true;
            canCloseDialog = true;
        },
        buttons: {
            /*cancel: {
                label: "<?= T::S('Playing to') ?> <strong>" + winScore + "</strong>",
                className: 'btn btn-outline-secondary',
                callback: function () {
                    return false;
                }
            },*/
            confirm: {
                label: '<?= T::S('OK') ?>',
                className: 'btn-primary',
                callback: function () {
                    activateFullScreenForMobiles();
                    canOpenDialog = true;
                    canCloseDialog = true;
                    return true;
                }
            }
        },
        callback: function (result) {
            canOpenDialog = true;
            canCloseDialog = true;
        }
    })
        .off("shown.bs.modal")
        .find('button.btn.btn.btn-sm.btn-info')
        .prop('disabled', true);

    return;
};

function makeCheckButtonInactive(dialog) {
    dialog.addClass(CHECK_BUTTON_INACTIVE_CLASS);
}

function makeSubmitButtonInactive(dialog) {
    dialog.addClass(SUBMIT_BUTTON_INACTIVE_CLASS);
}

function checkButtonActive() {
    return !$('.' + CHECK_BUTTON_INACTIVE_CLASS).length;
}

function submitButtonActive() {
    return !$('.' + SUBMIT_BUTTON_INACTIVE_CLASS).length;
}

function playersButtonFunction() {
    if (bootBoxIsOpenedGlobal()) {
        return;
    }

    if (!gameNumber) {
        return;
    }

    if (window.innerWidth < window.innerHeight) {
        var orient = 'vertical';
    } else {
        var orient = 'horizontal';
    }

    buttons['playersButton']['svgObject'].disableInteractive();
    buttons['playersButton']['svgObject'].bringToTop(buttons['playersButton']['svgObject'].getByName('playersButton' + 'Inactive'));

    setTimeout(function () {
        fetchGlobalMVC(PLAYER_RATING_SCRIPT + '?common_id=' + commonId + '&' + commonParams(), '', orient).then((data) => {
                canOpenDialog = false;
                canCloseDialog = false;

                if (data == '')
                    var responseText = 'Error';
                else
                    var responseText = JSON.stringify(data);

                const p = PlayersPage(data);
                const html = p.buildHtml();
                const onLoad = p.onLoad;

                dialog = bootbox.alert({
                    title: '',
                    message: html,
                    className: 'modal-settings modal-players',
                    buttons: {
                        ok: {
                            label: '<?= T::S('Back') ?>',
                            className: 'btn btn-sm ml-auto mr-0',
                        },
                    },
                    onShown: function (e) {
                        onLoad();
                    },
                    closeButton: false, //
                    callback: () => {
                        $('.modal-players').modal('hide');

                        bootbox.hideAll();
                        canOpenDialog = true;
                        canCloseDialog = true;
                        dialog = false;
                    }
                });

                makeCheckButtonInactive(dialog);
                makeSubmitButtonInactive(dialog);

                buttons['playersButton']['svgObject'].setInteractive();
                buttons['playersButton']['svgObject'].bringToTop(buttons['playersButton']['svgObject'].getByName('playersButton' + OTJAT_MODE));
            }
        );
    }, 100);

    setTimeout(function () {
        buttons['playersButton']['svgObject'].setInteractive();
        buttons['playersButton']['svgObject'].bringToTop(buttons['playersButton']['svgObject'].getByName('playersButton' + OTJAT_MODE));
    }, 3000);
}

function claimIncome() {
    if (!commonId || !commonIdHash) {
        return;
    }

    fetchGlobalMVC(CLAIM_SCRIPT, '', `common_id=${commonId}&common_id_hash=${commonIdHash}`)
        .then(result => {
            if ('result' in result && result.result === 'success') {
                let balanceSudokuSelector = $('#balanceSudoku');
                let mainBalanceSudokuSelector = $('#main_balance');
                let bonusAccrualSelector = $('#bonusAccrual');
                let ratingByCoinsSelectior = $('#ratingByCoins');

                balanceSudokuSelector.html(result.SUDOKU_BALANCE);
                mainBalanceSudokuSelector.html(result.SUDOKU_BALANCE);
                bonusAccrualSelector.html(result.rewards);
                ratingByCoinsSelectior.html(result.SUDOKU_TOP);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

function checkCommonCards(commonCardsObj) {
    for (let pos in commonCardsObj) {
        // Deleting existing cards
        if (cards['commonCard' + pos].svgObject) {
            cards['commonCard' + pos].svgObject.setVisible(false).destroy();
            cards['commonCard' + pos].svgObject = false;
        }

        // Show cards
        if (commonCardsObj[pos].length) {
            // Take only last common card to display
            let currentCardValue = commonCardsObj[pos].pop();

            cards['commonCard' + pos].svgObject = getSVGCardBlockGlobal(
                coordinates['commonArea' + pos].x,
                coordinates['commonArea' + pos].y,
                'commonCard' + pos,
                faserObject,
                false,
                {entity: 'commonCard' + pos, cardValue: currentCardValue},
                false, // not draggable
                getCardImgName(currentCardValue)
            );
        }
    }
}

function displayCardCounter(count, player) {
    let counterBlockName = '';
    let playerBlockName = '';

    if (player === YOU) {
        counterBlockName = 'cardCounterYou';
        playerBlockName = 'youBlock';
    } else {
        counterBlockName = 'cardCounterPlayer' + player;
        playerBlockName = 'player' + player + 'Block';
    }

    if (entities[counterBlockName].svgObject && 'count' in entities[counterBlockName].svgObject && entities[counterBlockName].svgObject.count === count) {
        return;
    }

    if (entities[counterBlockName].svgObject) {
        entities[counterBlockName].svgObject.setVisible(false).destroy();
        entities[counterBlockName].svgObject = false;
    }

    entities[counterBlockName].svgObject = getContainerFromSVG(
        coordinates[player].cardCounter.x,
        coordinates[player].cardCounter.y,
        counterBlockName,
        count,
        {count: count}
    );

    displayScoreGlobal(winScore - count, playerBlockName, true);
}

function checkPlayerGoalCard(goalCardValue, player) {
    if (cards['goalCardPlayer' + player].svgObject && +cards['goalCardPlayer' + player].svgObject.cardValue !== goalCardValue) {
        cards['goalCardPlayer' + player].svgObject.setVisible(false).destroy();
        cards['goalCardPlayer' + player].svgObject = false;
    }

    if (!cards['goalCardPlayer' + player].svgObject) {
        cards['goalCardPlayer' + player].svgObject = getSVGCardBlockGlobal(
            coordinates[player].goalCard.x,
            coordinates[player].goalCard.y,
            'goalCardPlayer' + player,
            faserObject,
            false,
            {entity: 'goalCard', cardValue: goalCardValue},
            false,
            getCardImgName(goalCardValue),
        );
    }
}

function checkYouGoalCard(goalCardValue) {
    if (cards.goalCard.svgObject && +cards.goalCard.svgObject.cardValue !== goalCardValue) {
        cards.goalCard.svgObject.setVisible(false).destroy();
        cards.goalCard.svgObject = false;
    }

    if (!cards.goalCard.svgObject) {
        cards.goalCard.svgObject = getSVGCardBlockGlobal(
            coordinates.you.goalCard.x,
            coordinates.you.goalCard.y,
            'goalCard',
            faserObject,
            false,
            {entity: 'goalCard', cardValue: goalCardValue},
            true, // Draggable
            getCardImgName(goalCardValue)
        );
    }
}

function checkPlayerBankCards(bankObj, player) {
    for (let pos in bankObj) {
        // Deleting existing cards
        while (cards['bankCard' + pos + 'Player' + player].svgObject.length) {
            cards['bankCard' + pos + 'Player' + player].svgObject.pop().destroy();
        }

        while (bankObj[pos].length) {
            let currentCardValue = bankObj[pos].shift();

            cards['bankCard' + pos + 'Player' + player].svgObject.push(
                getSVGCardBlockGlobal(
                    coordinates[player]['bankCard' + pos].x,
                    coordinates[player]['bankCard' + pos].y,
                    'bankCard' + pos + 'Player' + player,
                    faserObject,
                    false,
                    {entity: 'bankCard' + pos, cardValue: currentCardValue},
                    false, // draggable last card only
                    getCardImgName(currentCardValue)
                )
            );
        }
    }
}

function checkYouBankCards(bankObj) {
    for (let pos in bankObj) {
        // Deleting existing cards
        while (cards['bankCard' + pos].svgObject.length) {
            cards['bankCard' + pos].svgObject.pop().destroy();
        }

        while (bankObj[pos].length) {
            let currentCardValue = bankObj[pos].shift();

            cards['bankCard' + pos].svgObject.push(
                getSVGCardBlockGlobal(
                    coordinates.you['bankCard' + pos].x,
                    coordinates.you['bankCard' + pos].y,
                    'bankCard' + pos,
                    faserObject,
                    false,
                    {entity: 'bankCard' + pos, cardValue: currentCardValue},
                    !bankObj[pos].length, // draggable last card only
                    getCardImgName(currentCardValue)
                )
            );
        }
    }
}

function getCardImgName(cardValue) {
    return 'card_' + (cardValue != SKIPBO ? cardValue : 'skipbo')
}

function checkHandCards(cardsObj) {
    /*
    let excludedCards = {};
    let handCardsCount = 0;

    for (let i = 1; i <= 5; i++) {
        let currentCard = cards['handCard' + i].svgObject;
        if (currentCard) {
            handCardsCount++;
            for (let k in cardsObj) {
                if (currentCard.cardValue === cardsObj[k] && !(i in excludedCards)) {
                    excludedCards[i] = currentCard.cardValue; // Карта проверена
                }
            }
        }
    }

    if (Object.keys(cardsObj).length === handCardsCount && handCardsCount === Object.keys(excludedCards).length) {
        // Все карты соответствуют - ничего не делаем
        return;
    }
    */

    for (let pos = 1; pos <= 5; pos++) {
        if (cards['handCard' + pos].svgObject) {
            cards['handCard' + pos].svgObject.setVisible(false).destroy();
            cards['handCard' + pos].svgObject = false;
        }

        if (pos in cardsObj && cardsObj[pos]) {
            cards['handCard' + pos].imgName = getCardImgName(cardsObj[pos]);
            cards['handCard' + pos].svgObject = getSVGCardBlockGlobal(
                cards['handCard' + pos].x,
                cards['handCard' + pos].y,
                'handCard' + pos,
                faserObject,
                false,
                {entity: 'handCard' + pos, cardValue: cardsObj[pos]},
                true
            );
        }
    }
}
