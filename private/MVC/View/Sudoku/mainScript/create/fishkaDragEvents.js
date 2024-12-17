
this.input.on('dragstart', function (pointer, gameObject) {
    gameObject.depth = 100;
    let cellX = Math.round((gameObject.x - stepX - correctionX) / yacheikaWidth) - 1;
    let cellY = Math.round((gameObject.y - stepY - correctionY) / yacheikaWidth) - 1;
    if ((cellX <= 8) && (cellX >= 0) && (cellY <= 8) && (cellY >= 0)) {
        cells[cellX][cellY][0] = false;
        cells[cellX][cellY][1] = false;
        cells[cellX][cellY][2] = false;

        gameObject.setData('cellX', false);
        gameObject.setData('cellY', false);

        gameObject.setData('oldCellX', cellX);
        gameObject.setData('oldCellY', cellY);
    } else {
        gameObject.setData('oldCellX', false);
        gameObject.setData('oldCellY', false);
    }

    if ((gameObject.getData('lotokX') !== false) && (gameObject.getData('lotokY') !== false)) {
        gameObject.setData('oldLotokX', gameObject.getData('lotokX'));
        gameObject.setData('oldLotokY', gameObject.getData('lotokY'));

        lotokFreeXY(gameObject.getData('lotokX'), gameObject.getData('lotokY'));

        gameObject.setData('lotokX', false);
        gameObject.setData('lotokY', false);
    } else {
        gameObject.setData('oldLotokX', false);
        gameObject.setData('oldLotokY', false);
    }
});

this.input.on('drag', function (pointer, gameObject, dragX, dragY) {
    gameObject.x = dragX;
    gameObject.y = dragY;
});

this.input.on('dragend', function (pointer, gameObject) {
    if (gameObject.x > stepX && gameObject.y < (ground.height + stepY)) {
        let cellX = Math.round((gameObject.x - stepX - correctionX) / yacheikaWidth) - 1;
        if (cellX < 0) {
            cellX = 0;
        }
        if (cellX > 8) {
            cellX = 8
        }

        let cellY = Math.round((gameObject.y - stepY - correctionY) / yacheikaWidth) - 1;
        if (cellY < 0) {
            cellY = 0;
        }
        if (cellY > 8) {
            cellY = 8
        }

        console.log('x', gameObject.x, 'y', gameObject.y, 'cellX', cellX, 'cellY', cellY);
        findPlaceGlobal(gameObject, gameObject.x, gameObject.y, cellX, cellY);
    } else {
        console.log('x', gameObject.x, 'y', gameObject.y, 'stepX', stepX, 'stepY', stepY);
    }

    gameObject.depth = 1;

    setSubmitButtonState();
    setCheckButtonState();
});