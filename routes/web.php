<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\MovimentoEstoqueController;
use App\Http\Controllers\MovimentoFinanceiroController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\Relatorios\SaldoEmpresa;
use App\Http\Controllers\Selects\EmpresaNomeTipo;
use App\Http\Controllers\Selects\ProdutoNome;
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
});
