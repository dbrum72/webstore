<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pedido extends Model {

    protected $fillable = ['cliente_id'];

    function cliente(): HasOne {

        return $this->hasOne(Cliente::class);
    }
}
