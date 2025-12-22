<?php

session_start();

require_once '../app/Form.php';

if (idem_used()) {
    exit('Form já enviado.');
}

$form = new Form();
$form->addField('nome', '', [fn($v) => $v !== '' ? true : 'Nome é obrigatório']);
$form->addField('email', '', [fn($v) => filter_var($v, FILTER_VALIDATE_EMAIL) ? true : 'Email inválido']);

$form->setData($_POST);

if ($form->validate()) {
    echo 'Formulário enviado com sucesso!<br><br><a href="../">Voltar</a>';
    file_put_contents('data.json', json_encode($form->getData()) . PHP_EOL, FILE_APPEND);
} else {
    echo "Erros:<br>";
    foreach ($form->getErrors() as $field => $error) {
        echo "$field: $error<br>";
    }
}

