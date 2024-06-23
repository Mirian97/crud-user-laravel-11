<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * Classe de requisição personalizada para operações relacionadas a usuários.
 */
class UserRequest extends FormRequest
{
    /**
     * Verifica se o usuário está autorizado a fazer esta requisição.
     *
     * @return bool Verdadeiro se o usuário estiver autorizado, falso caso contrário.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Manipula a falha na validação da requisição.
     *
     * @param Validator $validator O validador que falhou.
     * @throws HttpResponseException Exceção lançada quando a validação falha.
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            "status" => true,
            "errors" => $validator->errors(),
        ], 422));
    }

    /**
     * Define as regras de validação que se aplicam à requisição.
     *
     * @return array<string, mixed> As regras de validação para esta requisição.
     */
    public function rules(): array
    {
        $user = $this->route("user");

        return [
            "name" => "required",
            "email"=> "required|email|unique:users,email," . ($user ? $user->id : null),
            "password" => "required|min:5",
        ];
    }

    /**
     * Mensagens personalizadas para erros de validação.
     *
     * @return array<string, string> As mensagens personalizadas para erros de validação.
     */
    public function messages(): array
    {
        return [
            "name.required" => "O campo nome é obrigatório!",
            "email.required" => "O campo e-mail é obrigatório!",
            "email.email" => "O e-mail não é um e-mail válido!",
            "email.unique" => "O e-mail já está cadastrado",
            "password.required" => "O campo senha é obrigatório!",
            "password.min" => "O campo senha deve ter no mínimo :min caracteres!"
        ];
    }
}
