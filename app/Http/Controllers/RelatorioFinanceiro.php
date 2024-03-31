<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\Saida;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        if(!$request->filled('data_inicial') || !$request->filled('data_final')){
            return redirect()->route('relatorios.index',[
                'data_inicial'=>(new \DateTime('first day of this month'))
                ->format('d/m/Y'),
                'data_final'=>(new \DateTime('last day of this month'))
                ->format('d/m/Y')
            ]);
        }
        // $saldo = Saldo::buscaPorIntervalo(
        //     $empresa->id,
        //     data_br_to_iso($request->data_inicial),
        //     data_br_to_iso($request->data_final)
        // );

        $user_id = $request->user_id;

        // Filtrar entradas e saídas pelo usuário, se o ID do usuário estiver presente na solicitação
        $entradasQuery = $user_id ? Entrada::where('user_id', $user_id) : Entrada::query();
        $saidasQuery = $user_id ? Saida::where('user_id', $user_id) : Saida::query();
        $entrada = Entrada::get();
        $saida = Saida::get();
        $total_entradas = $entradasQuery->sum('valor');
        $total_saidas = $saidasQuery->sum('valor');
        $diferenca = $total_entradas - $total_saidas;
        $users = User::all();


// Consulta com Eloquent para calcular a soma dos valores de entrada e saída por usuário
        $resultados = User::join('entradas', 'users.id', '=', 'entradas.user_id')
            ->join('saidas', 'users.id', '=', 'saidas.user_id')
            ->select(
                'users.nome',
                DB::raw('SUM(entradas.valor) as total_entradas'),
                DB::raw('SUM(saidas.valor) as total_saidas')
            )
        ->groupBy('users.id', 'users.nome')
        ->get();

        return view('relatorios.index', [
            'total_entradas' => $total_entradas,
            'total_saidas' => $total_saidas,
            'diferenca' => $diferenca,
            'saida'=>$saida,
            'entrada'=>$entrada,
            'users'=>$users,
            'results' => $resultados
        ]);

    }
}
