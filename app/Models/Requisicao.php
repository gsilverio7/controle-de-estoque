<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Requisicao extends Model
{
    // banco
    protected $table = 'requisicoes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user',
        'tipo'
    ];

    // relacionamentos
    public function movimentacoes()
    {
        return $this->hasMany('App\Models\Movimentacao', 'id_requisicao', 'id');
    }

    public function usuario()
    {
        return $this->hasOne('App\User', 'id', 'id_user');
    }

    //accessors
    
    public function getTipoAttribute($value)
    {
        if ($value == 'c') {
            return 'Compra';
        }
        return 'Venda';
    }
    

    public function getCreatedAtAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y H:i:s');
    }
}
