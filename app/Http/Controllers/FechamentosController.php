<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\FechamentoRequest;
use App\Models\Entrada;
use App\Models\Estoque;
use App\Models\Produto;

use App\Models\Fechamento;
use App\Models\ProdutosFechamento;
use Illuminate\Http\Request;

class FechamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(FechamentoRequest $request)
    {
        $keyword = $request->get('search');
        $perPage = 10;

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

        return view('fechamentos.index', compact('fechamentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data = new \DateTime();
        $data_atual = $data->format('Y-m-d');
        $produtos = new Produto();
        $produtos = $produtos->relacaoProdutos($data_atual,$data_atual, auth()->user()->id);

        $cartaoCredito = Entrada::where('created_at','LIKE',"%$data_atual%")->where('id_tipo_pagamento', '=', 3)->where('user_id','=',auth()->user()->id)->sum('valor');
        $cartaoDebito = Entrada::where('created_at','LIKE',"%$data_atual%")->where('id_tipo_pagamento','=',4)->where('user_id','=',auth()->user()->id)->sum('valor');
        $pix = Entrada::where('created_at','LIKE',"%$data_atual%")->where('id_tipo_pagamento','=',1)->where('user_id','=',auth()->user()->id)->sum('valor');
        $dinheiro = Entrada::where('created_at','LIKE',"%$data_atual%")->where('id_tipo_pagamento','=',2)->where('user_id','=',auth()->user()->id)->sum('valor');

        return view('fechamentos.create', compact('produtos','cartaoCredito','cartaoDebito','pix','dinheiro'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\FechamentoRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(FechamentoRequest $request)
    {
        $requestData = $request->all();

        $data = new \DateTime();
        $data_atual = $data->format('Y-m-d');
        $produtos = new Produto();
        $produtos = $produtos->relacaoProdutos($data_atual,$data_atual, auth()->user()->id);
        $fechamento = Fechamento::create($requestData);

        foreach ($produtos as $produto) {
            ProdutosFechamento::create([
                'id_fechamento'=>$fechamento->id,
                'producao'=>$produto->producao ? $produto->producao : '0',
                'desperdicio'=>$produto->desperdicio ? $produto->desperdicio : '0',
                'sobra'=> $produto->totalproducao - ($produto->totalvenda + $produto->totaldesperdicio),
                'bolos_vendidos'=>$produto->venda ? $produto->venda : '0',
                'id_produto'=>$produto->id
            ]);
        }

        if(auth()->user()->type_user == 2){
            return redirect()->route('fechamentos.create')->with('success', 'Fechamento adicionado!');
        }

        return redirect()->route('fechamentos.index')->with('success', 'Fechamento adicionado!');
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
        $produtos_fechamentos = ProdutosFechamento::where('id_fechamento','=',$id)->get();
        return view('fechamentos.show', compact('fechamento','produtos_fechamentos'));
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
     * @param \Illuminate\Http\FechamentoRequest $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(FechamentoRequest $request, $id)
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

        return redirect()->route('fechamentos')->with('success', 'Fechamento atualizado!');
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

        return redirect()->route('fechamentos')->with('success', 'Fechamento deletado!');
    }
}
