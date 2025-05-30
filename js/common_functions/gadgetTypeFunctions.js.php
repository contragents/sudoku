//
function isAndroidAppGlobal() {
    if (getCookieGlobal('DEVICE') === 'Android') {
        return true;
    }

    if (getCookieGlobal('PRODUCT') === 'RocketWeb') {
        return true;
    }

    return window.location.href.indexOf('app=1') > -1;
}


function isVerstkaTestGlobal() {
    return window.location.href.indexOf('verstka=1') > -1;
}

function isPureSiteRoot() {
    return !(isVkAppGlobal() || isTgBot() || isAndroidAppGlobal() || isFbAppGlobal());
}

function isMobileDeviceGlobal() {
    const ua = navigator.userAgent;
    if (/(tablet|ipad|playbook|silk)|(android(?!.*mobi))/i.test(ua)) {
        return true;//tablet
    } else if (/Mobile|Android|iP(hone|od)|IEMobile|BlackBerry|Kindle|Silk-Accelerated|(hpw|web)OS|Opera M(obi|ini)/.test(ua)) {
        return true;//mobile
    }

    return false;
}

function isTabletDeviceGlobal() {
    const ua = navigator.userAgent;
    if (/(tablet|ipad|playbook|silk)|(android(?!.*mobi))/i.test(ua)) {
        return true;
    }

    return false;
}

function isFbAppGlobal() {
    return !!document.location.href.match('fbclid');
}

function isVkAppGlobal() {
    if (document.referrer === 'https://vk.com/') {
        return true;
    }

    if (document.location.href.match('api_url')) {
        return true;
    }

    return false;
}

function isYandexFakeGlobal() {
    if (document.location.href.match('yandex_test')) {
        return true;
    }

    if (window.location.href.indexOf('yandex_test') > -1) {
        return true;
    }

    return false;
}

function isYandexAppGlobal() {
    if (document.location.href.match('yandex')) {
        return true;
    }

    if (window.location.href.indexOf('yandex') > -1) {
        return true;
    }

    return false;
}

function getCookieGlobal(cookieName) {
    var results = document.cookie.match('(^|;) ?' + cookieName + '=([^;]*)(;|$)');

    if (results)
        return (unescape(results[2]));
    else
        return false;
}

function isIOSDevice() {
    if (/iPhone|iPad|iPod/i.test(navigator.userAgent)) {
        return true;
    }

    return false;
}
