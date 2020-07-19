<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetRequest extends FormRequest
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
        return [
            'name'        => 'required|string',
            'description' => 'required|string',
            'age'         => 'required|numeric',
            'user_id'     => 'required|numeric|exists:users,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required'        => 'O Campo Nome é Obrigatório!',
            'description.required' => 'O Campo Descrição é Obrigatório!',
            'Age.required'         => 'O Campo Idade é Obrigatório!',
            'user.required'        => 'O Campo Usuário é Obrigatório!'
        ];
    }
}
