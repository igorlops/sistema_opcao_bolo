<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use App\Models\Fechamento;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RelatoryDataExportLucro implements FromCollection,WithHeadings
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
        return collect(Fechamento::exportLucroRelatory($this->data_ini, $this->data_fin));
    }

    public function headings() : array
    {
        return [
            'Receita',
            'Saídas',
            'Lucro final'
        ];
    }
}
