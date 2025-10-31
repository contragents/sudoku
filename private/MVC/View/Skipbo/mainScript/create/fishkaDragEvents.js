//
this.input.on('dragstart', function (pointer, gameObject) {
    dragBegin = {x: gameObject.x, y: gameObject.y};

    switchOnYouBankFrames();
    switchOnCommonFrames(getAvailablePlaces(gameObject.cardValue));

    console.log('dragging', gameObject.entity);
    if ('entity' in gameObject && gameObject.entity in cards) {
        parentObject = cards[gameObject.entity];
        if ('dragStartFunction' in parentObject) {
            parentObject.dragStartFunction();
        }
    }

    gameObject.depth = 100;
});

this.input.on('drag', function (pointer, gameObject, dragX, dragY) {
    gameObject.x = dragX;
    gameObject.y = dragY;
});

this.input.on('dragend', function (pointer, gameObject) {

    console.log('x', gameObject.x, 'y', gameObject.y);
    if (isDragPointInCommonCardsArea(gameObject.x, gameObject.y)) {
        let position = choosePlaceInCommonCardsArea(gameObject.x, gameObject.y);
        if(getAvailablePlaces(gameObject.cardValue).includes(position)) {
            moveCardToPosition(gameObject, coordinates['areaCommon' + position]);
        } else {
            gameObject.x = dragBegin.x;
            gameObject.y = dragBegin.y;
        }
    } else if(isDragPointInYouBankArea(gameObject.x, gameObject.y)) {
        let position = choosePlaceInYouBankArea(gameObject.x, gameObject.y);
        moveCardToPosition(gameObject, coordinates.you['bankCard' + position]);
    } else {
        gameObject.x = dragBegin.x;
        gameObject.y = dragBegin.y;
    }

    dragBegin = false;

    gameObject.depth = 1;

    switchOffFrames();
});

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

function switchOnYouBankFrames() {
    for (let i = 1; i <= 4; i++) {
        if (cards['activeFrameYouBank' + i].svgObject) {
            cards['activeFrameYouBank' + i].svgObject.visible = true;
            faserObject.children.bringToTop(cards['activeFrameYouBank' + i].svgObject);
        }
    }
}

function switchOnCommonFrames(frameNums = [1, 2, 3, 4]) {
    for (let i in frameNums) {
        if (cards['activeFrameCommon' + frameNums[i]].svgObject) {
            cards['activeFrameCommon' + frameNums[i]].svgObject.visible = true;
            faserObject.children.bringToTop(cards['activeFrameCommon' + frameNums[i]].svgObject);
        }
    }
}

function getAvailablePlaces(cardNum) {
    let res = [];

    for (let i = 1; i <= 4; i++) {
        let currentCard = cards['cardCommon' + i].svgObject;

        if (currentCard) {
            if (cardNum === SKIPBO && currentCard.cardValue !== SKIPBO) {
                res.push(i);
            } else if (cardNum === SKIPBO || (cardNum - currentCard.cardValue === 1)) {
                res.push(i);
            }
        } else if (cardNum === 1 || cardNum === SKIPBO) {
            res.push(i);
        }
    }

    return res;
}

function choosePlaceInCommonCardsArea(x, y) {
    let minQuad = 100000;
    let position = false;

    for (let i = 1; i <= 4; i++) {
        let quad = (x - coordinates['areaCommon' + i].x) ** 2 + (y - coordinates['areaCommon' + i].y) ** 2;
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
    if (x >= (coordinates.areaCommon1.x - cardWidth / 2) && x <= (coordinates.areaCommon4.x + cardWidth / 2)) {
        if (y >= (coordinates.areaCommon1.y - cardWidth / 2 * cardSideFactor) && y <= (coordinates.areaCommon1.y + cardWidth / 2 * cardSideFactor)) {
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

function moveCardToPosition(gameObject, coordinates = {x: 0, y: 0}) {
    gameObject.x = coordinates.x;
    gameObject.y = coordinates.y;
}
