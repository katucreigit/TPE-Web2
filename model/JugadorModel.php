<?php

    class JugadorModel {
        private $db;

        public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=bd_album_mundial;charset=utf8', 'root', '');
        }


        public function getAll() {
            $query = $this->db->prepare('SELECT j.id_jugador, j.nombre, s.pais AS Seleccion
                                        FROM jugador j
                                        JOIN seleccion s ON j.id_seleccion = s.id_seleccion');
            $query->execute();

            return $query->fetchAll(PDO::FETCH_OBJ);
        }
        

        public function getById($id_jugador) {
            $query = $this->db->prepare(' SELECT j.*, s.pais AS Seleccion
                                            FROM jugador j
                                            JOIN seleccion s ON j.id_seleccion = s.id_seleccion
                                            WHERE j.id_jugador = ?');
            $query->execute([$id_jugador]);

            return $query->fetch(PDO::FETCH_OBJ);
        }

    }
?>