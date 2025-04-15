<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Aluno - Sistema de Academia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background: #F5E9DD;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100%;
            background: #FF6F61;
            padding-top: 20px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        .sidebar h3 {
            color: #000000;
            font-weight: 600;
            text-align: center;
            margin-bottom: 30px;
            letter-spacing: 1px;
        }

        .sidebar a {
            color: #000000;
            padding: 15px 20px;
            text-decoration: none;
            display: flex;
            align-items: center;
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: background 0.3s ease;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        .sidebar a:hover {
            background-color: #FF8A80;
        }

        .hamburger {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            font-size: 1.5rem;
            color: #5C4033;
            cursor: pointer;
            z-index: 1100;
        }

        .close-btn {
            display: none;
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 1.5rem;
            color: #FFFFFF;
            cursor: pointer;
        }

        .main-content {
            margin-left: 250px;
            padding: 40px;
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

        .form-control, select.form-control {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 12px 12px 12px 40px;
            font-size: 1rem;
            letter-spacing: 0.5px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            position: relative;
        }

        .form-control:focus, select.form-control:focus {
            border-color: #007BFF;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
            outline: none;
        }

        .form-control:focus ~ .underline::after,
        select.form-control:focus ~ .underline::after {
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

        .no-icon {
            padding: 12px;
        }

        .btn-primary {
            background: #007BFF;
            border: none;
            border-radius: 10px;
            padding: 14px;
            font-weight: 500;
            font-size: 1.1rem;
            letter-spacing: 1px;
            transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-primary:hover {
            background: #0056b3;
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.4);
        }

        .alert-success {
            background-color: #e6fffa;
            color: #0d4f4f;
            border: 1px solid #0d4f4f;
            border-radius: 10px;
            margin-bottom: 25px;
            letter-spacing: 0.5px;
        }

        .alert-danger {
            background-color: #ffe6e6;
            color: #DC3545;
            border: 1px solid #DC3545;
            border-radius: 10px;
            margin-bottom: 25px;
            letter-spacing: 0.5px;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 250px;
                height: 100%;
                position: fixed;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            .hamburger {
                display: block;
            }

            .close-btn {
                display: block;
            }

            h2 {
                font-size: 1.5rem;
            }

            .form-control, select.form-control {
                padding: 10px 10px 10px 35px;
                font-size: 0.9rem;
            }

            .no-icon {
                padding: 10px;
            }

            .input-group i {
                left: 10px;
                font-size: 1rem;
            }

            .btn-primary {
                padding: 12px;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="hamburger">
        <i class="bi bi-list"></i>
    </div>
    <div class="sidebar">
        <div class="close-btn">
            <i class="bi bi-x"></i>
        </div>
        <h3>Sistema de Academia</h3>
        <a href="/sistema-academia/public/index.php?page=dashboard"><i class="bi bi-house-door"></i> Dashboard</a>
        <a href="/sistema-academia/public/index.php?page=alunos_cadastro"><i class="bi bi-person-plus"></i> Cadastrar Aluno</a>
        <a href="/sistema-academia/public/index.php?page=alunos_lista"><i class="bi bi-person-lines-fill"></i> Lista de Alunos</a>
        <a href="/sistema-academia/public/index.php?page=planos_cadastro"><i class="bi bi-file-earmark-plus"></i> Cadastrar Plano</a>
        <a href="/sistema-academia/public/index.php?page=planos_lista"><i class="bi bi-file-earmark-text"></i> Lista de Planos</a>
        <a href="/sistema-academia/public/index.php?page=pagamentos_cadastro"><i class="bi bi-currency-dollar"></i> Registrar Pagamento</a>
        <a href="/sistema-academia/public/index.php?page=pagamentos_lista"><i class="bi bi-receipt"></i> Lista de Pagamentos</a>
        <a href="/sistema-academia/public/index.php?page=frequencia_registro"><i class="bi bi-calendar-check"></i> Registrar Frequência</a>
        <a href="/sistema-academia/public/index.php?page=frequencias_lista"><i class="bi bi-list-check"></i> Lista de Frequências</a>
        <a href="/sistema-academia/public/index.php?page=logout"><i class="bi bi-box-arrow-right"></i> Sair</a>
    </div>
    <div class="main-content">
        <h2>Cadastrar Aluno</h2>
        <?php if (isset($mensagem)): ?>
            <div class="alert alert-success"><?= htmlspecialchars($mensagem) ?></div>
        <?php endif; ?>
        <?php if (isset($erro)): ?>
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
                <label for="id_plano" class="form-label">Plano</label>
                <select class="form-control no-icon" id="id_plano" name="id_plano" required>
                    <option value="">Selecione um plano</option>
                    <?php foreach ($planos as $plano): ?>
                        <option value="<?= $plano['id_plano'] ?>"><?= htmlspecialchars($plano['nome']) ?></option>
                    <?php endforeach; ?>
                    <span class="underline"></span>
                </select>
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
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const hamburger = document.querySelector('.hamburger');
        const sidebar = document.querySelector('.sidebar');
        const closeBtn = document.querySelector('.close-btn');

        hamburger.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });

        closeBtn.addEventListener('click', () => {
            sidebar.classList.remove('active');
        });
    </script>

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