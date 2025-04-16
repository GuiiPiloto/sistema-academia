<?php
require_once __DIR__ . '/../models/Pagamento.php';

class PagamentoController {
    public function cadastrar() {
        $id_aluno = $_POST['id_aluno'] ?? '';
        $valor = $_POST['valor'] ?? '';
        $data_vencimento = $_POST['data_vencimento'] ?? '';

        if (empty($id_aluno) || empty($valor) || empty($data_vencimento)) {
            $GLOBALS['erro'] = "Por favor, preencha todos os campos.";
            return;
        }

        try {
            $pagamento = new Pagamento();
            $pagamento->id_aluno = $id_aluno;
            $pagamento->valor = $valor;
            $pagamento->data_vencimento = $data_vencimento;

            if ($pagamento->cadastrar()) {
                $GLOBALS['mensagem'] = "Pagamento registrado com sucesso!";
            } else {
                $GLOBALS['erro'] = "Erro ao registrar pagamento.";
            }
        } catch (Exception $e) {
            $GLOBALS['erro'] = "Erro: " . $e->getMessage();
        }
    }

    public function listar() {
        $pagamento = new Pagamento();
        return $pagamento->listar();
    }

    public function excluir() {
        $id_pagamento = $_POST['delete_id'] ?? '';
    
        try {
            $pagamento = new Pagamento();
            if ($pagamento->excluir($id_pagamento)) {
                $_SESSION['mensagem'] = "Pagamento excluído com sucesso!";
                header("Location: index.php?page=pagamentos_lista");
                exit;
            } else {
                $_SESSION['erro'] = "Falha ao excluir o pagamento.";
            }
        } catch (Exception $e) {
            $_SESSION['erro'] = "Erro: " . $e->getMessage();
        }
    } 
}