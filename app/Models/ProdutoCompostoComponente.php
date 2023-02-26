<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdutoCompostoComponente extends Model
{
    // banco
    protected $table = 'produtos_compostos_componentes';

    // timestamps
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_produto_composto',
        'id_produto_simples',
        'quantidade'
    ];

    // relacionamentos
    public function produtoComposto()
    {
        return $this->hasOne('App\Models\ProdutoComposto', 'id', 'id_produto_composto');
    }

    public function produtoSimples()
    {
        return $this->hasOne('App\Models\ProdutoSimples', 'id', 'id_produto_simples');
    }
}
