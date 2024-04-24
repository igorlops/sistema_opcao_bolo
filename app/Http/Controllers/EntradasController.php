<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Http\Requests\EntradaRequest;
use App\Models\Entrada;
use App\Models\Produto;
use App\Models\TipoPagamento;
use Illuminate\Http\Request;

class EntradasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(EntradaRequest $request)
    {
        $keyword = $request->get('search');
        $perPage = 10;

        if (!empty($keyword)) {
            $entradas = Entrada::where('tipo_entrada', 'LIKE', "%$keyword%")
                ->orWhere('observacao', 'LIKE', "%$keyword%")
                ->orWhere('id_tipo_pagamento', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->orWhere('id_produto', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $entradas = Entrada::latest()->paginate($perPage);
        }

        return view('entradas.index', compact('entradas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $tipo_pagamentos = TipoPagamento::all();
        $produtos = Produto::all();
        return view('entradas.create',compact('tipo_pagamentos','produtos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\EntradaRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(EntradaRequest $request)
    {
        $requestData = $request->all();
        Entrada::create($requestData);

        if(auth()->user()->type_user == 2){
            return redirect()->route('entradas.create')->with('success', 'Entrada Adicionada!');
        }
        return redirect()->route('entradas.index')->with('success', 'Entrada Adicionada!');
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
        $entrada = Entrada::findOrFail($id);
        return view('entradas.show', compact('entrada'));
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
        $entrada = Entrada::findOrFail($id);
        $tipo_pagamentos = TipoPagamento::all();
        $produtos = Produto::all();
        return view('entradas.edit', compact('entrada','tipo_pagamentos','produtos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\EntradaRequest $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(EntradaRequest $request, $id)
    {
        $requestData = $request->all();

        $entrada = Entrada::findOrFail($id);
        $entrada->update($requestData);

        return redirect()->route('entradas.index')->with('success', 'Entrada Atualizada!');
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
        Entrada::destroy($id);

        return redirect()->route('entradas.index')->with('success', 'Entrada deletada!');
    }
}
