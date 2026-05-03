<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'controller/JugadorController.php';
require_once 'Controller/SeleccionController.php';
require_once 'controller/LoginController.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$action = 'listado';

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch ($params[0]) {

    case 'listado':
        $controller = new JugadorController();
        $controller->getAll();
        break;

    case 'detalle':
        $controller = new JugadorController();
        $controller->getById($params[1]);
        break;

    case 'selecciones':
        $controller = new SeleccionController();
        $controller->getAll();
        break;

    case 'jugadoresPorSeleccion':
        $controller = new SeleccionController();
        if (!empty($params[1])) {
            $controller->getById($params[1]);
        } else {
            echo "Falta ID de selección";
        }
        break;
    case 'login':
        $controller = new LoginController();
        $controller->showLogin();
        break;
    case 'verificar':
        $controller = new LoginController();
        $controller->verificar();
        break;
    case 'hash':
        echo password_hash('admin', PASSWORD_DEFAULT);
        break;
    case 'logout':
            $controller = new LoginController();
            $controller->logout();
            break;
    default:
        echo '404 error';
        break;
}

?>