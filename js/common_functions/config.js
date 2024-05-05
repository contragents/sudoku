//
var config = {
    type: Phaser.AUTO,
    width: gameWidth,
    height: gameHeight,
    backgroundColor: 0xdddddd,
    parent: 'game_block',
    scene: UIScene,
    scale: {
        mode: Phaser.Scale.FIT,
        parent: 'game_block',
        autoCenter: Phaser.Scale.CENTER_BOTH,
        width: gameWidth,
        height: gameHeight
    }
};