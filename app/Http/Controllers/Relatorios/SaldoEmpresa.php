<?php

namespace App\Http\Controllers\Relatorios;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Models\Saldo;
use Illuminate\Http\Request;

class SaldoEmpresa extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\Factory|Illuminate\Contracts\View\View
     */
    public function __invoke(Empresa $empresa,Request $request)
    {
        if(!$request->filled('data_inicial') || !$request->filled('data_final')){
            return redirect()->route('relatorios.index',[
                'empresa'=>$empresa,
                'data_inicial'=>(new \DateTime('first day of this month'))
                ->format('d/m/Y'),
                'data_final'=>(new \DateTime('last day of this month'))
                ->format('d/m/Y')
            ]);
        }
        $saldo = Saldo::buscaPorIntervalo(
            $empresa->id,
            data_br_to_iso($request->data_inicial),
            data_br_to_iso($request->data_final)
        );

    }
}
