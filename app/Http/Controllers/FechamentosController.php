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
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $perPage = 25;
    
        $query = Fechamento::select('*')
            ->join('users as u', 'u.id', '=', 'fechamentos.user_id')
            ->join('entradas as in', 'in.user_id', '=', 'fechamentos.user_id')
            ->join('saidas as out', 'out.user_id', '=', 'fechamentos.user_id');
    
        if (!empty($startDate) && !empty($endDate)) {
            $query->whereBetween('fechamentos.created_at', [$startDate . '00:00:00', $endDate . '23:59:59']);
            $query->whereBetween('in.created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
            $query->whereBetween('out.created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }
    
        if (!empty($keyword)) {
            $query->where(function($q) use ($keyword) {
                $q->where('total_vendas', 'LIKE', "%$keyword%")
                  ->orWhere('total_pagamentos', 'LIKE', "%$keyword%")
                  ->orWhere('saldo_ini', 'LIKE', "%$keyword%")
                  ->orWhere('saldo_fin', 'LIKE', "%$keyword%")
                  ->orWhere('diferenca_caixa', 'LIKE', "%$keyword%")
                  ->orWhere('observacao', 'LIKE', "%$keyword%")
                  ->orWhere('id_imagem', 'LIKE', "%$keyword%")
                  ->orWhere('user_id', 'LIKE', "%$keyword%");
            });
        }
    
        $fechamentos = $query->latest()->paginate($perPage);
    
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
			'id_imagem' => 'file',
			'user_id' => 'required'
		]);
        $data_comprovante = now()->format('Y-m-d');
        $nomeArquivo = $data_comprovante . '_' . $request->user_id . '_' .  $request->
                                                                            file('id_imagem')->
                                                                            getClientOriginalName();


        $request->file('id_imagem')->storeAs("imagens/comprovantes",$nomeArquivo);
        $requestData = $request->all();
        
        Fechamento::create($requestData);
        if(auth()->user()->type_user === "2"){
            return redirect()->route('fechamentos.create');
        }
        return redirect()->route('fechamentos.index')->with('flash_message', 'Fechamento added!');
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

        return redirect()->route('fechamentos.index')->with('flash_message', 'Fechamento updated!');
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

        return redirect()->route('fechamentos.index')->with('flash_message', 'Fechamento deleted!');
    }
}
