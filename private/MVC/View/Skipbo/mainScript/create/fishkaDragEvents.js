//
this.input.on('dragstart', function (pointer, gameObject) {
    dragBegin = {x: gameObject.x, y: gameObject.y};

    console.log('dragging', gameObject.entity);
    if('entity' in gameObject && gameObject.entity in cards) {
        parentObject = cards[gameObject.entity];
        if('dragStartFunction' in parentObject) {
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

    console.log('x', gameObject.x, 'y', gameObject.y,);
    gameObject.x = dragBegin.x;
    gameObject.y = dragBegin.y;

    dragBegin = false;

    gameObject.depth = 1;
});