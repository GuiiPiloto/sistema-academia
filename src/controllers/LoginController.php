<?php
require_once __DIR__ . '/../models/Usuario.php';

class LoginController {
    public function login() {
        if (isset($_POST['email']) && isset($_POST['senha'])) {
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $usuarioModel = new Usuario();
            $usuario = $usuarioModel->login($email, $senha);

            if ($usuario) {
                session_start();
                $_SESSION['usuario_id'] = $usuario['id_usuario'];
                $_SESSION['usuario_nome'] = $usuario['nome'];
                header("Location: /sistema-academia/public/index.php?page=dashboard");
                exit;
            } else {
                $GLOBALS['erro'] = "Email ou senha incorretos.";
            }
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: /sistema-academia/public/index.php");
        exit;
    }
}