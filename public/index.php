<?php
session_start();

$page = $_GET['page'] ?? '';

require_once __DIR__ . '/../src/controllers/LoginController.php';
require_once __DIR__ . '/../src/controllers/AlunoController.php';
require_once __DIR__ . '/../src/controllers/PlanoController.php';
require_once __DIR__ . '/../src/controllers/PagamentoController.php';
require_once __DIR__ . '/../src/controllers/FrequenciaController.php';

$loginController = new LoginController();
$alunosController = new AlunoController();
$planosController = new PlanoController();
$pagamentosController = new PagamentoController();
$frequenciaController = new FrequenciaController();

switch ($page) {
    case 'dashboard':
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /sistema-academia/public/index.php");
            exit;
        }
        require_once __DIR__ . '/../src/views/dashboard.php';
        break;

    case 'alunos_cadastro':
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /sistema-academia/public/index.php");
            exit;
        }
        $planos = $planosController->listar();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $alunosController->cadastrar();
        }
        require_once __DIR__ . '/../src/views/alunos_cadastro.php';
        break;

    case 'alunos_lista':
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /sistema-academia/public/index.php");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
            $alunosController->excluir();
        }
        $alunos = $alunosController->listar();
        require_once __DIR__ . '/../src/views/alunos_lista.php';
        break;

    case 'planos_cadastro':
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /sistema-academia/public/index.php");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $planosController->cadastrar();
        }
        require_once __DIR__ . '/../src/views/planos_cadastro.php';
        break;

    case 'planos_lista':
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /sistema-academia/public/index.php");
            exit;
        }
        $planos = $planosController->listar();
        require_once __DIR__ . '/../src/views/planos_lista.php';
        break;

    case 'pagamentos_cadastro':
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /sistema-academia/public/index.php");
            exit;
        }
        $alunos = $alunosController->listar();
        $pagamentos = $pagamentosController->listar();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pagamentosController->cadastrar();
        }
        require_once __DIR__ . '/../src/views/pagamentos_cadastro.php';
        break;

    case 'pagamentos_lista':
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /sistema-academia/public/index.php");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
            $pagamentosController->excluir();
        }
        $pagamentos = $pagamentosController->listar();
        require_once __DIR__ . '/../src/views/pagamentos_lista.php';
        break;

    case 'frequencia_registro':
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /sistema-academia/public/index.php");
            exit;
        }
        $frequencias = $frequenciaController->listar();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $frequenciaController->registrar();
        }
        require_once __DIR__ . '/../src/views/frequencia_registro.php';
        break;

    case 'frequencias_lista':
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /sistema-academia/public/index.php");
            exit;
        }
        $frequencias = $frequenciaController->listar();
        require_once __DIR__ . '/../src/views/frequencias_lista.php';
        break;

    case 'logout':
        $loginController->logout();
        break;

    default:
        if (isset($_SESSION['usuario_id'])) {
            header("Location: /sistema-academia/public/index.php?page=dashboard");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $loginController->login();
        }
        ?>
        <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Login - Sistema de Academia</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
            <style>
                body {
                    margin: 0;
                    font-family: 'Poppins', sans-serif;
                    background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://www.smartfit.com.br/news/wp-content/uploads/2024/03/Como-criar-o-habito-de-ir-para-a-academia-destaque.png') no-repeat center center fixed;
                    background-size: cover;
                    height: 100vh;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }

                body::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(0, 0, 0, 0.6);
                    z-index: 1;
                }

                .login-container {
                    position: relative;
                    z-index: 2;
                    width: 100%;
                    max-width: 450px;
                    padding: 40px;
                    background: #FFFFFF;
                    border-radius: 20px;
                    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
                    animation: fadeIn 0.5s ease-in-out;
                }

                @keyframes fadeIn {
                    from {
                        opacity: 0;
                        transform: translateY(20px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

                h2 {
                    color: #5C4033;
                    font-weight: 600;
                    font-size: 2rem;
                    text-align: center;
                    margin-bottom: 30px;
                    letter-spacing: 1px;
                }

                .form-label {
                    color: #5C4033;
                    font-weight: 500;
                    font-size: 1.1rem;
                    letter-spacing: 0.5px;
                    margin-bottom: 8px;
                }

                .input-group {
                    position: relative;
                    margin-bottom: 25px;
                }

                .input-group i {
                    position: absolute;
                    left: 15px;
                    top: 50%;
                    transform: translateY(-50%);
                    color: #FF6F61;
                    font-size: 1.2rem;
                    z-index: 1;
                    transition: transform 0.3s ease;
                }

                .input-group i:hover {
                    animation: pulse 0.6s infinite;
                }

                @keyframes pulse {
                    0% {
                        transform: translateY(-50%) scale(1);
                    }
                    50% {
                        transform: translateY(-50%) scale(1.2);
                    }
                    100% {
                        transform: translateY(-50%) scale(1);
                    }
                }

                .form-control {
                    border: 1px solid #ddd;
                    border-radius: 10px;
                    padding: 12px 12px 12px 40px;
                    font-size: 1rem;
                    letter-spacing: 0.5px;
                    transition: border-color 0.3s ease, box-shadow 0.3s ease;
                    position: relative;
                }

                .form-control:focus {
                    border-color: #007BFF;
                    box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
                    outline: none;
                }

                .form-control:focus ~ .underline::after {
                    width: 100%;
                }

                .underline {
                    position: relative;
                    display: block;
                    height: 2px;
                    background: transparent;
                }

                .underline::after {
                    content: '';
                    position: absolute;
                    bottom: 0;
                    left: 0;
                    width: 0;
                    height: 2px;
                    background: #007BFF;
                    transition: width 0.3s ease;
                }

                .btn-primary {
                    background: #007BFF;
                    border: none;
                    border-radius: 10px;
                    padding: 14px;
                    font-weight: 500;
                    font-size: 1.1rem;
                    letter-spacing: 1px;
                    width: 100%;
                    transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.2s ease;
                }

                .btn-primary:hover {
                    background: #0056b3;
                    transform: scale(1.05);
                    box-shadow: 0 5px 15px rgba(0, 123, 255, 0.4);
                }

                .text-center a {
                    color: #007BFF;
                    text-decoration: none;
                    font-weight: 500;
                    letter-spacing: 0.5px;
                }

                .text-center a:hover {
                    text-decoration: underline;
                }

                .alert-danger {
                    background-color: #ffe6e6;
                    color: #DC3545;
                    border: 1px solid #DC3545;
                    border-radius: 10px;
                    margin-bottom: 25px;
                    letter-spacing: 0.5px;
                }

                @media (max-width: 576px) {
                    .login-container {
                        margin: 20px;
                        padding: 25px;
                    }

                    h2 {
                        font-size: 1.5rem;
                    }

                    .btn-primary {
                        padding: 12px;
                        font-size: 1rem;
                    }

                    .form-control {
                        padding: 10px 10px 10px 35px;
                        font-size: 0.9rem;
                    }

                    .input-group i {
                        left: 10px;
                        font-size: 1rem;
                    }
                }
            </style>
        </head>
        <body>
            <div class="login-container">
                <h2>Login</h2>
                <?php if (isset($erro)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
                <?php endif; ?>
                <form method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <i class="bi bi-envelope"></i>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <span class="underline"></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <div class="input-group">
                            <i class="bi bi-lock"></i>
                            <input type="password" class="form-control" id="senha" name="senha" required>
                            <span class="underline"></span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Entrar</button>
                </form>
                <div class="text-center mt-4">
                    <p>Não tem uma conta? <a href="/sistema-academia/public/cadastro_usuario.php">Cadastre-se</a></p>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
        <?php
        break;
}