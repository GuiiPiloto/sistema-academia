<?php
require_once __DIR__ . '/../../config/database.php';

class Plano {
    private $conn;
    public $nome;
    public $valor;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function cadastrar() {
        $stmt = $this->conn->prepare("INSERT INTO planos (nome, valor) VALUES (:nome, :valor)");
        $stmt->execute([
            'nome' => $this->nome,
            'valor' => $this->valor
        ]);
        return $stmt->rowCount() > 0;
    }

    public function listar() {
        $stmt = $this->conn->prepare("SELECT * FROM planos");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}