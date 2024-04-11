<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Models\Estoque;
use App\Models\User;
use Illuminate\Http\Request;

class EstoquesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        if(!$request->filled('data_ini') || !$request->filled('data_fin')){
            return redirect()->route('estoques.index',[
                'data_ini'=>(new \DateTime())
                ->format('d/m/Y'),
                'data_fin'=>(new \DateTime())
                ->format('d/m/Y')
            ]);
        }

        // dd(data_br_to_iso($request->data_ini));

        $produtos = Produto::select('produtos.id', 'produtos.nome')
        ->selectRaw("(SELECT SUM(estoques.quantidade) FROM estoques WHERE tipo_estoque = 'd' AND created_at BETWEEN '".data_br_to_iso($request->data_ini)." 00:00:00' AND '".data_br_to_iso($request->data_fin)." 23:59:59' AND id_produto = produtos.id  AND estoques.user_id = ".auth()->user()->id.") AS desperdicio")
        ->selectRaw("(SELECT SUM(estoques.quantidade) FROM estoques WHERE tipo_estoque = 'p' AND created_at BETWEEN '".data_br_to_iso($request->data_ini)." 00:00:00' AND '".data_br_to_iso($request->data_fin)." 23:59:59'  AND id_produto = produtos.id AND estoques.user_id = ".auth()->user()->id." ) AS producao")
        ->selectRaw("(SELECT COUNT(entradas.valor) FROM entradas WHERE created_at BETWEEN '".data_br_to_iso($request->data_ini)." 00:00:00' AND '".data_br_to_iso($request->data_fin)." 23:59:59'  AND entradas.id_produto = produtos.id AND entradas.user_id = ".auth()->user()->id." AND entradas.metade IS NULL ) AS venda")
        ->addSelect('estoques.user_id')
        ->leftJoin('estoques', 'estoques.id_produto', '=', 'produtos.id')
        ->leftJoin('users', 'estoques.user_id', '=', 'users.id')
        ->groupBy('produtos.id','produtos.nome', 'estoques.user_id')
        ->get();
        // dd($produtos);
        // $users = User::all();
        // $produtosAllUsersAll = [];

        // if(auth()->user()->type_user == 1){
        //     foreach($users as $key=>$user){
        //         $produtosAllUsers = Produto::select('produtos.id', 'produtos.nome')
        //         ->selectRaw("(SELECT SUM(estoques.quantidade) FROM estoques WHERE tipo_estoque = 'd' AND created_at BETWEEN '".data_br_to_iso($request->data_ini)." 00:00:00' AND '".data_br_to_iso($request->data_fin)." 23:59:59' AND id_produto = produtos.id ) AS desperdicio")
        //         ->selectRaw("(SELECT SUM(estoques.quantidade) FROM estoques WHERE tipo_estoque = 'p' AND created_at BETWEEN '".data_br_to_iso($request->data_ini)." 00:00:00' AND '".data_br_to_iso($request->data_fin)." 23:59:59'  AND id_produto = produtos.id ) AS producao")
        //         ->selectRaw("(SELECT COUNT(entradas.valor) FROM entradas WHERE created_at BETWEEN '".data_br_to_iso($request->data_ini)." 00:00:00' AND '".data_br_to_iso($request->data_fin)." 23:59:59'  AND entradas.id_produto = produtos.id ) AS venda")
        //         ->addSelect('estoques.user_id')
        //         ->leftJoin('estoques', 'estoques.id_produto', '=', 'produtos.id')
        //         ->leftJoin('users', 'estoques.user_id', '=', 'users.id')
        //         ->where('users.id','=',$user->id)
        //         ->groupBy('produtos.id','produtos.nome', 'estoques.user_id')
        //         ->get();
        //         $produtosAllUsersAll[] = $produtosAllUsers;
        //     }
        // }

        return view('estoques.index',compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $produtos = Produto::all();
        return view('estoques.create',compact('produtos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'tipo_estoque' => 'required',
			'quantidade' => 'required',
			'id_produto' => 'required'
		]);
        $requestData = $request->all();

        Estoque::create($requestData);

        if(auth()->user()->type_user === 1){
            return redirect()->route('estoques')->with('flash_message', 'Estoque added!');
        }
        return redirect()->route('estoques.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $estoque = Estoque::findOrFail($id);

        return view('estoques.show', compact('estoque'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $estoque = Estoque::findOrFail($id);

        return view('estoques.edit', compact('estoque'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'tipo_estoque' => 'required',
			'quantidade' => 'required',
			'id_produto' => 'required'
		]);
        $requestData = $request->all();

        $estoque = Estoque::findOrFail($id);
        $estoque->update($requestData);

        return redirect()->route('estoques')->with('flash_message', 'Estoque updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Estoque::destroy($id);

        return redirect()->route('estoques')->with('flash_message', 'Estoque deleted!');
    }
}
