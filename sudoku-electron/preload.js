const { contextBridge, ipcRenderer } = require('electron/renderer')

contextBridge.exposeInMainWorld('electronAPI', {
    closeApp: (param) => ipcRenderer.send('close-app', param),
})
