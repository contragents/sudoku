//
function parseDeskGlobal(newDesc) {
    resetButtonFunction(true);

    newCells = newDesc;
    for (let i = 0; i <= 8; i++) {
        for (let j = 0; j <= 8; j++) {
            cells[i][j][0] = newCells[i][j] !== false;
            cells[i][j][1] = newCells[i][j] !== false ? newCells[i][j] : false;
            cells[i][j][2] = false;
        }
    }

    while (cellsToBlink.length) {
        cellsToBlink.pop();
    }

    while (fixedContainer.length) {
        fixedContainer.pop().destroy();
    }

    for (let i = 0; i <= 8; i++) {
        for (let j = 0; j <= 8; j++) {
            if (cells[i][j][0] !== false) {
                let fixFishka = getFishkaGlobal(cells[i][j][1], 1, 1, this.game.scene.scenes[gameScene], false).disableInteractive();
                placeGlobal(fixFishka, i, j);
                fixFishka.setData('cellX', i);
                fixFishka.setData('cellY', j);
                fixedContainer.push(fixFishka);

                if (true/*!(blinkCellsCounter > 0)*/) {
                    if (!dontBlink && !(i in prevCellsOpened && j in prevCellsOpened[i])) {
                        cellsToBlink.push(fixFishka);
                    }

                    if (!(i in prevCellsOpened)) {
                        prevCellsOpened[i] = {};
                    }

                    prevCellsOpened[i][j] = true;
                }
            }
        }
    }

    dontBlink = false;
    blinkCellsCounter = BLINK_COUNT;
}

function processMistakesSudokuGlobal(mistakes) {
    while (errorsToBlink.length) {
        errorsToBlink.pop();
    }

    while (sudokuMistakesContainer.length) {
        sudokuMistakesContainer.pop().destroy();
    }

    for (let i = 0; i <= 8; i++) {
        for (let j = 0; j <= 8; j++) {
            for (let number = 1; number <= 9; number++) {
                if (i in mistakes && j in mistakes[i] && number in mistakes[i][j] && cells[i][j][0] === false) {
                    let errorNumberGameObject = getFishkaGlobal(number, 1, 1, this.game.scene.scenes[gameScene], false, 'red').disableInteractive();
                    placeErrorSudokuGlobal(errorNumberGameObject, i, j, number);
                    sudokuMistakesContainer.push(errorNumberGameObject);

                    if (true /*!(blinkErrorsCounter > 0)*/) {
                        if (!(i in prevErrors && j in prevErrors[i] && number in prevErrors[i][j])) {
                            errorsToBlink.push(errorNumberGameObject);
                        }

                        if (!(i in prevErrors)) {
                            prevErrors[i] = {};
                        }
                        if (!(j in prevErrors[i])) {
                            prevErrors[i][j] = {};
                        }
                        prevErrors[i][j][number] = number;
                    }
                }
            }
        }
    }

    blinkErrorsCounter = BLINK_COUNT;
}

function blinkRightGlobal() {
    blinkErrorsCounter--;

    if (blinkErrorsCounter > 0) {
        for (let k in errorsToBlink) {
            errorsToBlink[k].x += 0.05;
        }
    }

    blinkCellsCounter--;
    if (blinkCellsCounter > 0) {
        for (let k in cellsToBlink) {
            cellsToBlink[k].x += 0.05;
        }
    }
}

function blinkLeftGlobal() {
    blinkErrorsCounter--;
    if (blinkErrorsCounter > 0) {
        for (let k in errorsToBlink) {
            errorsToBlink[k].x -= 0.05;
        }
    }

    blinkCellsCounter--;
    if (blinkCellsCounter > 0) {
        for (let k in cellsToBlink) {
            cellsToBlink[k].x -= 0.05;
        }
    }
}