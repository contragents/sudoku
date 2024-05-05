//
var UIScene = new Phaser.Class({
   
    Extends: Phaser.Scene,

    initialize:
    //<?php include(ROOT_DIR . '/js/common_functions/initializeFunction.js')?>
    ,

    preload: 
    //<?php include('preloadFunction.js')?>
    ,

    create: 
    //<?php include('createFunction.js')?>
    ,
    
    update : 
    //<?php include('updateFunction.js')?>
});

//<?php include('globalVars.js')?>

//<?php include(ROOT_DIR . '/js/common_functions/config.js')?>

//<?php include('globalFunctions.js')?>

var game = new Phaser.Game(config);

document.body.style.backgroundColor = "#dddddd";


