<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PedidoSaveRequest extends FormRequest {

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
            'cliente_id' => 'required|exists:clientes,id'
        ];
    }

    public function messages() {       

        return [
            'required' => 'Este campo é obrigatório.',
            'exists' => 'O dado informado não existe.'
        ];        
    }
}
