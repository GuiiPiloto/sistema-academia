<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Frequências - Sistema de Academia</title>
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

        .table {
            background: #FFFFFF;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .table th {
            background: #FF6F61;
            color: #FFFFFF;
            font-weight: 500;
            letter-spacing: 0.5px;
            padding: 15px;
        }

        .table td {
            padding: 15px;
            vertical-align: middle;
            letter-spacing: 0.5px;
            color: #5C4033;
        }

        .table tbody tr {
            transition: background 0.3s ease;
        }

        .table tbody tr:hover {
            background: linear-gradient(90deg, #FFF5E1 0%, #F5E9DD 100%);
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

        p {
            color: #5C4033;
            font-size: 1.1rem;
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

            .table th, .table td {
                padding: 10px;
                font-size: 0.9rem;
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
        <h2>Lista de Frequências</h2>
        <?php if (isset($mensagem)): ?>
            <div class="alert alert-success"><?= htmlspecialchars($mensagem) ?></div>
        <?php endif; ?>
        <?php if (isset($erro)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
        <?php endif; ?>
        <?php if (empty($frequencias)): ?>
            <p>Nenhuma frequência registrada.</p>
        <?php else: ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Aluno</th>
                        <th>Data de Entrada</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($frequencias as $frequencia): ?>
                        <tr>
                            <td><?= htmlspecialchars($frequencia['nome_aluno']) ?></td>
                            <td><?= htmlspecialchars($frequencia['data_entrada']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
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
</body>
</html>