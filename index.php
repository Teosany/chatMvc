<?php
session_start();
function loadClass($class): void
{
    if (str_contains($class, 'Controller')) {
        require 'controllers/' . $class . '.php';
    }
    if (str_contains($class, 'Model')) {
        require 'models/' . $class . '.php';
    }
    if (str_contains($class, 'Database')) {
        require 'models/' . $class . '.php';
    }
}
spl_autoload_register('loadClass');

define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

if (isset($_GET['action'])) {
    $params = explode('/', $_GET['action']);
}

if (isset($params[1])) {
    $controller = $params[0] . "Controller";
    $method = $params[1];

    $oController = new $controller();

    if (method_exists($oController, $method)) {
        $oController->$method();
    } else {
        http_response_code(404);
        echo "La page recherchée n'existe pas";
    }
} else {
    $oController = new loginController();

    $oController->login();
}