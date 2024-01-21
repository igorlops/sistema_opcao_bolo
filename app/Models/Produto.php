<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'produtos';

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
    protected $fillable = ['nome', 'descricao'];

    protected $visible = ['id','text'];
    protected $appends = ['text'];

    public static function buscarPorNome(string $nome)
    {
        $nome = '%'.$nome.'%';
        return self::where('nome','LIKE',$nome)->get();
    }

    public function getTextAttribute()
    {
        return $this->attributes['nome'];
    }
    
}
