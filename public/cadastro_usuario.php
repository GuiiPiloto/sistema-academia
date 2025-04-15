<?php
require_once __DIR__ . '/../src/models/Usuario.php';

$mensagem = '';
$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $cpf = $_POST['cpf'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $data_cadastro = $_POST['data_cadastro'] ?? '';

    if (empty($nome) || empty($email) || empty($senha) || empty($cpf) || empty($telefone) || empty($data_cadastro)) {
        $erro = "Por favor, preencha todos os campos.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Email inválido.";
    } else {
        try {
            $usuario = new Usuario();
            $usuario->nome = $nome;
            $usuario->email = $email;
            $usuario->senha = password_hash($senha, PASSWORD_DEFAULT);
            $usuario->cpf = $cpf;
            $usuario->telefone = $telefone;
            $usuario->data_cadastro = $data_cadastro;

            if ($usuario->cadastrar()) {
                $mensagem = "Usuário cadastrado com sucesso! Redirecionando para o login...";
                header("Refresh: 2; url=/sistema-academia/public/index.php");
            } else {
                $erro = "Erro ao cadastrar usuário. Tente novamente.";
            }
        } catch (Exception $e) {
            $erro = "Erro: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário - Sistema de Academia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://lancamentosrj.com/wp-content/uploads/2023/12/Academias-Em-Copacabana-f1.jpg') no-repeat center center fixed;
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

        .cadastro-container {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 380px; /* Reduzido ainda mais */
            padding: 20px; /* Reduzido o padding */
            background: #FFFFFF;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h2 {
            color: #5C4033;
            font-weight: 600;
            font-size: 1.5rem; /* Reduzido mais */
            text-align: center;
            margin-bottom: 15px; /* Reduzido o espaço */
            letter-spacing: 0.5px;
        }

        .form-label {
            color: #5C4033;
            font-weight: 500;
            font-size: 0.9rem; /* Reduzido mais */
            letter-spacing: 0.5px;
            margin-bottom: 3px; /* Reduzido o espaço */
        }

        .input-group {
            position: relative;
            margin-bottom: 10px; /* Reduzido ainda mais */
        }

        .input-group i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #FF6F61;
            font-size: 0.9rem; /* Reduzido mais */
            z-index: 10;
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 6px; /* Bordas menores */
            padding: 8px 8px 8px 30px; /* Reduzido mais o padding */
            font-size: 0.85rem; /* Reduzido mais o tamanho da fonte */
            letter-spacing: 0.5px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            position: relative;
        }

        .form-control:focus {
            border-color: #007BFF;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
            outline: none;
        }

        .form-control:focus ~ .underline::after {
            width: 100%;
        }

        .underline {
            position: relative;
            display: block;
            height: 1px; /* Reduzido a espessura */
            background: transparent;
        }

        .underline::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 1px;
            background: #007BFF;
            transition: width 0.3s ease;
        }

        .btn-primary {
            background: #007BFF;
            border: none;
            border-radius: 6px;
            padding: 10px; /* Reduzido mais */
            font-weight: 500;
            font-size: 0.9rem; /* Reduzido mais */
            letter-spacing: 0.5px;
            width: 100%;
            transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-primary:hover {
            background: #0056b3;
            transform: scale(1.03);
            box-shadow: 0 3px 10px rgba(0, 123, 255, 0.4);
        }

        .text-center {
            margin-top: 10px; /* Reduzido o espaço */
        }

        .text-center a {
            color: #007BFF;
            text-decoration: none;
            font-weight: 500;
            letter-spacing: 0.5px;
            font-size: 0.85rem; /* Reduzido mais */
        }

        .text-center a:hover {
            text-decoration: underline;
        }

        .alert-success {
            background-color: #e6ffed;
            color: #28a745;
            border: 1px solid #28a745;
            border-radius: 6px;
            margin-bottom: 10px; /* Reduzido mais */
            letter-spacing: 0.5px;
            font-size: 0.85rem; /* Reduzido mais */
            padding: 8px; /* Reduzido o padding */
        }

        .alert-danger {
            background-color: #ffe6e6;
            color: #DC3545;
            border: 1px solid #DC3545;
            border-radius: 6px;
            margin-bottom: 10px; /* Reduzido mais */
            letter-spacing: 0.5px;
            font-size: 0.85rem; /* Reduzido mais */
            padding: 8px; /* Reduzido o padding */
        }

        @media (max-width: 576px) {
            .cadastro-container {
                margin: 10px;
                padding: 15px;
            }

            h2 {
                font-size: 1.2rem;
            }

            .btn-primary {
                padding: 8px;
                font-size: 0.85rem;
            }

            .form-control {
                padding: 6px 6px 6px 25px;
                font-size: 0.8rem;
            }

            .input-group i {
                left: 6px;
                font-size: 0.8rem;
            }

            .form-label {
                font-size: 0.85rem;
            }

            .alert-success, .alert-danger {
                font-size: 0.8rem;
                padding: 6px;
            }

            .text-center a {
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="cadastro-container">
        <h2>Cadastro de Usuário</h2>
        <?php if ($mensagem): ?>
            <div class="alert alert-success"><?= htmlspecialchars($mensagem) ?></div>
        <?php endif; ?>
        <?php if ($erro): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <div class="input-group">
                    <i class="bi bi-person"></i>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                    <span class="underline"></span>
                </div>
            </div>
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
            <div class="mb-3">
                <label for="cpf" class="form-label">CPF</label>
                <div class="input-group">
                    <i class="bi bi-card-text"></i>
                    <input type="text" class="form-control" id="cpf" name="cpf" maxlength="14" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" placeholder="000.000.000-00" required>
                    <span class="underline"></span>
                </div>
            </div>
            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone</label>
                <div class="input-group">
                    <i class="bi bi-telephone"></i>
                    <input type="text" class="form-control" id="telefone" name="telefone" maxlength="15" pattern="\(\d{2}\)\s\d{5}-\d{4}" placeholder="(DD) 99999-9999" required>
                    <span class="underline"></span>
                </div>
            </div>
            <div class="mb-3">
                <label for="data_cadastro" class="form-label">Data de Cadastro</label>
                <div class="input-group">
                    <i class="bi bi-calendar"></i>
                    <input type="date" class="form-control" id="data_cadastro" name="data_cadastro" required>
                    <span class="underline"></span>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
        <div class="text-center">
            <p>Já tem uma conta? <a href="/sistema-academia/public/index.php">Faça login</a></p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Máscara para CPF
        document.getElementById('cpf').addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, ''); // Remove tudo que não é dígito
            if (value.length > 11) value = value.substring(0, 11); // Limita a 11 dígitos
            value = value.replace(/(\d{3})(\d)/, '$1.$2'); // Adiciona o primeiro ponto
            value = value.replace(/(\d{3})(\d)/, '$1.$2'); // Adiciona o segundo ponto
            value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2'); // Adiciona o traço
            e.target.value = value;
        });

        // Máscara para Telefone
        document.getElementById('telefone').addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, ''); // Remove tudo que não é dígito
            if (value.length > 11) value = value.substring(0, 11); // Limita a 11 dígitos
            value = value.replace(/(\d{2})(\d)/, '($1) $2'); // Adiciona os parênteses e espaço
            value = value.replace(/(\d{5})(\d)/, '$1-$2'); // Adiciona o traço
            e.target.value = value;
        });
    </script>
</body>
</html>