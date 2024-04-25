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
    protected $fillable = ['vendas_extras', 'desconto', 'vendas_abc', 'total_caixa', 'env', 'cartao_cred', 'cartao_deb', 'pix'];

    public function vendasCaixa()
    {
        return $this->belongsTo(Caixa::class,'',    '');
    }
}
