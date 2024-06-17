<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
    public function up(): void {

        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoria_id')->constrained()->cascadeOnDelete();
            $table->string('nome', 255);
            $table->text('descricao')->nullable();
            $table->bigInteger('codigo')->nullable();
            $table->boolean('ativo')->default('1');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void {

        Schema::disableForeignKeysConstraints();

        Schema::dropIfExists('produtos');

        Schema::enableForeignKeysConstraints();
    }
};
