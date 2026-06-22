<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PropriedadeController;
use App\Http\Controllers\Admin\ProdutoServicoController;
use App\Http\Controllers\Admin\CategoriaController;

Route::get('/', [PublicController::class, 'home'])->name('home');

Route::get('/catalogo/propriedades', [PublicController::class, 'propriedades'])
    ->name('public.propriedades');

Route::get('/catalogo/propriedades/{propriedade}', [PublicController::class, 'showPropriedade'])
    ->name('public.propriedades.show');

Route::get('/catalogo/produtos', [PublicController::class, 'produtos'])
    ->name('public.produtos');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

Route::get('/cadastro', [AuthController::class, 'showRegister'])->name('register');
Route::post('/cadastro', [AuthController::class, 'register'])->name('register.store');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('propriedades', PropriedadeController::class);
    Route::resource('categorias', CategoriaController::class);

    Route::resource('produtos', ProdutoServicoController::class)
        ->parameters(['produtos' => 'produto']);
});
