<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EstoqueProduto;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Http\Request;

class EstoqueProdutosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        if(!$request->filled('data_ini') || !$request->filled('data_fin')){
            return redirect()->route('estoque-produtos.index',[
                'data_ini'=>(new \DateTime('first day of this month'))
                ->format('d/m/Y'),
                'data_fin'=>(new \DateTime('last day of this month'))
                ->format('d/m/Y')
            ]);
        }
        $perPage = 10;
        $users = User::all();
        $produtos = new Produto();
        $produtos = $produtos->relacaoProdutosEstoque(data_br_to_iso($request->data_ini). ' 00:00:00',data_br_to_iso($request->data_fin).' 23:59:59');
        $estoques = EstoqueProduto::whereBetween('created_at',[data_br_to_iso($request->data_ini). ' 00:00:00',data_br_to_iso($request->data_fin).' 23:59:59'])->latest()->paginate($perPage);
        // dd("Entrei aqui");
        return view('estoque-produtos.index',compact('produtos','users','estoques'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $produtos = Produto::where('tipo_produto','=','e')->get();
        $users = User::all();
        return view('estoque-produtos.create',compact('produtos','users'));
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
			'id_produto' => 'required',
            'id_user_estoque' => 'required'
		]);
        $requestData = $request->all();

        EstoqueProduto::create($requestData);

        if(auth()->user()->type_user == 1){
            return redirect()->route('estoque-produtos.index')->with('success', 'Estoque adicionado!');
        }
        return redirect()->route('estoque-produtos.create')->with('success', 'Estoque adicionado!');
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
        $estoque = EstoqueProduto::findOrFail($id);

        return view('estoque-produtos.show', compact('estoque'));
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
        $estoque = EstoqueProduto::findOrFail($id);
        $produtos = Produto::where('tipo_produto','=','e')->get();
        $users = User::all();
        return view('estoque-produtos.edit', compact('estoque','produtos','users'));
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
			'id_produto' => 'required',
            'id_user_estoque' => 'required'
		]);
        $requestData = $request->all();

        $estoque = EstoqueProduto::findOrFail($id);
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
        EstoqueProduto::destroy($id);

        return redirect()->route('estoques')->with('success', 'Estoque deletado!');
    }
}
