<?php
require_once  'Models/SeleccionModel.php';
require_once  'Views/SeleccionView.php';
require_once 'Controllers/BaseController.php';

class SeleccionController extends BaseController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new SeleccionModel();
        $this->view = new SeleccionView();
    }

    public function getAll() {
        $selecciones = $this->model->getAll();
        $isAdmin = isset($_SESSION['usuario']);
        $this->view->renderSeleccion($selecciones, $isAdmin);
    }
    

    public function getById($id_seleccion) {
        $jugadores = $this->model->getById($id_seleccion);

        if (empty($jugadores)) {
            $this->errorView->render("No se ha encontrado esta seleccion.");n;
        return;
        }

        $this->view->showJugadoresdeSeleccion($jugadores);
    }
    
    public function addSeleccion() {

        $this->checkLoggedIn();

        if(!isset($_POST['pais']) || empty($_POST['pais']) || !isset($_POST['dt_seleccion']) || empty($_POST['dt_seleccion']) || !isset($_POST['cant_mundiales_ganados']) || $_POST['cant_mundiales_ganados'] === '' || !isset($_POST['participaciones_totales']) || $_POST['participaciones_totales'] === '' || !isset($_POST['foto_seleccion']) || empty($_POST['foto_seleccion'])){
            $this->errorView->render("Por favor, completa todos los campos del formulario para añadir una seleccion.");
            return;
        }

        $pais= $_POST['pais'];
        $dt_seleccion = $_POST['dt_seleccion'];
        $cant_mundiales_ganados = $_POST['cant_mundiales_ganados'];
        $participaciones_totales= $_POST['participaciones_totales'];
        $foto_seleccion = $_POST['foto_seleccion'];
        
        $id_seleccion = $this->model->addSeleccion($pais, $dt_seleccion, $cant_mundiales_ganados, $participaciones_totales, $foto_seleccion);

        if (!$id_seleccion) {
            $this->errorView->render("Error al insertar, no se ha encontrado una seleccion.");
            return;
        }
        header("Location: " . BASE_URL );
        exit;
    }

    public function showAddForm() {
        $this->checkLoggedIn();
        $this->view->showAddForm();
    }

    public function showEditForm($id_seleccion){
        $this->checkLoggedIn();
        $seleccion = $this->model->getById($id_seleccion);
        $this->view->showEditForm($seleccion);
    }

    public function editSeleccion(){
        $this->checkLoggedIn();

        if(!isset($_POST['pais']) || empty($_POST['pais']) || !isset($_POST['dt_seleccion']) || empty($_POST['dt_seleccion']) || !isset($_POST['cant_mundiales_ganados']) || $_POST['cant_mundiales_ganados'] === '' || !isset($_POST['participaciones_totales']) || $_POST['participaciones_totales'] === '' || !isset($_POST['foto_seleccion']) || empty($_POST['foto_seleccion'])){
            $this->errorView->render("Por favor, completa todos los campos del formulario para editar una seleccion.");
            return;
        }

        $id_seleccion = $_POST['id_seleccion'];
        $pais= $_POST['pais'];
        $dt_seleccion = $_POST['dt_seleccion'];
        $cant_mundiales_ganados = $_POST['cant_mundiales_ganados'];
        $participaciones_totales= $_POST['participaciones_totales'];
        $foto_seleccion = $_POST['foto_seleccion'] ;

        $this->model->editSeleccion($id_seleccion, $pais, $dt_seleccion, $cant_mundiales_ganados, $participaciones_totales, $foto_seleccion);

        header("Location: " . BASE_URL);
        exit;
    }

    public function confirmDeleteSeleccion($id_seleccion){
        $this->checkLoggedIn();

        $seleccion = $this->model->getById($id_seleccion);

        
        $this->view->confirmDeleteSeleccion($seleccion);
    }

    public function deleteSeleccion($id_seleccion){
        
        $this->checkLoggedIn();

        $this->model->deleteSeleccion($id_seleccion);

        header("Location: " . BASE_URL );
        exit;
    }
}
?>