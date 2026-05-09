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
        $this->view->renderSeleccion($selecciones);
    }
    

    public function getById($id_seleccion) {
        $jugadores = $this->model->getById($id_seleccion);

        if (empty($jugadores)) {
            echo "No hay jugadores para esta seleccion";
        return;
        }

        $this->view->showJugadoresdeSeleccion($jugadores);
    }
    
    public function addSeleccion() {

        $this->checkLoggedIn();

        if(!isset($_POST['pais']) || empty($_POST['pais']) || !isset($_POST['dt_seleccion']) || empty($_POST['dt_seleccion']) || !isset($_POST['cant_mundiales_ganados']) || $_POST['cant_mundiales_ganados'] === '' || !isset($_POST['participaciones_totales']) || $_POST['participaciones_totales'] === '' ){
            echo 'Error: datos incompletos';
            return;
        }

        $pais= $_POST['pais'];
        $dt_seleccion = $_POST['dt_seleccion'];
        $cant_mundiales_ganados = $_POST['cant_mundiales_ganados'];
        $participaciones_totales= $_POST['participaciones_totales'];
        $foto_seleccion = $_POST['foto_seleccion'] ?? null;
        
        $id_seleccion = $this->model->addSeleccion($pais, $dt_seleccion, $cant_mundiales_ganados, $participaciones_totales, $foto_seleccion);

        if (!$id_seleccion) {
            echo 'Error al insertar';
            return;
        }
        header("Location: " . BASE_URL );
        exit;
    }
}
?>