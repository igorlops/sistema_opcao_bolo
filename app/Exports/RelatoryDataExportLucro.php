<?php

namespace App\Exports;

use App\Models\Fechamento;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class RelatoryDataExportLucro implements FromView
{
    public function view(): View
    {
        $teste = Fechamento::all();
        // dd($teste);
        return view('relatorios.index', compact('teste'));
    }
}
