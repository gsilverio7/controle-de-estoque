<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoSimplesFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ('PUT' == $this->method()) {
            return [
                'nome' => 'required|max:191|unique:produtos_simples,nome,' . $this->route('idProduto'),
            ];
        }

        return [
            'nome' => 'required|max:191|unique:produtos_simples',
        ];
    }
}
