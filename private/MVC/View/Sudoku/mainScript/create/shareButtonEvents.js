        shareButton.on('pointerup', function () {
             if (bootBoxIsOpenedGlobal())
                return;
            
            
            /*Phaser.Actions.Call(shareButton.getAll(), function(elem) {
                elem.setVisible(false);        
            }, this);
            */

            game.renderer.snapshot(function (image) {
               // image.style.width = '160px';
               // image.style.height = '120px';
                //image.style.paddingLeft = '2px';
                image.id = 'strange';
                //snapHistory.push(image);
                console.log('snap!');
                document.getElementById('ss').appendChild(image);
            });
            
            

            setTimeout(function(){
                var img = document.getElementById('strange');
                var xhr = new XMLHttpRequest();
                var body = 'png=' + encodeURIComponent(img.src);
                xhr.open("POST", '//xn--d1aiwkc2d.club/snapshot.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onreadystatechange = function (govno){
                    if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        console.log(xhr.responseText);
                        window.open('//xn--d1aiwkc2d.club/snapshots/'+xhr.responseText+'/');
                    };
                };

                xhr.send(body);
                Phaser.Actions.Call(shareButton.getAll(), function(elem) {
                elem.setVisible(true);        
                }, this);
            },1000);
        //ground.tint = Math.random() * 0xffffff;
        
        });
        /*
        shareButton.on('pointerover', function () {
        shareButton.getRandom(0,0).tint = 0x00ff00;
        });
        */
        /*
        shareButton.on('pointerout', function () {
        shareButton.getRandom(0,0).tint = 0xff0000;
        });
        */