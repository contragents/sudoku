var isOnline = true;
var errorMessage = 'no_internet';
var lang = false;

const net = require('net');

function checkInternetConnection(callback) {
    // const socket = net.createConnection(53, '8.8.8.8');
    const socket = net.createConnection(443, 'sudoku.box');

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
        console.log('Internet-connection is active');
    } else {
        isOnline = false;
        console.log('No Internet');
    }
});

const version = '1.0.0.3';
const {app, BrowserWindow, ipcMain} = require('electron/main')
const path = require('node:path')
const {languages} = require('./locale.js')
try {
    const steamworks = require("steamworks.js")

    const client = steamworks.init()
    var playerName = client.localplayer.getName()
    var steamId64 = client.localplayer.getSteamId().steamId64

    const steamLang = client.apps.currentGameLanguage();
    if (steamLang in languages) {
        lang = languages[steamLang];
    } else {
        lang = 'en';
    }

    //lang = languages['turkish']; // todo remove on release

    console.log('current_language', lang)
    console.log('available_game_languages', client.apps.availableGameLanguages())
    // /!\ Those 3 lines are important for Steam compatibility!
    app.commandLine.appendSwitch("in-process-gpu")
    app.commandLine.appendSwitch("disable-direct-composition")
    app.allowRendererProcessReuse = false
} catch (e) {
    isOnline = false;
    errorMessage = 'no_steam_app';
    lang = false;
}

function handleCloseApp(event, param) {
    app.quit();
}

var createWindow = true;

//isOnline = false; // todo remove line afret tests

if (isOnline) {
    createWindow = () => {
        const win = new BrowserWindow({
            webPreferences: {
                preload: path.join(__dirname, 'preload.js')
            },
            icon: path.join(__dirname, '/img/sudoku-coin.png'/*'images/sudoku-coin-128.ico'*/) // Укажите путь к вашей иконке
            // autoHideMenuBar: true, // todo включить на релизе
        })

        win.setBackgroundColor("#719998")
        win.setFullScreen(true)
        const url = 'https://sudoku.box/sudoku/?app=steam'
            + '&steamId64=' + steamId64
            + '&playerName=' + encodeURIComponent(playerName)
            + '&l=' + lang
            + curVersion();
        console.log(url);
        win.loadURL(url)
    }
} else {
    createWindow = () => {
        const win = new BrowserWindow({
            webPreferences: {
                preload: path.join(__dirname, 'preload.js')
            },
            // autoHideMenuBar: true, // todo включить на релизе - НУЖНО!
        })
        //win.setBackgroundColor("#719998")
        // win.setFullScreen(true) // todo включить на релизе - а нужно??
        win.loadURL(path.join(__dirname, 'no_internet.html?')
            + '&l=' + languages['turkish'/*lang*/] // hard select language
            + curVersion()
            + '&message='
            + encodeURIComponent(languages.phrases[errorMessage].get(lang))
            + '&ok='
            + encodeURIComponent(languages.phrases.ok_button_caption.get(lang))
            + '&title='
            + encodeURIComponent(languages.phrases.title.get(lang))
        )
    }
}

app.whenReady().then(() => {
    if (!lang) {
        const systemLanguage = app.getLocale();
        console.log('System language:', systemLanguage);

        if (systemLanguage in languages.icu) {
            lang = languages.icu[systemLanguage];
            console.log("ICU language found: ", lang);
        } else {
            lang = 'ru'; // todo change to "en" on release
            console.log("Default language set: ", lang);
        }
        console.log("errorMessage", errorMessage);
        console.log(languages.phrases[errorMessage].get(lang));
        lang = 'zh-cn';
    }

    createWindow()
    app.on('activate', () => {
        if (BrowserWindow.getAllWindows().length === 0) createWindow()
    })

    ipcMain.on('close-app', handleCloseApp);

    const fs = require('fs');
    ipcMain.on('get-file', (event, filePath) => {
        fs.readFile(filePath, (err, data) => {
            if (err) {
                console.log(err);
                event.sender.send('file-from-main', filePath, false);
            } else {
                console.log(data);
                event.sender.send('file-from-main', filePath, data);
            }
        });
    });

})

const fs = require('fs');

async function readBinaryFile(filePath) {
    let res = await fs.readFile(filePath, (err, data) => {
        if (err) {
            console.log(err);
            return false;
        }
        return data.toString('base64');
    });

    return res;
}

function curVersion() {
    return '&version=' + version;
}