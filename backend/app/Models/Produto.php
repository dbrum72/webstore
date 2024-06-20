<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model {

    use SoftDeletes;

    protected $fillable = [
        'categoria_id',
        'codigo',
        'nome',
        'descricao',
        'ativo'
    ];

    public function pedidos(): BelongsToMany {

        return $this->belongsToMany('App\Models\Pedido', 'pedidos_produtos');
    }

    public function categoria(): BelongsTo {

        return $this->belongsTo('App\Models\Categoria', 'categoria_id');
    }
}
