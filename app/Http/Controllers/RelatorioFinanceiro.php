<?php

namespace App\Http\Controllers;

use App\Exports\RelatoryDataExport;
use App\Exports\RelatoryDataExportLucro;
use App\Models\Entrada;
use App\Models\Fechamento;
use App\Models\Produto;
use App\Models\TipoPagamento;
use App\Models\TipoSaida;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Excel;

class RelatorioFinanceiro extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return View
     */
    public function index(Request $request)
    {
        if(!$request->filled('data_inicial') || !$request->filled('data_final')){
            return redirect()->route('relatorios.index',[
                'data_inicial'=>(new \DateTime('first day of this month'))
                ->format('d/m/Y'),
                'data_final'=>(new \DateTime('last day of this month'))
                ->format('d/m/Y')
            ]);
        }
        $data_inicial = \data_br_to_iso($request->data_inicial);
        $data_final = \data_br_to_iso($request->data_final);

        $users = User::all();
        $formaPagamentos = TipoPagamento::all();
        $tipoSaidas = TipoSaida::all();
        $produtos = Produto::all();


        $user_id = $request->usuario_select;
        $formaPagamento = $request->formaPagamento;
        $tipoSaida = $request->tipo_saida;
        $produto = $request->produto;

        $pagamentos = TipoPagamento::select('tipo_pagamentos.id', 'tipo_pagamentos.nome')
                ->selectRaw('(SELECT SUM(entradas.valor)
                    FROM entradas
                    WHERE entradas.id_tipo_pagamento = tipo_pagamentos.id
                    '.($user_id ? "AND entradas.user_id = '$user_id'" : '').'
                    '.($formaPagamento || $formaPagamento != '' ? "AND entradas.id_tipo_pagamento = $formaPagamento" : '').'
                    '.($produto || $produto != '' ? "AND entradas.id_produto = $produto" : '').'
                    AND entradas.created_at
                    BETWEEN "'.$data_inicial.' 00:00:00" AND "'.$data_final.' 23:59:59") as soma_valores')
                ->whereBetween('tipo_pagamentos.created_at', [$data_inicial ." 00:00:00", $data_final ." 23:59:59"])
                ->groupBy('tipo_pagamentos.id', 'tipo_pagamentos.nome')
                ->get();


        $saida = TipoSaida::select('tipo_saidas.descricao','tipo_saidas.id')
                ->selectRaw('(SELECT SUM(saidas.valor)
                    FROM saidas
                    WHERE saidas.id_descricao = tipo_saidas.id
                    '.($user_id ? "AND saidas.user_id = $user_id " : '').'
                    '.($tipoSaida || $tipoSaida != '' ? "AND saidas.id_descricao = $tipoSaida " : '').'
                    AND saidas.created_at BETWEEN "'.$data_inicial.' 00:00:00"
                                            AND "'.$data_final.' 23:59:59") as soma_saidas')
                ->whereBetween('created_at',[$data_inicial,$data_final])
                ->groupBy('tipo_saidas.descricao','tipo_saidas.id')
                ->get();

        $produto_vendidos = Produto::select('produtos.id','produtos.nome')
                ->selectRaw('(SELECT COUNT("*")
                    FROM entradas
                    WHERE entradas.id_produto = produtos.id
                    '.($user_id ? "AND entradas.user_id = $user_id" : '' ).'
                    '.($formaPagamento || $formaPagamento != '' ? "AND entradas.id_tipo_pagamento = $formaPagamento " : '').'
                    '.($produto || $produto != '' ? "AND entradas.id_produto = $produto " : '').'
                    AND entradas.created_at BETWEEN "'.$data_inicial.' 00:00:00"
                    AND "'.$data_final.' 23:59:59") as contador_produtos')
                ->whereBetween('created_at',[$data_inicial,$data_final])
                ->groupBy('produtos.nome','produtos.id')
                ->get();

        $fechamento = new Fechamento();
        $fechamento = $fechamento->relatorioFinanceiro($data_inicial,$data_final,$user_id);


        // dd($fechamento);
        return view('relatorios.index', [
            'users'=>$users,
            'pagamentos' => $formaPagamentos,
            'tipoSaidas' => $tipoSaidas,
            'produtos' => $produtos,
            'filtro_pagamentos' => $pagamentos,
            'filtro_saida' => $saida,
            'filtro_vendas' => $produto_vendidos,
            'fechamento' => $fechamento
        ]);

    }

    public function exportExcelResume(Request $request)
    {
        $data_inicial = data_br_to_iso($request->input('data_ini_export_relatory'));
        $data_final = data_br_to_iso($request->input('data_fin_export_relatory'));
        return \Maatwebsite\Excel\Facades\Excel::download( new RelatoryDataExport($data_inicial,$data_final), 'relatorio_mensal.xlsx');
    }

    public function exportExcelLucro(Request $request)
    {
        $data_inicial = data_br_to_iso($request->input('data_ini_export'));
        $data_final = data_br_to_iso($request->input('data_fin_export'));
        return \Maatwebsite\Excel\Facades\Excel::download( new RelatoryDataExportLucro($data_inicial,$data_final), 'lucro_mensal.xlsx');
    }

}
