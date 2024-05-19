<?php

namespace App\Http\Controllers;

use App\Exports\RelatoryDataExport;
use App\Exports\RelatoryDataExportLucro;
use App\Exports\RelatoryDataExportSistema;
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
        if (!$request->filled('data_inicial') || !$request->filled('data_final')) {
            return redirect()->route('relatorios.index', [
                'data_inicial' => (new \DateTime('first day of this month'))->format('d/m/Y'),
                'data_final' => (new \DateTime('last day of this month'))->format('d/m/Y')
            ]);
        }

        $data_inicial = \data_br_to_iso($request->data_inicial);
        $data_final = \data_br_to_iso($request->data_final);

        $users = User::all();
        $formaPagamentos = TipoPagamento::all();
        $tipoSaidas = TipoSaida::all();
        $produtos = Produto::where('tipo_produto','=','p')->get();

        $user_id = $request->usuario_select;
        $formaPagamento = $request->formaPagamento;
        $tipoSaida = $request->tipo_saida;
        $produto = $request->produto;

        $pagamentos = $this->getPagamentos($data_inicial, $data_final, $user_id, $formaPagamento, $produto);
        $saida = $this->getSaida($data_inicial, $data_final, $user_id, $tipoSaida);
        $produto_vendidos = $this->getProdutoVendidos($data_inicial, $data_final, $user_id, $formaPagamento, $produto);

        $fechamento = (new Fechamento())->relatorioFinanceiro($data_inicial, $data_final, $user_id);
        $entrada = (new Entrada())->estimativaLucro($data_inicial, $data_final, $user_id);

        return view('relatorios.index', [
            'users' => $users,
            'pagamentos' => $formaPagamentos,
            'tipoSaidas' => $tipoSaidas,
            'produtos' => $produtos,
            'filtro_pagamentos' => $pagamentos,
            'filtro_saida' => $saida,
            'filtro_vendas' => $produto_vendidos,
            'fechamento' => $fechamento,
            'entrada' => $entrada
        ]);
    }

    private function getPagamentos($data_inicial, $data_final, $user_id, $formaPagamento, $produto)
    {
        $bindings = [];
        if ($user_id) $bindings[] = $user_id;
        if ($formaPagamento) $bindings[] = $formaPagamento;
        if ($produto) $bindings[] = $produto;

        $bindings[] = "$data_inicial 00:00:00";
        $bindings[] = "$data_final 23:59:59";


        return TipoPagamento::select('tipo_pagamentos.id', 'tipo_pagamentos.nome')
            ->selectRaw('(SELECT SUM(entradas.valor)
                FROM entradas
                WHERE entradas.id_tipo_pagamento = tipo_pagamentos.id
                ' . ($user_id ? "AND entradas.user_id = ?" : '') . '
                ' . ($formaPagamento ? "AND entradas.id_tipo_pagamento = ?" : '') . '
                ' . ($produto ? "AND entradas.id_produto = ?" : '') . '
                AND entradas.created_at BETWEEN ? AND ?
            ) as soma_valores', $bindings)
            ->whereBetween('tipo_pagamentos.created_at', ["$data_inicial 00:00:00", "$data_final 23:59:59"])
            ->groupBy('tipo_pagamentos.id', 'tipo_pagamentos.nome')
            ->get();
    }

    private function getSaida($data_inicial, $data_final, $user_id, $tipoSaida)
    {
        $bindings = [];
        if ($user_id) $bindings[] = $user_id;
        if ($tipoSaida) $bindings[] = $tipoSaida;
        $bindings[] = "$data_inicial 00:00:00";
        $bindings[] = "$data_final 23:59:59";

        return TipoSaida::select('tipo_saidas.descricao', 'tipo_saidas.id')
            ->selectRaw('(SELECT SUM(saidas.valor)
                FROM saidas
                WHERE saidas.id_descricao = tipo_saidas.id
                ' . ($user_id ? "AND saidas.user_id = ?" : '') . '
                ' . ($tipoSaida ? "AND saidas.id_descricao = ?" : '') . '
                AND saidas.created_at BETWEEN ? AND ?
            ) as soma_saidas', $bindings)
            ->whereBetween('created_at', ["$data_inicial 00:00:00", "$data_final 23:59:59"])
            ->groupBy('tipo_saidas.descricao', 'tipo_saidas.id')
            ->get();
    }

    private function getProdutoVendidos($data_inicial, $data_final, $user_id, $formaPagamento, $produto)
    {
        $bindings = [];
        if ($user_id) $bindings[] = $user_id;
        if ($formaPagamento) $bindings[] = $formaPagamento;
        if ($produto) $bindings[] = $produto;
        $bindings[] = "$data_inicial 00:00:00";
        $bindings[] = "$data_final 23:59:59";

        return Produto::select('produtos.id', 'produtos.nome')
            ->selectRaw('(SELECT COUNT(*)
                FROM entradas
                WHERE entradas.id_produto = produtos.id
                ' . ($user_id ? "AND entradas.user_id = ?" : '') . '
                ' . ($formaPagamento ? "AND entradas.id_tipo_pagamento = ?" : '') . '
                ' . ($produto ? "AND entradas.id_produto = ?" : '') . '
                AND entradas.created_at BETWEEN ? AND ?
                AND produtos.tipo_produto = "p"
            ) as contador_produtos', $bindings)
            ->where('produtos.tipo_produto', '=', 'p')
            ->whereBetween('created_at', ["$data_inicial 00:00:00", "$data_final 23:59:59"])
            ->groupBy('produtos.nome', 'produtos.id')
            ->get();
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
    public function exportExcelSistema(Request $request)
    {
        $data_inicial = data_br_to_iso($request->input('data_ini_export_sistema'));
        $data_final = data_br_to_iso($request->input('data_fin_export_sistema'));
        return \Maatwebsite\Excel\Facades\Excel::download( new RelatoryDataExportSistema($data_inicial,$data_final), 'lucro_valores_sistemas.xlsx');
    }

}
