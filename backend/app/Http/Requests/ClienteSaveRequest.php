<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteSaveRequest extends FormRequest {

    public function authorize(): bool {

        return true;
    }

    /** @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> */

    public function rules() {
        
        return [
            'id' => 'unique:clientes,id,'.(isset($this->cliente) ? $this->cliente : null).',id',
            'nome' => 'required|min:3|max:255',
            'cnpj_cpf' => 'required|digits_between:11,14|unique:clientes,cnpj_cpf,'.(isset($this->cliente) ? $this->cliente : null).',id',
            'email' => 'nullable|email|unique:clientes,email,'.(isset($this->cliente) ? $this->cliente : null).',id',
            'tel_cel' => 'nullable|digits:11',            
        ];
    }

    public function messages() {       

        return [
            'required' => 'Este campo é obrigatório.',
            'min' => 'Campo deve possuir no mínimo 3 caracteres.',
            'max' => 'Campo deve possuir no máximo 255 caracteres.',
            'unique' => 'O dado informado já existe.',
            'integer' => 'Campo somente números.',
            'email' => 'O dado informado não corresponde a um endereço de email válido.',
            'cnpj_cpf.digits_between' =>  'O registro deve ter 11 ou 14 dígitos, para CPF ou CNPJ, respectivamente.',
            'tel_cel.digits' =>  'O telefone deve possuir 11 dígitos.',
        ];        
    }
}
