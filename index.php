<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once __DIR__ . '/autoload.php';

$path = parse_url($_SERVER['REQUEST_URI'])['path'];
$pathParts = explode('/', $path);
if (count($pathParts) > 2 || strpos($pathParts[1], 'ndex.php')) {
    header('HTTP/1.0 403 Forbidden');

    echo 'Доступ запрещен';
    exit();
}

$emitentSN = $pathParts[1];
//print_r($_REQUEST);
if (!empty($_REQUEST['form_data'])) {
    $_REQUEST['form_data'] = json_decode($_REQUEST['form_data'], true);

    if (!empty($_REQUEST['form_data']['action'])) {
        print json_encode(
            (new EmitentController(
                $_REQUEST['form_data']['action'],
                array_merge($_REQUEST, ['emitent_short_name' => $emitentSN])
            ))->Run()
        );
    }
} elseif (!empty($_REQUEST['action'])) {
    print (new EmitentController($_REQUEST['action'], $_REQUEST))->Run();
} elseif (!empty($emitentSN)){
    print (new EmitentController('emitent', array_merge($_REQUEST, ['emitent_short_name' => $emitentSN])))->Run();
} else {
    print (new EmitentController('main', $_REQUEST))->Run();
}
