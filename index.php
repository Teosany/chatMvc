<?php
session_start();

spl_autoload_register(static function ($fqcn): void {
    $path = sprintf('%s.php', str_replace(['App', '\\'], [__DIR__, '/'], $fqcn));

    require_once $path;
});

define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

use App\controllers\ChatController;
use App\controllers\LoginController;
use App\controllers\SearchController;

if (isset($_GET['action'])) {
    $params = explode('/', $_GET['action']);
    error_log($_GET['action']);
}

if (isset($params[1])) {
    $method = $params[1];

    if ($params[0] === 'login') {
        $oController = new LoginController();
    } elseif ($params[0] === 'chat') {
        $oController = new ChatController();
    } else {
        $oController = new SearchController();
    }

    if (method_exists($oController, $method)) {
        if (isset($params[2])) {
            $oController->$method($params[2]);
        } else {
            if (isset($_POST['search'])) {
                $oController->$method($_POST);
            } elseif ($params[0] === 'search') {
                $oController->$method(',');
            } else {
                $oController->$method();
            }
        }
    } else {
        http_response_code(404);
        echo "La page recherchée n'existe pas";
    }
} elseif (isset($_POST['message'])) {
    $chatController = new ChatController();

    date_default_timezone_set('Europe/Paris');
    $date = date("d/m/Y H:i:s");

    $chatController->updateChat($_SESSION['userid'], $_SESSION['roomId'], $_POST['message'], $_POST['name'], $_SESSION['color'], $date);

    header('Content-Type: application/json; charset=utf-8');
    $response = array('color' => $_SESSION['color'], 'date' => $date);

    echo json_encode($response);
} else {
    $oController = new LoginController();

    $oController->login();
}
