<?php

require_once 'app/Form.php';

$form = new Form();
$form->addField('nome', '', [fn($v) => $v !== '' ? true : 'Nome é obrigatório']);
$form->addField('email', '', [fn($v) => filter_var($v, FILTER_VALIDATE_EMAIL) ? true : 'Email inválido']);
?>
<form action="submit/index.php" method="post">
    Nome: <input type="text" name="nome"><br>
    Email: <input type="text" name="email"><br>
    <button type="submit">Enviar</button>
</form>
