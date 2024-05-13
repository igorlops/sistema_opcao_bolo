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
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 10;
        $tipo = $request->get('tipo');

        if($tipo === "variavel") {
            if (!empty($keyword)) {
                $saidas = Saida::where('valor', 'LIKE', "%$keyword%")
                ->orWhere('observacao', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->orWhere('id_descricao', 'LIKE', "%$keyword%")
                ->where('tipo','=','variavel')
                ->latest()->paginate($perPage);
            } else {
                $saidas = Saida::where('tipo','=','variavel')->latest()->paginate($perPage);
            }

            return view('saidas.index', compact('saidas'));
        }elseif($tipo === "fixo") {
            if (!empty($keyword)) {
                $saidas = Saida::where('valor', 'LIKE', "%$keyword%")
                ->orWhere('observacao', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->orWhere('id_descricao', 'LIKE', "%$keyword%")
                ->where('tipo', '=', "fixo")
                ->latest()->paginate($perPage);
            } else {
                $saidas = Saida::where('tipo', '=', "fixo")->latest()->paginate($perPage);
            }
            return view('saidas-fixas.index', compact('saidas'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $tipo = $request->get('tipo');
        if($tipo === 'fixo') {
            $descricoes = TipoSaida::where('is_fixo','=','s')->get();
            return view('saidas-fixas.create', compact('descricoes'));
        }
        elseif($tipo === 'variavel') {
            $descricoes = TipoSaida::where('is_fixo','=','n')->get();
            return view('saidas.create', compact('descricoes'));
        }
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
        // dd($requestData["tipo"]);
        Saida::create($requestData);
        if(auth()->user()->type_user == 2){
            return redirect()->to(route('saidas.create'). "?tipo=".$requestData["tipo"])->with('tipo',$requestData["tipo"])->with('success', 'Saida cadastrada!');
        }
        elseif(auth()->user()->type_user == 1) {
            if($requestData["tipo"] === "variavel") {
                return redirect()->to(route('saidas.index'). "?tipo=".$requestData["tipo"])->with('tipo',$requestData["tipo"])->with('success', 'Saida cadastrada!');
            }
            elseif($requestData["tipo"] === "fixo") {
                return redirect()->to(route('saidas.index'). "?tipo=".$requestData["tipo"])->with('tipo',$requestData["tipo"])->with('success', 'Saida cadastrada!');
            }
        }
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
        dd($saida);
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
        $requestData = $request->all();

        $saida = Saida::findOrFail($id);
        $saida->update($requestData);

        return redirect()->route('saidas.index')->with('tipo',$request->tipo)->with('success', 'Saida atualizada!');
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
