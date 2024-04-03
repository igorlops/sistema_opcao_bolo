<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\TipoSaida;
use Illuminate\Http\Request;

class TipoSaidasController extends Controller
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
            $tiposaidas = TipoSaida::where('descricao', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $tiposaidas = TipoSaida::latest()->paginate($perPage);
        }

        return view('tipo-saidas.index', compact('tiposaidas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('tipo-saidas.create');
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
			'descricao' => 'required|string'
		]);
        $requestData = $request->all();
        
        TipoSaida::create($requestData);

        return redirect()->route('tipo-saidas.index')->with('flash_message', 'TipoSaida added!');
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
        $tiposaida = TipoSaida::findOrFail($id);

        return view('tipo-saidas.show', compact('tiposaida'));
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
        $tiposaida = TipoSaida::findOrFail($id);

        return view('tipo-saidas.edit', compact('tiposaida'));
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
			'descricao' => 'required|string'
		]);
        $requestData = $request->all();
        
        $tiposaida = TipoSaida::findOrFail($id);
        $tiposaida->update($requestData);

        return redirect()->route('tipo-saidas.index')->with('flash_message', 'TipoSaida updated!');
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
        TipoSaida::destroy($id);

        return redirect()->route('tipo-saidas.index')->with('flash_message', 'TipoSaida deleted!');
    }
}
