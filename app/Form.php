<?php

class Form {
    private array $fields = [];
    private array $errors = [];

    public function addField(string $name, string $value = '', array $validators = []): void {
        $this->fields[$name] = ['value' => $value, 'validators' => $validators];
    }

    public function validate(): bool {
        $this->errors = [];
        foreach ($this->fields as $name => $field) {
            foreach ($field['validators'] as $validator) {
                $error = $validator($field['value']);
                if ($error !== true) {
                    $this->errors[$name] = $error;
                    break;
                }
            }
        }
        return empty($this->errors);
    }

    public function getErrors(): array {
        return $this->errors;
    }

    public function getData(): array {
        $data = [];
        foreach ($this->fields as $name => $field) {
            $data[$name] = $field['value'];
        }
        return $data;
    }

    public function setData(array $data): void {
        foreach ($data as $name => $value) {
            if (isset($this->fields[$name])) {
                $this->fields[$name]['value'] = $value;
            }
        }
    }
}

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
