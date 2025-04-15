<?php
require_once __DIR__ . '/../models/Frequencia.php';

class FrequenciaController {
    public function registrar() {
        $cpf = $_POST['cpf'] ?? '';

        if (empty($cpf)) {
            $GLOBALS['erro'] = "Por favor, informe o CPF do aluno.";
            return;
        }

        try {
            $frequencia = new Frequencia();
            if ($frequencia->registrar($cpf)) {
                $GLOBALS['mensagem'] = "Frequência registrada com sucesso!";
            } else {
                $GLOBALS['erro'] = "Erro ao registrar frequência. Verifique o CPF.";
            }
        } catch (Exception $e) {
            $GLOBALS['erro'] = "Erro: " . $e->getMessage();
        }
    }

    public function listar() {
        $frequencia = new Frequencia();
        return $frequencia->listar();
    }
}