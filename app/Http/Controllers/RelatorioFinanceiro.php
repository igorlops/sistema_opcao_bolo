<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\Saida;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class RelatorioFinanceiro extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return View
     */
    public function __invoke(Request $request)
    {
        // if(!$request->filled('data_inicial') || !$request->filled('data_final')){
        //     return redirect()->route('relatorios.index',[
        //         'empresa'=>$empresa,
        //         'data_inicial'=>(new \DateTime('first day of this month'))
        //         ->format('d/m/Y'),
        //         'data_final'=>(new \DateTime('last day of this month'))
        //         ->format('d/m/Y')
        //     ]);
        // }
        // $saldo = Saldo::buscaPorIntervalo(
        //     $empresa->id,
        //     data_br_to_iso($request->data_inicial),
        //     data_br_to_iso($request->data_final)
        // );

        $user_id = $request->user_id;

        // Filtrar entradas e saídas pelo usuário, se o ID do usuário estiver presente na solicitação
        $entradasQuery = $user_id ? Entrada::where('user_id', $user_id) : Entrada::query();
        $saidasQuery = $user_id ? Saida::where('user_id', $user_id) : Saida::query();

        $total_entradas = $entradasQuery->sum('valor');
        $total_saidas = $saidasQuery->sum('valor');
        $diferenca = $total_entradas - $total_saidas;

        return view('relatorios.index', [
            'total_entradas' => $total_entradas,
            'total_saidas' => $total_saidas,
            'diferenca' => $diferenca,
        ]);

    }
}
