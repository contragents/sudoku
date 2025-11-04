//
function (time, delta) {

    let dateGetTime = (new Date()).getTime();
    if (
        isUserBlockActive
        && requestSended
        && !hiddenRequestSended
        && (dateGetTime - requestTimestamp > normalRequestTimeout)
        && pageActive !== 'hidden'
    ) {
        noNetworkImg.visible = true;
        noNetworkImg.alpha = (dateGetTime - requestTimestamp) < (normalRequestTimeout * 2)
            ? (dateGetTime - requestTimestamp - normalRequestTimeout) / 1000
            : 1;
    } else {
        noNetworkImg.visible = false;
    }
    // noNetworkImg.visible = false;
    if (gameState === CHOOSE_GAME_STATE && (queryNumber > 0)) {
        return;
    }

    let flor = Math.floor(time / 1000);

    if (
        (
            (flor > lastQueryTime)
            && ((flor % gameStates[gameState]['refresh']) === 0)
        )
        || (queryNumber === 0)
    ) {
        if ((isYandexAppGlobal() && uniqID) || !isYandexAppGlobal() || isYandexFakeGlobal()) {
            if (requestToServerEnabled) {
                lastQueryTime = flor;
                fetchGlobal(STATUS_CHECKER_SCRIPT)
                    .then((data) => {
                        commonCallback(data);
                    });
            }
        }
    }

    if ([MY_TURN_STATE, PRE_MY_TURN_STATE, OTHER_TURN_STATE, START_GAME_STATE].indexOf(gameState) >= 0) {
        if (flor > lastTimeCorrection) {
            lastTimeCorrection = flor;
            if ((vremiaMinutes > 0) || (vremiaSeconds > 0)) {
                vremiaSeconds--;
                if (vremiaSeconds < 0) {
                    vremiaMinutes--;
                    vremiaSeconds = 59;
                }

                displayTimeGlobal(+vremiaMinutes * 100 + +vremiaSeconds);
            }
        }
    }

    if (gameState === MY_TURN_STATE) {
        if ((vremiaMinutes === 0) && (vremiaSeconds <= 10) && buttons.submitButton.svgObject.input.enabled) {
            // todo SB-8 мигание кнопки Отпарвитть
            if ((flor % 2) === 0) {
            } else {
            }
        }
    }

    if ([MY_TURN_STATE, PRE_MY_TURN_STATE, OTHER_TURN_STATE].indexOf(gameState) >= 0) {
        let activeUserBlockName = (gameState === MY_TURN_STATE) ? 'youBlock' : ('player' + (+activeUser + 1) + 'Block');
        let timerContainer = players.timerBlock.svgObject;

        if ((flor % 2) === 0) {
            buttonSetModeGlobal(players, activeUserBlockName, ALARM_MODE);
            timerContainer.getByName(timerState.mode + '_' + 'dvoetoch').setVisible(true);
        } else {
            buttonSetModeGlobal(players, activeUserBlockName, OTJAT_MODE);
            timerContainer.getByName(timerState.mode + '_' + 'dvoetoch').setVisible(false);
        }
    }

    if (gameState === GAME_RESULTS_STATE) {
        if ((flor % 2) === 0) {
            buttons.newGameButton.svgObject
                .bringToTop(buttons.newGameButton.svgObject
                    .getByName('newGameButton' + ALARM_MODE));
        } else {
            buttons.newGameButton.svgObject
                .bringToTop(buttons.newGameButton.svgObject
                    .getByName('newGameButton' + OTJAT_MODE));
        }
    }
}