//
//<?php include(ROOT_DIR . '/js/common_functions/tg.js')?>

var UIScene = new Phaser.Class({
   
    Extends: Phaser.Scene,

    initialize:
    //<?php include(ROOT_DIR . '/js/common_functions/initializeFunction.js')?>
    ,

    preload: 
    //<?php include(ROOT_DIR . '/js/common_functions/preloadFunction.js.php')?>
    ,

    create: 
    //<?php include('createFunction.js')?>
    ,
    
    update : 
    //<?php include('updateFunction.js')?>
});

//<?php include('globalVars.js.php')?>

//<?php include(ROOT_DIR . '/js/common_functions/config.js')?>

//<?php include('globalFunctions.js.php')?>

var game = new Phaser.Game(config);

document.body.style.backgroundImage = screenOrient === HOR ? "url('img/back_gorizont_2.svg')" : "url('img/back2.svg')";
document.body.style.backgroundSize = 'cover';
document.body.style.backgroundPosition = 'center';
document.body.style.backgroundOrigin = 'border-box';

//CLUB-421
document.addEventListener('contextmenu', event => event.preventDefault());
document.addEventListener('dragstart', event => {
    if (event.target.tagName === 'IMG') event.preventDefault();
});

//<?php include(ROOT_DIR . '/js/common_functions/ysdk_4.js')?>
