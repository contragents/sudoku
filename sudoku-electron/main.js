require('dotenv').config();

const DOMAIN = process.env.DOMAIN; // '5-5.su'; //'sudoku.box'; // '5-5.su'; // todo На релизе поставить sudoku.box
var isOnline = true;
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
        console.log('Internet connection is active');
    } else {
        isOnline = false;
        console.log('No Internet');
    }
});

const version = '1.0.0.3';
const {app, BrowserWindow, ipcMain} = require('electron/main');
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

    console.log('current_language', lang);
    console.log('available_game_languages', client.apps.availableGameLanguages());

    // /!\ Those 3 lines are important for Steam compatibility!
    app.commandLine.appendSwitch("in-process-gpu");
    app.commandLine.appendSwitch("disable-direct-composition");
    app.allowRendererProcessReuse = false;
} catch (e) {
    isSteam = false;
    errorMessage = 'no_steam_app';
    lang = false;
    console.log('Steam app not loaded');
}

function handleCloseApp(event, param) {
    app.quit();
}

var createWindow = true;

createWindow = () => {
    if (isOnline && isSteam) {
        const win = new BrowserWindow({
            webPreferences: {
                preload: path.join(__dirname, 'preload.js')
            },
            icon: path.join(__dirname, '/img/sudoku-coin.png'),
            autoHideMenuBar: true, // todo включать на релизе - НУЖНО!
        })

        win.setBackgroundColor("#719998")
        win.setFullScreen(true)
        const url = `https://${DOMAIN}/sudoku/?app=steam`
            + '&steamId64=' + steamId64
            + '&playerName=' + encodeURIComponent(playerName)
            + '&l=' + lang
            + curVersion();
        win.loadURL(url);
    } else {
        const win = new BrowserWindow({
            webPreferences: {
                preload: path.join(__dirname, 'preload.js')
            },
            icon: path.join(__dirname, '/img/sudoku-coin.png'),
            autoHideMenuBar: true, // todo включать на релизе - НУЖНО!
        });
        win.setBackgroundColor("#719998");
        // win.setFullScreen(true) // при ошибке открываем уменьшенное окно
        win.loadURL(path.join(__dirname, 'no_internet.html')
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


app.whenReady().then(() => {
    if (!lang) {
        const systemLanguage = app.getLocale();
        console.log('System language:', systemLanguage);

        if (systemLanguage in languages.icu) {
            lang = languages.icu[systemLanguage];
        } else {
            lang = 'en';
        }
    }

    createWindow();
    app.on('activate', () => {
        if (BrowserWindow.getAllWindows().length === 0) {
            createWindow();
        }
    })

    ipcMain.on('close-app', handleCloseApp);

    var scriptsAsked = {};

    const fs = require('fs');
    ipcMain.on('get-file', (event, filePath) => {
        fs.readFile(filePath, (err, data) => {
            if (err) {
                console.log(err);
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
            console.log(filePath, 'Duplicate script query!');
        }
    });

    ipcMain.on('get-style', (event, filePath) => {
        if (!(filePath in scriptsAsked)) {
            scriptsAsked[filePath] = true;
            const fileData = fs.readFileSync(filePath, "utf8");
            event.sender.send('style-from-main', filePath, fileData ? fileData : '');
        } else {
            console.log(filePath, 'Duplicate style query!');
        }
    });
});

function curVersion() {
    return '&version=' + version;
}