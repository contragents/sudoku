//
class CardMove {
    constructor(data) {
        this.numUser = data.numUser;
        this.cardTypeFrom = data.cardTypeFrom;
        this.positionFrom = data.positionFrom;
        this.cardTypeTo = data.cardTypeTo;
        this.positionTo = data.positionTo;
        this.cardValue = data.cardValue;
    }

    // Метод для удобного создания из массива
    static fromArray(dataArray) {
        return dataArray.map(item => new CardMove(item));
    }

    /**
     * @param {Phaser.Scene} scene
     * @param {Phaser.GameObjects.Sprite} cardSprite - спрайт карты, который нужно двигать
     */
    async animate(scene, cardSprite) {
        // Рассчитываем координаты цели (условно)
        const targetX = this.positionTo * 100;
        const targetY = 500;

        return new Promise((resolve) => {
            scene.tweens.add({
                targets: cardSprite,
                x: targetX,
                y: targetY,
                duration: 500,
                ease: 'Power2',
                onComplete: () => {
                    // Когда карта прилетела, разрешаем промис
                    resolve();
                }
            });
        });
    }

    findCardSprite(scene, type, pos) {
        return scene.children.list.find(c =>
            c.getData && c.getData('type') === type && c.getData('pos') === pos
        );
    }
}
