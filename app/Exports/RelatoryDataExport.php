<?php

namespace App\Exports;

use App\Models\Fechamento;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RelatoryDataExport implements FromCollection,WithHeadings
{
    protected $data_ini;
    protected $data_fin;

    public function __construct($data_ini, $data_fin)
    {
        $this->data_ini = $data_ini;
        $this->data_fin = $data_fin;
    }
    public function collection(): Collection
    {
        return collect(Fechamento::exportRelatory($this->data_ini, $this->data_fin));
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
