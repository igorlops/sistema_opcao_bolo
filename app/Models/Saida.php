<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saida extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'saidas';

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
    protected $fillable = ['valor', 'observacao', 'user_id', 'id_descricao'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function tipo_saida()
    {
        return $this->belongsTo('App\Models\TipoSaida');
    }
    
}
