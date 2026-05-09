<?php

class SeleccionView {
    public function renderSeleccion($selecciones) {
        require_once  'Views/templates/SeleccionList.phtml';
    }

    public function showJugadoresdeSeleccion($jugadores) {
        require_once  'Views/templates/JugadoresPorSeleccionList.phtml';
    }
}


?>