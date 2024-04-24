<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Http\Requests\SaidaRequest;
use App\Models\Saida;
use App\Models\TipoSaida;
use Illuminate\Http\Request;

class SaidasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(SaidaRequest $request)
    {
        $keyword = $request->get('search');
        $perPage = 10;

        if (!empty($keyword)) {
            $saidas = Saida::where('valor', 'LIKE', "%$keyword%")
                ->orWhere('observacao', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->orWhere('id_descricao', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $saidas = Saida::latest()->paginate($perPage);
        }

        return view('saidas.index', compact('saidas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $descricoes = TipoSaida::all();
        return view('saidas.create', compact('descricoes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\SaidaRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(SaidaRequest $request)
    {
        $requestData = $request->all();

        Saida::create($requestData);
        if(auth()->user()->type_user == 2){
            return redirect()->route('saidas.create')->with('success', 'Saida cadastrada!');
        }
        return redirect()->route('saidas.index')->with('success', 'Saida cadastrada!');
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
        $saida = Saida::findOrFail($id);

        return view('saidas.show', compact('saida'));
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
        $saida = Saida::findOrFail($id);

        return view('saidas.edit', compact('saida'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\SaidaRequest $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(SaidaRequest $request, $id)
    {
        $this->validate($request, [
			'valor' => 'required|string|max:100',
			'user_id' => 'required',
			'id_descricao' => 'required'
		]);
        $requestData = $request->all();

        $saida = Saida::findOrFail($id);
        $saida->update($requestData);

        return redirect()->route('saidas.index')->with('success', 'Saida atualizada!');
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
        Saida::destroy($id);

        return redirect()->route('saidas.index')->with('success', 'Saida deletada!');
    }
}
