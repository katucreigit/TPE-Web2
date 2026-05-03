<?php
require_once __DIR__ . '/../model/JugadorModel.php';
require_once __DIR__ . '/../view/JugadorView.php';
require_once __DIR__ . '/../controller/BaseController.php';

class JugadorController extends BaseController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new JugadorModel();
        $this->view = new JugadorView();
    }

    public function getAll() {
        $jugadores = $this->model->getAll();
        $this->view->renderJugador($jugadores);
    }
    

    public function getById($id_jugador) {
        $jugador = $this->model->getById($id_jugador);

        if (!$jugador) {
            echo "Jugador no encontrado";
        return;
        }

        $this->view->showJugador($jugador);
    }
}
?>