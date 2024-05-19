<?php

namespace App\Exports;

use App\Models\Entrada;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportEntrada implements FromCollection, WithHeadings, WithMapping
{
    public function collection(): Collection
    {
        $data_ini = (new \DateTime('first day of this month'))->format('Y-m-d');
        $data_fin = (new \DateTime('last day of this month'))->format('Y-m-d');

        return collect(
            Entrada::select('entradas.id', 'produtos.nome as produto_nome', 'users.name as user_name', 'entradas.valor', 'entradas.tipo_entrada', 'entradas.observacao')
                ->selectRaw('CASE
                                WHEN entradas.metade IS NULL THEN "Não"
                                WHEN entradas.metade IS NOT NULL THEN "Sim"
                                ELSE "Não identificado"
                            END AS metade')
                ->addSelect('tipo_pagamentos.nome as tipo_pagamento_nome', 'entradas.created_at', 'entradas.updated_at')
                ->whereBetween('entradas.created_at', [$data_ini, $data_fin])
                ->join('produtos', 'produtos.id', '=', 'entradas.id_produto')
                ->join('tipo_pagamentos', 'tipo_pagamentos.id', '=', 'entradas.id_tipo_pagamento')
                ->join('users', 'users.id', '=', 'entradas.user_id')
                ->orderBy('entradas.id', 'asc')
                ->get()
        );
    }

    public function headings(): array
    {
        return [
            'ID',
            'Produto',
            'Loja',
            'Valor',
            'Tipo de entrada',
            'Observação',
            'É Metade?',
            'Tipo de Pagamento',
            'Data criado',
            'Data alterado'
        ];
    }

    public function map($entrada): array
    {
        return [
            $entrada->id,
            $entrada->produto_nome,
            $entrada->user_name,
            numero_iso_para_br($entrada->valor), // Formatando valor com 2 casas decimais
            $entrada->tipo_entrada,
            $entrada->observacao,
            $entrada->metade,
            $entrada->tipo_pagamento_nome,
            $entrada->created_at->format('d/m/Y H:i:s'), // Formatando data
            $entrada->updated_at->format('d/m/Y H:i:s')  // Formatando data
        ];
    }
}
