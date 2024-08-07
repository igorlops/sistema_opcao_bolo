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
    protected $fillable = ['nome', 'is_bolo_extra','tipo_produto'];

     public function relacaoProdutosProducao($data_ini,$data_fin, $user_id = null) {

        $produtos = $this->select('produtos.id', 'produtos.nome')
            ->selectRaw("COALESCE((SELECT SUM(estoques.quantidade) FROM estoques WHERE tipo_estoque = 'd' AND created_at BETWEEN ? AND ? AND id_produto = produtos.id  AND produtos.tipo_produto = 'p' " . ($user_id ? "AND estoques.user_id = ".$user_id : '') . "), 0) AS desperdicio", [$data_ini, $data_fin])
            ->selectRaw("COALESCE((SELECT SUM(estoques.quantidade) FROM estoques WHERE tipo_estoque = 'p' AND created_at BETWEEN ? AND ? AND id_produto = produtos.id  AND produtos.tipo_produto = 'p' " . ($user_id ? "AND estoques.user_id = ".$user_id : '') . "), 0) AS producao",  [$data_ini, $data_fin])
            ->selectRaw("COALESCE((SELECT COUNT(*) FROM entradas WHERE created_at BETWEEN ? AND ? AND entradas.id_produto = produtos.id  AND produtos.tipo_produto = 'p' " . ($user_id ? "AND entradas.user_id = ".$user_id : '') . " AND entradas.metade IS NULL), 0) AS vendaCompleta", [$data_ini, $data_fin])
            ->selectRaw("COALESCE((SELECT COUNT(*) FROM entradas WHERE created_at BETWEEN ? AND ? AND entradas.id_produto = produtos.id  AND produtos.tipo_produto = 'p' " . ($user_id ? "AND entradas.user_id = ".$user_id : '') . " AND entradas.metade LIKE '%on%'), 0) AS vendaMetade", [$data_ini, $data_fin])
            ->selectRaw("COALESCE((SELECT SUM(estoques.quantidade) FROM estoques WHERE tipo_estoque = 'd' AND id_produto = produtos.id  AND produtos.tipo_produto = 'p' " . ($user_id ? "AND estoques.user_id = ".$user_id : '') . "), 0) AS totaldesperdicio")
            ->selectRaw("COALESCE((SELECT SUM(estoques.quantidade) FROM estoques WHERE tipo_estoque = 'p' AND id_produto = produtos.id  AND produtos.tipo_produto = 'p' " . ($user_id ? "AND estoques.user_id = ".$user_id : '') . "), 0) AS totalproducao")
            ->selectRaw("COALESCE((SELECT COUNT(*) FROM entradas WHERE entradas.id_produto = produtos.id  AND produtos.tipo_produto = 'p' " . ($user_id ? "AND entradas.user_id = ".$user_id : '') . " AND entradas.metade IS NULL), 0) AS totalvendacompleta")
            ->selectRaw("COALESCE((SELECT COUNT(*) FROM entradas WHERE entradas.id_produto = produtos.id  AND produtos.tipo_produto = 'p' " . ($user_id ? "AND entradas.user_id = ".$user_id : '') . " AND entradas.metade IS NOT NULL), 0) AS totalvendametade")
            ->leftJoin('estoques', 'estoques.id_produto', '=', 'produtos.id')
            ->leftJoin('users', 'estoques.user_id', '=', 'users.id')
            ->where('tipo_produto','=','p')
            ->groupBy('produtos.id','produtos.nome')
            ->get();

    return $produtos;

    }
    public function relacaoProdutosEstoque($data_ini,$data_fin) {

        $produtos = $this->select('produtos.id', 'produtos.nome')
            ->selectRaw("COALESCE((SELECT SUM(estoque_produtos.quantidade) FROM estoque_produtos WHERE produtos.tipo_produto = 'e' AND estoque_produtos.created_at BETWEEN ? AND ? AND id_produto = produtos.id ), 0) AS soma_produtos", [$data_ini, $data_fin])
            ->selectRaw("COALESCE((SELECT COUNT(estoque_produtos.quantidade) FROM estoque_produtos WHERE produtos.tipo_produto = 'e' AND estoque_produtos.created_at BETWEEN ? AND ? AND id_produto = produtos.id ), 0) AS contador_produtos",  [$data_ini, $data_fin])
            ->leftJoin('estoques', 'estoques.id_produto', '=', 'produtos.id')
            ->leftJoin('users', 'estoques.user_id', '=', 'users.id')
            ->where('tipo_produto','=','e')
            ->groupBy('produtos.id','produtos.nome')
            ->get();

        return $produtos;

    }
}
