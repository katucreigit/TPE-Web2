<?php

class SeleccionView {
    public function renderSeleccion($selecciones) {
        require_once  'View/templates/SeleccionList.phtml';
    }

    public function showJugadoresdeSeleccion($jugadores) {
        require_once  'View/templates/JugadoresPorSeleccionList.phtml';
    }
}


?>