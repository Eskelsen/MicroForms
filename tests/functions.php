<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title>MicroForms Demo – Modais e Tooltips</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <?php

    $args = ['E ae, cãraaa','primary',true];
    $argsb = ['primary','E ae, cãraaa',true];
    $argsc= ['page','primary','E ae, cãraaa'];
    $argss= ['danger','url','fa-solid fa-code-simple'];

    include dirname(__DIR__, 1) . '/app/view_functions.php';

    ?>
    Alerta
    <?=  alertfy($args) ?>
    Link
    <?=  linkfy($argsc) ?>
    Span
    <?=  spanfy($argss) ?>
    Botão
    <?=  buttonfy($argsb) ?>

    
</body>
</html>