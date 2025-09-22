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

Готовим релиз:
Все файлы и папки с ресурсами удаляются из папки ./out/sudoku_electron-win32-x64 - нужно после команды npm run make откатить изменения в коммите 

Для релиза на стиме подготовить папку ./out/sudoku_electron-win32-x64 - заархивировать все файлы и подпапки внутри этой папки в .zip архив - архив
В настройках сборки указан исполняемый .exe sudoku_electron.exe (partner.steam...)

Проверить файл out/sudoku_electron-win32-x64/.env - 
ENV=prod - рабочая версия 
ENV=dev - режим разработки, log() выводит логи

Проверить файл out/sudoku_electron-win32-x64/steam_appid.txt
SUDOKU полная версия - id приложения стим 3841140
SUDOKU DEMO-версия - id приложения стим 4048410