//
function parseDeskGlobal(newDesc) {
    newCells = newDesc;
    for (var i = 0; i <= 8; i++) {
        for (var j = 0; j <= 8; j++) {
            console.log(i, j, newCells[i][j]);
            cells[i][j][0] = newCells[i][j] !== false;
            cells[i][j][1] = newCells[i][j] !== false ? newCells[i][j] : false;
            cells[i][j][2] = false;
            console.log(cells[i][j][0], cells[i][j][1]);
        }
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
            }
        }
    }
/*
    if ('mistakes' in newCells) {
        for (let i = 0; i <= 8; i++) {
            for (let j = 0; j <= 8; j++) {
                for (let number = 1; number <= 9; number++) {
                    if (i in newCells.mistakes && j in newCells.mistakes[i] && number in newCells.mistakes[i][j] && cells[i][j][0] === false) {
                        let errorNumberGameObject = getFishkaGlobal(number, 1, 1, this.game.scene.scenes[gameScene], false).disableInteractive();
                        placeErrorSudokuGlobal(errorNumberGameObject, i, j, number);
                    }
                }
            }
        }
    }
*/
    resetButtonFunction(true);
}

function processMistakesSudokuGlobal(mistakes) {
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
                }
            }
        }
    }
}
