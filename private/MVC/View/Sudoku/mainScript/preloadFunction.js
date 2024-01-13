//
function () {

    var progressBar = this.add.graphics();
    var progressBox = this.add.graphics();
    progressBox.fillStyle(0x222222, 0.3);
    progressBox.fillRect(gameWidth / 2 - 320 / 2, gameHeight / 2 - 50 / 5, 320, 50);

    var showCaution = false;
    /*
    if (screenOrient == 'vertical' && !isYandexAppGlobal() && !isIOSDevice() && !isVkAppGlobal()) {
        showCaution = true;
        var textAPPWidth = this.cameras.main.width;
        var textAPPHeight = this.cameras.main.height;
        var androidText1 = this.make.text({
            x: textAPPWidth / 2,
            y: textAPPHeight / 2 - 150,
            text: 'Внимание. Вышла новая версия Игры. Обновите ее, нажав shift-F5 в браузере',
            style: {
                font: '26px monospace',
                fill: '#ff0000'
            }
        });
        androidText1.setOrigin(0.5, 0.5);
        var androidText2 = this.make.text({
            x: textAPPWidth / 2,
            y: textAPPHeight / 2 - 120,
            text: 'или в Яндекс-Играх. В приложении Android Необходимо очистить кэш.',
            style: {
                font: '26px monospace',
                fill: '#ff0000'
            }
        });
        androidText2.setOrigin(0.5, 0.5);
    }
    */
    var textWidth = this.cameras.main.width;
    var textHeight = this.cameras.main.height;
    var loadingText = this.make.text({
        x: textWidth / 2,
        y: textHeight / 2 - 50,
        text: 'Загружаем игру...',
        style: {
            font: '20px monospace',
            fill: '#000000'
        }
    });
    loadingText.setOrigin(0.5, 0.5);

    this.load.on('progress', function (value) {
        progressBar.clear();
        progressBar.fillStyle(0xffffff, 1);
        progressBar.fillRect(gameWidth / 2 + 10 - 320 / 2, gameHeight / 2 - 30 / 2 + 15, 300 * value, 30);
    });

    /*this.load.on('fileprogress', function (file) {
        console.log(file.src);
    });*/

    this.load.on('complete', function () {
        progressBar.destroy();
        progressBox.destroy();
        loadingText.destroy();
        if (showCaution) {
            androidText1.destroy();
            androidText2.destroy();
        }
    });

    preloaderObject = this;

    this.load.image('no_network', 'img/no_network_transparent.png');
    this.load.svg('ground', 'img/field_source.svg', {'width': 513 * 2, 'height': 500 * 2});
    this.load.svg('donate', 'img/donate.svg');
    this.load.image('zvezda', 'img/star_transparent.png');
    this.load.svg('zvezdaVerh', 'img/star_transparent_2.svg', {scale: 0.025 * 2});
    this.load.svg('zvezdaCenter', 'img/star_transparent_2.svg', {scale: 0.06 * 2});
    this.load.atlas('fishka_empty', 'img/fishka_empty.png', 'img/fishka_empty.json');
    this.load.atlas('megaset', 'img/letters.png', 'img/letters.json');
    this.load.atlas('digits', 'img/letters.png', 'img/nums.json');
    this.load.atlas('megaset_english', 'img/letters_english.png', 'img/letters_english.json');
    this.load.image('back', 'img/background_test.jpg');

    for (var k in buttons)
        if ('modes' in buttons[k])
            buttons[k]['modes'].forEach(mode => this.load.svg(k + mode, 'img/' + mode.toLowerCase() + '/' + buttons[k]['filename'] + '.svg', {
                'width': buttons[k]['width'],
                'height': 32 * 2,
            }));
        else
            modes.forEach(mode => this.load.svg(k + mode, 'img/' + mode.toLowerCase() + '/' + buttons[k]['filename'] + '.svg', {
                'width': buttons[k]['width'],
                'height': 32 * 2,
            }));

    this.load.svg('fullscreen', 'img/fullscreen.svg', {
        'width': fullscreenButtonSize,
        'height': fullscreenButtonSize
    });
}