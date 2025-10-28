<?php
use classes\Cookie;
use classes\GameSkipbo;
use classes\MonetizationService;
use classes\Steam;
use classes\T;
use BaseController as BC;
?>

var lang = '<?= T::$lang ?>';
bootbox.setLocale(convertLang2Bootbox());

var version = '<?= BC::$version ?>';

const SUPPORTED_LANGS = <?= T::getSupportedLangsForJS() ?>;

const BASE_URL = '<?= SkipboController::GAME_URL() ?>';

//<?php include(ROOT_DIR . '/js/common_functions/globalVarsCommon.js.php'); ?>

if (windowInnerWidth > windowInnerHeight) {
    screenOrient = HOR;

    var gameWidth = standardHorizontalWidth;
    var gameHeight = 9 / 16 * gameWidth; // standardHorizontalHeight;
    var topHeight = gameHeight * TOP_PERCENT;
    var buttonHeight = topHeight;
    var cardWidth = buttonWidth * 1 / 2; // Ширина карты (полного размера)
    var cardStep = cardWidth / 10; // Расстояние между картами

    var knopkiLeftWidth = gameWidth / 2; // 4 top-left buttons width
    var knopkiRightWidth = gameWidth / 3; // 3 top-right buttons width
    var centerPlayerBackplateCenterX = gameWidth / 2;
    var centerPlayerBackplateCenterY = gameHeight / 4 + 6 * cardStep;
    var playerBackplateWidth = gameWidth / 3 * 0.9;
    var kolodaCardsBlockWidth = 6 * cardWidth + 10 * cardStep;// gameWidth * 2 / 3; // Ширина центрального блока - Колода, 4 карты, активная карта Игрока
    var kolodaCardsBlockCenterX = gameWidth / 2;
    var kolodaCardsBlockX = kolodaCardsBlockCenterX - kolodaCardsBlockWidth / 2; // Х-координата центрального блока
    var kolodaCardsBlockY = gameHeight / 2;
    var kolodaCardsBlockHeight = gameHeight / 4; // Высота центрального блока
    var timerHeight = kolodaCardsBlockHeight; // Высота таймера
    var timerXCenter = kolodaCardsBlockX / 2; // Центр X блока таймера
    var timerYCenter = kolodaCardsBlockY + kolodaCardsBlockHeight / 2; // Центр Y блока таймера
    var bankGoalBlockXCenter = gameWidth - kolodaCardsBlockX / 2;
    var bankGoalBlockYCenter = timerYCenter;
    var youBlockXCenter = buttonWidth / 2 + cardStep;
    var youBlockYCenter = gameHeight - kolodaCardsBlockHeight - cardStep * 6;
    var cardCommonBlockYCenter = kolodaCardsBlockY + kolodaCardsBlockHeight / 2 + kolodaCardsBlockHeight / 6;
    var card1CommonBlockXCenter = kolodaCardsBlockCenterX - cardStep / 2 - cardWidth - cardStep - cardWidth / 2;
    var handCard1CenterX = cardWidth / 2 + cardStep;
    var handCardCenterY = gameHeight - gameHeight / 8;
    var bankCard4CenterX = gameWidth - cardWidth / 2 - cardStep;
    var bankCardCenterY = handCardCenterY;

    // var topHeight = gameHeight * TOP_PERCENT;
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

// var buttonHeight = topHeight;

var lotokCells = [];

var stepX = 0;
var stepY = 0;

var gameScene = 0;

var submitButton = false;

var dialog = false;
var dialogResponse = false;

var ochki = false;
var ochki_arr = false;
var myUserNum = false;

var canOpenDialog = true;
var canCloseDialog = true;

var data = [];
var responseData = [];
var lastflor = 0;
var gameLog = [];
var chatLog = [];
var hasIncomingMessages = false;
var intervalId = 0;
var vremia = false;
var vremiaMinutes = false;
var vremiaSeconds = false;
var lastTimeCorrection = 0;
var vremiaFontSizeDefault = 24 * 2;
var vremiaFontSizeDelta = 8;
var vremiaFontSize = vremiaFontSizeDefault;

var gWLimit = false;

var pageActive = 'visible';
var fullImgID = false;
var fullImgWidth = 0;

var soundPlayed = false;
var lastSoundPlayedTimestamp = 0;
const SOUND_TIMEOUT = 10000;
var instruction = '';

//<?php include('globals/tgGlobalFunction.js')?>
//<?php include('globals/buttonSettingsGlobal.js.php')?>
//<?php include('globals/gameStates_1.js.php')?>
//<?php if (!Steam::isSteamApp()) {
    include(ROOT_DIR . '/js/common_functions/wav.js');
}?>

yacheikaWidth = 32 * 2 * 15 / 9 * 0.96;
correctionX = 4;
correctionY = -7 * 2;
