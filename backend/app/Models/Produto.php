<?php

namespace App\Models;

use App\Model\Estoque;
use App\Model\ProdutoDetalhe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model {

    use SoftDeletes;

    protected $fillable = [
        'categoria_id',
        'nome',
        'descricao',
        'codigo',
        'ativo'
    ];

    function pedidos(): BelongsToMany {

        return $this->belongsToMany('App\Models\Pedido', 'pedidos_produtos');
    }
}
