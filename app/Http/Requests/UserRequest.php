<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'nome',
            'email' => 'endereço de e-mail',
            'type' => 'tipo',
            'enabled' => 'habilitado',
            'password' => 'senha',
            'password_confirmation' => 'confirmação de senha',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => 'required|string',
                    'email' => 'required|email|unique:users,email',
                    'type' => 'required|string',
                    'enabled' => 'string',
                    'password' => 'required|string',
                    'password_confirmation' => 'required|same:password',
                    'private_key' => 'nullable|string',
                    'certificate' => 'nullable|string',
                    'private_key_password' => 'nullable|string',
                ];
            case 'PUT':
                return [
                    'name' => 'required|string',
                    'email' => 'required|email|unique:users,email,' . $this->get('id'),
                    'type' => 'required|string',
                    'enabled' => 'string',
                    'password' => 'nullable|string',
                    'password_confirmation' => 'nullable|same:password',
                    'private_key' => 'nullable|string',
                    'certificate' => 'nullable|string',
                    'private_key_password' => 'nullable|string',
                ];
        }
    }
}
