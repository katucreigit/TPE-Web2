<?php
require_once __DIR__ . '/../Models/JugadorModel.php';
require_once __DIR__ . '/../Views/JugadorView.php';
require_once __DIR__ . '/../Controllers/BaseController.php';
require_once __DIR__ . '/../Models/SeleccionModel.php';
require_once __DIR__ . '/../Views/ErrorView.php';

class JugadorController extends BaseController {
    private $model;
    private $view;
    private $seleccionModel;
    private $errorView;

    public function __construct() {
        $this->model = new JugadorModel();
        $this->view = new JugadorView();
        $this->seleccionModel = new SeleccionModel();
        $this->errorView = new ErrorView();
    }

    public function getAll() {
        $jugadores = $this->model->getAll();
        $selecciones = $this->seleccionModel->getAll();
        $isAdmin = isset($_SESSION['usuario']);

        $this->view->renderJugador($jugadores, $selecciones, $isAdmin);
    }

    public function getById($id_jugador) {
        $jugador = $this->model->getById($id_jugador);

        if (!$jugador) {
            $this->errorView->render("El jugador no existe.");
        return;
        }

        $this->view->showJugador($jugador);
    }

    public function add() {
        $this->checkLoggedIn();

        if (!isset($_POST['nombre']) || empty($_POST['nombre']) ||
            !isset($_POST['posicion']) || empty($_POST['posicion']) ||
            !isset($_POST['numero']) || empty($_POST['numero']) ||
            !isset($_POST['peso']) || empty($_POST['peso']) ||
            !isset($_POST['altura']) || empty($_POST['altura']) ||
            !isset($_POST['fecha_nacimiento']) || empty($_POST['fecha_nacimiento']) ||
            !isset($_POST['id_seleccion']) || empty($_POST['id_seleccion']) ||
            !isset($_POST['foto_jugador']) || empty($_POST['foto_jugador'])) {

            $this->errorView->render("Por favor, completa todos los campos del formulario para agregar un jugador.");
            return;
        }

        $nombre = $_POST['nombre'];
        $posicion = $_POST['posicion'];
        $numero = $_POST['numero'];
        $peso = $_POST['peso'];
        $altura = $_POST['altura'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $id_seleccion = $_POST['id_seleccion'];
        $foto_jugador = $_POST['foto_jugador'];

        $id_jugador = $this->model->add($nombre, $posicion, $numero, $peso, $altura, $fecha_nacimiento, $id_seleccion, $foto_jugador);

        if (empty($id_jugador)) {
            $this->errorView->render("No se pudo guardar el jugador. Verifique que los datos sean correctos o intente más tarde.");
            return;
        }
        header("Location: " . BASE_URL );
        exit;
    }
    public function showAddForm() {
        $this->checkLoggedIn();
        $selecciones = $this->seleccionModel->getAll();
        $this->view->showAddForm($selecciones);
    }

    public function edit() {
        $this->checkLoggedIn();

        if (!isset($_POST['nombre']) || empty($_POST['nombre']) ||
            !isset($_POST['posicion']) || empty($_POST['posicion']) ||
            !isset($_POST['numero']) || empty($_POST['numero']) ||
            !isset($_POST['peso']) || empty($_POST['peso']) ||
            !isset($_POST['altura']) || empty($_POST['altura']) ||
            !isset($_POST['fecha_nacimiento']) || empty($_POST['fecha_nacimiento']) ||
            !isset($_POST['id_seleccion']) || empty($_POST['id_seleccion']) ||
            !isset($_POST['foto_jugador']) || empty($_POST['foto_jugador'])) {

            $this->errorView->render("Por favor, completa todos los campos del formulario para editar un jugador.");
            return;
        }

        $id_jugador = $_POST['id_jugador'];
        $nombre = $_POST['nombre'];
        $posicion = $_POST['posicion'];
        $numero = $_POST['numero'];
        $peso = $_POST['peso'];
        $altura = $_POST['altura'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $id_seleccion = $_POST['id_seleccion'];
        $foto_jugador = $_POST['foto_jugador'];

        $this->model->edit($id_jugador, $nombre, $posicion, $numero, $peso, $altura, $fecha_nacimiento, $id_seleccion, $foto_jugador);

        header("Location: " . BASE_URL);
        exit;
    }

    public function showEditForm($id_jugador) {
        $this->checkLoggedIn();
        $jugador = $this->model->getById($id_jugador);
        $selecciones = $this->seleccionModel->getAll();
        $this->view->showEditForm($jugador, $selecciones);
    }
    

    public function confirmDelete($id_jugador) {
        $this->checkLoggedIn();

        $jugador = $this->model->getById($id_jugador);

        if (!$jugador) {
            $this->errorView->render("El jugador no fue encontrado.");
            return;
        }
        $this->view->renderConfirmDelete($jugador);
    }
    public function delete($id_jugador){
        $this->checkLoggedIn();
        $this->model->delete($id_jugador);

        header("Location: " . BASE_URL );
        exit;
    }
}
?>