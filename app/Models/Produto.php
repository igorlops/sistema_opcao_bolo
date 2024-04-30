<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
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
    protected $fillable = ['nome', 'is_bolo_extra'];

    public function relacaoProdutos($data_ini,$data_fin, $user_id = null) {

        $produtos = $this->select('produtos.id', 'produtos.nome')
        ->selectRaw("(SELECT SUM(estoques.quantidade) FROM estoques WHERE tipo_estoque = 'd' AND created_at BETWEEN ? AND ? AND id_produto = produtos.id ? ) AS desperdicio", ["$data_ini 00:00:00", "$data_fin 23:59:59", $user_id ? "AND estoques.user_id =".$user_id : '' ])
        ->selectRaw("(SELECT SUM(estoques.quantidade) FROM estoques WHERE tipo_estoque = 'p' AND created_at BETWEEN ? AND ? AND id_produto = produtos.id ? ) AS producao" ,  ["$data_ini 00:00:00", "$data_fin 23:59:59",$user_id ? "AND estoques.user_id =".$user_id : '' ])
        ->selectRaw("(SELECT COUNT(*) FROM entradas WHERE created_at BETWEEN ? AND ? AND entradas.id_produto = produtos.id ? ) AS venda", ["$data_ini 00:00:00", "$data_fin 23:59:59", $user_id ? "AND entradas.user_id =".$user_id : ''])
        ->selectRaw("(SELECT SUM(estoques.quantidade) FROM estoques WHERE tipo_estoque = 'd' AND id_produto = produtos.id ? ) AS totaldesperdicio" ,[$user_id ? "AND estoques.user_id =".$user_id : '' ])
        ->selectRaw("(SELECT SUM(estoques.quantidade) FROM estoques WHERE tipo_estoque = 'p' AND id_produto = produtos.id ? ) AS totalproducao",[$user_id ? "AND estoques.user_id =".$user_id : '' ])
        ->selectRaw("(SELECT COUNT(*) FROM entradas WHERE entradas.id_produto = produtos.id  ? ) AS totalvenda" ,[ $user_id ? "AND entradas.user_id =".$user_id : '' ])
        ->leftJoin('estoques', 'estoques.id_produto', '=', 'produtos.id')
        ->leftJoin('users', 'estoques.user_id', '=', 'users.id')
        ->groupBy('produtos.id','produtos.nome')
        ->get();
        return $produtos;
    }
    public function estimativaLucro($data_ini,$data_fin, $user_id = null) {

        $produtos = $this->select('produtos.id', 'produtos.nome')
        ->selectRaw("(SELECT SUM(estoques.quantidade) FROM estoques WHERE tipo_estoque = 'd' AND created_at BETWEEN ? AND ? AND id_produto = produtos.id ? ) AS desperdicio", ["$data_ini 00:00:00", "$data_fin 23:59:59", $user_id ? "AND estoques.user_id =".$user_id : '' ])
        ->selectRaw("(SELECT SUM(estoques.quantidade) FROM estoques WHERE tipo_estoque = 'p' AND created_at BETWEEN ? AND ? AND id_produto = produtos.id ? ) AS producao" ,  ["$data_ini 00:00:00", "$data_fin 23:59:59",$user_id ? "AND estoques.user_id =".$user_id : '' ])
        ->selectRaw("(SELECT COUNT(*) FROM entradas WHERE created_at BETWEEN ? AND ? AND entradas.id_produto = produtos.id ? ) AS venda", ["$data_ini 00:00:00", "$data_fin 23:59:59", $user_id ? "AND entradas.user_id =".$user_id : ''])
        ->selectRaw("(SELECT SUM(estoques.quantidade) FROM estoques WHERE tipo_estoque = 'd' AND id_produto = produtos.id ? ) AS totaldesperdicio" ,[$user_id ? "AND estoques.user_id =".$user_id : '' ])
        ->selectRaw("(SELECT SUM(estoques.quantidade) FROM estoques WHERE tipo_estoque = 'p' AND id_produto = produtos.id ? ) AS totalproducao",[$user_id ? "AND estoques.user_id =".$user_id : '' ])
        ->selectRaw("(SELECT COUNT(*) FROM entradas WHERE entradas.id_produto = produtos.id  ? ) AS totalvenda" ,[ $user_id ? "AND entradas.user_id =".$user_id : '' ])
        ->leftJoin('estoques', 'estoques.id_produto', '=', 'produtos.id')
        ->leftJoin('users', 'estoques.user_id', '=', 'users.id')
        ->groupBy('produtos.id','produtos.nome')
        ->get();
        return $produtos;
    }
}
