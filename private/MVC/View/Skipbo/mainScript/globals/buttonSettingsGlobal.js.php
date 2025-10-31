<?php
use classes\T;
?>
//
var topLeftButtons = {
    newGameButton: {displayWidth: 0},
    instructButton: {displayWidth: 0},
    prizesButton: {displayWidth: 0},
    ...(!isYandexAppGlobal() && !isSteamGlobal() && {
        inviteButton: {displayWidth: 0}
    }),
};

var topRightButtons = {
    logButton: {displayWidth: 0},
    ...(!isYandexAppGlobal() && !isSteamGlobal() && {
        chatButton: {displayWidth: 0}
    }),
    playersButton: {displayWidth: 0},
};

var modes = [OTJAT_MODE, ALARM_MODE, 'Inactive', 'Navedenie', 'Najatie'];

var buttons = {
    newGameButton: {
        filename: 'new_game2' + ((lang !== 'EN' && lang in SUPPORTED_LANGS) ? ('_' + lang) : ''),
        modes: [OTJAT_MODE, INACTIVE_MODE, 'Navedenie', 'Najatie', ALARM_MODE],
        x: topXY.x + lotokX + buttonWidth / 2 - lotokCellStep / 2 + 5,
        y: (topXY.y + topHeight) / 2,
        caption: 'New#Game',
        width: buttonWidth,
        svgObject: false,
        pointerupFunction: function () {
            newGameButtonFunction();
        },
        enabled: {myTurn: 1, preMyTurn: 1, otherTurn: 1, gameResults: 1},
    },
    instructButton: {
        filename: 'instrukt2' + ((lang !== 'EN' && lang in SUPPORTED_LANGS) ? ('_' + lang) : ''),
        modes: [OTJAT_MODE, NAVEDENO_MODE, NAJATO_MODE],
        x: topXY.x + lotokX + buttonWidth / 2 - lotokCellStep / 2 + 5 + buttonWidth,
        y: (topXY.y + topHeight) / 2,
        caption: 'инструкция',
        width: buttonWidth / 2,
        svgObject: false,
        pointerupFunction: function () {
            if (bootBoxIsOpenedGlobal()) {
                return;
            }

            btnFAQClickHandler(false);
        }
    },
    prizesButton: {
        filename: 'prizes2',
        modes: [OTJAT_MODE, 'Navedenie', 'Najatie'],
        x: (topXY.x + knopkiLeftWidth) / 2,
        y: (topXY.y + topHeight) / 2,
        caption: 'Prizes',
        width: buttonWidth / 2,
        svgObject: false,
        pointerupFunction: prizesButtonHandler,
    },
    ...(!isYandexAppGlobal() && !isSteamGlobal() && {
        inviteButton: {
            filename: 'invite2',
            modes: [OTJAT_MODE, NAVEDENO_MODE, NAJATO_MODE],
            x: topXY.x + knopkiLeftWidth - buttonWidth,
            y: topXY.y + topHeight / 2,
            caption: 'Invite',
            width: buttonWidth / 2,
            svgObject: false,
            pointerupFunction: function () {
                {
                    if (bootBoxIsOpenedGlobal()) {
                        return;
                    }

                    if (!isTgBot()) {
                        buttons.inviteButton.svgObject.disableInteractive();
                        var copyLinkDialog = bootbox.alert(
                            {
                                className: 'modal-settings modal-profile text-white',
                                message: '<?= T::S('Your invitation link has been copied to clipboard') ?>',
                            }
                        );

                        setTimeout(
                            function () {
                                copyTextToClipboard(inviteLink());
                                copyLinkDialog.find(".bootbox-close-button").trigger("click");
                                buttons.inviteButton.svgObject.setInteractive();
                            }
                            , 2000
                        );
                    } else {
                        shareTgGlobal();
                    }

                    return false;
                }
            }
        },
    }),
    playersButton: {
        filename: 'igroki2',
        x: botXY.x + knopkiLeftWidth - buttonWidth / 2 - buttonStepX,
        y: (topXY.y + topHeight) / 2,
        caption: 'players',
        width: buttonWidth / 2,
        svgObject: false,
        pointerupFunction: function () {
            playersButtonFunction();
        }
    },
    ...(!isYandexAppGlobal() && !isSteamGlobal() && {
        chatButton: {
            filename: 'chat2',
            x: botXY.x + knopkiLeftWidth / 2,
            y: (topXY.y + topHeight) / 2,
            caption: 'chat',
            width: buttonWidth / 2,
            svgObject: false,
            pointerupFunction: function () {
                chatButtonFunction();
            },
        },
    }),
    logButton: {
        filename: 'log2' + ((lang !== 'EN' && lang in SUPPORTED_LANGS) ? ('_' + lang) : ''),
        modes: [OTJAT_MODE, 'Inactive', 'Navedenie', 'Najatie'],
        x: botXY.x + buttonStepX + buttonWidth / 2,
        y: (topXY.y + topHeight) / 2,
        caption: 'log',
        width: buttonWidth / 2,
        svgObject: false,
        pointerupFunction: function () {
            logButtonFunction();
        },
    },
};

var playerBlockModes = [OTJAT_MODE, ALARM_MODE];
var digitPositions = [3, 2, 1];

var digits = {
    playerDigits: {
        Otjat: {
            digit_0: {filename: 'numbers/player_digit_0'},
            digit_1: {filename: 'numbers/player_digit_1'},
            digit_2: {filename: 'numbers/player_digit_2'},
            digit_3: {filename: 'numbers/player_digit_3'},
            digit_4: {filename: 'numbers/player_digit_4'},
            digit_5: {filename: 'numbers/player_digit_5'},
            digit_6: {filename: 'numbers/player_digit_6'},
            digit_7: {filename: 'numbers/player_digit_7'},
            digit_8: {filename: 'numbers/player_digit_8'},
            digit_9: {filename: 'numbers/player_digit_9'}
        },
        Alarm: {
            digit_0: {filename: 'numbers/player_digit_0'},
            digit_1: {filename: 'numbers/player_digit_1'},
            digit_2: {filename: 'numbers/player_digit_2'},
            digit_3: {filename: 'numbers/player_digit_3'},
            digit_4: {filename: 'numbers/player_digit_4'},
            digit_5: {filename: 'numbers/player_digit_5'},
            digit_6: {filename: 'numbers/player_digit_6'},
            digit_7: {filename: 'numbers/player_digit_7'},
            digit_8: {filename: 'numbers/player_digit_8'},
            digit_9: {filename: 'numbers/player_digit_9'}
        },
    },
    timerDigits: {
        Otjat: {
            digit_0: {filename: 'numbers/timer_digit_0'},
            digit_1: {filename: 'numbers/timer_digit_1'},
            digit_2: {filename: 'numbers/timer_digit_2'},
            digit_3: {filename: 'numbers/timer_digit_3'},
            digit_4: {filename: 'numbers/timer_digit_4'},
            digit_5: {filename: 'numbers/timer_digit_5'},
            digit_6: {filename: 'numbers/timer_digit_6'},
            digit_7: {filename: 'numbers/timer_digit_7'},
            digit_8: {filename: 'numbers/timer_digit_8'},
            digit_9: {filename: 'numbers/timer_digit_9'}
        },
        Alarm: {
            digit_0: {filename: 'numbers/timer_digit_0'},
            digit_1: {filename: 'numbers/timer_digit_1'},
            digit_2: {filename: 'numbers/timer_digit_2'},
            digit_3: {filename: 'numbers/timer_digit_3'},
            digit_4: {filename: 'numbers/timer_digit_4'},
            digit_5: {filename: 'numbers/timer_digit_5'},
            digit_6: {filename: 'numbers/timer_digit_6'},
            digit_7: {filename: 'numbers/timer_digit_7'},
            digit_8: {filename: 'numbers/timer_digit_8'},
            digit_9: {filename: 'numbers/timer_digit_9'}
        },
    }
}
var modesColors = {
    Alarm: 'red',
    Otjat: 'yellow',
}

function handCardDragStart(handCardObject) {
    let container = cards[handCardObject].svgObject;
    console.log('dragstart: ', container.cardValue);
}

var cards = {
    cardCommon1: { // Общая открытая карта на столе №1
        imgName: false,
        x: card1CommonBlockXCenter,
        y: cardCommonBlockYCenter,
        width: cardWidth,
        svgObject: false,
        preload: false,
    },
    cardCommon2: {
        imgName: false,
        x: card1CommonBlockXCenter + cardStep + cardWidth,
        y: cardCommonBlockYCenter,
        width: cardWidth,
        svgObject: false,
        preload: false,
    },
    cardCommon3: {
        imgName: false,
        x: card1CommonBlockXCenter + 2 * (cardStep + cardWidth),
        y: cardCommonBlockYCenter,
        width: cardWidth,
        svgObject: false,
        preload: false,
    },
    cardCommon4: {
        imgName: false,
        x: card1CommonBlockXCenter + 3 * (cardStep + cardWidth),
        y: cardCommonBlockYCenter,
        width: cardWidth,
        svgObject: false,
        preload: false,
    },
    areaCommon1: {
        imgName: 'card_area',
        x: card1CommonBlockXCenter,
        y: cardCommonBlockYCenter,
        width: cardWidth,
        svgObject: false,
    },
    areaCommon2: {
        imgName: 'card_area',
        x: card1CommonBlockXCenter + cardStep + cardWidth,
        y: cardCommonBlockYCenter,
        width: cardWidth,
        svgObject: false,
    },
    areaCommon3: {
        imgName: 'card_area',
        x: card1CommonBlockXCenter + 2 * (cardStep + cardWidth),
        y: cardCommonBlockYCenter,
        width: cardWidth,
        svgObject: false,
    },
    areaCommon4: {
        imgName: 'card_area',
        x: card1CommonBlockXCenter + 3 * (cardStep + cardWidth),
        y: cardCommonBlockYCenter,
        width: cardWidth,
        svgObject: false,
    },
    kolodaCard1: {
        imgName: 'card_back',
        x: card1CommonBlockXCenter - 5 * cardStep - cardWidth,
        y: cardCommonBlockYCenter - cardStep,
        width: cardWidth,
        svgObject: false,
    },
    kolodaCard2: {
        imgName: 'card_back',
        x: card1CommonBlockXCenter - 5 * cardStep - cardWidth,
        y: cardCommonBlockYCenter - 2 * cardStep,
        width: cardWidth,
        svgObject: false,
    },
    kolodaCard3: {
        imgName: 'card_back',
        x: card1CommonBlockXCenter - 5 * cardStep - cardWidth,
        y: cardCommonBlockYCenter - 3 * cardStep,
        width: cardWidth,
        svgObject: false,
    },
    goalCard: {
        imgName: 'card_10',
        x: card1CommonBlockXCenter + 3 * (cardStep + cardWidth) + 5 * cardStep + cardWidth,
        y: cardCommonBlockYCenter - cardStep,
        width: cardWidth,
        svgObject: false,
    },
    playerCenterBackplate: {
        imgName: 'back_player',
        x: centerPlayerBackplateCenterX,
        y: centerPlayerBackplateCenterY,
        width: playerBackplateWidth,
        svgObject: false,
    },
    playerLeftBackplate: {
        imgName: 'back_player',
        x: centerPlayerBackplateCenterX - 4 * cardStep - playerBackplateWidth,
        y: centerPlayerBackplateCenterY,
        width: playerBackplateWidth,
        svgObject: false,
    },
    playerRightBackplate: {
        imgName: 'back_player',
        x: centerPlayerBackplateCenterX + 4 * cardStep + playerBackplateWidth,
        y: centerPlayerBackplateCenterY,
        width: playerBackplateWidth,
        svgObject: false,
    },
    handCard1: {
        imgName: 'card_1',
        x: handCard1CenterX,
        y: handCardCenterY,
        width: cardWidth,
        svgObject: false,
        dragStartFunction: () => handCardDragStart('handCard1'),
        props: {entity: 'handCard1', cardValue: 1},
    },
    handCard2: {
        imgName: 'card_skipbo_2',
        x: handCard1CenterX + cardStep + cardWidth,
        y: handCardCenterY,
        width: cardWidth,
        svgObject: false,
        dragStartFunction: () => handCardDragStart('handCard2'),
        props: {entity: 'handCard2', cardValue: SKIPBO + 2},
    },
    handCard3: {
        imgName: 'card_5',
        x: handCard1CenterX + 2 * (cardStep + cardWidth),
        y: handCardCenterY,
        width: cardWidth,
        svgObject: false,
        dragStartFunction: () => handCardDragStart('handCard3'),
        props: {entity: 'handCard3', cardValue: 5},
    },
    handCard4: {
        imgName: 'card_skipbo',
        x: handCard1CenterX + 3 * (cardStep + cardWidth),
        y: handCardCenterY,
        width: cardWidth,
        svgObject: false,
        dragStartFunction: () => handCardDragStart('handCard4'),
        props: {entity: 'handCard4', cardValue: SKIPBO},
    },
    handCard5: {
        imgName: 'card_12',
        x: handCard1CenterX + 4 * (cardStep + cardWidth),
        y: handCardCenterY,
        width: cardWidth,
        svgObject: false,
        dragStartFunction: () => handCardDragStart('handCard5'),
        props: {entity: 'handCard5', cardValue: 12},
    },
    bankCard4: {
        imgName: 'card_area',
        x: bankCard4CenterX,
        y: bankCardCenterY,
        width: cardWidth,
        svgObject: false,
    },
    bankCard3: {
        imgName: 'card_area',
        x: bankCard4CenterX - (cardStep + cardWidth),
        y: bankCardCenterY,
        width: cardWidth,
        svgObject: false,
    },
    bankCard2: {
        imgName: 'card_area',
        x: bankCard4CenterX - 2 * (cardStep + cardWidth),
        y: bankCardCenterY,
        width: cardWidth,
        svgObject: false,
    },
    bankCard1: {
        imgName: 'card_area',
        x: bankCard4CenterX - 3 * (cardStep + cardWidth),
        y: bankCardCenterY,
        width: cardWidth,
        svgObject: false,
    },
    activeFrameCommon1: {
        imgName: 'frame_card',
        x: card1CommonBlockXCenter,
        y: cardCommonBlockYCenter,
        width: cardWidth,
        svgObject: false,
    },
    activeFrameCommon2: {
        imgName: 'frame_card',
        x: card1CommonBlockXCenter + cardStep + cardWidth,
        y: cardCommonBlockYCenter,
        width: cardWidth,
        svgObject: false,
    },
    activeFrameCommon3: {
        imgName: 'frame_card',
        x: card1CommonBlockXCenter + 2 * (cardStep + cardWidth),
        y: cardCommonBlockYCenter,
        width: cardWidth,
        svgObject: false,
    },
    activeFrameCommon4: {
        imgName: 'frame_card',
        x: card1CommonBlockXCenter + 3 * (cardStep + cardWidth),
        y: cardCommonBlockYCenter,
        width: cardWidth,
        svgObject: false,
    },
    activeFrameYouBank1: {
        imgName: 'frame_card',
        x: 1,
        y: 1,
        width: cardWidth,
        svgObject: false,
        preload: false,
    },
    activeFrameYouBank2: {
        imgName: 'frame_card',
        x: 1,
        y: 1,
        width: cardWidth,
        svgObject: false,
        preload: false,
    },
    activeFrameYouBank3: {
        imgName: 'frame_card',
        x: 1,
        y: 1,
        width: cardWidth,
        svgObject: false,
        preload: false,
    },
    activeFrameYouBank4: {
        imgName: 'frame_card',
        x: 1,
        y: 1,
        width: cardWidth,
        svgObject: false,
        preload: false,
    },
}

var avatars = {

}

var entities = {
    avatarYou: {
        preloaded: false, // загружать каждый раз с сервера
        filename: 'https://sudoku.box/img/sudoku-coin.png',
        x: gameWidth / 2,
        y: handCardCenterY,
        width: cardWidth * 2,
        height: cardWidth * 2,
        svgObject: false,
        preload: false, // Не обрабатывать массово
    },
    avatarPlayer1: {
        preloaded: false, // загружать каждый раз с сервера
        filename: ANONYM_AVATAR_URL,
        x: 1,
        y: 1,
        width: mediumCardWidth * 1.7,
        height: mediumCardWidth * 1.7,
        svgObject: false,
        preload: false, // Не обрабатывать массово
    },
    avatarPlayer2: {
        preloaded: false, // загружать каждый раз с сервера
        filename: ANONYM_AVATAR_URL,
        x: 1,
        y: 1,
        width: mediumCardWidth * 1.7,
        height: mediumCardWidth * 1.7,
        svgObject: false,
        preload: false, // Не обрабатывать массово
    },
    avatarPlayer3: {
        preloaded: false, // загружать каждый раз с сервера
        filename: ANONYM_AVATAR_URL,
        x: 1,
        y: 1,
        width: mediumCardWidth * 1.7,
        height: mediumCardWidth * 1.7,
        svgObject: false,
        preload: false, // Не обрабатывать массово
    },
    avatarPlayer4: {
        preloaded: false, // загружать каждый раз с сервера
        filename: ANONYM_AVATAR_URL,
        x: 1,
        y: 1,
        width: mediumCardWidth * 1.7,
        height: mediumCardWidth * 1.7,
        svgObject: false,
        preload: false, // Не обрабатывать массово
    },
    cardCounter: {
        preloaded: false, // загружать каждый раз с сервера
        filename: CARD_COUNTER_SVG,
        x: 1,
        y: 1,
        width: mediumCardWidth,
        svgObject: false, // массив счетчиков, удалять через pop().destroy();
        preload: false, // Не обрабатывать массово
    },
    handCard: {
        preloaded: true, // изображения загружены
        filename: 'card_back',
        x: 1,
        y: 1,
        width: smallCardWidth,
        svgObject: false, // массив карточек, удалять через pop().destroy();
        preload: false, // Не обрабатывать массово
    },
    goalCard: {
        preloaded: true, // изображения загружены
        filename: 'card_10',
        x: 1,
        y: 1,
        width: mediumCardWidth,
        svgObject: false, // массив карточек, удалять через pop().destroy();
        preload: false, // Не обрабатывать массово
    },
    bankCard: {
        preloaded: true, // изображение загружено
        filename: 'card_area',
        x: 1,
        y: 1,
        width: mediumCardWidth,
        svgObject: false, // массив карточек, удалять через pop().destroy();
        preload: false, // Не обрабатывать массово
    },
    nicknameBlock: {
        preloaded: false, // загружать каждый раз с сервера
        filename: NICKNAME_SVG,
        x: 1,
        y: 1,
        width: buttonWidth,
        svgObject: false, // массив никнеймов, удалять через pop().destroy();
        preload: false, // Не обрабатывать массово
    },
}

var players = {
    youBlock: {
        filename: 'you' + ((lang !== 'EN' && lang in SUPPORTED_LANGS) ? ('_' + lang) : ''),
        x: youBlockXCenter,
        y: youBlockYCenter + buttonHeight / 2,
        width: buttonWidth,
        svgObject: false,
        numbers: true,
    },
    player1Block: {
        filename: 'player1' + ((lang !== 'EN' && lang in SUPPORTED_LANGS) ? ('_' + lang) : ''),
        x: botXY.x + buttonStepX + buttonWidth / 2,
        y: botXY.y + botHeight * 0.75 * 0.1,
        width: buttonWidth,
        svgObject: false,
        numbers: true,
    },
    player2Block: {
        filename: 'player2' + ((lang !== 'EN' && lang in SUPPORTED_LANGS) ? ('_' + lang) : ''),
        x: botXY.x + buttonStepX + buttonWidth / 2,
        y: botXY.y + botHeight * 0.75 * (0.2 + 0.1),
        width: buttonWidth,
        svgObject: false,
        numbers: true,
    },
    player3Block: {
        filename: 'player3' + ((lang !== 'EN' && lang in SUPPORTED_LANGS) ? ('_' + lang) : ''),
        x: botXY.x + buttonStepX + buttonWidth / 2,
        y: botXY.y + botHeight * 0.75 * (0.2 + 0.1),
        width: buttonWidth,
        svgObject: false,
        numbers: true,
    },
    player4Block: {
        filename: 'player4' + ((lang !== 'EN' && lang in SUPPORTED_LANGS) ? ('_' + lang) : ''),
        x: botXY.x + buttonStepX + buttonWidth / 2,
        y: botXY.y + botHeight * 0.75 * (0.2 + 0.1),
        width: buttonWidth,
        svgObject: false,
        numbers: true,
    },
    goalBlock: {
        modes: [OTJAT_MODE],
        filename: 'goal_30',
        x: bankGoalBlockXCenter,
        y: bankGoalBlockYCenter + buttonHeight / 3,
        width: buttonWidth,
        svgObject: false, // array of 1 object - needs to properly destroy
        preload: true, // todo SB-3 need to be false - lazy loading
    },
    bankBlock: {
        modes: [OTJAT_MODE],
        filename: 'bank_500_RU',
        x: bankGoalBlockXCenter,
        y: bankGoalBlockYCenter - buttonHeight / 3,
        width: buttonWidth,
        svgObject: false, // array of 1 object - needs to properly destroy
        preload: true, // todo SB-3 need to be false - lazy loading
    },
    timerBlock: {
        filename: 'timer',
        x: timerXCenter,
        y: timerYCenter,
        width: buttonWidth * 1.5,
        height: buttonHeight * 1.5,
        svgObject: false,
        scalable: false,
        numbers: true,
        numbersX1: () => 0 - timerDigitStep() / 2 - dvoetochWidth() - timerDigitStep() - timerDigitWidth() / 2,
        dvoetochX: () => 0 - timerDigitStep() / 2 - dvoetochWidth() / 2,
        numbersX2: () => 0 + timerDigitStep() / 2 + timerDigitWidth() / 2,
        numbersX3: () => 0 + timerDigitStep() / 2 + timerDigitWidth() + timerDigitStep() + timerDigitWidth() / 2,
        numbersY: () => players.timerBlock.height / 5,
    },
};

function displayScoreGlobal(score, blockName, isActive = false) {
    let mode = isActive ? ALARM_MODE : OTJAT_MODE;

    let container = players[blockName].svgObject;

    let thirdDigit = score % 10;

    let secondDigit = ((score - thirdDigit) % 100) / 10;
    let firstDigit = (score - secondDigit * 10 - thirdDigit) / 100;

    if (thirdDigit !== playerScores[blockName].digit3 || mode !== playerScores[blockName].mode) {
        container.getByName(playerScores[blockName].mode + '_' + playerScores[blockName].digit3 + '_' + '3').setVisible(false);
    }

    if (secondDigit !== playerScores[blockName].digit2 || mode !== playerScores[blockName].mode) {
        container.getByName(playerScores[blockName].mode + '_' + playerScores[blockName].digit2 + '_' + '2').setVisible(false);
    }

    if (firstDigit !== playerScores[blockName].digit1 || mode !== playerScores[blockName].mode) {
        container.getByName(playerScores[blockName].mode + '_' + playerScores[blockName].digit1 + '_' + '1').setVisible(false);
    }

    playerScores[blockName].mode = mode;
    playerScores[blockName].digit3 = thirdDigit;
    playerScores[blockName].digit2 = secondDigit;
    playerScores[blockName].digit1 = firstDigit;


    container.getByName(mode + '_' + thirdDigit + '_3').setVisible(true);

    if (secondDigit > 0 || firstDigit > 0) {
        container.getByName(mode + '_' + secondDigit + '_2').setVisible(true);
    }

    if (firstDigit > 0) {
        container.getByName(mode + '_' + firstDigit + '_1').setVisible(true);
    }
}

function displayTimeGlobal(time, forceShowAll = false) {
    let mode = (time < 20) ? ALARM_MODE : OTJAT_MODE;
    let disabledMode = (!(time < 20)) ? ALARM_MODE : OTJAT_MODE;

    let container = players.timerBlock.svgObject;

    let thirdDigit = time % 10;

    let secondDigit = ((time - thirdDigit) % 100) / 10;
    let firstDigit = (time - secondDigit * 10 - thirdDigit) / 100;

    if (!container.getByName(mode + '_' + 'dvoetoch').visible) {
        container.getByName(mode + '_' + 'dvoetoch').setVisible(true);
    }

    if (container.getByName(disabledMode + '_' + 'dvoetoch').visible) {
        container.getByName(disabledMode + '_' + 'dvoetoch').setVisible(false);
    }

    if (thirdDigit !== timerState.digit3 || mode !== timerState.mode || forceShowAll) {
        container.getByName(timerState.mode + '_' + timerState.digit3 + '_' + '3').setVisible(false);
        container.getByName(mode + '_' + thirdDigit + '_3').setVisible(true);
    }

    if (secondDigit !== timerState.digit2 || mode !== timerState.mode || forceShowAll) {
        container.getByName(timerState.mode + '_' + timerState.digit2 + '_' + '2').setVisible(false);
        container.getByName(mode + '_' + secondDigit + '_2').setVisible(true);
    }

    if (firstDigit !== timerState.digit1 || mode !== timerState.mode || forceShowAll) {
        container.getByName(timerState.mode + '_' + timerState.digit1 + '_' + '1').setVisible(false);
        container.getByName(mode + '_' + firstDigit + '_1').setVisible(true);
    }

    timerState.mode = mode;
    timerState.digit3 = thirdDigit;
    timerState.digit2 = secondDigit;
    timerState.digit1 = firstDigit;
}

function buttonSetModeGlobal(objectSet, objectName, mode) {
    let svgObject = objectSet[objectName].svgObject;
    svgObject.bringToTop(svgObject.getByName(objectName + mode));

    if (mode === ALARM_MODE) {
        svgObject.getByName(objectName + ALARM_MODE).setVisible(true);
        svgObject.getByName(objectName + OTJAT_MODE).setVisible(false);
    } else {
        svgObject.getByName(objectName + ALARM_MODE).setVisible(false);
        svgObject.getByName(objectName + OTJAT_MODE).setVisible(true);
    }
}

function initScoresGlobal() {
    for (let blockName in playerScores) {
        let container = players[blockName].svgObject;

        for (let number = 0; number <= 9; number++) {
            for (let mode in playerBlockModes) {
                for (let digitPos = 1; digitPos <= 3; digitPos++) {
                    container.getByName(playerBlockModes[mode] + '_' + number + '_' + digitPos).setVisible(false);
                }
            }
        }
    }
}
