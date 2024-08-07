<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 10;

        if (!empty($keyword)) {
            $produtos = Produto::where('nome', 'LIKE', "%$keyword%")
                ->orWhere('is_bolo_extra', 'LIKE', "%$keyword%")
                ->where('tipo_produto','=','p')
                ->latest()->paginate($perPage);

            $produtos_estoque = Produto::where('nome', 'LIKE', "%$keyword%")
                ->orWhere('is_bolo_extra', 'LIKE', "%$keyword%")
                ->where('tipo_produto','=','e')
                ->latest()->paginate($perPage);
        } else {
            $produtos = Produto::where('tipo_produto','=','p')->latest()->paginate($perPage,['*'],'page_producao');
            $produtos_estoque = Produto::where('tipo_produto','=','e')->latest()->paginate($perPage,['*'],'page_estoque');
        }

        return view('produtos.index', compact('produtos','produtos_estoque'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('produtos.create');
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
			'nome' => 'required|string|max:255',
			'is_bolo_extra' => 'required',
            'tipo_produto' => 'required'
		]);
        $requestData = $request->all();

        Produto::create($requestData);

        return redirect()->route('produtos.index')->with('success', 'Produto adicionado!');
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
        $produto = Produto::findOrFail($id);

        return view('produtos.show', compact('produto'));
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
        $produto = Produto::findOrFail($id);

        return view('produtos.edit', compact('produto'));
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
			'nome' => 'required|string|max:255',
			'is_bolo_extra' => 'required'
		]);
        $requestData = $request->all();

        $produto = Produto::findOrFail($id);
        $produto->update($requestData);

        return redirect()->route('produtos.index')->with('success', 'Produto atualizado!');
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
        Produto::destroy($id);

        return redirect()->route('produtos.index')->with('success', 'Produto deletado!');
    }
}
