//
function moveCardToCommonArea(gameObject, position) {
    let cardObject = gameObject.entity;
    let nextCardValue =
        (cards['commonCard' + position].svgObject && 'cardValue' in cards['commonCard' + position].svgObject)
            ? (cards['commonCard' + position].svgObject.cardValue % SKIPBO) + 1
            : 1;
    nextCardValue += (gameObject.cardValue === SKIPBO ? SKIPBO : 0); // Признак SKIPBO

    if (isBankCard(gameObject)) {
        cards[cardObject].svgObject.pop();
    } else if (isHandCard(gameObject)) {
        cards[cardObject].svgObject = false;
    } else if (isGoalCard(gameObject)) {
        cards.goalCard.svgObject = false;
    }

    gameObject.entity = 'commonCard' + position;
    if (cards['commonCard' + position].svgObject) {
        cards['commonCard' + position].svgObject.setVisible(false).destroy();
        cards['commonCard' + position].svgObject = false;
    }

    if (nextCardValue < 12 || (nextCardValue > SKIPBO && nextCardValue < (SKIPBO + 12))) {

        // Need to replace card image if it was SKIPBO
        if(gameObject.cardValue === SKIPBO) {
            let gameObjectNew = getSVGCardBlockGlobal(
                gameObject.x,
                gameObject.y,
                cardObject,
                faserObject,
                false,
                {entity: cardObject, cardValue: nextCardValue},
                false, // Not draggable
                getCardImgName(nextCardValue)
            );

            gameObject.disableInteractive().setVisible(false).destroy();
            gameObject = gameObjectNew;
        }

        cards['commonCard' + position].svgObject = gameObject;
        cards['commonCard' + position].svgObject.cardValue = nextCardValue;
        moveCardToPosition(gameObject, coordinates['commonArea' + position]);
        gameObject.disableInteractive();
    } else {
        gameObject.visible = false;
        gameObject.disableInteractive().setVisible(false).destroy();
    }
}

function moveCardToBank(gameObject, position) {
    let handCardObject = gameObject.entity;
    gameObject.entity = 'bankCard' + position;

    moveCardToPosition(gameObject, coordinates.you['bankCard' + position]);

    cards['bankCard' + position].svgObject.push(gameObject);
    // todo перерисовать bankCard position

    cards[handCardObject].svgObject = false;
}

function switchOffFrames() {
    for (let i = 1; i <= 4; i++) {
        if (cards['activeFrameCommon' + i].svgObject) {
            cards['activeFrameCommon' + i].svgObject.visible = false;
        }
        if (cards['activeFrameYouBank' + i].svgObject) {
            cards['activeFrameYouBank' + i].svgObject.visible = false;
        }
    }
}

function switchOnYouBankFrames(frameNums = [1, 2, 3, 4]) {
    for (let i in frameNums) {
        if (cards['activeFrameYouBank' + frameNums[i]].svgObject) {
            cards['activeFrameYouBank' + frameNums[i]].svgObject.visible = true;
            faserObject.children.bringToTop(cards['activeFrameYouBank' + frameNums[i]].svgObject);
            cards['activeFrameYouBank' + frameNums[i]].svgObject.depth = 100;
        }
    }
}

function switchOnCommonFrames(frameNums = [1, 2, 3, 4]) {
    for (let i in frameNums) {
        if (cards['activeFrameCommon' + frameNums[i]].svgObject) {
            cards['activeFrameCommon' + frameNums[i]].svgObject.visible = true;
            faserObject.children.bringToTop(cards['activeFrameCommon' + frameNums[i]].svgObject);
            cards['activeFrameCommon' + frameNums[i]].svgObject.depth = 100;
        }
    }
}

function getAvailableBankPlaces(gameObject) {
    let res = [];

    if (isHandCard(gameObject)) {
        res = [1, 2, 3, 4];
    }

    return res;
}

function getAvailableCommonPlaces(cardNum) {
    let res = [];

    for (let i = 1; i <= 4; i++) {
        let currentCard = cards['commonCard' + i].svgObject;
        console.log(currentCard);
        // Учитываем SKIPBO + номер карты для карты в commonArea
        if (currentCard) {
            if (cardNum === SKIPBO && currentCard.cardValue < SKIPBO) {
                res.push(i);
            } else if (cardNum - (currentCard.cardValue % SKIPBO) === 1) {
                res.push(i);
            }
        } else if (cardNum === 1 || cardNum === SKIPBO) {
            res.push(i);
        }
    }
    console.log(res, cardNum);
    return res;
}

function choosePlaceInCommonCardsArea(x, y) {
    let minQuad = 100000;
    let position = false;

    for (let i = 1; i <= 4; i++) {
        let quad = (x - coordinates['commonArea' + i].x) ** 2 + (y - coordinates['commonArea' + i].y) ** 2;
        if (quad < minQuad) {
            minQuad = quad;
            position = i;
        }
    }

    return position;
}

function choosePlaceInYouBankArea(x, y) {
    let minQuad = 100000;
    let position = false;

    for (let i = 1; i <= 4; i++) {
        let quad = (x - coordinates.you['bankCard' + i].x) ** 2 + (y - coordinates.you['bankCard' + i].y) ** 2;
        if (quad < minQuad) {
            minQuad = quad;
            position = i;
        }
    }

    return position;
}

function isDragPointInCommonCardsArea(x, y) {
    if (x >= (coordinates.commonArea1.x - cardWidth / 2) && x <= (coordinates.commonArea4.x + cardWidth / 2)) {
        if (y >= (coordinates.commonArea1.y - cardWidth / 2 * cardSideFactor) && y <= (coordinates.commonArea1.y + cardWidth / 2 * cardSideFactor)) {
            return true
        }
    }

    return false;
}

function isDragPointInYouBankArea(x, y) {
    if (x >= (coordinates.you.bankCard1.x - cardWidth / 2) && x <= (coordinates.you.bankCard4.x + cardWidth / 2)) {
        if (y >= (coordinates.you.bankCard1.y - cardWidth / 2 * cardSideFactor) && y <= (coordinates.you.bankCard1.y + cardWidth / 2 * cardSideFactor)) {
            return true
        }
    }

    return false;
}

function isGoalCard(gameObject) {
    return gameObject.entity.indexOf('goalCard') === 0;
}

function isBankCard(gameObject) {
    return gameObject.entity.indexOf('bankCard') === 0;
}

function isHandCard(gameObject) {
    return gameObject.entity.indexOf('handCard') === 0;
}

function moveCardToPosition(gameObject, coordinates = {x: 0, y: 0}) {
    gameObject.x = coordinates.x;
    gameObject.y = coordinates.y;
}
