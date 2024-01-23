<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\MovimentoFinanceiroRequest;
use App\Models\MovimentosFinanceiro;
use Illuminate\Http\Request;

class MovimentoFinanceiroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        if(!$request->filled('data_inicial') || !$request->filled('data_final')){
            return redirect()->route('movimentos-financeiros.index',[
                'data_inicial'=>(new \DateTime('first day of this month'))
                ->format('d/m/Y'),
                'data_final'=>(new \DateTime('last day of this month'))
                ->format('d/m/Y')
            ]);
        }
        $movimentos_financeiros = MovimentosFinanceiro::buscaPorIntervalo(
            data_br_to_iso($request->data_inicial),
            data_br_to_iso($request->data_final)
        );
        return view('movimentos-financeiros.index', compact('movimentos_financeiros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('movimentos-financeiros.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(MovimentoFinanceiroRequest $request)
    {
        $requestData = $request->all();
        
        MovimentosFinanceiro::create($requestData);

        return redirect('movimentos-financeiros')->with('flash_message', 'MovimentosFinanceiro added!');
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
        $movimentos_financeiro = MovimentosFinanceiro::findOrFail($id);

        return view('movimentos-financeiros.show', compact('movimentos_financeiro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        MovimentosFinanceiro::destroy($id);

        return redirect('movimentos-financeiros')->with('flash_message', 'MovimentosFinanceiro deleted!');
    }
}
