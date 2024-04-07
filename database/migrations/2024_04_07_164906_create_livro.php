<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('livros', function (Blueprint $table) {
            $table->id();
            $table->string('isbn',10)->nullable(true);
            $table->string('localizacao', 100)->nullable(true);
            $table->string('nome', 100);
            $table->string('autor', 100);
            $table->string('categoria', 100)->nullable(true);
            $table->integer('faixa_etaria');
            $table->string('editora', 50)->nullable(true);
            $table->string('foto')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livros');
    }
};
