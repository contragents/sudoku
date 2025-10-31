<?php
use classes\Cookie;
use classes\MonetizationService;
use classes\T;
?>

// todo сюда внести общую часть настроек переменных для игр
const chooseFile = "'<?= T::S('Choose file') ?>'";
document.documentElement.style.setProperty('--choose-file', chooseFile);

const INVITE_FRIEND_PROMPT = '<?= T::S('invite_friend_prompt') ?>';
const GAME_BOT_URL = '<?= T::S('game_bot_url') ?>';
const LOADING_TEXT = '<?= T::S('loading_text') ?>';
const errorServerMessage = '<?= T::S('Server connecting error. Please try again')?>';
const STATS_GET_ERROR = '<?= T::S('Stats getting error')?>';
const ANONYM_AVATAR_URL = '<?= StatsController::ANONYM_AVATAR_URL ?>';

const YOU = 'you';

const ALARM_MODE = 'Alarm';
const OTJAT_MODE = 'Otjat';
const INACTIVE_MODE = 'Inactive';
const NAJATO_MODE = 'Najatie';
const NAVEDENO_MODE = 'Navedenie';

var preloaderObject = false;
var lastComment = false;

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
const NICKNAME_SVG = BASE_URL + 'players/nickname?nickname=';
const CARD_COUNTER_SVG = BASE_URL + 'players/counter?counter=';

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

var digitHeight = () => buttonHeight * 0.5 / (buttonHeightKoef < 1 ? 0.5 : 1);
var digitWidth = () => buttonHeight * 0.23 * 0.5 / (buttonHeightKoef < 1 ? 0.5 : 1);
var timerDigitHeight = () => buttonHeight * 0.5 / (buttonHeightKoef < 1 ? 0.8 : 1);
var timerDigitWidth = () => buttonHeight * 0.4 * 0.5 / (buttonHeightKoef < 1 ? 0.8 : 1);
var dvoetochWidth = () => buttonHeight * 0.15 * 0.5 / (buttonHeightKoef < 1 ? 0.8 : 1);
var timerDigitStep = () => dvoetochWidth() / 2;
