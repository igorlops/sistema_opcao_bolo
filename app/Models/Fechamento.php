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
    public function relatorioFinanceiro($data_ini, $data_fin,$user_id)
    {
        $fechamentos = $this->select('users.name', 'users.perc_cred', 'users.perc_deb');

        $fechamentos->selectRaw("SUM(total_caixa) AS total_caixa")
            ->selectRaw("SUM(env) AS env")
            ->selectRaw("SUM(pix) AS pix")
            ->selectRaw("SUM(cartao_cred) AS cartao_cred")
            ->selectRaw("SUM(cartao_deb) AS cartao_deb")
            ->selectRaw("SUM(diferenca) AS diferenca")
            ->whereBetween('created_at', [$data_ini . " 00:00:00", $data_fin . " 23:59:59"]);

        if ($user_id) {
            $fechamentos->where('fechamentos.user_id', $user_id);
        }

        $fechamentos = $fechamentos
            ->join('users', 'users.id', '=', 'fechamentos.user_id')
            ->groupBy('users.name', 'users.perc_cred', 'users.perc_deb')
            ->get();

        dd($fechamentos);

        return $fechamentos;
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
