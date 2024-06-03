<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ProdutoSaveRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {

        return [
            'id' => 'unique:produtos,id,'.(isset($this->produto) ? $this->produto : null).',id',
            'nome' => 'required|min:3|max:255',
            'descricao' => 'required|max:255',
            'codigo' => 'nullable|digits_between:13,15|unique:produtos,codigo,'.(isset($this->produto) ? $this->produto : null).',id',
        ];
    }

    public function messages() {       

        return [
            'required' => 'Este campo é obrigatório.',
            'unique' => 'O dado informado já existe.',
            'min' => 'Campo deve possuir no mínimo 3 caracteres.',
            'max' => 'Campo deve possuir no máximo 255 caracteres.',
            'digits_between' => 'Este campo deve ter entre 13 e 15 dígitos.'
        ];        
    }
}
