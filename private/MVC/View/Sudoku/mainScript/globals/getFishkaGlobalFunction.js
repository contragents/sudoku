//
function getFishkaGlobal(numLetter, X, Y, _this, draggable = true) {
    let fishka = _this.add.image(0, 0, (draggable ? 'button_' : 'black_') + numLetter);
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
