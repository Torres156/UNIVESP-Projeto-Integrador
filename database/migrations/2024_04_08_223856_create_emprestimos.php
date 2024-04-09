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
        // 'aluno_id',
        // 'livro_id',
        // 'estado',
        // 'devolucao', 
        // 'status',  
        Schema::create('emprestimos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('aluno_id')->unsigned()->index()->nullable();
            $table->string('aluno_nome')->nullable();
            $table->bigInteger('livro_id')->unsigned()->index()->nullable();
            $table->string('livro_nome')->nullable();
            $table->string('estado',20);
            $table->enum('status', ['EMPRESTADO', 'DEVOLVIDO'])->default('EMPRESTADO');
            $table->date('devolucao');
            $table->timestamps();

            $table->foreign('aluno_id')->references('id')->on('alunos');
            $table->foreign('livro_id')->references('id')->on('livros');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emprestimos');
    }
};
