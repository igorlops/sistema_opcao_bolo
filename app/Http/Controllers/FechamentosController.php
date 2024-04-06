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

        return view('fechamentos.index', compact('fechamentos'));
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
