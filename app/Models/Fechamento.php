<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        $users = User::all();

        $total_caixa = "(SELECT SUM(fechamentos.total_caixa) FROM fechamentos WHERE created_at BETWEEN ? AND ? AND fechamentos.user_id = ? ) AS total_caixa";
        $env = "(SELECT SUM(fechamentos.env) FROM fechamentos WHERE created_at BETWEEN ? AND ? AND fechamentos.user_id = ? ) AS env";
        $pix = "(SELECT SUM(fechamentos.pix) FROM fechamentos WHERE created_at BETWEEN ? AND ? AND fechamentos.user_id = ? ) AS pix";
        $cartao_cred = "(SELECT SUM(fechamentos.cartao_cred) FROM fechamentos WHERE created_at BETWEEN ? AND ? AND fechamentos.user_id = ? ) AS cartao_cred";
        $cartao_deb = "(SELECT SUM(fechamentos.cartao_deb) FROM fechamentos WHERE created_at BETWEEN ? AND ? AND fechamentos.user_id = ? ) AS cartao_deb";
        $diferenca = "(SELECT SUM(fechamentos.diferenca) FROM fechamentos WHERE created_at BETWEEN ? AND ? AND fechamentos.user_id = ? ) AS diferenca";

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
                foreach ($fechamentos as $fechamento) {
                    $results[] = $fechamento->getAttributes();
                }
            }
        }
        return $results;
    }

}





// $total_caixa = $this->query();
        // $env = $this->query();
        // $pix = $this->query();
        // $cartao_cred = $this->query();
        // $cartao_deb = $this->query();
        // $diferenca = $this->query();
        // $total_caixa = $total_caixa->where('user_id', $user_id);
        // $env = $env->where('user_id', $user_id);
        // $pix = $pix->where('user_id', $user_id);
        // $cartao_cred = $cartao_cred->where('user_id', $user_id);
        // $cartao_deb = $cartao_deb->where('user_id', $user_id);
        // $diferenca = $diferenca->where('user_id', $user_id);
        // $total_caixa = $total_caixa->whereBetween('created_at',[$data_ini,$data_fin]);
        // $env = $env->whereBetween('created_at',[$data_ini,$data_fin]);
        // $pix = $pix->whereBetween('created_at',[$data_ini,$data_fin]);
        // $cartao_cred = $cartao_cred->whereBetween('created_at',[$data_ini,$data_fin]);
        // $cartao_deb = $cartao_deb->whereBetween('created_at',[$data_ini,$data_fin]);
        // $diferenca = $diferenca->whereBetween('created_at',[$data_ini,$data_fin]);
        // $total_caixa = $this->sum('total_caixa');
        // $env = $this->sum('env');
        // $pix = $this->sum('pix');
        // $cartao_cred = $this->sum('cartao_cred');
        // $cartao_deb = $this->sum('cartao_deb');
        // $diferenca = $this->sum('diferenca');
