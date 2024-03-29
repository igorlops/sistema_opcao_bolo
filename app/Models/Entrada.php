<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'entradas';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['tipo_entrada', 'observacao', 'id_tipo_pagamento', 'user_id', 'id_produto'];

    public function tipo_pagamento()
    {
        return $this->belongsTo('App\Models\TipoPagamento');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function produto()
    {
        return $this->belongsTo('App\Models\Produto');
    }
    
}
