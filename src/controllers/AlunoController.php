<?php
require_once __DIR__ . '/../models/Aluno.php';

class AlunoController {
    public function cadastrar() {
        $nome = $_POST['nome'] ?? '';
        $cpf = $_POST['cpf'] ?? '';
        $telefone = $_POST['telefone'] ?? '';
        $id_plano = $_POST['id_plano'] ?? '';
        $data_cadastro = $_POST['data_cadastro'] ?? '';

        if (empty($nome) || empty($cpf) || empty($telefone) || empty($id_plano) || empty($data_cadastro)) {
            $GLOBALS['erro'] = "Por favor, preencha todos os campos.";
            return;
        }

        try {
            $aluno = new Aluno();
            $aluno->nome = $nome;
            $aluno->cpf = $cpf;
            $aluno->telefone = $telefone;
            $aluno->id_plano = $id_plano;
            $aluno->data_cadastro = $data_cadastro;

            if ($aluno->cadastrar()) {
                $GLOBALS['mensagem'] = "Aluno cadastrado com sucesso!";
            } else {
                $GLOBALS['erro'] = "Erro ao cadastrar aluno.";
            }
        } catch (Exception $e) {
            $GLOBALS['erro'] = "Erro: " . $e->getMessage();
        }
    }

    public function listar() {
        $aluno = new Aluno();
        return $aluno->listar();
    }

    public function excluir() {
        $id = $_POST['delete_id'] ?? '';

        try {
            $aluno = new Aluno();
            if ($aluno->excluir($id)) {
                $GLOBALS['mensagem'] = "Aluno excluído com sucesso!";
            } else {
                $GLOBALS['erro'] = "Erro ao excluir aluno.";
            }
        } catch (Exception $e) {
            $GLOBALS['erro'] = "Erro: " . $e->getMessage();
        }
    }
}