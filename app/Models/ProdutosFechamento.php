<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdutosFechamento extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'produtos_fechamentos';

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
    protected $fillable = ['producao', 'desperdicio', 'sobra', 'bolos_vendidos', 'total_bolos_vendidos', 'id_produto', 'id_fechamento'];

    public function produto()
    {
        return $this->belongsTo('App\Models\Produto','id');
    }
    public function fechamento()
    {
        return $this->belongsTo('App\Models\Fechamento','id');
    }

}
