<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Models\Estoque;
use App\Models\Entrada;
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
        $user_id = null;
        if($request->user_selected){
            $user_id = $request->user_selected;
        }
        $users = User::all();
        $produtos = new Produto();

        if(auth()->user()->type_user == 1){
            $produtos = $produtos->relacaoProdutos(data_br_to_iso($request->data_ini),data_br_to_iso($request->data_fin));

        } else if (auth()->user()->type_user == 2 || $user_id){
            $produtos = $produtos->relacaoProdutos(data_br_to_iso($request->data_ini),data_br_to_iso($request->data_fin), auth()->user()->type_user == 2 ? auth()->user()->id : $user_id);
        }
        // dd("Entrei aqui");
        return view('estoques.index',compact('produtos','users'));
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

        if(auth()->user()->type_user == 1){
            return redirect()->route('estoques.index')->with('success', 'Estoque adicionado!');
        }
        return redirect()->route('estoques.create')->with('success', 'Estoque adicionado!');
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

        return redirect()->route('estoques')->with('success', 'Estoque atualizado!');
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

        return redirect()->route('estoques')->with('success', 'Estoque deletado!');
    }
}
