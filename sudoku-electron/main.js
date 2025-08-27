require('dotenv').config();

const DOMAIN = process.env.DOMAIN; // '5-5.su' для локальной разработки, 'sudoku.box' - для PROD
var isOnline = null;
var isSteam = true;
var errorMessage = 'no_internet';
var lang = false;

const net = require('net');

function checkInternetConnection(callback) {
    const socket = net.createConnection(443, DOMAIN);

    socket.on('connect', () => {
        socket.end();
        callback(true);
    });

    socket.on('error', () => {
        socket.destroy();
        callback(false);
    });
}

checkInternetConnection((isConnected) => {
    if (isConnected) {
        isOnline = true;
        log('Internet connection is active');
    } else {
        isOnline = false;
        console.log('No Internet');
    }
});

const version = '1.0.0.3';
const {app, BrowserWindow, ipcMain, shell} = require('electron/main');
const path = require('node:path');
const {languages} = require('./locale.js');
try {
    const steamworks = require("steamworks.js");

    const client = steamworks.init();
    var playerName = client.localplayer.getName();
    var steamId64 = client.localplayer.getSteamId().steamId64;

    const steamLang = client.apps.currentGameLanguage();
    if (steamLang in languages) {
        lang = languages[steamLang];
    } else {
        lang = 'en';
    }

    log('current_language', lang);
    log('available_game_languages', client.apps.availableGameLanguages());

    // /!\ Those 3 lines are important for Steam compatibility!
    app.commandLine.appendSwitch("in-process-gpu");
    app.commandLine.appendSwitch("disable-direct-composition");
    app.allowRendererProcessReuse = false;
} catch (e) {
    isSteam = false;
    errorMessage = 'no_steam_app';
    lang = false;
    log('Steam app not loaded');
}

function handleCloseApp(event, param) {
    app.quit();
}

var createWindow = true;
var mainWindow = false;

createWindow = () => {
    if (isOnline && isSteam) {
        mainWindow = new BrowserWindow({
            webPreferences: {
                preload: path.join(__dirname, 'preload.js')
            },
            icon: path.join(__dirname, '/img/sudoku-coin.png'),
            autoHideMenuBar: true, // todo включать на релизе - НУЖНО!
        })

        mainWindow.setBackgroundColor("#719998")
        mainWindow.setFullScreen(true)
        const url = `https://${DOMAIN}/sudoku/?app=steam`
            + '&steamId64=' + steamId64
            + '&playerName=' + encodeURIComponent(playerName)
            + '&l=' + lang
            + curVersion();
        mainWindow.loadURL(url);
    } else {
        mainWindow = new BrowserWindow({
            webPreferences: {
                preload: path.join(__dirname, 'preload.js')
            },
            icon: path.join(__dirname, '/img/sudoku-coin.png'),
            autoHideMenuBar: true, // todo включать на релизе - НУЖНО!
        });
        mainWindow.setBackgroundColor("#719998");
        // win.setFullScreen(true) // при ошибке открываем уменьшенное окно
        mainWindow.loadURL(path.join(__dirname, 'no_internet.html')
            + '?'
            + 'message='
            + encodeURIComponent(languages.phrases[errorMessage].get(lang))
            + '&ok='
            + encodeURIComponent(languages.phrases.ok_button_caption.get(lang))
            + '&title='
            + encodeURIComponent(languages.phrases.title.get(lang))
        );
    }
}

function waitForIsOnlineChange(callback) {
    const intervalId = setInterval(() => {
        if (isOnline !== null) { // Проверяем, изменилась ли переменная
            clearInterval(intervalId); // Останавливаем проверку
            callback(); // Вызываем функцию обратного вызова с новым значением
        }
    }, 10); // Проверяем каждые 10 миллисекунд
}

app.whenReady().then(() => {
    if (!lang) {
        const systemLanguage = app.getLocale();
        log('System language:', systemLanguage);

        if (systemLanguage in languages.icu) {
            lang = languages.icu[systemLanguage];
        } else {
            lang = 'en';
        }
    }

    createW = function() {
        createWindow();
        app.on('activate', () => {
            if (BrowserWindow.getAllWindows().length === 0) {
                createWindow();
            }
        })
    }

    waitForIsOnlineChange(createW);

    ipcMain.on('close-app', handleCloseApp);

    var scriptsAsked = {};

    const fs = require('fs');
    ipcMain.on('get-file', (event, filePath) => {
        fs.readFile(filePath, (err, data) => {
            if (err) {
                log(err);
                event.sender.send('file-from-main', filePath, false);
            } else {
                event.sender.send('file-from-main', filePath, data);
            }
        });
    });

    ipcMain.on('get-script', (event, filePath) => {
        if (filePath === 'page_reload_event') {
            scriptsAsked = {};

            return;
        }

        if (!(filePath in scriptsAsked)) {
            scriptsAsked[filePath] = true;
            const fileData = fs.readFileSync(filePath, "utf8");
            event.sender.send('script-from-main', filePath, fileData ? fileData : '');
        } else {
            log(filePath, 'Duplicate script query!');
        }
    });

    ipcMain.on('get-style', (event, filePath) => {
        if (!(filePath in scriptsAsked)) {
            scriptsAsked[filePath] = true;
            const fileData = fs.readFileSync(filePath, "utf8");
            event.sender.send('style-from-main', filePath, fileData ? fileData : '');
        } else {
            log(filePath, 'Duplicate style query!');
        }
    });

    ipcMain.on('open-link', (event, link) => {
        shell.openExternal(link);
    });

    // События для всех окон приложения. Пока их только одно
    app.on('browser-window-focus', () => {
        log('Window get focus', 1);
        mainWindow.webContents.send('window-focus', 'visible');
    });

    app.on('browser-window-blur', () => {
        log('Window lost focus', 2);
        mainWindow.webContents.send('window-focus', 'hidden');
    });
});

function curVersion() {
    return '&version=' + version;
}

function log(...args) {
    if (process.env.ENV === 'dev') {
        console.log(...args);
    }
}