<?php

namespace App\Exports;

use App\Models\Entrada;
use Illuminate\Support\Collection;
use App\Models\Fechamento;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RelatoryDataExportSistema implements FromCollection,WithHeadings
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
        return collect(Entrada::exportSistemaRelatory($this->data_ini, $this->data_fin));
    }

    public function headings() : array
    {
        return [
            'Dinheiro',
            'Pix',
            'Cartão de crédito',
            'Cartão de débito',
            'Saídas variáveis',
            'Saídas fixas',
            'Total Saídas',
            'Total Receita',
            'Lucro'
        ];
    }
}
