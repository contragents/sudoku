const {contextBridge, ipcRenderer} = require('electron/renderer')

contextBridge.exposeInMainWorld('electronAPI', {
    closeApp: (param) => ipcRenderer.send('close-app', param),
    getFile: (filePath, caller) => {
        ipcRenderer.send('get-file', filePath);
        ipcRenderer.on('file-from-main', (event, data) => {
            console.log(caller);
            caller.buffer = data;
            caller.onLoad(); // Uncaught TypeError: caller.onLoad is not a function
        });
    },
})
