<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimentosEstoque extends Model
{
    use HasFactory;
    protected $table = 'movimentos_estoque';
    protected $fillable = ['produto_id','quantidade','valor','tipo','empresa_id'];
    
    public function produto()
    {
        return $this->belongsTo('App\Models\Produto');
    }
}
