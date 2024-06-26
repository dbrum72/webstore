<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
    public function up(): void {

        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained()->cascadeOnDelete();
            $table->foreignId('progresso_id')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void {

        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('pedidos');

        Schema::enableForeignKeyConstraints();
    }
};