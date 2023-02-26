<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
                'name' => 'required|max:191|unique:users,name,' . $this->route('idUsuario'),
                'email' => 'required|max:191|unique:users,email,' . $this->route('idUsuario'),
                'new_password' => 'nullable|min:6|required_with:new_password_confirm|same:new_password_confirm',
                'new_password_confirm' => 'nullable|min:6'
            ];
        }

        return [
            'name' => 'required|max:191|unique:users',
            'email' => 'required|max:191|unique:users',
            'new_password' => 'required|min:6|required_with:new_password_confirm|same:new_password_confirm',
            'new_password_confirm' => 'required|min:6'
        ];
    }

    public function attributes()
    {
        return [
            'new_password' => 'Senha',
            'new_password_confirm' => 'Confirmar Senha',
        ];
    }
}
