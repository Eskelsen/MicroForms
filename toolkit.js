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
