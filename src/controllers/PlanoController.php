<?php
require_once __DIR__ . '/../models/Plano.php';

class PlanoController {
    public function cadastrar() {
        $nome = $_POST['nome'] ?? '';
        $valor = $_POST['valor'] ?? '';

        if (empty($nome) || empty($valor)) {
            $GLOBALS['erro'] = "Por favor, preencha todos os campos.";
            return;
        }

        try {
            $plano = new Plano();
            $plano->nome = $nome;
            $plano->valor = $valor;

            if ($plano->cadastrar()) {
                $GLOBALS['mensagem'] = "Plano cadastrado com sucesso!";
            } else {
                $GLOBALS['erro'] = "Erro ao cadastrar plano.";
            }
        } catch (Exception $e) {
            $GLOBALS['erro'] = "Erro: " . $e->getMessage();
        }
    }

    public function listar() {
        $plano = new Plano();
        return $plano->listar();
    }
}