//
function (time, delta) {

    let dateGetTime = (new Date()).getTime();
    if (isUserBlockActive && requestSended && (dateGetTime - requestTimestamp > normalRequestTimeout)) {
        noNetworkImg.visible = true;
        noNetworkImg.alpha = (dateGetTime - requestTimestamp) < (normalRequestTimeout * 2)
            ? (dateGetTime - requestTimestamp - normalRequestTimeout) / 1000
            : 1;
    } else {
        noNetworkImg.visible = false;
    }

    if (gameState == 'chooseGame' && (queryNumber > 0)) {
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
        if((isYandexAppGlobal() && uniqID) || !isYandexAppGlobal() || isYandexFakeGlobal()) {
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

    if (gameState == MY_TURN_STATE) {
        if ((vremiaMinutes === 0) && (vremiaSeconds <= 10) && buttons['submitButton']['svgObject'].input.enabled) {
            if ((flor % 2) === 0) {
                buttons['submitButton']['svgObject']
                    .bringToTop(buttons['submitButton']['svgObject']
                        .getByName('submitButton' + ALARM_MODE));
            } else {
                buttons['submitButton']['svgObject']
                    .bringToTop(buttons['submitButton']['svgObject']
                        .getByName('submitButton' + OTJAT_MODE));
            }
        }
    }

    if (gameState == MY_TURN_STATE || gameState == PRE_MY_TURN_STATE || gameState == OTHER_TURN_STATE) {
        let activeUserBlockName = (gameState == MY_TURN_STATE) ? 'youBlock' : ('player' + (+activeUser + 1) + 'Block');
        let timerContainer = players.timerBlock.svgObject;

        if ((flor % 2) === 0) {
            buttonSetModeGlobal(players, activeUserBlockName, ALARM_MODE);
            timerContainer.getByName(timerState.mode + '_' + 'dvoetoch').setVisible(true);
            blinkRightGlobal();
        } else {
            buttonSetModeGlobal(players, activeUserBlockName, OTJAT_MODE);
            timerContainer.getByName(timerState.mode + '_' + 'dvoetoch').setVisible(false);
            blinkLeftGlobal();
        }
    }

    if (gameState == 'gameResults') {
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