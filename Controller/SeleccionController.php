<?php
require_once  'Model/SeleccionModel.php';
require_once  'View/SeleccionView.php';

class SeleccionController {
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

}
?>