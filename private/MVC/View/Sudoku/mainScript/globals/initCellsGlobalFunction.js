//
function initCellsGlobal() {
    var n = 9;
    for (var i = 0; i < n; i++) {
        cells[i] = [];
        for (var j = 0; j < n; j++) {
            cells[i][j] = [false, false, false, false];
        }
    }
}