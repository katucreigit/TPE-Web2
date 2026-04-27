<?php

class JugadorView {
    public function renderJugador($jugadores) {
        require_once __DIR__ . '/templates/JugadorList.phtml';
    }

    public function showJugador($jugador) {
        require __DIR__ . '/templates/JugadorDetail.phtml';
    }
}


?>
