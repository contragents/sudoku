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

document.body.style.backgroundColor = "#dddddd";

//<?php include(ROOT_DIR . '/js/common_functions/ysdk.js')?>
