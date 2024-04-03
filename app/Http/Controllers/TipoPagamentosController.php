<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\TipoPagamento;
use Illuminate\Http\Request;

class TipoPagamentosController extends Controller
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
            $tipopagamentos = TipoPagamento::where('nome', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $tipopagamentos = TipoPagamento::latest()->paginate($perPage);
        }

        return view('tipo-pagamentos.index', compact('tipopagamentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('tipo-pagamentos.create');
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
			'nome' => 'required|string|max:255'
		]);
        $requestData = $request->all();
        
        TipoPagamento::create($requestData);

        return redirect()->route('tipo-pagamentos.index')->with('flash_message', 'TipoPagamento added!');
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
        $tipopagamento = TipoPagamento::findOrFail($id);

        return view('tipo-pagamentos.show', compact('tipopagamento'));
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
        $tipopagamento = TipoPagamento::findOrFail($id);

        return view('tipo-pagamentos.edit', compact('tipopagamento'));
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
			'nome' => 'required|string|max:255'
		]);
        $requestData = $request->all();
        
        $tipopagamento = TipoPagamento::findOrFail($id);
        $tipopagamento->update($requestData);

        return redirect()->route('tipo-pagamentos.index')->with('flash_message', 'TipoPagamento updated!');
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
        TipoPagamento::destroy($id);

        return redirect()->route('tipo-pagamentos.index')->with('flash_message', 'TipoPagamento deleted!');
    }
}
