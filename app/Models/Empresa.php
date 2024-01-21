<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pagination\AbstractPaginator;

class Empresa extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = ['nome','tipo','razao_social','documento','ie_rg','nome_contato', 'celular','email','telefone','cep','logradouro','bairro','cidade','estado','observacao'];
    
    protected $visible = ['id','text'];
    protected $appends = ['text'];


    public function movimentosEstoque()
    {
        return $this->hasMany('App\Models\MovimentosEstoque');
    }

    public static function todasPorTipo(string $tipo,int $quantidade = 10): AbstractPaginator
    {
        return self::where('tipo',$tipo)->paginate($quantidade);
    }
    public static function buscarPorNomeTipo(string $nome, string $tipo)
    {
        $nome = '%'.$nome.'%';
        return self::where('nome','LIKE',$nome)
            ->where('tipo',$tipo)
            ->get();
    }
    public static function buscaPorId(int $id)
    {
        return self::with([
            'movimentosEstoque' => function($query){
                $query->latest()->take(2);
            },
            'movimentosEstoque.produto'
        ])
        ->findOrFail($id); 
    }
    public function getTextAttribute()
    {
        return sprintf(
            '%s (%s)',
            $this->attributes['nome'],
            $this->attributes['razao_social']
        );
    }


}
