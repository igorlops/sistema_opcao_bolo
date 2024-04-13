<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Produto;

use App\Models\Fechamento;
use Illuminate\Http\Request;

class FechamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $fechamentos = Fechamento::where('vendas_extras', 'LIKE', "%$keyword%")
                ->orWhere('desconto', 'LIKE', "%$keyword%")
                ->orWhere('vendas_abc', 'LIKE', "%$keyword%")
                ->orWhere('total_caixa', 'LIKE', "%$keyword%")
                ->orWhere('env', 'LIKE', "%$keyword%")
                ->orWhere('cartao_cred', 'LIKE', "%$keyword%")
                ->orWhere('cartao_deb', 'LIKE', "%$keyword%")
                ->orWhere('pix', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $fechamentos = Fechamento::latest()->paginate($perPage);
        }
        $produtos = Produto::select('produtos.id', 'produtos.nome')
        ->selectRaw("(SELECT SUM(estoques.quantidade) FROM estoques WHERE tipo_estoque = 'd' AND created_at BETWEEN '".data_br_to_iso($request->data_ini)." 00:00:00' AND '".data_br_to_iso($request->data_fin)." 23:59:59' AND id_produto = produtos.id AND estoques.user_id = ".auth()->user()->id.") AS desperdicio")
        ->selectRaw("(SELECT SUM(estoques.quantidade) FROM estoques WHERE tipo_estoque = 'p' AND created_at BETWEEN '".data_br_to_iso($request->data_ini)." 00:00:00' AND '".data_br_to_iso($request->data_fin)." 23:59:59'  AND id_produto = produtos.id AND estoques.user_id = ".auth()->user()->id.") AS producao")
        ->selectRaw("(SELECT COUNT(entradas.valor) FROM entradas WHERE created_at BETWEEN '".data_br_to_iso($request->data_ini)." 00:00:00' AND '".data_br_to_iso($request->data_fin)." 23:59:59'  AND entradas.id_produto = produtos.id  AND estoques.user_id = ".auth()->user()->id.") AS venda")
        ->addSelect('estoques.user_id')
        ->leftJoin('estoques', 'estoques.id_produto', '=', 'produtos.id')
        ->leftJoin('users', 'estoques.user_id', '=', 'users.id')
        ->where('users.id','=',auth()->user()->id)
        ->groupBy('produtos.id','produtos.nome', 'estoques.user_id')
        ->get();

        return view('fechamentos.index', compact('fechamentos','produtos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $produtos = Produto::all();
        return view('fechamentos.create', compact('produtos'));
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
			'vendas_abc' => 'required',
			'total_caixa' => 'required',
			'env' => 'required',
			'cartao_cred' => 'required',
			'cartao_deb' => 'required',
			'pix' => 'required'
		]);
        $requestData = $request->all();

        Fechamento::create($requestData);

        return redirect()->route('fechamentos')->with('flash_message', 'Fechamento added!');
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
        $fechamento = Fechamento::findOrFail($id);

        return view('fechamentos.show', compact('fechamento'));
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
        $fechamento = Fechamento::findOrFail($id);

        return view('fechamentos.edit', compact('fechamento'));
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
			'vendas_abc' => 'required',
			'total_caixa' => 'required',
			'env' => 'required',
			'cartao_cred' => 'required',
			'cartao_deb' => 'required',
			'pix' => 'required'
		]);
        $requestData = $request->all();

        $fechamento = Fechamento::findOrFail($id);
        $fechamento->update($requestData);

        return redirect()->route('fechamentos')->with('flash_message', 'Fechamento updated!');
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
        Fechamento::destroy($id);

        return redirect()->route('fechamentos')->with('flash_message', 'Fechamento deleted!');
    }
}
