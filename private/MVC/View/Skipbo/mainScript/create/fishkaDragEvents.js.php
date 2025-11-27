//
<?php
use classes\GameStatusSkipbo;
use classes\TurnSkipbo;
?>

this.input.on('dragstart', function (pointer, gameObject) {
    dragBegin = {x: gameObject.x, y: gameObject.y};

    switchOnYouBankFrames(getAvailableBankPlaces(gameObject));
    switchOnCommonFrames(getAvailableCommonPlaces(gameObject.cardValue));

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
    if (isDragPointInCommonCardsArea(gameObject.x, gameObject.y)) {
        let position = choosePlaceInCommonCardsArea(gameObject.x, gameObject.y);
        if (getAvailableCommonPlaces(gameObject.cardValue).includes(position) && !turnSubmitObject.isProcessing) {
            // Prepare object for server approval
            turnSubmitObject.isProcessing = true;
            turnSubmitObject.gameObject = gameObject;
            turnSubmitObject.cardMoveParams.entity =
                gameObject.entity === '<?= GameStatusSkipbo::GOAL_CARD ?>'
                    ? gameObject.entity
                    : gameObject.entity.slice(0, -1); // returning entity without position number
            turnSubmitObject.cardMoveParams.entity_num =
                gameObject.entity === '<?= GameStatusSkipbo::GOAL_CARD ?>'
                    ? 0
                    : gameObject.entity.slice(-1); // returning entity position number
            turnSubmitObject.cardMoveParams.entity_value = gameObject.cardValue;
            turnSubmitObject.cardMoveParams.new_position = '<?= GameStatusSkipbo::COMMON_AREA ?>';
            turnSubmitObject.cardMoveParams.new_position_num = position;
            turnSubmitObject.oldX = dragBegin.x;
            turnSubmitObject.oldY = dragBegin.y;

            fetchGlobal(SUBMIT_SCRIPT, '<?= TurnSkipbo::TURN_DATA_PARAM ?>', turnSubmitObject.cardMoveParams)
                .then((data) => {
                commonCallback(data);
            });

            turnSubmitObject.isSentToServer = true;

            // moveCardToCommonArea(gameObject, position); // todo заменить на отправку запроса на сервер, а потом move
        } else {
            gameObject.x = dragBegin.x;
            gameObject.y = dragBegin.y;
        }
    } else if (isDragPointInYouBankArea(gameObject.x, gameObject.y)) {

        let position = choosePlaceInYouBankArea(gameObject.x, gameObject.y);
        if (getAvailableBankPlaces(gameObject).includes(position) && !turnSubmitObject.isProcessing) {
            moveCardToBank(gameObject, position); // todo заменить на отправку запроса на сервер, а потом move
        } else {
            gameObject.x = dragBegin.x;
            gameObject.y = dragBegin.y;
        }
    } else {
        gameObject.x = dragBegin.x;
        gameObject.y = dragBegin.y;
    }

    dragBegin = false;

    gameObject.depth = 1;

    switchOffFrames();
});


