<?php

session_start();

require_once '../app/Form.php';

if (idem_used()) {
    exit('Form já enviado.');
}

$form = new Form();
$form->addField('name', '', [fn($v) => $v !== '' ? true : 'Nome é obrigatório']);
$form->addField('email', '', [fn($v) => filter_var($v, FILTER_VALIDATE_EMAIL) ? true : 'Email inválido']);
$form->addField('password', '');
$form->addField('birth', '');
$form->addField('age', '');
$form->addField('profile', '');
$form->addField('permissions', '');
$form->addField('bio', '');
$form->addField('notify', '');
$form->addField('newsletter', '');
$form->addField('beta', '');
$form->addField('plan', '');

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

