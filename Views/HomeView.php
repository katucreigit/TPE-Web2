<?php

class HomeView{
    public function renderHome(){
        require __DIR__ . '/Views/JugadorView.php';
        require __DIR__ . '/Views/SeleccionView.php';
    }
}