<?php
class Database {
    private $host = "localhost";
    private $dbname = "academia_db";
    private $username = "root";
    private $password = "";
    private $conn;

    public function getConnection() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            echo "Erro na conexão: " . $e->getMessage();
            return null;
        }
    }
}