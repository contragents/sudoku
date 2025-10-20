//
// Sudoku special function
function getFishkaGlobal(numLetter, X, Y, _this, draggable = true, color = 'black') {
    let tint = 0xffffff;
    if (color === 'green') {
        tint = 0x00aa00;
        color = 'white';
    }

    let fishka = numLetter < 10
    ? _this.add.image(0, 0, (draggable ? 'button_' : (color + '_')) + numLetter).setTint(tint)
    : _this.add.image(0, 0, (draggable ? 'button_' : ('key' + '_')) + (numLetter-10));
    fishka.displayWidth = 32 * 2;
    fishka.displayHeight = 32 * 2;
    const correction = 1.5;

    var container = _this.add.container(X, Y, [fishka]);

    container.setSize(fishka.displayWidth, fishka.displayHeight);
    container.setData('letter', numLetter);
    container.setData('cellX', false);
    container.setData('cellY', false);
    container.setInteractive();
    if (draggable) {
        _this.input.setDraggable(container);
        if (fishkaScale > 1) {
            container.setScale(fishkaScale);
        }
    }

    return container;
}
