<?php

require_once '../app/Form.php';

$form = new Form();
$form->addField('nome', '', [fn($v) => $v !== '' ? true : 'Nome é obrigatório']);
$form->addField('email', '', [fn($v) => filter_var($v, FILTER_VALIDATE_EMAIL) ? true : 'Email inválido']);

$form->setData($_POST);

if ($form->validate()) {
    echo "Formulário enviado com sucesso!";
    file_put_contents('../data/form_data.json', json_encode($form->getData()) . PHP_EOL, FILE_APPEND);
} else {
    echo "Erros:<br>";
    foreach ($form->getErrors() as $field => $error) {
        echo "$field: $error<br>";
    }
}
