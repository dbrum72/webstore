<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pedido extends Model {

    protected $fillable = ['cliente_id'];

    function cliente(): BelongsTo {

        return $this->belongsTo('App\Models\Cliente');
    }

    function produtos(): BelongsToMany {

        return $this->belongsToMany('App\Models\Produto', 'pedidos_produtos')->withPivot('id','quantidade','valor');
    }

    function status(): HasOne {

        return $this->hasOne('App\Models\PedidoStatus');
    }
}
