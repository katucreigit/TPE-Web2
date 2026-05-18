<?php

require_once 'config.php';

class Model {
    protected $db;

    public function __construct() {
        try {
            $this->db = new PDO(
                "mysql:host=" . MYSQL_HOST . ";charset=utf8",
                MYSQL_USER,
                MYSQL_PASS
            );
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->db->query("CREATE DATABASE IF NOT EXISTS " . MYSQL_DB . " CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
            
            $this->db->query("USE " . MYSQL_DB);


            $this->_deploy();

        } catch (PDOException $e) {
            die("Error de conexión o base de datos: " . $e->getMessage());
        }
    }

    private function _deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        
        if(count($tables) == 0) {
            

            $sql = <<<END

            CREATE TABLE IF NOT EXISTS seleccion (
                id_seleccion INT AUTO_INCREMENT PRIMARY KEY,
                pais VARCHAR(100) NOT NULL,
                dt_seleccion VARCHAR(100),
                cant_mundiales_ganados INT DEFAULT 0,
                participaciones_totales INT DEFAULT 0,
                foto_seleccion VARCHAR(255)
            ) ENGINE=InnoDB;

            CREATE TABLE IF NOT EXISTS jugador (
                id_jugador INT AUTO_INCREMENT PRIMARY KEY,
                nombre VARCHAR(100) NOT NULL,
                posicion VARCHAR(50),
                numero INT,
                peso DECIMAL(5,2),
                altura DECIMAL(3,2),
                fecha_nacimiento DATE,
                id_seleccion INT,
                foto_jugador VARCHAR(255),
                FOREIGN KEY (id_seleccion) REFERENCES seleccion(id_seleccion) ON DELETE CASCADE
            ) ENGINE=InnoDB;

    
            INSERT INTO seleccion (id_seleccion, pais, dt_seleccion, cant_mundiales_ganados, participaciones_totales, foto_seleccion) 
            VALUES (1, 'Argentina', 'Lionel Scaloni', 3, 18, 'argentina.jpg');


            INSERT INTO jugador (nombre, posicion, numero, peso, altura, fecha_nacimiento, id_seleccion, foto_jugador) 
            VALUES ('Lionel Messi', 'Delantero', 10, 72, 1.70, '1987-06-24', 1, 'messi.jpg');
END;

            $this->db->query($sql);
        }
    }
}