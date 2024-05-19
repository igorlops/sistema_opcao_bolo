<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstoqueProduto extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'estoque_produtos';

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
    protected $fillable = ['tipo_estoque', 'quantidade', 'id_produto','user_id','id_user_estoque'];

    public function produto()
    {
        return $this->belongsTo('App\Models\Produto', 'id_produto');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function user_produto()
    {
        return $this->belongsTo('App\Models\User', 'id_user_estoque');
    }

}
