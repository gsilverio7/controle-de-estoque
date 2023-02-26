<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ProdutoComposto extends Model
{
    // banco
    protected $table = 'produtos_compostos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ativo',
        'nome',
        'preco_venda'
    ];

    // relacionamentos
    public function componentes()
    {
        return $this->hasMany('App\Models\ProdutoCompostoComponente', 'id_produto_composto', 'id');
    }

    //accessors
    public function getCreatedAtAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y H:i:s');
    }
}
