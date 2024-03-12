<?php
// Débute ou récupère une session
session_start();

// Class autoloader
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

// Racine du site ( C:/wamp/www/chatmvc/ )
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

// On sépare les paramètres et on les met dans le tableau $params
// Vérifier la présence du fichier .htaccess à la racine du site.
$params = explode('/', $_GET['action']);
error_log($params[0]);

// Si au moins 1 paramètre existe
if (isset($params[1])) {
    // On sauvegarde le 1er paramètre dans $controller
    // puis, on lui en ajoute le suffixe Controller.
    $controller = $params[0] . "Controller";

    // On sauvegarde le 2ème paramètre dans $method si il existe, sinon index
    $method = $params[1];

    // On appelle le controlleur correspondant
//     error_log(ROOT . 'controllers/' . $controller . '.php');
    // On instancie la classe correspondante
    $oController = new $controller();

    // On vérifie si la méthode existe bien dans la classe
    if (method_exists($oController, $method)) {
        // On appelle la méthode $method du controleur $controller
        $oController->$method();
    } else {
        // On envoie le code réponse 404
        http_response_code(404);
        echo "La page recherchée n'existe pas";
        echo $params[2];
    }
} else {
    // Ici aucun paramètre n'est défini
    // On appelle le contrôleur par défaut : loginController

    // On instancie le contrôleur
    $oController = new loginController();
//    error_log(print_r($_POST, true));

    // On appelle la méthode login
    $oController->loginIndex();
}