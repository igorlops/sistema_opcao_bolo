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
    Route::get('relatorio-financeiro', [App\Http\Controllers\RelatorioFinanceiro::class, 'index'])->name('relatorios.index');
    Route::resource('fechamentos', App\Http\Controllers\FechamentosController::class);
    Route::resource('produtos-fechamentos', App\Http\Controllers\ProdutosFechamentosController::class);
    Route::resource('estoques', App\Http\Controllers\EstoquesController::class);
    Route::resource('estoque-produtos', App\Http\Controllers\EstoqueProdutosController::class);
    Route::post('/aprova-fechamento/{id}', [App\Http\Controllers\FechamentosController::class,'aprovaFechamento'])->name('aprovaFechamento');
    Route::get('/excel-exports-resume', [App\Http\Controllers\RelatorioFinanceiro::class,'exportExcelResume'])->name('exportExcel');
    Route::get('/excel-exports-lucros', [App\Http\Controllers\RelatorioFinanceiro::class,'exportExcelLucro'])->name('exportExcelLucro');
    Route::get('/excel-lucro-sistema', [App\Http\Controllers\RelatorioFinanceiro::class,'exportExcelSistema'])->name('exportExcelSistema');
    Route::get('/excel-exports-saidas-variavel', [App\Http\Controllers\SaidasController::class,'exportSaidasVariavel'])->name('exportSaidasVariavel');
    Route::get('/excel-exports-saidas-fixa', [App\Http\Controllers\SaidasController::class,'exportSaidasFixa'])->name('exportSaidasFixa');
    Route::get('/excel-exports-entradas', [App\Http\Controllers\EntradasController::class,'exportEntradas'])->name('exportEntradas');

});
