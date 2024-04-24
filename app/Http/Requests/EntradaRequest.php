<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntradaRequest extends FormRequest
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
            'tipo_entrada' => 'required|string',
			'id_tipo_pagamento' => 'required',
			'user_id' => 'required',
			'id_produto' => 'required',
            'valor' => 'required|numeric',
        ];
    }

    public function validationData(){
        $campos = $this->all();
        $campos['valor'] = numero_br_para_iso($campos['valor']);

        $this->replace($campos);

        return $campos;
    }
}
