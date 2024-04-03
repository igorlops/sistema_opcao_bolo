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
        $perPage = 25;

        if (!empty($keyword)) {
            $produtos = Produto::where('nome', 'LIKE', "%$keyword%")
                ->orWhere('is_bolo_extra', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $produtos = Produto::latest()->paginate($perPage);
        }

        return view('produtos.index', compact('produtos'));
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
			'is_bolo_extra' => 'required'
		]);
        $requestData = $request->all();
        
        Produto::create($requestData);

        return redirect()->route('produtos.index')->with('flash_message', 'Produto added!');
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

        return redirect()->route('produtos.index')->with('flash_message', 'Produto updated!');
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

        return redirect()->route('produtos.index')->with('flash_message', 'Produto deleted!');
    }
}
