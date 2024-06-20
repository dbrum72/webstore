<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Progresso extends Model {

    protected $fillable = ['nome'];

    public $timestamps = false;
}
