<?php
use classes\Cookie;
use classes\GameSkipbo;use classes\MonetizationService;
use classes\Steam;
use classes\T;
use BaseController as BC;
?>

var lang = '<?= T::$lang ?>';
bootbox.setLocale(convertLang2Bootbox());

var version = '<?= BC::$version ?>';

const SUPPORTED_LANGS = <?= T::getSupportedLangsForJS() ?>;

const BASE_URL = '<?= SkipboController::GAME_URL() ?>';

const chooseFile = "'<?= T::S('Choose file') ?>'";
document.documentElement.style.setProperty('--choose-file', chooseFile);

const INVITE_FRIEND_PROMPT = '<?= T::S('invite_friend_prompt') ?>';
const GAME_BOT_URL = '<?= T::S('game_bot_url') ?>';
const LOADING_TEXT = '<?= T::S('loading_text') ?>';
const errorServerMessage = '<?= T::S('Server connecting error. Please try again')?>';
const STATS_GET_ERROR = '<?= T::S('Stats getting error')?>';

const ALARM_MODE = 'Alarm';
const OTJAT_MODE = 'Otjat';
const INACTIVE_MODE = 'Inactive';
const NAJATO_MODE = 'Najatie';
const NAVEDENO_MODE = 'Navedenie';

const BLINK_COUNT = 3000;
var dontBlink = true;
var preloaderObject = false;
var lastComment = false;
var prevErrors = {};
var errorsToBlink = [];
var blinkErrorsCounter = 0;
var prevCellsOpened = {};
var cellsToBlink = [];
var blinkCellsCounter = 0;

const FALL_BACK_COOKIE = '<?= COOKIE::getPersonalCookie() ?>';
var cookieStored = false;
var useLocalStorage = false;
if (localStorage != 'undefined') {
    useLocalStorage = !!localStorage.<?= Cookie::COOKIE_NAME ?>;
    if (useLocalStorage) {
        cookieStored = localStorage.<?= Cookie::COOKIE_NAME ?>;
    }
}
var useYandexStorage = false;

// common vars
var isDemo = false;
var isDemoEnded = false;
// common vars end

// vars initializing in chooseGame state
var isInviteGameWaiting = false;
var tWaiting = false;
var isUserBlockActive = false;
var isOpponentBlockActive = false;
var winScore = false;
var gameBid = false;
var playerScores = {
    youBlock: {mode: OTJAT_MODE, digit3: 0, digit2: 0, digit1: 0},
    player1Block: {mode: OTJAT_MODE, digit3: 0, digit2: 0, digit1: 0},
    player2Block: {mode: OTJAT_MODE, digit3: 0, digit2: 0, digit1: 0},
}
// vars initializing in chooseGame state END

// SUDOKU VARS
const sudokuSet1Column = new Set([1, 4, 7]);
const sudokuSet2Column = new Set([2, 5, 8]);
const sudokuSet3Column = new Set([3, 6, 9]);
const sudoku1RowCorrectionLower = new Set([3, 4, 5, 6, 7]);
var sudokuMistakesContainer = [];
var sudokuChecksContainer = [];
// SUDOKU VARS END

const SUDOKU_PRICE = <?= MonetizationService::SUDOKU_PRICE ?>;
const COMMON_TPL_DIR = 'tpl/common/';
const PROFILE_TPL = BASE_URL + COMMON_TPL_DIR
+ (isYandexAppGlobal()
    ? 'profile-modal-tpl_yandex.html'
    : (isSteamGlobal()
        ? 'profile-modal-tpl_steam.html'
        : 'profile-modal-tpl_1.html')
    );
const FAQ_TPL = BASE_URL + COMMON_TPL_DIR + 'faq-modal-tpl_';
const STATS_TPL = BASE_URL + COMMON_TPL_DIR + 'stats-modal-tpl.html';
var LEADERBOARD_TPL = BASE_URL + COMMON_TPL_DIR + 'leaderboard-modal-tpl_';

const SUBMIT_SCRIPT = 'turnSubmitter';
const WORD_CHECKER_SCRIPT = 'word_checker.php';
const STATUS_CHECKER_SCRIPT = 'statusChecker';
const INIT_GAME_SCRIPT = 'initGame';
const CABINET_SCRIPT = 'playerCabinet';
const PLAYER_RATING_SCRIPT = 'players/info'; // todo ...
const HIDE_BALANCE_SCRIPT = 'players/hideBalance';
const CLAIM_SCRIPT = 'pay/claim';
const PAY_SCRIPT = 'pay/pay';

const CHAT_SCRIPT = 'sendChatMessage';
const COMPLAIN_SCRIPT = 'complain';
const SET_INACTIVE_SCRIPT = 'setInactive';
const MERGE_IDS_SCRIPT = 'merge_the_ids.php';

const SET_PLAYER_NAME_SCRIPT = 'players/saveUserName';
const AVATAR_UPLOAD_SCRIPT = 'players/avatarUpload';

const STATS_URL = 'stats/viewV2'
const PRIZES_SCRIPT_URL = 'stats/leaders'
const NEW_GAME_SCRIPT = 'newGame';
const INVITE_SCRIPT = 'inviteToNewGame';

const COOKIE_CHECKER_SCRIPT = 'cookie_checker.php';
const SET_AVATAR_SCRIPT = 'set_player_avatar_url.php';
const HOR = 'horizontal';
const VERT = 'vertical';

const MY_TURN_STATE = 'myTurn';
const PRE_MY_TURN_STATE = 'preMyTurn';
const OTHER_TURN_STATE = 'otherTurn';
const INIT_GAME_STATE = 'initGame';
const INIT_RATING_GAME_STATE = 'initRatingGame';
const GAME_RESULTS_STATE = 'gameResults';
const START_GAME_STATE = 'startGame';
const CHOOSE_GAME_STATE = 'chooseGame';
const NO_GAME_STATE = 'noGame';

const BAD_REQUEST = 400;
const PAGE_NOT_FOUND = 404;

const CHECK_BUTTON_INACTIVE_CLASS = 'disable-check-button';
const SUBMIT_BUTTON_INACTIVE_CLASS = 'disable-submit-button';
const TOP_PERCENT = 0.15;
const FISHKI_PERCENT = 0.15;
const BOTTOM_PERCENT = 0.7;

const INACTIVE_USER_ALPHA = 0.2;

var activeUser = false;
var commonId = false;
var commonIdHash = false;

var timerState = {
    mode: OTJAT_MODE,
    digit3: 0,
    digit2: 0,
    digit1: 0
}

var dialogTurn = false;

var turnAutocloseDialog = false;
var timeToCloseDilog = 0;
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

var gameNumber = false;
var gameBank = false;
var gameBankString = '';
var faserObject = false;
var graphics;
var letterMin = 0;
var letterMax = 31;
var chooseFishka = false;
var fullscreenButtonSize = 64;
var FullScreenButton = false;

var buttonWidth = 120 * 2;
var buttonStepX = 10 * 2;
var buttonStepY = 50 * 2;

var requestSended = false;
var hiddenRequestSended = false;
var requestTimestamp = (new Date()).getTime();
const normalRequestTimeout = 500;

var noNetworkImg = false;
var noNetworkImgOpponent = {};

var propKoef = 1;
var buttonHeightKoef = 1;
var fishkaScale = 1;

var cells = [];
var newCells = [];
var fixedContainer = [];
var container = [];
var dragBegin = false;
var yacheikaWidth = 32 * 2;
var correctionX = 6 * 2;
var correctionY = -7 * 2;

var screenOrient = VERT;

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
