<?php

use classes\Config;

if (preg_match('#^/(bot|calc|web3)/#', $_SERVER['REQUEST_URI'])) {
    include_once __DIR__ . '/../invest.legal/index.php';

    exit;
}

include_once __DIR__ . '/autoload.php';

!defined('ROOT_DIR') ? define('ROOT_DIR', __DIR__) : '';

if (Config::isDev()) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

$path = parse_url($_SERVER['REQUEST_URI'])['path'];
$pathParts = explode('/', $path);
if (strpos($pathParts[1], 'ndex.php')) {
    header('HTTP/1.0 403 Forbidden');

    echo 'Access denied';
    exit();
}

$controller = ($pathParts[1] ?? false)
    ? (ucfirst($pathParts[1]) . 'Controller')
    : BaseController::DEFAULT_CONTROLLER;
$action = $pathParts[2] ?? $controller::DEFAULT_ACTION;
$subAction = $pathParts[3] ?? '';

if (class_exists($controller) && method_exists($controller, $action . 'Action')) {
    $res = (new $controller(
        $action, $_REQUEST + ($subAction ? [BaseController::SUB_ACTION_PARAM => $subAction] : [])
    ))->Run();

    print is_array($res) ? json_encode($res, JSON_UNESCAPED_UNICODE) : $res;
} else {
    header('HTTP/1.0 403 Forbidden');
    echo 'Access denied';
}

exit();

