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
        $query = $this->db->prepare("SELECT * FROM seleccion WHERE id_seleccion= ?");
        $query->execute([$id_seleccion]);

        return $query->fetch(PDO::FETCH_OBJ);
    }

        public function addSeleccion($pais, $dt_seleccion, $cant_mundiales_ganados, $participaciones_totales, $foto_seleccion){
            $query = $this->db->prepare("INSERT INTO seleccion (pais, dt_seleccion, cant_mundiales_ganados, participaciones_totales, foto_seleccion) VALUES (?, ?, ?, ?, ?)");
            $query->execute([$pais, $dt_seleccion, $cant_mundiales_ganados, $participaciones_totales, $foto_seleccion]);
            return $this->db->lastInsertId();

        }

        public function editSeleccion($id_seleccion,$pais, $dt_seleccion, $cant_mundiales_ganados, $participaciones_totales, $foto_seleccion ){
            
            $query = $this->db->prepare("UPDATE seleccion SET pais= ?, dt_seleccion= ?, cant_mundiales_ganados= ?, participaciones_totales=?, foto_seleccion = ? WHERE id_seleccion = ?");
            $query->execute ([$pais, $dt_seleccion, $cant_mundiales_ganados, $participaciones_totales, $foto_seleccion,$id_seleccion]);
            
        }

        public function deleteSeleccion($id_seleccion){
            $query= $this->db->prepare ("DELETE FROM seleccion WHERE id_seleccion = ?");
            $query->execute([$id_seleccion]);
        }
    }
?>