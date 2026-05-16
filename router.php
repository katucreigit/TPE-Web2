<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'Controllers/JugadorController.php';
require_once 'Controllers/SeleccionController.php';
require_once 'Controllers/LoginController.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$action = 'jugadores';

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch ($params[0]) {
    case 'jugadores':
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
            $controller->getJugadoresPorSeleccion($params[1]);
        } else {
            $this->errorView->render("No se ha encontrado una seleccion .");
            return;
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
    case 'logout':
            $controller = new LoginController();
            $controller->logout();
            break;
    case 'delete':
        $controller = new JugadorController();
        $controller->delete($params[1]);
        break;
    case 'confirmDelete':
        $controller = new JugadorController();
        $controller->confirmDelete($params[1]);
        break;
    case 'edit':
        $controller = new JugadorController();
        $controller->edit();
        break;
    case 'formEdit':
        $controller = new JugadorController();
        $controller->showEditForm($params[1]);
        break;
    case 'add':
        $controller = new JugadorController();
        $controller->add();
        break;
    case 'formAdd':
        $controller = new JugadorController();
        $controller->showAddForm();
        break;
    case 'formAddSeleccion':
        $controller = new SeleccionController();
        $controller->showAddForm();
        break;
    case 'addSeleccion':
        $controller = new SeleccionController();
        $controller->addSeleccion();
        break;
    case 'formEditSeleccion':
        $controller = new SeleccionController();
        $controller->showEditForm($params[1]);
        break;
    case 'editSeleccion':
        $controller = new SeleccionController();
        $controller->editSeleccion();
        break;
    case 'confirmDeleteSeleccion':
        $controller = new SeleccionController();
        $controller->confirmDeleteSeleccion($params[1]);
        break;
    case 'deleteSeleccion':
        $controller = new SeleccionController();
        $controller->deleteSeleccion($params[1]);
        break;
    default:
        echo '404 error';
        break;
}

?>