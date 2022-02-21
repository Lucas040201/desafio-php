<?php

namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class SalaRequest extends FormRequest
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
            'numero_sala' => 'required|unique:salas,numero_sala',
        ];
    }

    public function messages()
    {
        return [
            'numero_sala.required' => 'O número da sala é obrigatório.',
            'numero_sala.unique' => 'O número de sala informado já existe.'
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
