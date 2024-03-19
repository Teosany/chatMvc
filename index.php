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
        error_log('a');
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
        if (isset($params[2])) {
            $oController->$method($params[2]);
        } else {
            if (isset($_POST)) {
                $oController->$method($_POST);
            } else {
                $oController->$method();
            }
        }
    } else {
        http_response_code(404);
        echo "La page recherchée n'existe pas";
    }
} elseif (isset($_POST['message'])) {
    $chatController = new chatController();

    date_default_timezone_set('Europe/Paris');
    $date = date("d/m/Y H:i:s");

    $chatController->updateChat($_SESSION['userid'], $_SESSION['roomId'], $_POST['message'], $_POST['name'], $_SESSION['color'], $date);

    header('Content-Type: application/json; charset=utf-8');
    $response = array('color' => $_SESSION['color'], 'date' => $date);

    echo json_encode($response);
} else {
    $oController = new loginController();

    $oController->login();
}