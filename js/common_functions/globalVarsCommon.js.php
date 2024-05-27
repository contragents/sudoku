
var preloaderObject = false;

const DEFAULT_FISHKA_SET = 'default';

const CODES = {
    'RU': [999, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31],
    'EN': [999, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59]
}

const SUBMIT_SCRIPT = 'turnSubmitter';
const WORD_CHECKER_SCRIPT = 'word_checker.php';
const STATUS_CHECKER_SCRIPT = 'statusChecker';
const STATUS_HIDDEN_CHECKER_SCRIPT = 'statusHiddenChecker';
const INIT_GAME_SCRIPT = 'initGame';
const CHAT_SCRIPT = 'send_chat_message.php';
const COMPLAIN_SCRIPT = 'complain.php';
const SET_INACTIVE_SCRIPT = 'set_inactive.php';
const MERGE_IDS_SCRIPT = 'merge_the_ids.php';
const SET_PLAYER_NAME_SCRIPT = 'set_player_name.php';
const DELETE_BAN_URL = 'mvc/ban/remove?common_id=';
const NEW_GAME_SCRIPT = 'newGame';
const PLAYER_RATING_SCRIPT = 'players_ratings.php';
const CHANGE_FISHKI_SCRIPT = 'change_fishki.php';
const COOKIE_CHECKER_SCRIPT = 'cookie_checker.php';
const CABINET_SCRIPT = 'player_cabinet.php';
const INVITE_SCRIPT = 'invite_to_new_game.php';
const AVATAR_UPLOAD_SCRIPT = 'avatar_upload.php';
const SET_AVATAR_SCRIPT = 'set_player_avatar_url.php';
const HOR = 'horizontal';
const VERT = 'vertical';

const BAD_REQUEST = 400;
const PAGE_NOT_FOUND = 404;

var turnAutocloseDialog = false;
var timeToCloseDilog = false;
var automaticDialogClosed = false;

var requestToServerEnabled = true;
var requestToServerEnabledTimeout = false;
var isSubmitResponseAwaining = false;
const GENERAL_REQUEST_TIMEOUT = 500;
const SUBMIT_REQUEST_TIMEOUT = 1000;

var reloadInervalNumber = false;

const windowInnerWidth = window.innerWidth;
const windowInnerHeight = window.innerHeight;

const standardVerticalWidth = 500 * 2;
const standardVerticalHeight = 800 * 2;
const standardHorizontalWidth = 960 * 2;
const standardHorizontalHeight = standardVerticalWidth;

const donateLink = 'https://pay.cloudtips.ru/p/9844e694';

var gameNumber = false;
var graphics;
var letterMin = 0;
var letterMax = 31;
var chooseFishka = false;
var fullscreenButtonSize = 64;
var FullScreenButton = false;

var buttonWidth = 240 * 2;
var buttonStepY = 50 * 2;

var requestSended = false;
var requestTimestamp = (new Date()).getTime();
const normalRequestTimeout = 500;
var noNetworkImg = false;
var propKoef = 1;
var buttonHeightKoef = 1;
var fishkaScale = 1;

if (windowInnerWidth > windowInnerHeight) {
    var screenOrient = HOR;
    var gameWidth = standardHorizontalWidth;
    var gameHeight = standardHorizontalHeight;
    var knopkiWidth = gameWidth - gameHeight;
    var lotokX = 30 * 2;
    var lotokY = 30 * 2;
    var lotokCellStep = 40 * 2;
    var lotokCellStepY = lotokCellStep;
    var lotokCapacityX = 10;
    var lotokCapacityY = 2;
    var fullscreenXY = {x: gameWidth - gameHeight - fullscreenButtonSize / 2, y: fullscreenButtonSize / 2 + 16};
    var backY = (gameHeight - 2000) * Math.random();
    var backX = (gameWidth - 2000) * Math.random();

} else {
    var screenOrient = VERT;
    if (isYandexAppGlobal()) {
        propKoef = window.outerHeight / window.outerWidth;
    } else if (isIOSDevice()) {
        //console.log('IOS!!!');
        propKoef = window.innerHeight / window.innerWidth;
    } else {
        const outerHeight = (window.screen.availHeight - window.outerHeight) / 2 + window.outerHeight;
        propKoef = outerHeight / window.outerWidth;
    }

    buttonHeightKoef = propKoef / (standardVerticalHeight / standardVerticalWidth);

    if (buttonHeightKoef < 1) {
        buttonHeightKoef = 1;
    }
    var gameWidth = standardVerticalWidth;
    var gameHeight = buttonHeightKoef <= 1 ? standardVerticalHeight : (gameWidth * propKoef);

    var knopkiWidth = gameWidth;
    var lotokX = 30 * 2;
    var lotokY = 530 * 2;

    if (buttonHeightKoef == 1) {
        var fishkaScale = 1.2;
        var lotokCellStep = 40 * 2;
        var lotokCapacityX = 9;
    } else {
        var fishkaScale = buttonHeightKoef;
        var lotokCellStep = 40 * 2 * buttonHeightKoef;
        var lotokCapacityX = 9;
    }

    var lotokCellStepY = lotokCellStep * buttonHeightKoef;
    buttonStepY = buttonStepY * buttonHeightKoef;

    var lotokCapacityY = 1;
    var fullscreenXY = {x: gameWidth - fullscreenButtonSize / 2 - 8, y: gameHeight - fullscreenButtonSize / 2 - 8};
    var backY = 100 + (gameWidth - 50) * Math.random();
    var backX = -1 * gameWidth * Math.random();
    var backScale = 1; // не используем, хз как работает setscale в Фазере
}

var lotokCells = [];

var stepX = 0;
var stepY = 0;

var cells = [];

var newCells = [];

var fixedContainer = [];

var container = [];

var yacheikaWidth = 32 * 2 * 15 / 9 * 0.96;
var correctionX = 6 * 2;
var correctionY = -7 * 2;

var gameScene = 0;

var submitButton = false;

var dialog = false;
var dialogResponse = false;

var winScore = '';
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
var intervalId = 0;
var vremia = false;
var vremiaMinutes = false;
var vremiaSeconds = false;
var lastTimeCorrection = 0;
var vremiaFontSizeDefault = 24 * 2;
var vremiaFontSizeDelta = 8;
var vremiaFontSize = vremiaFontSizeDefault;

var tWaiting = false;
var gWLimit = false;

var pageActive = 'visible';
var fullImgID = false;
var fullImgWidth = 0;

var useLocalStorage = localStorage.<?= BaseController::$SM::$cookieKey ?> ? true : false;
console.log('useLocalStorage', useLocalStorage);
var instruction = '';

var soundPlayed = false;
var uniqID = false;
