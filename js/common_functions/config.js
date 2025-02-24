//
var config = {
    type: Phaser.AUTO,
    width: gameWidth,
    height: gameHeight,
    transparent: true,
    parent: 'phaser-example',
    scene: UIScene,
    scale: {
        mode: Phaser.Scale.FIT,
        parent: 'phaser-example',
        autoCenter: Phaser.Scale.CENTER_BOTH,
        width: gameWidth,
        height: gameHeight
    },
    loader: {
        maxRetries: 10, // from 3.85 version - using in Yandex version
    },
    physics: {
        fps: {
            max: 30,
            min: 24,
            target: 30,
        }
    },
};