//
function findPlaceGlobal(gameObject, oldX, oldY, cellX, cellY) {
    console.log(oldX, oldY, cellX, cellY, cells);

    let n = 9;

    cellX = correctCellNumber(n, cellX);
    cellY = correctCellNumber(n, cellY);

    if (!(cells[cellX][cellY][0] === false && oldX === 1 && oldY === 1)) {
        mk = false;

        minQuad = 100000;
        for (var i = 0; i < n; i++) {
            for (var j = 0; j < n; j++) {
                k = containerFishkaPresent(i, j);

                newQuad = (((i + 1) * yacheikaWidth + stepX + correctionX - oldX) ** 2 + ((j + 1) * yacheikaWidth + stepY + correctionY - oldY) ** 2);

                if (cells[i][j][0] !== false && (k !== false) && newQuad < minQuad) {
                    mk = k;
                    cellX = i;
                    cellY = j;
                    minQuad = newQuad;
                } else if (cells[i][j][0] === false && newQuad < minQuad) {
                    cellX = i;
                    cellY = j;
                    minQuad = newQuad;
                }
            }
        }
    }

    if (cells[cellX][cellY][0] !== false) {
        if ((mk !== false) && (container[mk].getData('cellX') === cellX) && (container[mk].getData('cellY') === cellY)) {
            if (gameObject.getData('oldCellX') !== false) {
                findPlaceGlobal(container[mk], 1, 1, gameObject.getData('oldCellX'), gameObject.getData('oldCellY'));
            } else {
                let slotXY = lotokFindSlotXY();
                container[mk].setData('cellX', false);
                container[mk].setData('cellY', false);
                container[mk].setData('lotokX', slotXY[0]);
                container[mk].setData('lotokY', slotXY[1]);
                container[mk].x = lotokGetX(slotXY[0], slotXY[1]);
                container[mk].y = lotokGetY(slotXY[0], slotXY[1]);
            }
        }
    }

    placeGlobal(gameObject, cellX, cellY);
    cells[cellX][cellY][0] = true;
    cells[cellX][cellY][1] = gameObject.getData('letter');
}

function placeErrorSudokuGlobal(gameObject, cellX, cellY, errorNumber) {
    let objectRow = errorNumber <= 3
        ? 3
        : (errorNumber <= 6
                ? 2
                : 1
        );
    let objectCol = sudokuSet1Column.has(errorNumber)
        ? 1
        : (sudokuSet2Column.has(errorNumber)
            ? 2
            : 3);

    gameObject.x = stepX + (cellX + 1) * yacheikaWidth + correctionX;
    gameObject.y = stepY + (cellY + 1) * yacheikaWidth + correctionY;

    gameObject.displayWidth = gameObject.displayWidth / 1.3;
    gameObject.displayHeight = gameObject.displayHeight / 1.3;

    gameObject.x += (objectCol - 2) * yacheikaWidth / 3;
    gameObject.y += (objectRow - 2) * yacheikaWidth / 3 + (sudoku1RowCorrectionLower.has(cellY) && errorNumber >= 7 ? 2 : 0);

    gameObject.setData('cellX', cellX);
    gameObject.setData('cellY', cellY);
    gameObject.setData('errorNumber', errorNumber);
}

function placeGlobal(gameObject, cellX, cellY) {
    gameObject.x = stepX + (cellX + 1) * yacheikaWidth + correctionX;
    gameObject.y = stepY + (cellY + 1) * yacheikaWidth + correctionY;
    gameObject.setData('cellX', cellX);
    gameObject.setData('cellY', cellY);
}

function containerFishkaPresent(i, j) {
    for (let k in container)
        if ((container[k].getData('cellX') === i) && (container[k].getData('cellY') === j))
            return k;

    return false;
}

function canSubmitTurn() {
    if(gameState !== MY_TURN_STATE) {
        return false;
    }

    let numFieldFishki = 0;
    for (let k in container) {
        if ((container[k].getData('cellX') !== false)) {
            numFieldFishki++;
        }
    }

    return numFieldFishki === 1;
}

function setSubmitButtonState() {
    if(canSubmitTurn()) {
        buttons.submitButton.setEnabled();
    } else {
        buttons.submitButton.setDisabled();
    }
}


function correctCellNumber(n, cellNumber) {
    if (cellNumber < 0) {
        cellNumber = 0;
    }

    if (cellNumber > (n - 1)) {
        cellNumber = n - 1;
    }

    return cellNumber
}

