<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function pedidos(): HasMany {

        return $this->HasMany('App\Models\Pedido', 'cliente_id');
    }
}