<?php
require_once __DIR__ . '/../../config/database.php';

class Aluno {
    private $conn;
    public $nome;
    public $cpf;
    public $telefone;
    public $id_plano;
    public $data_cadastro;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function cadastrar() {
        $stmt = $this->conn->prepare("SELECT id_aluno FROM alunos WHERE cpf = :cpf");
        $stmt->execute(['cpf' => $this->cpf]);
        if ($stmt->rowCount() > 0) {
            throw new Exception("CPF já cadastrado.");
        }

        $stmt = $this->conn->prepare("INSERT INTO alunos (nome, cpf, telefone, id_plano, data_cadastro) 
                                      VALUES (:nome, :cpf, :telefone, :id_plano, :data_cadastro)");
        $stmt->execute([
            'nome' => $this->nome,
            'cpf' => $this->cpf,
            'telefone' => $this->telefone,
            'id_plano' => $this->id_plano,
            'data_cadastro' => $this->data_cadastro
        ]);
        return $stmt->rowCount() > 0;
    }

    public function listar() {
        $stmt = $this->conn->prepare("SELECT a.*, p.nome AS nome_plano 
                                      FROM alunos a 
                                      LEFT JOIN planos p ON a.id_plano = p.id_plano");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function excluir($id) {
        $stmt = $this->conn->prepare("SELECT * FROM pagamentos WHERE id_aluno = :id");
        $stmt->execute(['id' => $id]);
        if ($stmt->rowCount() > 0) {
            throw new Exception("Não é possível excluir o aluno. Existem pagamentos associados.");
        }

        $stmt = $this->conn->prepare("SELECT * FROM frequencias WHERE id_aluno = :id");
        $stmt->execute(['id' => $id]);
        if ($stmt->rowCount() > 0) {
            throw new Exception("Não é possível excluir o aluno. Existem frequências associadas.");
        }

        $stmt = $this->conn->prepare("DELETE FROM alunos WHERE id_aluno = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->rowCount() > 0;
    }
}