<?php

namespace App\Models;

use App\Model\Estoque;
use App\Model\ProdutoDetalhe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model {

    use SoftDeletes;

    protected $fillable = [
        'nome',
        'descricao',
        'codigo_barras'
    ];

    protected static function boot() {
        parent::boot();
    
        static::deleting(function($detalhe) {
            $detalhe->detalhe()->delete();
        });

        static::deleting(function($estoque) {
            $estoque->estoque()->delete();
        });
    }

    function detalhe() {

        return $this->hasOne(ProdutoDetalhe::class);
    }

    function estoque() {

        return $this->hasOne(Estoque::class);
    }
}
