<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaidaRequest extends FormRequest
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
			'valor' => 'required|string|max:100',
			'user_id' => 'required',
			'id_descricao' => 'required',
            'tipo' => 'required'
        ];
    }

    public function validationData(){
        $campos = $this->all();
        $campos['valor'] = numero_br_para_iso($campos['valor']);


        $this->replace($campos);

        return $campos;
    }
}
