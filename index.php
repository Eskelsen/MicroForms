<?php

session_start();

$_SESSION['csrf_key'] = bin2hex(random_bytes(32));

$_SESSION['idem_key'] = bin2hex(random_bytes(16));

$_SESSION['idem_set'][] = $_SESSION['idem_key'];

require_once 'app/helpers.php';
require_once 'app/Form.php';

?><!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>MicroForms – Formulário de Exemplo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        :root {
            --bg: #0f172a;
            --card: #111827;
            --border: #1f2933;
            --primary: #38bdf8;
            --primary-hover: #0ea5e9;
            --text: #e5e7eb;
            --muted: #9ca3af;
            --danger: #ef4444;
            --radius: 14px;
        }

        * {
            box-sizing: border-box;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Ubuntu, sans-serif;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, #020617, #020617 40%, #020617);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text);
        }

        .container {
            width: 100%;
            max-width: 820px;
            padding: 24px;
        }

        .card {
            background: radial-gradient(1200px circle at top, #0b1220, var(--card));
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 28px;
            box-shadow: 0 20px 60px rgba(0,0,0,.45);
        }

        h1 {
            margin: 0 0 6px;
            font-size: 1.8rem;
        }

        p.subtitle {
            margin: 0 0 28px;
            color: var(--muted);
        }

        form {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px 24px;
        }

        .full {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            font-size: .85rem;
            color: var(--muted);
            margin-bottom: 6px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 12px 14px;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: #020617;
            color: var(--text);
            outline: none;
            transition: border .2s, box-shadow .2s;
        }

        textarea {
            resize: vertical;
            min-height: 90px;
        }

        input:focus, select:focus, textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(56,189,248,.25);
        }

        .group {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .option {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-size: .9rem;
            color: var(--text);
        }

        input[type="checkbox"],
        input[type="radio"] {
            width: 16px;
            height: 16px;
            accent-color: var(--primary);
            cursor: pointer;
        }

        .divider {
            grid-column: 1 / -1;
            height: 1px;
            background: linear-gradient(to right, transparent, var(--border), transparent);
            margin: 8px 0;
        }

        .actions {
            grid-column: 1 / -1;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        button {
            padding: 12px 22px;
            border-radius: 999px;
            border: none;
            background: linear-gradient(135deg, var(--primary), var(--primary-hover));
            color: #020617;
            font-weight: 600;
            cursor: pointer;
            transition: transform .1s, box-shadow .1s, opacity .1s;
            box-shadow: 0 10px 30px rgba(14,165,233,.35);
        }

        button:hover {
            transform: translateY(-1px);
            opacity: .95;
        }

        .hint {
            font-size: .8rem;
            color: var(--muted);
        }

        .danger {
            color: var(--danger);
            font-size: .8rem;
        }

        @media (max-width: 640px) {
            form {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h1>MicroForms</h1>
        <p class="subtitle">Formulário de exemplo completo (inputs, select, radio, checkbox)</p>

        <form action="submit/index.php" id="form" method="post">
            <?= csrf(); ?>
            <?= idem(); ?>
            <div>
                <label>Nome completo</label>
                <input name="name" type="text" placeholder="Ex: Daniel Eskelsen">
            </div>

            <div>
                <label>Email</label>
                <input name="email" type="email" placeholder="email@exemplo.com">
            </div>

            <div>
                <label>Senha</label>
                <input name="password" type="password" placeholder="••••••••">
            </div>

            <div>
                <label>Data de nascimento</label>
                <input name="birth" type="date">
            </div>

            <div>
                <label>Idade</label>
                <input name="age" type="number" min="0" placeholder="Ex: 30">
            </div>

            <div>
                <label>Perfil</label>
                <select name="profile">
                    <option value="">Selecione</option>
                    <option>Usuário</option>
                    <option>Administrador</option>
                    <option>Convidado</option>
                </select>
            </div>

            <div>
                <label>Permissões</label>
                <select name="permissions[]" multiple size="5">
                    <option value="read">Leitura</option>
                    <option value="write">Escrita</option>
                    <option value="delete">Exclusão</option>
                    <option value="export">Exportação</option>
                    <option value="admin">Administração</option>
                </select>
            </div>

            <div class="full">
                <label>Biografia</label>
                <textarea name="bio" placeholder="Fale um pouco sobre você"></textarea>
            </div>

            <div class="divider"></div>

            <div class="full">
                <label>Preferências (checkbox)</label>
                <div class="group">
                    <label class="option"><input type="checkbox" name="notify"> Receber notificações</label>
                    <label class="option"><input type="checkbox" name="newsletter"> Participar da newsletter</label>
                    <label class="option"><input type="checkbox" name="beta"> Acesso beta</label>
                </div>
            </div>

            <div class="full">
                <label>Plano (radio)</label>
                <div class="group">
                    <label class="option"><input type="radio" name="plan"> Básico</label>
                    <label class="option"><input type="radio" name="plan"> Profissional</label>
                    <label class="option"><input type="radio" name="plan"> Enterprise</label>
                </div>
            </div>

            <div class="divider"></div>

            <div class="actions">
                <div>
                    <div class="hint">Campos são apenas ilustrativos</div>
                    <div class="danger">Nenhum dado será enviado</div>
                </div>
                <button type="submit">Enviar formulário</button>
            </div>
        </form>
    </div>
</div>

<script src="toolkit.js"></script>

<script>

// const json = '{"name":"Daniel Eskelsen","email":"eskelsen@yahoo.com","password":"123123123","birth":"1988-02-27","age":"37","profile":"Administrador","bio":"Programador PHP Beta","notify":"on","newsletter":"","beta":"on","plan":"on"}';
const json = '{"name":"Daniel Eskelsen","email":"eskelsen@yahoo.com","password":"123123","birth":"1988-02-27","age":"37","profile":"Administrador","permissions":["read","delete","admin"],"bio":"Programador PHP","notify":"on","newsletter":"","beta":"on","plan":"on"}';

microFormsFill('form', json);

</script>

</body>
</html>