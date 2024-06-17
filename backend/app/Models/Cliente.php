<?php

namespace App\Models;

use App\Models\Pedido;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    function pedidos(): HasMany {

        return $this->HasMany(Pedido::class);
    }
}