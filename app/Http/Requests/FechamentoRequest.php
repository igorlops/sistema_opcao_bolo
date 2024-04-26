<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FechamentoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
			'vendas_abc' => 'required|numeric',
			'total_caixa' => 'required|numeric',
			'env' => 'required|numeric',
			'cartao_cred' => 'required|numeric',
			'cartao_deb' => 'required|numeric',
			'pix' => 'required|numeric'
        ];
    }

    public function validationData(){
        $campos = $this->all();
        $campos['vendas_extras'] = numero_br_para_iso($campos['vendas_extras']);
        $campos['desconto'] = numero_br_para_iso($campos['desconto']);
        $campos['vendas_abc'] = numero_br_para_iso($campos['vendas_abc']);
        $campos['total_caixa'] = numero_br_para_iso($campos['total_caixa']);
        $campos['env'] = numero_br_para_iso($campos['env']);
        $campos['cartao_cred'] = numero_br_para_iso($campos['cartao_cred']);
        $campos['cartao_deb'] = numero_br_para_iso($campos['cartao_deb']);
        $campos['pix'] = numero_br_para_iso($campos['pix']);
        $campos['diferenca'] = numero_br_para_iso($campos['diferenca']);

        $this->replace($campos);

        // dd($campos);
        return $campos;
    }
}
