<?php

    class LoginModel {
        private $db;

        public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=bd_album_mundial;charset=utf8', 'root', '');
        }

    public function getUser($username) {
        $query = $this->db->prepare('SELECT * FROM usuario WHERE username = ?');
        $query->execute([$username]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
}