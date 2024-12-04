//
function parseDeskGlobal(newDesc) {
    newCells = newDesc;
    for (var i = 0; i <= 8; i++) {
        for (var j = 0; j <= 8; j++) {
            console.log(i,j,newCells[i][j]);
            cells[i][j][0] = newCells[i][j] !== false;
            cells[i][j][1] = newCells[i][j] !== false ? newCells[i][j] : false;
            cells[i][j][2] = false;
            cells[i][j][3] = false;
            console.log(cells[i][j][0], cells[i][j][1]);
        }
    }

    for (var k = 400; k >= 0; k--) {
        if (k in fixedContainer) {
            fixedContainer[k].destroy();
            fixedContainer.splice(k, 1);
        }
    }

    for (var i = 0; i <= 8; i++)
        for (var j = 0; j <= 8; j++)
            if (cells[i][j][0] !== false) {
                var fixFishka = getFishkaGlobal(cells[i][j][1], 1, 1, this.game.scene.scenes[gameScene], false).disableInteractive();
                placeGlobal(fixFishka, i, j);
                fixFishka.setData('cellX', i);
                fixFishka.setData('cellY', j);
                fixedContainer.push(fixFishka);
            }
}
