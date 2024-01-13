<?php
use classes\Config;

include_once __DIR__ . '/autoload.php';

//if (Config::isDev()) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
//}

$path = parse_url($_SERVER['REQUEST_URI'])['path'];
$pathParts = explode('/', $path);
if (strpos($pathParts[1], 'ndex.php')) {
    header('HTTP/1.0 403 Forbidden');

    echo 'Доступ запрещен';
    exit();
}

if (count($pathParts) >= 2) {
    $controller = ucfirst($pathParts[1]) . 'Controller';
    $action = $pathParts[2] ?: $controller::DEFAULT_ACTION;

    if (is_callable([$controller, $action . 'Action'])) {
        print (new $controller($action, $_REQUEST))->Run();
    } else {
        header('HTTP/1.0 403 Forbidden');
        echo 'Доступ запрещен';
    }
} else {
    header('HTTP/1.0 403 Forbidden');
    echo 'Доступ запрещен';
}

exit();

