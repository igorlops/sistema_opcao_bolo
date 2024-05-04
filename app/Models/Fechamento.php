<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Fechamento extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'fechamentos';

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
    protected $fillable = ['vendas_extras', 'desconto', 'vendas_abc', 'total_caixa', 'env', 'cartao_cred', 'cartao_deb', 'pix','diferenca','user_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
    public function relatorioFinanceiro($data_ini, $data_fin, $user_id)
    {
        $results = [];
        $users = User::all();

        $total_caixa = "COALESCE((SELECT SUM(fechamentos.total_caixa) FROM fechamentos WHERE created_at BETWEEN ? AND ? AND fechamentos.user_id = ? ), 0) AS total_caixa";
        $env = "COALESCE((SELECT SUM(fechamentos.env) FROM fechamentos WHERE created_at BETWEEN ? AND ? AND fechamentos.user_id = ? ), 0) AS env";
        $pix = "COALESCE((SELECT SUM(fechamentos.pix) FROM fechamentos WHERE created_at BETWEEN ? AND ? AND fechamentos.user_id = ? ), 0) AS pix";
        $cartao_cred = "COALESCE((SELECT SUM(fechamentos.cartao_cred) FROM fechamentos WHERE created_at BETWEEN ? AND ? AND fechamentos.user_id = ? ), 0) AS cartao_cred";
        $cartao_deb = "COALESCE((SELECT SUM(fechamentos.cartao_deb) FROM fechamentos WHERE created_at BETWEEN ? AND ? AND fechamentos.user_id = ? ), 0) AS cartao_deb";
        $diferenca = "COALESCE((SELECT SUM(fechamentos.diferenca) FROM fechamentos WHERE created_at BETWEEN ? AND ? AND fechamentos.user_id = ? ), 0) AS diferenca";

        if ($user_id) {
            $fechamentos = $this->select('users.name','users.perc_cred','users.perc_deb');
            $params = [$data_ini . " 00:00:00", $data_fin . " 23:59:59", $user_id];

            $results = $fechamentos
                ->selectRaw($total_caixa, $params)
                ->selectRaw($env, $params)
                ->selectRaw($pix, $params)
                ->selectRaw($cartao_cred, $params)
                ->selectRaw($cartao_deb, $params)
                ->selectRaw($diferenca, $params)
                ->join('users','users.id','=','fechamentos.user_id')
                ->where('users.id', $user_id)
                ->groupBy('users.name', 'users.perc_cred', 'users.perc_deb')
                ->get();

                // dd($results);

        } else {
            foreach ($users as $user) {
                $fechamentos = $this->select('users.name','users.perc_cred','users.perc_deb');
                $params = [$data_ini . " 00:00:00", $data_fin . " 23:59:59", $user->id];

                $total_caixa = "COALESCE((SELECT SUM(fechamentos.total_caixa) FROM fechamentos WHERE created_at BETWEEN ? AND ? AND fechamentos.user_id = ? ), 0 ) AS total_caixa";
                $env = "COALESCE((SELECT SUM(fechamentos.env) FROM fechamentos WHERE created_at BETWEEN ? AND ? AND fechamentos.user_id = ? ), 0 ) AS env";
                $pix = "COALESCE((SELECT SUM(fechamentos.pix) FROM fechamentos WHERE created_at BETWEEN ? AND ? AND fechamentos.user_id = ? ), 0 ) AS pix";
                $cartao_cred = "COALESCE((SELECT SUM(fechamentos.cartao_cred) FROM fechamentos WHERE created_at BETWEEN ? AND ? AND fechamentos.user_id = ? ), 0 ) AS cartao_cred";
                $cartao_deb = "COALESCE((SELECT SUM(fechamentos.cartao_deb) FROM fechamentos WHERE created_at BETWEEN ? AND ? AND fechamentos.user_id = ? ), 0 ) AS cartao_deb";
                $diferenca = "COALESCE((SELECT SUM(fechamentos.diferenca) FROM fechamentos WHERE created_at BETWEEN ? AND ? AND fechamentos.user_id = ? ), 0 ) AS diferenca";
                $saidas = "COALESCE((SELECT SUM(saidas.valor) FROM saidas WHERE created_at BETWEEN ? AND ? AND saidas.user_id = ? ), 0 ) AS saidas";
            $fechamentos = $fechamentos
                    ->selectRaw($total_caixa, $params)
                    ->selectRaw($env, $params)
                    ->selectRaw($pix, $params)
                    ->selectRaw($cartao_cred, $params)
                    ->selectRaw($cartao_deb, $params)
                    ->selectRaw($diferenca, $params)
                    ->selectRaw($saidas, $params)
                    ->join('users','users.id','=','fechamentos.user_id')
                    ->where('users.id', $user->id)
                    ->groupBy('users.name', 'users.perc_cred', 'users.perc_deb')
                    ->get();
                foreach ($fechamentos as $fechamento) {

                    $taxa_cred = $fechamento->getAttribute('perc_cred');
                    $taxa_deb = $fechamento->getAttribute('perc_deb');
                    $valor_cred = $fechamento->getAttribute('cartao_cred');
                    $valor_deb = $fechamento->getAttribute('cartao_deb');
                    $valor_env = $fechamento->getAttribute('env');
                    $valor_pix = $fechamento->getAttribute('pix');

                    $new_cred = $valor_cred - (($taxa_cred / 100) * $valor_cred);
                    $new_deb = $valor_deb - (($taxa_deb / 100)* $valor_deb);

                    $valor_env = number_format(floatval(str_replace(',', '.', $valor_env)), 2, '.', '');
                    $valor_pix = number_format(floatval(str_replace(',', '.', $valor_pix)), 2, '.', '');
                    $new_cred = number_format(floatval(str_replace(',', '.', $new_cred)), 2, '.', '');
                    $new_deb = number_format(floatval(str_replace(',', '.', $new_deb)), 2, '.', '');
                    $total_definitivo = ($valor_env) + ($valor_pix) + ($new_cred) + ($new_deb);

                    $previsao_lucro = $total_definitivo - $fechamento->getAttribute('saidas');

                    // Reatribuindo os valores

                    $fechamento->setAttribute('total',$total_definitivo);
                    $fechamento->setAttribute('lucro',$previsao_lucro);
                    $fechamento->setAttribute('perc_cred',$taxa_cred);
                    $fechamento->setAttribute('perc_deb',$taxa_deb);
                    $fechamento->setAttribute('cartao_cred',$new_cred);
                    $fechamento->setAttribute('cartao_deb',$new_deb);
                    $fechamento->setAttribute('env',$valor_env);
                    $fechamento->setAttribute('pix',$valor_pix);

                    $results[] = $fechamento->getAttributes();

                }
            }
        }
        return $results;
    }

    public static function exportRelatory($data_ini, $data_fin)
    {
        $results = collect();
        $users = User::all();
        foreach ($users as $user) {
            $fechamentos = DB::table('fechamentos')
                ->select('users.name','users.perc_cred','users.perc_deb');
            $params = [$data_ini . " 00:00:00", $data_fin . " 23:59:59", $user->id];
            $total_caixa = "(SELECT SUM(fechamentos.total_caixa) FROM fechamentos WHERE created_at BETWEEN ? AND ? AND fechamentos.user_id = ? ) AS total_caixa";
            $env = "(SELECT SUM(fechamentos.env) FROM fechamentos WHERE created_at BETWEEN ? AND ? AND fechamentos.user_id = ? ) AS env";
            $pix = "(SELECT SUM(fechamentos.pix) FROM fechamentos WHERE created_at BETWEEN ? AND ? AND fechamentos.user_id = ? ) AS pix";
            $cartao_cred = "(SELECT SUM(fechamentos.cartao_cred) FROM fechamentos WHERE created_at BETWEEN ? AND ? AND fechamentos.user_id = ? ) AS cartao_cred";
            $cartao_deb = "(SELECT SUM(fechamentos.cartao_deb) FROM fechamentos WHERE created_at BETWEEN ? AND ? AND fechamentos.user_id = ? ) AS cartao_deb";
            $diferenca = "(SELECT SUM(fechamentos.diferenca) FROM fechamentos WHERE created_at BETWEEN ? AND ? AND fechamentos.user_id = ? ) AS diferenca";
            $fechamentos = $fechamentos
                ->selectRaw($total_caixa, $params)
                ->selectRaw($env, $params)
                ->selectRaw($pix, $params)
                ->selectRaw($cartao_cred, $params)
                ->selectRaw($cartao_deb, $params)
                ->selectRaw($diferenca, $params)
                ->join('users','users.id','=','fechamentos.user_id')
                ->where('users.id', $user->id)
                ->groupBy('users.name', 'users.perc_cred', 'users.perc_deb')
                ->get();

            if($fechamentos->isNotEmpty()) {
                // dd($fechamentos[0]->cartao_cred);

                $fechamentos[0]->cartao_cred =
                numero_iso_para_br($fechamentos[0]->cartao_cred - (
                    ($fechamentos[0]->perc_cred / 100) * $fechamentos[0]->cartao_cred
                ));
                // dd($fechamentos[0]->cartao_cred);

                $fechamentos[0]->cartao_deb =
                numero_iso_para_br($fechamentos[0]->cartao_deb - (
                    ($fechamentos[0]->cartao_deb / 100) * $fechamentos[0]->perc_deb
                ));

                $fechamentos[0]->diferenca = numero_iso_para_br($fechamentos[0]->diferenca);
                $fechamentos[0]->total_caixa = numero_iso_para_br($fechamentos[0]->total_caixa);
                $fechamentos[0]->env = numero_iso_para_br($fechamentos[0]->env);
                $fechamentos[0]->pix = numero_iso_para_br($fechamentos[0]->pix);

                $total = numero_br_para_iso($fechamentos[0]->env) +
                numero_br_para_iso($fechamentos[0]->pix) +
                numero_br_para_iso($fechamentos[0]->cartao_cred) +
                numero_br_para_iso($fechamentos[0]->cartao_deb);

                $fechamentos[0]->total_definitivo = numero_iso_para_br($total);
                // $fechamentos[0]->receita = $total;

                $results->push($fechamentos[0]);
            }
        }

        return $results;
    }


    public static function exportLucroRelatory($data_ini, $data_fin)
    {
        $results = collect();
        $users = User::all();

        foreach ($users as $user) {
            $fechamentos = DB::table('fechamentos')
            ->select('users.name','users.perc_cred','users.perc_deb');
            $params = [$data_ini . " 00:00:00", $data_fin . " 23:59:59", $user->id];

            $total_caixa = "(SELECT SUM(fechamentos.total_caixa) FROM fechamentos WHERE created_at BETWEEN ? AND ? AND fechamentos.user_id = ? ) AS total_caixa";
            $env = "(SELECT SUM(fechamentos.env) FROM fechamentos WHERE created_at BETWEEN ? AND ? AND fechamentos.user_id = ? ) AS env";
            $pix = "(SELECT SUM(fechamentos.pix) FROM fechamentos WHERE created_at BETWEEN ? AND ? AND fechamentos.user_id = ? ) AS pix";
            $cartao_cred = "(SELECT SUM(fechamentos.cartao_cred) FROM fechamentos WHERE created_at BETWEEN ? AND ? AND fechamentos.user_id = ? ) AS cartao_cred";
            $cartao_deb = "(SELECT SUM(fechamentos.cartao_deb) FROM fechamentos WHERE created_at BETWEEN ? AND ? AND fechamentos.user_id = ? ) AS cartao_deb";
            $diferenca = "(SELECT SUM(fechamentos.diferenca) FROM fechamentos WHERE created_at BETWEEN ? AND ? AND fechamentos.user_id = ? ) AS diferenca";
            $saidas = "(SELECT SUM(saidas.valor) FROM saidas WHERE created_at BETWEEN ? AND ? AND saidas.user_id = ? ) AS saidas";
            $fechamentos = $fechamentos
                ->selectRaw($total_caixa, $params)
                ->selectRaw($env, $params)
                ->selectRaw($pix, $params)
                ->selectRaw($cartao_cred, $params)
                ->selectRaw($cartao_deb, $params)
                ->selectRaw($diferenca, $params)
                ->selectRaw($saidas, $params)
                ->join('users','users.id','=','fechamentos.user_id')
                ->where('users.id', $user->id)
                ->groupBy('users.name', 'users.perc_cred', 'users.perc_deb')
                ->get();

            if($fechamentos->isNotEmpty()) {

                $fechamentos[0]->cartao_cred =
                numero_iso_para_br($fechamentos[0]->cartao_cred - (
                    ($fechamentos[0]->perc_cred / 100) * $fechamentos[0]->cartao_cred
                ));

                $fechamentos[0]->cartao_deb =
                numero_iso_para_br($fechamentos[0]->cartao_deb - (
                    ($fechamentos[0]->cartao_deb / 100) * $fechamentos[0]->perc_deb
                ));



                $fechamentos[0]->diferenca = numero_iso_para_br($fechamentos[0]->diferenca);
                $fechamentos[0]->total_caixa = numero_iso_para_br($fechamentos[0]->total_caixa);
                $fechamentos[0]->env = numero_iso_para_br($fechamentos[0]->env);
                $fechamentos[0]->pix = numero_iso_para_br($fechamentos[0]->pix);

                $total = numero_br_para_iso($fechamentos[0]->env) +
                numero_br_para_iso($fechamentos[0]->pix) +
                numero_br_para_iso($fechamentos[0]->cartao_cred) +
                numero_br_para_iso($fechamentos[0]->cartao_deb);


                $fechamentos[0]->receita = numero_iso_para_br($total);
                $fechamentos[0]->saidas = $fechamentos[0]->saidas ? $fechamentos[0]->saidas : 0;
                $fechamentos[0]->total_definitivo = numero_iso_para_br($total - $fechamentos[0]->saidas);

                // dd($fechamentos[0]);
                // dd($total);
                $results->push([$fechamentos[0]->receita, numero_iso_para_br($fechamentos[0]->saidas), $fechamentos[0]->total_definitivo]);
            }
        }

        return $results;
    }
}
