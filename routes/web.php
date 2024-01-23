<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\MovimentoEstoqueController;
use App\Http\Controllers\MovimentoFinanceiroController;
use App\Http\Controllers\ProdutosController;
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
    Route::resource('empresas',EmpresaController::class);
    Route::resource('produtos', ProdutosController::class);
    Route::resource('users', UsersController::class);
    Route::post('/empresas/buscar-por/nome',EmpresaNomeTipo::class);
    Route::resource('movimentos-financeiros', MovimentoFinanceiroController::class)->except(['edit','update']);
    Route::delete('/movimentos_estoque/{id}', [MovimentoEstoqueController::class, 'destroy'])->name('movimentos_estoque.destroy');
    Route::post('/movimentos_estoque', [MovimentoEstoqueController::class, 'store'])->name('movimentos_estoque.store');
    Route::post('/produtos/buscar-por/nome',ProdutoNome::class);
}); 