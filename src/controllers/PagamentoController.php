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

    public function marcarComoPago() {
        $id_pagamento = $_POST['mark_paid_id'] ?? '';

        try {
            $pagamento = new Pagamento();
            if ($pagamento->marcarComoPago($id_pagamento)) {
                $GLOBALS['mensagem'] = "Pagamento marcado como pago!";
            } else {
                $GLOBALS['erro'] = "Erro ao marcar pagamento como pago.";
            }
        } catch (Exception $e) {
            $GLOBALS['erro'] = "Erro: " . $e->getMessage();
        }
    }
}