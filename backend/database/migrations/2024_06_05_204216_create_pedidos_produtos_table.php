<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {

        Schema::create('pedidos_produtos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_id');
            $table->foreignId('produto_id');
            $table->integer('quantidade');
            $table->float('valor', 8, 2);
            $table->timestamps();
        });
    }

    public function down(): void {
        
        Schema::dropIfExists('pedidos_produtos');
    }
};
