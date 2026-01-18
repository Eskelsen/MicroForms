<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title>MicroForms Demo – Modais e Tooltips</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

  <h1 class="mb-4">MicroForms – Demo</h1>

  <section class="mb-5">
    <h4>Tooltip</h4>
    <button
      class="btn btn-secondary"
      data-bs-toggle="tooltip"
      data-bs-placement="right"
      title="Este é um tooltip do Bootstrap"
    >
      Passe o mouse
    </button>
  </section>

  <section class="mb-5">
    <h4>Modal padrão</h4>
    <button
      class="btn btn-primary"
      data-bs-toggle="modal"
      data-bs-target="#modalExemplo"
    >
      Abrir modal
    </button>
  </section>

  <section class="mb-5">

    <h4>Confirmação</h4>

    <button
      class="btn btn-danger"
      data-microforms-confirm="Deseja realmente excluir este item?"
      data-microforms-confirm-ok="Sim, excluir"
      data-microforms-confirm-cancel="Cancelar"
    >
      Excluir
    </button>
  </section>

  <section>
    <h4>Toggle</h4>
<div class="form-check form-switch js-toggle">
  <input
    class="form-check-input"
    type="checkbox"
    role="switch"
    id="userActive"
    checked
    data-endpoint="/modal/api.json"
  >
  <label class="form-check-label" for="userActive">
    Ativo
  </label>
</div>
  </section>

    <section>
<div class="form-check form-switch">
  <input
    class="form-check-input js-toggle"
    type="checkbox"
    role="switch"
    id="userActive_5"
    name="ativo"
    checked
    data-endpoint="/modal/api.json"
    data-payload='{"id":5}'
  >
  <label class="form-check-label" for="userActive_5">
    Usuário ativo
  </label>
</div>
  </section>

</div>

<div class="modal fade" id="modalExemplo" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Modal Exemplo</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        Este é um modal comum usando Bootstrap.
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>

    </div>
  </div>
</div>


<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="appToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <strong class="me-auto" id="toastTitle">Sistema</strong>
      <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
    </div>
    <div class="toast-body" id="toastBody"></div>
  </div>
</div>

<?php

include dirname(__DIR__, 1) . '/app/view_functions.php';

?>

<?= modal('microformsConfirmModal','Modality','E ae, cãraa'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

console.log('gato');

document
  .querySelectorAll('[data-bs-toggle="tooltip"]')
  .forEach(el => new bootstrap.Tooltip(el));

const microformsConfirmModalEl = document.getElementById('microformsConfirmModal');
const microformsConfirmModal   = new bootstrap.Modal(microformsConfirmModalEl);
const microformsConfirmMessage = document.getElementById('microformsConfirmMessage');
const microformsConfirmOkBtn   = document.getElementById('microformsConfirmOk');
const microformsConfirmCancel  = document.getElementById('microformsConfirmCancel');

let microformsConfirmCallback = null;

document.addEventListener('click', e => {
  const btn = e.target.closest('[data-microforms-confirm]');
  if (!btn) return;

  e.preventDefault();

//   microformsConfirmMessage.textContent = btn.dataset.microformsConfirm;
//   microformsConfirmOkBtn.textContent   = btn.dataset.microformsConfirmOk || 'Confirmar';
//   microformsConfirmCancel.textContent  = btn.dataset.microformsConfirmCancel || 'Cancelar';

  microformsConfirmCallback = () => {
    console.log('Confirmado!');
    // Aqui futuramente entra:
    // - submit de form
    // - redirect
    // - fetch
  };

  microformsConfirmModal.show();
});

microformsConfirmOkBtn.addEventListener('click', () => {
  if (typeof microformsConfirmCallback === 'function') {
    microformsConfirmCallback();
  }
  microformsConfirmModal.hide();
});
</script>

</body>
</html>