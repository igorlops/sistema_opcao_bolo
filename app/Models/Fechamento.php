<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fechamento extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'fechamentos';

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
    protected $fillable = ['total_vendas', 'total_pagamentos', 'saldo_ini', 'saldo_fin', 'diferenca_caixa', 'observacao', 'id_imagem', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
}
