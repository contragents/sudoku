// window.cacheXML = {};
const {contextBridge, ipcRenderer} = require('electron/renderer');

contextBridge.exposeInMainWorld('electronAPI', {
    closeApp: (param) => ipcRenderer.send('close-app', param),
    getFile: (filePath, callback) => {
        ipcRenderer.send('get-file', filePath);
        ipcRenderer.on('file-from-main', (event, filePathBack, data) => {
            //console.log(window.cacheXML);
            //window.cacheXML[filePath].buffer = data;
            //window.cacheXML[filePath].done(); // Uncaught TypeError: caller.onLoad is not a function
            callback(filePathBack, data);
        });
    },
})
