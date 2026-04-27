<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'controller/JugadorController.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$action = 'listado';

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

$controller = new JugadorController();

switch ($params[0]) {
    case 'listado':
        $controller->getAll();
        break;

    case 'detalle':
        $controller->getById($params[1]);
        break;
    
    default:
        echo '404 error';
        break;
}

?>