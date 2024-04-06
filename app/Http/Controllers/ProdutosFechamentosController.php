<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\ProdutosFechamento;
use Illuminate\Http\Request;

class ProdutosFechamentosController extends Controller
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
            $produtosfechamentos = ProdutosFechamento::where('producao', 'LIKE', "%$keyword%")
                ->orWhere('desperdicio', 'LIKE', "%$keyword%")
                ->orWhere('sobra', 'LIKE', "%$keyword%")
                ->orWhere('bolos_vendidos', 'LIKE', "%$keyword%")
                ->orWhere('total_bolos_vendidos', 'LIKE', "%$keyword%")
                ->orWhere('id_produto', 'LIKE', "%$keyword%")
                ->orWhere('id_fechamento', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $produtosfechamentos = ProdutosFechamento::latest()->paginate($perPage);
        }

        return view('produtos-fechamentos.index', compact('produtosfechamentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('produtos-fechamentos.create');
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
			'producao' => 'required',
			'total_bolos_vendidos' => 'required',
			'id_produto' => 'required',
			'id_fechamento' => 'required'
		]);
        $requestData = $request->all();
        
        ProdutosFechamento::create($requestData);

        return redirect()->route('produtos-fechamentos')->with('flash_message', 'ProdutosFechamento added!');
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
        $produtosfechamento = ProdutosFechamento::findOrFail($id);

        return view('produtos-fechamentos.show', compact('produtosfechamento'));
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
        $produtosfechamento = ProdutosFechamento::findOrFail($id);

        return view('produtos-fechamentos.edit', compact('produtosfechamento'));
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
			'producao' => 'required',
			'total_bolos_vendidos' => 'required',
			'id_produto' => 'required',
			'id_fechamento' => 'required'
		]);
        $requestData = $request->all();
        
        $produtosfechamento = ProdutosFechamento::findOrFail($id);
        $produtosfechamento->update($requestData);

        return redirect()->route('produtos-fechamentos')->with('flash_message', 'ProdutosFechamento updated!');
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
        ProdutosFechamento::destroy($id);

        return redirect()->route('produtos-fechamentos')->with('flash_message', 'ProdutosFechamento deleted!');
    }
}
