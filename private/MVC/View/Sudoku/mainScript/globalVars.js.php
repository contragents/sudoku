<?php
use classes\Cookie;
use classes\MonetizationService;
use classes\Steam;
use classes\T;
use BaseController as BC;
?>

var lang = '<?= T::$lang ?>';
bootbox.setLocale(convertLang2Bootbox());

var version = '<?= BC::$version ?>';

const SUPPORTED_LANGS = <?= T::getSupportedLangsForJS() ?>;

const BASE_URL = '<?= SudokuController::GAME_URL() ?>';

//<?php include(ROOT_DIR . '/js/common_functions/globalVarsCommon.js.php'); ?>

// SUDOKU VARS
const sudokuSet1Column = new Set([1, 4, 7]);
const sudokuSet2Column = new Set([2, 5, 8]);
const sudokuSet3Column = new Set([3, 6, 9]);
const sudoku1RowCorrectionLower = new Set([3, 4, 5, 6, 7]);
var sudokuMistakesContainer = [];
var sudokuChecksContainer = [];
const BLINK_COUNT = 3000;
var dontBlink = true;
var prevErrors = {};
var errorsToBlink = [];
var blinkErrorsCounter = 0;
var prevCellsOpened = {};
var cellsToBlink = [];
var blinkCellsCounter = 0;
// SUDOKU VARS END

if (windowInnerWidth > windowInnerHeight) {
    screenOrient = HOR;
    var gameWidth = standardHorizontalWidth;
    var gameHeight = standardHorizontalHeight;
    var knopkiWidth = gameWidth - gameHeight;

    var topHeight = gameHeight * TOP_PERCENT;
    var fishkiHeight = gameHeight * FISHKI_PERCENT;
    var botHeight = gameHeight * BOTTOM_PERCENT;
    var topXY = {x: 0, y: 0};
    var fishkiXY = {x: 0, y: topHeight};
    var botXY = {x: 0, y: topHeight + fishkiHeight};

    var lotokX = fishkiXY.x + 30 * 2;
    var lotokY = fishkiXY.y + 20 * 2;
    var lotokCellStep = 40 * 2;
    var lotokCellStepY = lotokCellStep;
    var fullscreenXY = {x: gameWidth - gameHeight - fullscreenButtonSize / 2, y: fullscreenButtonSize / 2 + 16};
    var backY = (gameHeight - 2000) * Math.random();
    var backX = (gameWidth - 2000) * Math.random();
} else {
    if (isYandexAppGlobal()) {
        propKoef = window.outerHeight / window.outerWidth;
    } else if (isIOSDevice()) {
        propKoef = window.innerHeight / window.innerWidth;
    } else {
        const outerHeight = (window.screen.availHeight - window.outerHeight) / 2 + window.outerHeight;
        propKoef = outerHeight / window.outerWidth;

        propKoef = window.innerHeight / window.innerWidth;
    }

    buttonHeightKoef = propKoef / (standardVerticalHeight / standardVerticalWidth);

    var gameWidth = standardVerticalWidth;
    var gameHeight = (gameWidth * propKoef);

    var knopkiWidth = gameWidth; // size of buttons block

    var topHeight = (gameHeight - gameWidth) * TOP_PERCENT;
    var fishkiHeight = (gameHeight - gameWidth) * FISHKI_PERCENT;
    var botHeight = (gameHeight - gameWidth) * BOTTOM_PERCENT;
    var topXY = {x: 0, y: 0};
    var fishkiXY = {x: 0, y: topHeight + gameWidth};
    var botXY = {x: 0, y: topHeight + gameWidth + fishkiHeight};

    var lotokX = fishkiXY.x + 30 * 2;
    var lotokY = fishkiXY.y + 20 * buttonHeightKoef * 2;

    if (buttonHeightKoef == 1) {
        fishkaScale = 1.2;
        var lotokCellStep = 40 * 2;
    } else {
        fishkaScale = buttonHeightKoef;
        var lotokCellStep = 40 * 2 * buttonHeightKoef;
    }

    var lotokCellStepY = lotokCellStep * buttonHeightKoef;
    buttonStepY = buttonStepY * buttonHeightKoef;

    var fullscreenXY = {x: gameWidth - fullscreenButtonSize / 2 - 8, y: gameHeight - fullscreenButtonSize / 2 - 8};
    var backY = 100 + (gameWidth - 50) * Math.random();
    var backX = -1 * gameWidth * Math.random();
    var backScale = 1; // не используем, хз как работает setscale в Фазере
}

var lotokCapacityX = 9;
var lotokCapacityY = 1;

var buttonHeight = topHeight;

//<?php include('globals/tgGlobalFunction.js')?>
//<?php include('globals/buttonSettingsGlobal.js.php')?>
//<?php include('globals/gameStates_1.js.php')?>
//<?php if (!Steam::isSteamApp()) {
    include(ROOT_DIR . '/js/common_functions/wav.js');
}?>

yacheikaWidth = 32 * 2 * 15 / 9 * 0.96;
correctionX = 4;
correctionY = -7 * 2;
