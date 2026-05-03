<?php

    class SeleccionModel {
        private $db;

        public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=bd_album_mundial;charset=utf8', 'root', '');
        }


        public function getAll() {
            $query = $this->db->prepare('SELECT * FROM seleccion');
            $query->execute();

            return $query->fetchAll(PDO::FETCH_OBJ);
        }
        

        public function getById($id_seleccion) {
            $query = $this->db->prepare('
        SELECT j.*, s.pais
        FROM jugador j
        JOIN seleccion s ON j.id_seleccion = s.id_seleccion
        WHERE s.id_seleccion = ?
    ');
        $query->execute([$id_seleccion]);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    }
?>