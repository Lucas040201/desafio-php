<?php

namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class UsuariosUpdateRequest extends FormRequest
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
            'nome' => 'string|nullable',
            'sobrenome' => 'string|nullable',
            'email' => 'nullable|unique:usuarios,email',
            'senha' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'O email é obrigatório.',
            'email.unique' => 'E-mail já cadastrado',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        $errors = str_replace("\n", ". \n", implode("\n", array_map(function ($arr) {
            return implode("\n", $arr);
        }, $errors)));
        throw new HttpResponseException(
            response()->json(['error' => 1, 'code' => 'Request Inválido', 'description' => $errors], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
