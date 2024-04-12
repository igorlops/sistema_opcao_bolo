<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user_id = $request->user_id;
        $data_ini = (new \DateTime('first day of this month'))->format('Y-m-d');
        $data_fin = (new \DateTime('last day of this month'))->format('Y-m-d');

        $resultados = User::join('entradas', 'users.id', '=', 'entradas.user_id')
        ->join('saidas', 'users.id', '=', 'saidas.user_id')
        ->select(
            'users.name',
            DB::raw('SUM(entradas.valor) as total_entradas'),
            DB::raw('SUM(saidas.valor) as total_saidas')
        );
        dd($resultados->get());
        if($user_id){
            $resultados->where('users.id','=',$user_id);

            $produtos = Produto::select('produtos.id', 'produtos.nome')
                ->selectRaw("(SELECT SUM(estoques.quantidade) FROM estoques WHERE tipo_estoque = 'p' AND estoques.created_at BETWEEN '$data_ini 00:00:00' AND '$data_fin 23:59:59' AND id_produto = produtos.id) AS producao")
                ->selectRaw("(SELECT COUNT(entradas.valor) FROM entradas WHERE entradas.id_produto = produtos.id AND entradas.created_at BETWEEN '$data_ini 00:00:00' AND '$data_fin 23:59:59' AND entradas.metade IS NULL ) AS venda")
                ->selectRaw("(SELECT SUM(estoques.quantidade) FROM estoques WHERE tipo_estoque = 'd' AND estoques.created_at BETWEEN '$data_ini 00:00:00' AND '$data_fin 23:59:59' AND id_produto = produtos.id) AS desperdicio")
                ->addSelect('estoques.user_id')
                ->leftJoin('estoques', 'estoques.id_produto', '=', 'produtos.id')
                ->groupBy('produtos.id', 'produtos.nome', 'estoques.user_id')
                ->get();

        }
        $resultados->groupBy('users.id', 'users.name')
        ->get();


        $users = User::all();
        return view('home', compact('users','resultados','produtos'));
    }
}
