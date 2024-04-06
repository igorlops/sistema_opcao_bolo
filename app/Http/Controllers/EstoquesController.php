<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Models\Estoque;
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
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $estoques = Estoque::where('tipo_estoque', 'LIKE', "%$keyword%")
                ->orWhere('quantidade', 'LIKE', "%$keyword%")
                ->orWhere('id_produto', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $estoques = Estoque::latest()->paginate($perPage);
        }

        return view('estoques.index', compact('estoques'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $produtos = Produto::all();
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

        if(auth()->user()->type_user === 1){
            return redirect()->route('estoques')->with('flash_message', 'Estoque added!');
        }
        return redirect()->route('estoques.create');
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

        return redirect()->route('estoques')->with('flash_message', 'Estoque updated!');
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

        return redirect()->route('estoques')->with('flash_message', 'Estoque deleted!');
    }
}
