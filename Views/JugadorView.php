<?php

class JugadorView {
    public function renderJugador($jugadores, $selecciones, $isAdmin) {
        require_once __DIR__ . '/templates/JugadorList.phtml';
    }

    public function showJugador($jugador) {
        require __DIR__ . '/templates/JugadorDetail.phtml';
    }

    public function showEditForm($jugador, $selecciones){
        require __DIR__ . '/templates/JugadorEdit.phtml';
    }
    public function renderConfirmDelete($jugador) {
        require __DIR__ . '/templates/confirmDelete.phtml';
    }
    public function showAddForm($selecciones){
        require __DIR__ . '/templates/JugadorAdd.phtml';
    }
}


?>
