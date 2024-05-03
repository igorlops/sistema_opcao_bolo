<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagensFechamento extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'imagens_fechamentos';

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
    protected $fillable = ['imagem', 'id_fechamento','tipo'];

    public function fechamento()
    {
        return $this->belongsTo('App\Models\Fechamento','id');
    }

}
