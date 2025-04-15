<?php
require_once __DIR__ . '/../../config/database.php';

class Frequencia {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function registrar($cpf) {
        $stmt = $this->conn->prepare("SELECT id_aluno FROM alunos WHERE cpf = :cpf");
        $stmt->execute(['cpf' => $cpf]);
        $aluno = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$aluno) {
            throw new Exception("Aluno não encontrado.");
        }

        $stmt = $this->conn->prepare("INSERT INTO frequencias (id_aluno, data_entrada) 
                                      VALUES (:id_aluno, NOW())");
        $stmt->execute(['id_aluno' => $aluno['id_aluno']]);
        return $stmt->rowCount() > 0;
    }

    public function listar() {
        $stmt = $this->conn->prepare("SELECT f.*, a.nome AS nome_aluno 
                                      FROM frequencias f 
                                      LEFT JOIN alunos a ON f.id_aluno = a.id_aluno 
                                      ORDER BY f.data_entrada DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}