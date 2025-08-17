<?php
use classes\Cookie;use classes\Steam;
?>
//
async function fetchGlobal(script, param_name = '', param_data = '') {
    if (pageActive == 'hidden' && gameState == 'chooseGame' && script === STATUS_CHECKER_SCRIPT) {
        return {message: "Выберите параметры игры", http_status: BAD_REQUEST, status: "error"};
    }

    if (!requestToServerEnabled && script === STATUS_CHECKER_SCRIPT) {
        return {message: errorServerMessage, http_status: BAD_REQUEST, status: "error"};
    }

    if (script === SUBMIT_SCRIPT) {
        isSubmitResponseAwaining = true;
    }

    if (!commonId && script === STATUS_CHECKER_SCRIPT && isTgBot()) {
        param_name = '';
        param_data = 'tg_authorize=true&' + TG.initData;
    }

    requestToServerEnabled = false;
    requestToServerEnabledTimeout = setTimeout(
        function () {
            requestToServerEnabled = true;
            isSubmitResponseAwaining = false;
        },
        isSubmitResponseAwaining
            ? 1000
            : 500
    )

    if (pageActive != 'hidden') {
        requestSended = true;
        requestTimestamp = (new Date()).getTime();
    }

    if (useLocalStorage) {
        return await fetchGlobalYowser(script, param_name, param_data);
    } else {
        return await fetchGlobalNominal(script, param_name, param_data);
    }
}

async function fetchGlobalMVC(urlPart, param_name, param_data) {
    const response = await fetch(
        BASE_URL + urlPart,
        {
            method: 'POST', // *GET, POST, PUT, DELETE, etc.
            mode: 'cors', // no-cors, *cors, same-origin
            cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
            credentials: 'include', // include, *same-origin, omit
            headers: {
                //'Content-Type': 'application/json'
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: (param_name !== '' ? param_name + '=' + encodeURIComponent(JSON.stringify(param_data)) : param_data)
        }
    );

    requestSended = false;

    if (response.status === BAD_REQUEST || response.status === PAGE_NOT_FOUND) {
        return {message: response.statusText, status: "error", http_status: response.status};
    }

    if (!response.ok) {
        console.log(`An error has occured: ${response.status}`);
        return {message: errorServerMessage, status: "error"};
    }

    return await response.json(); // parses JSON response into native JavaScript objects
}

function commonParams() {
    return 'queryNumber='
        + (queryNumber++)
        + '&lang='
        + lang
        + '&game_id='
        + (gameNumber ? gameNumber : 0)
        + '&gameState='
        + gameState
        + (pageActive == 'hidden' ? '&page_hidden=true' : '')
        + ('hash' in webAppInitDataUnsafe ? ('&tg_hash=' + webAppInitDataUnsafe.hash) : '')
        + ('user' in webAppInitDataUnsafe && 'id' in webAppInitDataUnsafe.user ? ('&tg_id=' + webAppInitDataUnsafe.user.id) : '')
        + (uniqID ? ('&yandex_user_id=' + encodeURIComponent(uniqID)) : '')
        + (isYandexAuthorized ? '&yandex_authorized=1' : '&yandex_authorized=0');
}

async function fetchGlobalNominal(script, param_name, param_data) {
    const response = await fetch(BASE_URL
        + script
        + '?'
        + commonParams(),
        {
            method: 'POST', // *GET, POST, PUT, DELETE, etc.
            mode: 'cors', // no-cors, *cors, same-origin
            cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
            credentials: 'include', // include, *same-origin, omit
            headers: {
                //'Content-Type': 'application/json'
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            //redirect: 'follow', // manual, *follow, error
            //referrerPolicy: 'no-referrer', // no-referrer, *client
            body: (param_name != '' ? param_name + '=' + encodeURIComponent(JSON.stringify(param_data)) : param_data) //JSON.stringify(data) // body data type must match "Content-Type" header
        }
    );

    requestSended = false;

    if (response.status === BAD_REQUEST || response.status === PAGE_NOT_FOUND) {
        return {message: response.statusText, status: "error", http_status: response.status};
    }

    if (!response.ok) {
        console.log(`An error has occured: ${response.status}`);

        if (isYandexAppGlobal()) {
            getLocalStorageValue('<?= Cookie::COOKIE_NAME ?>')
        }

        return {message: errorServerMessage, status: "error"};
    }

    return await response.json(); // parses JSON response into native JavaScript objects
}

// todo ...
async function fetchGlobalYowser(script, param_name, param_data) {
    const response = await fetch('yowser'
        + '?cooki='
        + localStorage.erudit_user_session_ID
        + '&script='
        + script
        + '&'
        + commonParams(),
        {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            credentials: 'include',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: (param_name != ''
                ? param_name + '=' + encodeURIComponent(JSON.stringify(param_data))
                : param_data)
        }
    );

    requestSended = false;

    if (response.status === BAD_REQUEST || response.status === PAGE_NOT_FOUND) {
        return {message: response.statusText, status: "error", http_status: response.status};
    }

    if (!response.ok) {
        console.log(`An error has occured: ${response.status}`);
        return {message: errorServerMessage, status: "error"};
    }

    return await response.json();
}

if (<?= Steam::isSteamApp() ?>) {
    const originalXMLHttpRequest = window.XMLHttpRequest;
    cacheXML = {};
    // Создаем новый класс, который расширяет оригинальный XMLHttpRequest
    class ElectronXMLHttpRequest extends originalXMLHttpRequest {
        // Регистрируем получение файла из API
        done(filePath, data) {
            cacheXML[filePath].buffer = data;
            console.log(cacheXML[filePath].buffer);
            //delete window.cacheXML[this.filePath];

            cacheXML[filePath].onload;
            //delete cacheXML[filePath];
        }

        // Переопределяем метод open
        open(method, url, async, user, password) {
            if(url.indexOf('field_source6.svg') > -1) {
                console.log(`XMLHttpRequest dropped open: ${method} ${url}`);
                this.filePath = 'img/sudoku/field_source6.svg';
                cacheXML[this.filePath] = this;
                return;
            }

            super.open(method, url, async, user, password);
        }

        get status() {
            if (this.filePath && this.buffer) {
                return 200;
            }
            if (this.filePath && !this.buffer) {
                return 0;
            }

            return super.status;
        }

        get response() {
            console.log(this.buffer)
            if (this.filePath && this.buffer) {

                return atob(this.buffer); // atob возвращает \r\n вместо перевода строки - портится файл. нужен другой способ
            }
            if (this.filePath && !this.buffer) {
                return '';
            }

            return super.response;
        }

        get readyState() {
            if (this.filePath && this.buffer) {
                return 4;
            }
            if (this.filePath && !this.buffer) {
                return 0;
            }

            return super.readyState;
        }

        // Переопределяем метод send
        send(body) {
            if (this.filePath) {

                window.electronAPI.getFile(this.filePath, this.done);

                return;
            }

            // Иначе отправляем запрос как обычно
            super.send(body);
        }
    }

    // Перехватываем вызов конструктора XMLHttpRequest
    window.XMLHttpRequest = ElectronXMLHttpRequest;
}
