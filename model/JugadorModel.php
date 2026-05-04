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

        public function add($id_jugador, $nombre, $posicion, $numero, $peso, $altura, $fecha_nacimiento, $id_seleccion, $foto_jugador) {
            $query = $this->db->prepare('INSERT INTO jugador(id_jugador, nombre, posicion, numero, peso, altura, fecha_nacimiento, id_seleccion, foto_jugador) VALUES(?,?,?,?,?,?,?,?,?,?)');
            $query->execute([$id_jugador, $nombre, $posicion, $numero, $peso, $altura, $fecha_nacimiento, $id_seleccion, $foto_jugador]);
            return $this->db->lastInsertId();
        }

        public function edit($id_jugador, $nombre, $posicion, $numero, $peso, $altura, $fecha_nacimiento, $id_seleccion, $foto_jugador) {
            $query = $this->db->prepare('UPDATE jugador SET nombre = ?, posicion = ?, numero = ?, peso = ?, altura = ?, fecha_nacimiento = ?, id_seleccion = ?, foto_jugador = ?,  WHERE id_jugador = ?');
            return $query->execute([$id_jugador, $nombre, $posicion, $numero, $peso, $altura, $fecha_nacimiento, $id_seleccion, $foto_jugador]);
        }

        public function delete($id_jugador) {
            $query = $this->db->prepare('DELETE FROM jugador WHERE id_jugador = ?');
            $query->execute([$id_jugador]);
        }
    }

?>