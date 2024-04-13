<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\Produto;
use App\Models\Saida;
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
        $mesAtual = (new \DateTime())->format('m');
        $mes = "";
        switch ($mesAtual) {
            case '1':
            $mes = "Janeiro";
            break;
            case '2':
            $mes = "Fevereiro";
            break;
            case '3':
            $mes = "Março";
            break;
            case '4':
            $mes = "Abril";
            break;
            case '5':
            $mes = "Maio";
            break;
            case '6':
            $mes = "Junho";
            break;
            case '7':
            $mes = "Julho";
            break;
            case '8':
            $mes = "Agosto";
            break;
            case '9':
            $mes = "Setembro";
            break;
            case '10':
            $mes = "Outubro";
            break;
            case '11':
            $mes = "Novembro";
            break;
            case '12':
            $mes = "Dezembro";
            break;

            default:
                # code...
                break;
        }
        if(auth()->user()->type_user == 1 ){
            $user_id = $request->user_id;
            if(!$request->filled('data_ini_home') || !$request->filled('data_fin_home')){
                return redirect()->route('home',[
                    'data_ini_home'=>(new \DateTime('first day of this month'))
                    ->format('d/m/Y'),
                    'data_fin_home'=>(new \DateTime('last day of this month'))
                    ->format('d/m/Y')
                ]);
            }
            $data_ini = $request->data_ini_home;
            $data_fin = $request->data_fin_home;

            $users = User::all();

            $entradas = Entrada::query();
            $saidas = Saida::query();
            $produtos = Produto::query();

            if($user_id){
                $entradas->selectRaw('SUM(entradas.valor) as total_entradas WHERE entradas.user_id = '.$user_id);
                $saidas->selectRaw('SUM(saidas.valor) as total_saidas WHERE saidas.user_id = '.$user_id);

                $produtos->selectRaw("(SELECT SUM(estoques.quantidade) FROM estoques WHERE tipo_estoque = 'p' AND estoques.created_at BETWEEN '".data_br_to_iso($data_ini)." 00:00:00' AND '".data_br_to_iso($data_fin)." 23:59:59' AND id_produto = produtos.id AND estoques.user_id = $user_id) AS producao")
                ->selectRaw("(SELECT COUNT(entradas.valor) FROM entradas WHERE entradas.id_produto = produtos.id AND entradas.created_at BETWEEN '".data_br_to_iso($data_ini)." 00:00:00' AND '".data_br_to_iso($data_fin)." 23:59:59' AND entradas.metade IS NULL AND entradas.user_id = $user_id ) AS vendaInteiras")
                ->selectRaw("(SELECT COUNT(entradas.valor) FROM entradas WHERE entradas.id_produto = produtos.id AND entradas.created_at BETWEEN '".data_br_to_iso($data_ini)." 00:00:00' AND '".data_br_to_iso($data_fin)." 23:59:59' AND entradas.metade = 's' AND entradas.user_id = $user_id ) AS vendaMetades")
                ->selectRaw("(SELECT SUM(estoques.quantidade) FROM estoques WHERE tipo_estoque = 'd' AND estoques.created_at BETWEEN '".data_br_to_iso($data_ini)." 00:00:00' AND '".data_br_to_iso($data_fin)." 23:59:59' AND id_produto = produtos.id AND estoques.user_id = $user_id) AS desperdicio")
                ->leftJoin('estoques', 'estoques.id_produto', '=', 'produtos.id')
                ->join('entradas','entradas.id_produto','produtos.id')
                ->where('estoques.user_id','=',$user_id);

            }else {
                $produtos->selectRaw("(SELECT SUM(estoques.quantidade) FROM estoques WHERE tipo_estoque = 'p' AND estoques.created_at BETWEEN '".data_br_to_iso($data_ini)." 00:00:00' AND '".data_br_to_iso($data_fin)." 23:59:59' AND id_produto = produtos.id) AS producao")
                ->selectRaw("(SELECT COUNT(entradas.valor) FROM entradas WHERE entradas.id_produto = produtos.id AND entradas.created_at BETWEEN '".data_br_to_iso($data_ini)." 00:00:00' AND '".data_br_to_iso($data_fin)." 23:59:59' AND entradas.metade = 's' ) AS vendaMetades")
                ->selectRaw("(SELECT COUNT(entradas.valor) FROM entradas WHERE entradas.id_produto = produtos.id AND entradas.created_at BETWEEN '".data_br_to_iso($data_ini)." 00:00:00' AND '".data_br_to_iso($data_fin)." 23:59:59' AND entradas.metade IS NULL ) AS vendaInteiras")
                ->selectRaw("(SELECT SUM(estoques.quantidade) FROM estoques WHERE tipo_estoque = 'd' AND estoques.created_at BETWEEN '".data_br_to_iso($data_ini)." 00:00:00' AND '".data_br_to_iso($data_fin)." 23:59:59' AND id_produto = produtos.id) AS desperdicio")
                ->join('estoques', 'estoques.id_produto', 'produtos.id')
                ->join('entradas','entradas.id_produto','produtos.id');

                $entradas->selectRaw('SUM(entradas.valor) as total_entradas');
                $saidas->selectRaw('SUM(saidas.valor) as total_saidas');
            }
            $produtos = $produtos->get();
            dd($produtos);
            $entradas = $entradas->get();
            $saidas = $saidas->get();
            // $resultados = $entradas - $saidas;
            $sobra = $produtos === [] ? $produtos->producao - ($produtos->venda + $produtos->desperdicio) : 0;

            return view('home', [
                'users' => $users,
                'entradas' => $entradas,
                'saidas' => $saidas,
                'produtos' => $produtos,
                'sobra' => $sobra,
                'mes' => $mes
            ]);
        }

    }

}
// else {
//     $user_id = auth()->user()->id;
//     if(!$request->filled('data_ini_home') || !$request->filled('data_fin_home')){
//         return redirect()->route('home',[
//             'data_ini_home'=>(new \DateTime('first day of this month'))
//             ->format('d/m/Y'),
//             'data_fin_home'=>(new \DateTime('last day of this month'))
//             ->format('d/m/Y')
//         ]);
//     }
//     $data_ini = $request->data_ini_home;
//     $data_fin = $request->data_fin_home;

//     $entradas = Entrada::query();
//     $saidas = Saida::query();

//     $produtos = Produto::query();

//     $entradas->selectRaw('SUM(entradas.valor) as total_entradas WHERE entradas.user_id = '.$user_id);
//     $saidas->selectRaw('SUM(saidas.valor) as total_saidas WHERE saidas.user_id = '.$user_id);

//     $produtos->selectRaw("(SELECT SUM(estoques.quantidade) FROM estoques WHERE tipo_estoque = 'p' AND estoques.created_at BETWEEN '".data_br_to_iso($data_ini)." 00:00:00' AND '".data_br_to_iso($data_fin)." 23:59:59' AND id_produto = produtos.id AND estoques.user_id = $user_id) AS producao")
//     ->selectRaw("(SELECT COUNT(entradas.valor) FROM entradas WHERE entradas.id_produto = produtos.id AND entradas.created_at BETWEEN '".data_br_to_iso($data_ini)." 00:00:00' AND '".data_br_to_iso($data_fin)." 23:59:59' AND entradas.metade IS NULL AND entradas.user_id = $user_id ) AS venda")
//     ->selectRaw("(SELECT SUM(estoques.quantidade) FROM estoques WHERE tipo_estoque = 'd' AND estoques.created_at BETWEEN '".data_br_to_iso($data_ini)." 00:00:00' AND '".data_br_to_iso($data_fin)." 23:59:59' AND id_produto = produtos.id AND estoques.user_id = $user_id) AS desperdicio")
//     ->leftJoin('estoques', 'estoques.id_produto', '=', 'produtos.id')
//     ->join('entradas','entradas.id_produto','produtos.id')
//     ->where('estoques.user_id','=',$user_id);

//     $produtos = $produtos->get();
//     $entradas = $entradas->get();
//     $saidas = $saidas->get();
//     // $resultados = $entradas - $saidas;
//     dd($produtos);
//     $sobra = $produtos === [] ? $produtos->producao - ($produtos->venda + $produtos->desperdicio) : 0;

//     return view('home', [
//         'entradas' => $entradas[0],
//         'saidas' => $saidas[0],
//         'produtos' => $produtos[0],
//         'sobra' => $sobra,
//         'mes' => $mes
//     ]);
// }
