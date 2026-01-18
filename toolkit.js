function microFormsFill(form_id = 'form', data_json = '') {
  const form = document.getElementById(form_id);
  if (!form) {
    console.warn(`MicroForms: form #${form_id} não encontrado`);
    return;
  }

  let data;

  try {
    data = typeof data_json === 'string' ? JSON.parse(data_json) : data_json;
  } catch (e) {
    console.warn('MicroForms (JSON inválido): ', e);
    return;
  }

  Object.entries(data).forEach(([name, value]) => {
    const fields = form.querySelectorAll(`[name="${name}"], [name="${name}[]"]`);

    fields.forEach(field => {
      switch (field.type) {
        case 'checkbox':
          field.checked = value === true || value === 1 || value === '1' || value === 'on';
          break;

        case 'radio':
          field.checked = field.value == value;
          break;

        case 'select-one':
        field.value = value;
        break;
        case 'select-multiple':
            if (Array.isArray(value)) {
                [...field.options].forEach(opt => {
                    opt.selected = value.includes(opt.value);
                });
            }
            break;
        default:
          field.value = value ?? '';
      }
    });
  });
}

window.toast = function (message, type = 'success') {
  const toastEl = document.getElementById('appToast');
  const bodyEl = document.getElementById('toastBody');
  const titleEl = document.getElementById('toastTitle');

  bodyEl.textContent = message;

  titleEl.textContent = type === 'error' ? 'Erro' : 'Sucesso';

  toastEl.classList.remove('text-bg-success', 'text-bg-danger');
  toastEl.classList.add(type === 'error' ? 'text-bg-danger' : 'text-bg-success');

  const toast = bootstrap.Toast.getOrCreateInstance(toastEl, {
    delay: 3000
  });

  toast.show();
};

window.Actions = {
  request({ method, endpoint, data }) {

    const headers = {
        'Accept': 'application/json'
    };

    const options = { method, headers };

    if (data !== undefined) {
        headers['Content-Type'] = 'application/json';
        options.body = JSON.stringify(data);
    }

    return fetch(endpoint, options)
      .then(async r => {
        const res = await r.json();

        // erro HTTP
        if (!r.ok) {
          throw res;
        }

        // erro de negócio
        if (res.error) {
          throw res;
        }

        return res;
      });
  },

  post({ endpoint, data }) {
    return this.request({
      method: 'POST',
      endpoint,
      data
    });
  },

  get({ endpoint }) {
    return this.request({
      method: 'GET',
      endpoint
    });
  },

  put({ endpoint, data }) {
    return this.request({
      method: 'PUT',
      endpoint,
      data
    });
  },

  patch({ endpoint, data }) {
    return this.request({
      method: 'PATCH',
      endpoint,
      data
    });
  },

  delete({ endpoint, data }) {
    return this.request({
      method: 'DELETE',
      endpoint,
      data
    });
  }
};

document.querySelectorAll('.js-toggle').forEach(toggle => {
  toggle.addEventListener('change', e => {
    const el = e.target;
    const checked = el.checked;
    const endpoint = el.dataset.endpoint;
    const payload = JSON.parse(el.dataset.payload || '{}');

    el.disabled = true;

    Actions.post({
      endpoint,
      data: {
        ...payload,
        ativo: checked ? 1 : 0
      }
    })
    .then(res => {
    toast(res.response || 'Salvo com sucesso');
    })
    .catch(err => {
    el.checked = !checked;
    toast(err.error || 'Erro ao salvar', 'error');
    })
    .finally(() => {
      el.disabled = false;
    });
  });
});
