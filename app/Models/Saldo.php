<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
    use HasFactory;
    protected $table = 'saldo';

    protected $fillable = ['valor','empresa_id'];

    public static function ultimoSaldoPorEmpresa(int $empresaId)
    {
        return self::where('empresa_id',$empresaId)->latest()->first();
    }
}
