const {contextBridge, ipcRenderer} = require('electron/renderer');

contextBridge.exposeInMainWorld('electronAPI', {
    closeApp: (param) => ipcRenderer.send('close-app', param),
    getFile: (filePath, callback) => {
        ipcRenderer.send('get-file', filePath);
        ipcRenderer.on('file-from-main', (event, filePathBack, data) => {
            callback(filePathBack, data);
        });
    },
    // Новый метод, т.к. callback нельзя менять в процессе работы
    getScript: (filePath, callback) => {
        ipcRenderer.send('get-script', filePath);
        ipcRenderer.on('script-from-main', (event, filePathBack, data) => {
            callback(filePathBack, data);
        });
    },

    getStyle: (filePath, callback) => {
        ipcRenderer.send('get-style', filePath);
        ipcRenderer.on('style-from-main', (event, filePathBack, data) => {
            callback(filePathBack, data);
        });
    },
})
