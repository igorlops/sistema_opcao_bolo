<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Entrada extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'entradas';

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
    protected $fillable = ['tipo_entrada', 'observacao', 'id_tipo_pagamento', 'user_id', 'id_produto', 'valor','metade'];

    public function tipo_pagamento()
    {
        return $this->belongsTo('App\Models\TipoPagamento','id_tipo_pagamento');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
    public function produto()
    {
        return $this->belongsTo('App\Models\Produto','id_produto');
    }
    public function estimativaLucro($data_ini, $data_fin, $user_id = null)
    {
        $results = [];
        $users = User::all();

        $dinheiro = "COALESCE((SELECT SUM(entradas.valor) FROM entradas WHERE created_at BETWEEN ? AND ? AND entradas.user_id = ? AND entradas.id_tipo_pagamento = ".DINHEIRO."), 0) AS dinheiro";
        $pix = "COALESCE((SELECT SUM(entradas.valor) FROM entradas WHERE created_at BETWEEN ? AND ? AND entradas.user_id = ? AND entradas.id_tipo_pagamento = ".PIX."), 0) AS pix";
        $cartao_cred = "COALESCE((SELECT SUM(entradas.valor) FROM entradas WHERE created_at BETWEEN ? AND ? AND entradas.user_id = ? AND entradas.id_tipo_pagamento = ".CARTAO_CRED."), 0) AS cartao_cred";
        $cartao_deb = "COALESCE((SELECT SUM(entradas.valor) FROM entradas WHERE created_at BETWEEN ? AND ? AND entradas.user_id = ? AND entradas.id_tipo_pagamento = ".CARTAO_DEB." ), 0) AS cartao_deb";
        $saidasVariaveis = "COALESCE((SELECT SUM(saidas.valor) FROM saidas WHERE created_at BETWEEN ? AND ? AND saidas.user_id = ? AND saidas.tipo = 'variavel'), 0 ) AS saidasVariaveis";
        $saidasFixas = "COALESCE((SELECT SUM(saidas.valor) FROM saidas WHERE created_at BETWEEN ? AND ? AND saidas.user_id = ? AND saidas.tipo = 'fixo'), 0 ) AS saidasFixas";
        if ($user_id) {
            $entradas = $this->select('users.name','users.perc_cred','users.perc_deb');
            $params = [$data_ini . " 00:00:00", $data_fin . " 23:59:59", $user_id];

            $entradas = $entradas
                ->selectRaw($dinheiro, $params)
                ->selectRaw($pix, $params)
                ->selectRaw($cartao_cred, $params)
                ->selectRaw($cartao_deb, $params)
                ->selectRaw($saidasVariaveis, $params)
                ->selectRaw($saidasFixas, $params)
                ->join('users','users.id','=','entradas.user_id')
                ->where('users.id', $user_id)
                ->groupBy('users.name', 'users.perc_cred', 'users.perc_deb')
                ->get();

                foreach ($entradas as $entrada) {

                    $taxa_cred = $entrada->getAttribute('perc_cred');
                    $taxa_deb = $entrada->getAttribute('perc_deb');
                    $valor_cred = $entrada->getAttribute('cartao_cred');
                    $valor_deb = $entrada->getAttribute('cartao_deb');
                    $dinheiro = $entrada->getAttribute('dinheiro');
                    $valor_pix = $entrada->getAttribute('pix');
                    $saidas_variaveis = $entrada->getAttribute('saidasVariaveis');
                    $saidas_fixas = $entrada->getAttribute('saidasFixas');

                    $new_cred = $valor_cred - (($taxa_cred / 100) * $valor_cred);
                    $new_deb = $valor_deb - (($taxa_deb / 100)* $valor_deb);

                    $valor_pix = number_format(floatval(str_replace(',', '.', $valor_pix)), 2, '.', '');
                    $dinheiro = number_format(floatval(str_replace(',', '.', $dinheiro)), 2, '.', '');
                    $new_cred = number_format(floatval(str_replace(',', '.', $new_cred)), 2, '.', '');
                    $new_deb = number_format(floatval(str_replace(',', '.', $new_deb)), 2, '.', '');
                    $total_definitivo = (($dinheiro) + ($valor_pix) + ($new_cred) + ($new_deb));

                    $saidas_total = $saidas_variaveis + $saidas_fixas;

                    $previsao_lucro = $total_definitivo - $saidas_total;

                    // Reatribuindo os valores

                    $entrada->setAttribute('total',$total_definitivo);
                    $entrada->setAttribute('lucro',$previsao_lucro);
                    $entrada->setAttribute('perc_cred',$taxa_cred);
                    $entrada->setAttribute('perc_deb',$taxa_deb);
                    $entrada->setAttribute('cartao_cred',$new_cred);
                    $entrada->setAttribute('cartao_deb',$new_deb);
                    $entrada->setAttribute('pix',$valor_pix);
                    $entrada->setAttribute('saidasVariaveis',$saidas_variaveis);
                    $entrada->setAttribute('saidasFixas',$saidas_fixas);
                    $entrada->setAttribute('saidasTotal',$saidas_total);

                    $results[] = $entrada->getAttributes();
                    // dd($results);
                }
                return $results;

        } else {
            foreach ($users as $user) {
                $entradas = $this->select('users.name','users.perc_cred','users.perc_deb');
                $params = [$data_ini . " 00:00:00", $data_fin . " 23:59:59", $user->id];

                $dinheiro = "COALESCE((SELECT SUM(entradas.valor) FROM entradas WHERE created_at BETWEEN ? AND ? AND entradas.user_id = ? AND entradas.id_tipo_pagamento = ".DINHEIRO."), 0) AS dinheiro";
                $pix = "COALESCE((SELECT SUM(entradas.valor) FROM entradas WHERE created_at BETWEEN ? AND ? AND entradas.user_id = ? AND entradas.id_tipo_pagamento = ".PIX."), 0) AS pix";
                $cartao_cred = "COALESCE((SELECT SUM(entradas.valor) FROM entradas WHERE created_at BETWEEN ? AND ? AND entradas.user_id = ? AND entradas.id_tipo_pagamento = ".CARTAO_CRED."), 0) AS cartao_cred";
                $cartao_deb = "COALESCE((SELECT SUM(entradas.valor) FROM entradas WHERE created_at BETWEEN ? AND ? AND entradas.user_id = ? AND entradas.id_tipo_pagamento = ".CARTAO_DEB." ), 0) AS cartao_deb";
                $saidasVariaveis = "COALESCE((SELECT SUM(saidas.valor) FROM saidas WHERE created_at BETWEEN ? AND ? AND saidas.user_id = ? AND saidas.tipo = 'variavel'), 0 ) AS saidasVariaveis";
                $saidasFixas = "COALESCE((SELECT SUM(saidas.valor) FROM saidas WHERE created_at BETWEEN ? AND ? AND saidas.user_id = ? AND saidas.tipo = 'fixo'), 0 ) AS saidasFixas";
                $entradas = $entradas
                    ->selectRaw($dinheiro, $params)
                    ->selectRaw($pix, $params)
                    ->selectRaw($cartao_cred, $params)
                    ->selectRaw($cartao_deb, $params)
                    ->selectRaw($saidasVariaveis, $params)
                    ->selectRaw($saidasFixas, $params)
                    ->join('users','users.id','=','entradas.user_id')
                    ->where('users.id', $user->id)
                    ->groupBy('users.name', 'users.perc_cred', 'users.perc_deb')
                    ->get();

                foreach ($entradas as $entrada) {

                    $taxa_cred = $entrada->getAttribute('perc_cred');
                    $taxa_deb = $entrada->getAttribute('perc_deb');
                    $valor_cred = $entrada->getAttribute('cartao_cred');
                    $valor_deb = $entrada->getAttribute('cartao_deb');
                    $dinheiro = $entrada->getAttribute('dinheiro');
                    $valor_pix = $entrada->getAttribute('pix');
                    $saidas_variaveis = $entrada->getAttribute('saidasVariaveis');
                    $saidas_fixas = $entrada->getAttribute('saidasFixas');

                    $new_cred = $valor_cred - (($taxa_cred / 100) * $valor_cred);
                    $new_deb = $valor_deb - (($taxa_deb / 100)* $valor_deb);

                    $valor_pix = number_format(floatval(str_replace(',', '.', $valor_pix)), 2, '.', '');
                    $dinheiro = number_format(floatval(str_replace(',', '.', $dinheiro)), 2, '.', '');
                    $new_cred = number_format(floatval(str_replace(',', '.', $new_cred)), 2, '.', '');
                    $new_deb = number_format(floatval(str_replace(',', '.', $new_deb)), 2, '.', '');
                    $total_definitivo = (($dinheiro) + ($valor_pix) + ($new_cred) + ($new_deb));

                    $saidas_total = $saidas_variaveis + $saidas_fixas;

                    $previsao_lucro = $total_definitivo - $saidas_total;

                    // Reatribuindo os valores

                    $entrada->setAttribute('total',$total_definitivo);
                    $entrada->setAttribute('lucro',$previsao_lucro);
                    $entrada->setAttribute('perc_cred',$taxa_cred);
                    $entrada->setAttribute('perc_deb',$taxa_deb);
                    $entrada->setAttribute('cartao_cred',$new_cred);
                    $entrada->setAttribute('cartao_deb',$new_deb);
                    $entrada->setAttribute('pix',$valor_pix);
                    $entrada->setAttribute('saidasVariaveis',$saidas_variaveis);
                    $entrada->setAttribute('saidasFixas',$saidas_fixas);
                    $entrada->setAttribute('saidasTotal',$saidas_total);

                    $results[] = $entrada->getAttributes();

                }
            }
        return $results;
        }
    }

    public static function exportSistemaRelatory($data_ini, $data_fin)
    {
        $results = collect();
        $users = User::all();

        foreach ($users as $user) {
            $entradas = DB::table('entradas')
            ->select('users.name','users.perc_cred','users.perc_deb');
            $params = [$data_ini . " 00:00:00", $data_fin . " 23:59:59", $user->id];
            $dinheiro = "COALESCE((SELECT SUM(entradas.valor) FROM entradas WHERE created_at BETWEEN ? AND ? AND entradas.user_id = ? AND entradas.id_tipo_pagamento = ".DINHEIRO."), 0) AS dinheiro";
            $pix = "COALESCE((SELECT SUM(entradas.valor) FROM entradas WHERE created_at BETWEEN ? AND ? AND entradas.user_id = ? AND entradas.id_tipo_pagamento = ".PIX."), 0) AS pix";
            $cartao_cred = "COALESCE((SELECT SUM(entradas.valor) FROM entradas WHERE created_at BETWEEN ? AND ? AND entradas.user_id = ? AND entradas.id_tipo_pagamento = ".CARTAO_CRED."), 0) AS cartao_cred";
            $cartao_deb = "COALESCE((SELECT SUM(entradas.valor) FROM entradas WHERE created_at BETWEEN ? AND ? AND entradas.user_id = ? AND entradas.id_tipo_pagamento = ".CARTAO_DEB." ), 0) AS cartao_deb";
            $saidasVariaveis = "COALESCE((SELECT SUM(saidas.valor) FROM saidas WHERE created_at BETWEEN ? AND ? AND saidas.user_id = ? AND saidas.tipo = 'variavel'), 0 ) AS saidasVariaveis";
            $saidasFixas = "COALESCE((SELECT SUM(saidas.valor) FROM saidas WHERE created_at BETWEEN ? AND ? AND saidas.user_id = ? AND saidas.tipo = 'fixo'), 0 ) AS saidasFixas";
            $entradas = $entradas
                ->selectRaw($dinheiro, $params)
                ->selectRaw($pix, $params)
                ->selectRaw($cartao_cred, $params)
                ->selectRaw($cartao_deb, $params)
                ->selectRaw($saidasVariaveis, $params)
                ->selectRaw($saidasFixas, $params)
                ->join('users','users.id','=','entradas.user_id')
                ->where('users.id', $user->id)
                ->groupBy('users.name', 'users.perc_cred', 'users.perc_deb')
                ->get();

            if($entradas->isNotEmpty()) {

                $entradas[0]->cartao_cred =
                numero_iso_para_br($entradas[0]->cartao_cred - (
                    ($entradas[0]->perc_cred / 100) * $entradas[0]->cartao_cred
                ));

                $entradas[0]->cartao_deb =
                numero_iso_para_br($entradas[0]->cartao_deb - (
                    ($entradas[0]->cartao_deb / 100) * $entradas[0]->perc_deb
                ));

                $entradas[0]->dinheiro = numero_iso_para_br($entradas[0]->dinheiro);
                $entradas[0]->pix = numero_iso_para_br($entradas[0]->pix);

                $total = numero_br_para_iso($entradas[0]->dinheiro) +
                numero_br_para_iso($entradas[0]->pix) +
                numero_br_para_iso($entradas[0]->cartao_cred) +
                numero_br_para_iso($entradas[0]->cartao_deb);


                $entradas[0]->receita = numero_iso_para_br($total);
                $entradas[0]->total_saidas = $entradas[0]->saidasVariaveis + $entradas[0]->saidasFixas;
                $entradas[0]->total_definitivo = numero_iso_para_br($total - $entradas[0]->total_saidas);

                // dd($entradas[0]);
                // dd($total);
                $results->push([
                    $entradas[0]->dinheiro,
                    $entradas[0]->pix,
                    $entradas[0]->cartao_cred,
                    $entradas[0]->cartao_deb,
                    $entradas[0]->saidasVariaveis,
                    $entradas[0]->saidasFixas,
                    $entradas[0]->total_saidas,
                    $entradas[0]->receita,
                    $entradas[0]->total_definitivo,
                ]);
            }
        }

        return $results;
    }
}
