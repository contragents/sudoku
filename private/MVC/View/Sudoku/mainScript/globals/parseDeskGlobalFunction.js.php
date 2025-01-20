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

                if(i in sudokuChecksContainer && j in sudokuChecksContainer[i]) {
                    while(sudokuChecksContainer[i][j].length) {
                        sudokuChecksContainer[i][j].pop().destroy();
                    }
                }

                if (!dontBlink && !(i in prevCellsOpened && j in prevCellsOpened[i])) {
                    fixFishka.setData('displayHeight', fixFishka.displayHeight);
                    fixFishka.setData('displayWidth', fixFishka.displayWidth);
                    cellsToBlink.push(fixFishka);
                } else if (!dontBlink && i in prevCellsOpened && j in prevCellsOpened[i] && prevCellsOpened[i][j] === 0 && cells[i][j][1] > 10) {
                    fixFishka.setData('displayHeight', fixFishka.displayHeight);
                    fixFishka.setData('displayWidth', fixFishka.displayWidth);
                    cellsToBlink.push(fixFishka);
                }

                //if(cells[i][j][1] !== 0) {
                if (!(i in prevCellsOpened)) {
                    prevCellsOpened[i] = {};
                }

                prevCellsOpened[i][j] = cells[i][j][1];
                //}

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

                    //check Begin

                    if(i in sudokuChecksContainer && j in sudokuChecksContainer[i]) {
                        let tmpArr = [];
                        while (sudokuChecksContainer[i][j].length) {
                            let checkGameObject = sudokuChecksContainer[i][j].pop();
                            if (checkGameObject.getData('letter') == number) {
                                checkGameObject.destroy();
                            } else {
                                tmpArr.push(checkGameObject);
                            }
                        }

                        while (tmpArr.length) {
                            sudokuChecksContainer[i][j].push(tmpArr.pop());
                        }
                    }

                    //check End

                        if (!(i in prevErrors && j in prevErrors[i] && number in prevErrors[i][j])) {
                            errorNumberGameObject.setData('displayHeight', errorNumberGameObject.displayHeight);
                            errorNumberGameObject.setData('displayWidth', errorNumberGameObject.displayWidth);
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

    blinkErrorsCounter = BLINK_COUNT;
}

function blinkRightGlobal() {
    blinkErrorsCounter--;

    for (let k in errorsToBlink) {
        if (blinkErrorsCounter > 0) {
            errorsToBlink[k].scale += 0.01;
            if (errorsToBlink[k].scale >= 1.5) {
                errorsToBlink[k].scale = 1.5;
            }
        } else {
            errorsToBlink[k].scale = 1;
            errorsToBlink[k].displayHeight = errorsToBlink[k].getData('displayHeight');
            errorsToBlink[k].displayWidth = errorsToBlink[k].getData('displayWidth');
        }
    }

    blinkCellsCounter--;

    for (let k in cellsToBlink) {
        if (blinkCellsCounter > 0) {
            //cellsToBlink[k].x += 0.05;
            cellsToBlink[k].scale += 0.01;
            if (cellsToBlink[k].scale >= 1.5) {
                cellsToBlink[k].scale = 1.5;
            }
        } else {
            cellsToBlink[k].scale = 1;
            cellsToBlink[k].displayHeight = cellsToBlink[k].getData('displayHeight');
            cellsToBlink[k].displayWidth = cellsToBlink[k].getData('displayWidth');
        }
    }
}


function blinkLeftGlobal() {
    blinkErrorsCounter--;
    for (let k in errorsToBlink) {
        if (blinkErrorsCounter > 0) {
            //errorsToBlink[k].x -= 0.05;
            //errorsToBlink[k].alpha = 0.3;
            errorsToBlink[k].scale -= 0.01;
            if (errorsToBlink[k].scale <= 0) {
                errorsToBlink[k].scale = 0;
            }
        } else {
            //errorsToBlink[k].alpha = 1;
            errorsToBlink[k].scale = 1;
            errorsToBlink[k].displayHeight = errorsToBlink[k].getData('displayHeight');
            errorsToBlink[k].displayWidth = errorsToBlink[k].getData('displayWidth');
        }
    }

    blinkCellsCounter--;
    for (let k in cellsToBlink) {
        if (blinkCellsCounter > 0) {
            //cellsToBlink[k].x -= 0.05;
            cellsToBlink[k].scale -= 0.01;
            if (cellsToBlink[k].scale < 0) {
                cellsToBlink[k].scale = 0;
            }
        } else {
            cellsToBlink[k].scale = 1;
            cellsToBlink[k].displayHeight = cellsToBlink[k].getData('displayHeight');
            cellsToBlink[k].displayWidth = cellsToBlink[k].getData('displayWidth');
        }
    }
}
