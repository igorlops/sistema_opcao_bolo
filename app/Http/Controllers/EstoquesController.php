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
        $user_id = $request->get('user_selected');
        $perPage = 10;
        $users = User::all();
        $produtos = new Produto();
        $estoques = Estoque::query();
        if (auth()->user()->type_user == 2 || !empty($user_id)){
            $estoques = $estoques
                ->where('user_id','=',auth()->user()->type_user == 2 ? auth()->user()->id : $user_id)
                ->whereBetween('created_at',[data_br_to_iso($request->data_ini). ' 00:00:00',data_br_to_iso($request->data_fin).' 23:59:59'])
                ->latest()
                ->paginate($perPage);

            $produtos = $produtos
                ->relacaoProdutosProducao(data_br_to_iso($request->data_ini). ' 00:00:00',data_br_to_iso($request->data_fin).' 23:59:59', auth()->user()->type_user == 2 ? auth()->user()->id : $user_id);
        }
        else if(auth()->user()->type_user == 1){
            $produtos = $produtos->relacaoProdutosProducao(data_br_to_iso($request->data_ini). ' 00:00:00',data_br_to_iso($request->data_fin).' 23:59:59');
            $estoques = $estoques->whereBetween('created_at',[data_br_to_iso($request->data_ini). ' 00:00:00',data_br_to_iso($request->data_fin).' 23:59:59'])->latest()->paginate($perPage);
        }
        // dd("Entrei aqui");
        return view('estoques.index',compact('produtos','users','estoques'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $produtos = Produto::where('tipo_produto','=','p')->get();
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
