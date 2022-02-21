<?php

namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class TurmaRequest extends FormRequest
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
            'turma' => 'required|unique:turmas,turma',
        ];
    }

    public function messages()
    {
        return [
            'turma.required' => 'A série é obrigatória.',
            'turma.unique' => 'Essa série já existe.'
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
