<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Cliente extends Model
{
    // banco
    protected $table = 'clientes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'nome',
        'cnpj',
        'cpf',
        'divida',
        'email',
        'endereco',
        'telefone',
        'tipo'
    ];

    //accessors
    public function getCreatedAtAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y H:i:s');
    }

    public function getCpfAttribute($value)
    {
        return substr($value, 0, 3) . '.' .
            substr($value, 3, 3) . '.' .
            substr($value, 6, 3) . '-' .
            substr($value, 9, 2);
    }

    public function getCnpjAttribute($value)
    {
        return substr($value, 0, 2) . '.' .
            substr($value, 2, 3) . '.' .
            substr($value, 5, 3) . '/' .
            substr($value, 8, 4) . '-'.
            substr($value, 12, 2);
    }

    public function getDividaAttribute($value)
    {
        return str_replace('.', ',', $value);
    }

    //mutators
    public function setCpfAttribute($value)
    {
        return $this->attributes['cpf'] = preg_replace('~\D~', '', $value);
    }

    public function setCnpjAttribute($value)
    {
        return $this->attributes['cnpj'] = preg_replace('~\D~', '', $value);
    }
}
