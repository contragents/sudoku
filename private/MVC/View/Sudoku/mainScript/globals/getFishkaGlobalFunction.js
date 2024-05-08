//
function getFishkaGlobal(numLetter, X, Y, _this, draggable = true) {
    let fishka = _this.add.image(0, 0, numLetter + (draggable ? '_button' : '_black'));
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

async function loadFishkiSet(fishkaSet) {
    fishkiLoaded[fishkaSet] = [];

    CODES[lang].forEach(function (numLetter) {
        imgName = fishkaSet + numLetter;
        preloaderObject.load.svg(imgName, '//xn--d1aiwkc2d.club/img/fishki_sets/' + fishkaSet + '/' + numLetter + '.svg');
        console.log(imgName);
        if (numLetter != 999) {
            let numfishka = numLetter + 999 + 1;
            imgName = fishkaSet + numfishka;
            preloaderObject.load.svg(imgName, '//xn--d1aiwkc2d.club/img/fishki_sets/' + fishkaSet + '/' + numfishka + '.svg');
            console.log(imgName);
        }
    });

    preloaderObject.load.start();
    preloaderObject.load.on('complete', function () {

        CODES[lang].forEach(function (numLetter) {
            imgName = fishkaSet + numLetter;
            fishkiLoaded[fishkaSet][numLetter] = imgName;
            console.log(imgName);
            if (numLetter != 999) {
                let numfishka = numLetter + 999 + 1;
                imgName = fishkaSet + numfishka;
                fishkiLoaded[fishkaSet][numfishka] = imgName;
                console.log(imgName);
            }
        });
    });
}