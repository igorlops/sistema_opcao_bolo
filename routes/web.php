<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[LoginController::class, 'showLoginForm']);

Auth::routes([
    'register'=>false
]);

Route::middleware('auth')->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('users', UsersController::class);
    Route::resource('tipo-pagamentos', App\Http\Controllers\TipoPagamentosController::class);
    Route::resource('tipo-saidas', App\Http\Controllers\TipoSaidasController::class);
    Route::resource('produtos', App\Http\Controllers\ProdutosController::class);
    Route::resource('entradas', App\Http\Controllers\EntradasController::class);
    Route::resource('saidas', App\Http\Controllers\SaidasController::class);
    Route::resource('fechamentos', App\Http\Controllers\FechamentosController::class);
    Route::get('relatorio-financeiro', [App\Http\Controllers\RelatorioFinanceiro::class, 'index'])->name('relatorios.index');
    Route::get('relatorio-financeiro/user/{id}', [App\Http\Controllers\RelatorioFinanceiro::class, 'user_details'])->name('relatorios.user_details');
});
