<?php
require_once __DIR__ . '/../../config/database.php';

class Usuario {
    private $conn;
    public $nome;
    public $email;
    public $senha;
    public $cpf;
    public $telefone;
    public $data_cadastro;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function cadastrar() {
        $stmt = $this->conn->prepare("SELECT id_usuario FROM usuarios WHERE email = :email OR cpf = :cpf");
        $stmt->execute(['email' => $this->email, 'cpf' => $this->cpf]);
        if ($stmt->rowCount() > 0) {
            throw new Exception("Email ou CPF já cadastrado.");
        }

        $stmt = $this->conn->prepare("INSERT INTO usuarios (nome, email, senha, cpf, telefone, data_cadastro) 
                                      VALUES (:nome, :email, :senha, :cpf, :telefone, :data_cadastro)");
        $stmt->execute([
            'nome' => $this->nome,
            'email' => $this->email,
            'senha' => $this->senha,
            'cpf' => $this->cpf,
            'telefone' => $this->telefone,
            'data_cadastro' => $this->data_cadastro
        ]);
        return $stmt->rowCount() > 0;
    }

    public function login($email, $senha) {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            return $usuario;
        }
        return false;
    }
}