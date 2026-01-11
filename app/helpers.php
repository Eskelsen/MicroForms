<?php

function csrf(){
    return '<input type="hidden" name="csrf_key" value="' . $_SESSION['csrf_key'] . '">';
}

function idem(){
    return '<input type="hidden" name="idem_key" value="' . $_SESSION['idem_key'] . '">';
}

function idem_used(){
    $chave = array_search($_POST['idem_key'], $_SESSION['idem_set']);
    if (!$chave) {
        return true;
    }
    unset($_SESSION['idem_set'][$chave]);
}
