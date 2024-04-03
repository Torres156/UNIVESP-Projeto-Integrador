<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
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
});