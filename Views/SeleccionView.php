<?php

class SeleccionView {
    public function renderSeleccion($selecciones, $isAdmin) {
        require_once  'Views/templates/SeleccionList.phtml';
    }

    public function showJugadoresdeSeleccion($jugadores) {
        require_once  'Views/templates/JugadoresPorSeleccionList.phtml';
    }

    public function showAddForm(){
        require  'Views/templates/SeleccionAdd.phtml';
    }

    public function showEditForm($seleccion){
        require  'Views/templates/SeleccionEdit.phtml';
    }

    public function confirmDeleteSeleccion($seleccion){
        require  'Views/templates/confirmDeleteSeleccion.phtml';
    }
}


?>