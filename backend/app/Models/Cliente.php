<?php

namespace App\Models;

use App\Models\ClienteEndereco;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model{

    use SoftDeletes;

    protected $table = 'clientes';

    protected $fillable = [
        'nome',  
        'cnpj_cpf',        
        'tel_cel',
        'whatsapp',
        'email',        
    ];   
}