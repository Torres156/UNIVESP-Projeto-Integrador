<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AlunoController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\LivroController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Auth
Route::get('/login', [AuthController::class, 'index'])->name("login");
Route::post('/login', [AuthController::class, 'entrar']);

// Dashboard
Route::name('admin.')->middleware(AuthMiddleware::class)->group(function() {

    Route::get("/", [AdminController::class, 'index'])->name('dashboard');

    Route::get("/sair", [AdminController::class, 'sair'])->name('logout');
    
    // Alunos
    Route::get("/aluno", [AlunoController::class, 'index'])->name('aluno');
    Route::post("/aluno", [AlunoController::class, 'gravar'])->name('aluno');

    // Livros
    Route::get("/livro/cadastro", [LivroController::class, "cadastro"])->name('livro.cadastro');    
    Route::post("/livro/cadastro", [LivroController::class, "novo"])->name('livro.cadastro.salvar');
    Route::get("/livro/edit/{id}", [LivroController::class, "editar"])->name('livro.editar');
    Route::post("/livro/edit/{id}", [LivroController::class, "salvar"])->name('livro.editar.salvar');
    Route::get("/livro", [LivroController::class, "index"])->name("livro");

});