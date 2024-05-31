<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoStoreRequest extends FormRequest {

    public function authorize(): bool {
        
        return true;
    }

    /** @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>*/

    public function rules() {
        
        return [
            'nome' => 'required|min:3|max:255',
            'descricao' => 'required'            
        ];
    }
}
