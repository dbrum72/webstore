<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PedidoStatus extends Model {

    protected $table = 'pedido_status';

    protected $fillable = ['nome'];

    public $timestamps = false;
}

function pedido(): BelongsTo {

    return $this->belongsTo('App\Models\Pedido');
}
