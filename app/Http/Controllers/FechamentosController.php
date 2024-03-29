<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

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
            $fechamentos = Fechamento::where('total_vendas', 'LIKE', "%$keyword%")
                ->orWhere('total_pagamentos', 'LIKE', "%$keyword%")
                ->orWhere('saldo_ini', 'LIKE', "%$keyword%")
                ->orWhere('saldo_fin', 'LIKE', "%$keyword%")
                ->orWhere('diferenca_caixa', 'LIKE', "%$keyword%")
                ->orWhere('observacao', 'LIKE', "%$keyword%")
                ->orWhere('id_imagem', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
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
        return view('fechamentos.create');
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
			'total_vendas' => 'required|string|max:100',
			'total_pagamentos' => 'required|text',
			'saldo_ini' => 'required',
			'saldo_fin' => 'required',
			'diferenca_caixa' => 'required',
			'observacao' => 'string',
			'id_imagem' => 'string',
			'user_id' => 'required'
		]);
        $requestData = $request->all();
        
        Fechamento::create($requestData);

        return redirect('fechamentos')->with('flash_message', 'Fechamento added!');
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
			'total_vendas' => 'required|string|max:100',
			'total_pagamentos' => 'required|text',
			'saldo_ini' => 'required',
			'saldo_fin' => 'required',
			'diferenca_caixa' => 'required',
			'observacao' => 'string',
			'id_imagem' => 'string',
			'user_id' => 'required'
		]);
        $requestData = $request->all();
        
        $fechamento = Fechamento::findOrFail($id);
        $fechamento->update($requestData);

        return redirect('fechamentos')->with('flash_message', 'Fechamento updated!');
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

        return redirect('fechamentos')->with('flash_message', 'Fechamento deleted!');
    }
}
