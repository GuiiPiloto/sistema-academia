<?php
require_once __DIR__ . '/../../config/database.php';

class Pagamento {
    private $conn;
    public $id_aluno;
    public $valor;
    public $data_vencimento;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function cadastrar() {
        $stmt = $this->conn->prepare("INSERT INTO pagamentos (id_aluno, valor, data_vencimento) 
                                      VALUES (:id_aluno, :valor, :data_vencimento)");
        $stmt->execute([
            'id_aluno' => $this->id_aluno,
            'valor' => $this->valor,
            'data_vencimento' => $this->data_vencimento
        ]);
        return $stmt->rowCount() > 0;
    }

    public function listar() {
        $stmt = $this->conn->prepare("SELECT p.*, a.nome AS nome_aluno 
                                      FROM pagamentos p 
                                      LEFT JOIN alunos a ON p.id_aluno = a.id_aluno");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function marcarComoPago($id_pagamento) {
        $stmt = $this->conn->prepare("UPDATE pagamentos SET status = 'Pago' WHERE id_pagamento = :id");
        $stmt->execute(['id' => $id_pagamento]);
        return $stmt->rowCount() > 0;
    }
}