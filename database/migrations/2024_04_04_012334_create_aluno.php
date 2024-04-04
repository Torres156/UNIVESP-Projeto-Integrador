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
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 40);
            $table->string('email', 40)->nullable(true);
            $table->string('ra', 8);
            $table->date("nascimento");
            $table->string('telefone', 15)->nullable(true);
            $table->string("sala",15);
            $table->timestamps();

            $table->unique('ra');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alunos');
    }
};
