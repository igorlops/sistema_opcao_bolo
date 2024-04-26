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
    protected $fillable = ['vendas_extras', 'desconto', 'vendas_abc', 'total_caixa', 'env', 'cartao_cred', 'cartao_deb', 'pix','diferenca'];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
    public function relatorioFinanceiro($data_ini = null, $data_fin = null,$user_id = null)
    {
        $total_caixa = $this->query();
        $env = $this->query();
        $pix = $this->query();
        $cartao_cred = $this->query();
        $cartao_deb = $this->query();
        $diferenca = $this->query();

        if($user_id)
        {
            $total_caixa = $total_caixa->where('user_id', $user_id);
            $env = $env->where('user_id', $user_id);
            $pix = $pix->where('user_id', $user_id);
            $cartao_cred = $cartao_cred->where('user_id', $user_id);
            $cartao_deb = $cartao_deb->where('user_id', $user_id);
            $diferenca = $diferenca->where('user_id', $user_id);
        }
        if($data_ini and $data_fin) {
            $total_caixa = $total_caixa->whereBetween('created_at',[$data_ini,$data_fin]);
            $env = $env->whereBetween('created_at',[$data_ini,$data_fin]);
            $pix = $pix->whereBetween('created_at',[$data_ini,$data_fin]);
            $cartao_cred = $cartao_cred->whereBetween('created_at',[$data_ini,$data_fin]);
            $cartao_deb = $cartao_deb->whereBetween('created_at',[$data_ini,$data_fin]);
            $diferenca = $diferenca->whereBetween('created_at',[$data_ini,$data_fin]);
        }
        $total_caixa = $this->sum('total_caixa');
        $env = $this->sum('env');
        $pix = $this->sum('pix');
        $cartao_cred = $this->sum('cartao_cred');
        $cartao_deb = $this->sum('cartao_deb');
        $diferenca = $this->sum('diferenca');

        return [
            $total_caixa,
            $env,
            $pix,
            $cartao_cred,
            $cartao_deb,
            $diferenca
        ];
    }
}
