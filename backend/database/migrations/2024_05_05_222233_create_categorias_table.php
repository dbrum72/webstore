<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
    public function up(): void {

        Schema::create('categorias', function (Blueprint $table) {            
            $table->id();
            $table->foreignId('pai_id')->nullable()->constrained('categorias')->cascadeOnDelete();
            $table->string('nome', 25);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void {

        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('categorias');

        Schema::enableForeignKeyConstraints();
    }
};
