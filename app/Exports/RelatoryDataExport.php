<?php

namespace App\Exports;

use App\Models\Fechamento;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RelatoryDataExport implements FromCollection,WithHeadings
{
    public function collection(): Collection
    {
        return collect(Fechamento::exportRelatory());
    }

    public function headings() : array
    {
        return [
            'Nome',
            'Taxa crédito',
            'Taxa débito',
            'Total dinheiro',
            'Envelope',
            'Pix',
            'Cartão de crédito',
            'Cartão de débito',
            'Diferença',
            'Total'
        ];
    }



}
