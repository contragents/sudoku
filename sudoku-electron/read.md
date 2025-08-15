Importing your project into Forge - установка билдера
npm install --save-dev @electron-forge/cli
npx electron-forge import

Установить онлайн-чекер
npm install is-online
Установить Windows api Steam
npm install steamworks.js

npm run start - просто запуск программы

npm run make
Создает .exe и другие файлы в каталоге ./out/sudoku_electron-win32-x64

Нужно скопировать *.dll из папки node_modules/steamworks.js/dist/win64 
в папку ./out/sudoku_electron-win32-x64/resources/app.asar.unpacked/node_modules/steamworks.js/dist/win64

Скопировать файл ./steam_appid.txt в папку ./out/sudoku_electron-win32-x64 - без него игра не запустится. не проверял из приложения стим

Для релиза на стиме подготовить папку ./out/sudoku_electron-win32-x64 (как?) - архив и в настройках сборки указать исполняемый .exe (partner.steam...)