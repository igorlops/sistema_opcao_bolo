<?php

namespace App\Exports;

use App\Models\Saida;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportSaidaFixo implements FromCollection,WithHeadings
{
    public function collection(): Collection
    {
        $data_ini = (new \DateTime('first day of this month'));
        $data_fin = (new \DateTime('last day of this month'));
        return collect(Saida::where('tipo','=','fixo')->whereBetween('created_at',[$data_ini,$data_fin])->orderBy('id_descricao','asc')->orderBy('id','asc')->get());
    }

    public function headings() : array
    {
        return [
            'id',
            'Data criado',
            'Data alterado',
            'Valor',
            'Tipo de saída',
            'Observação',
            'User ID',
            'Id descrição'
        ];
    }
}
