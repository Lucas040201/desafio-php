<?php

namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class AgendamentoUpdateRequest extends FormRequest
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
            'id_sala' => 'nullable|exists:salas,id',
            'id_usuario' => 'nullable|exists:usuarios,id',
            'id_turma' => 'nullable|exists:turmas,id',
            'data_agendamento' => 'nullable',
            'horario_inicio' => 'nullable',
            'horario_fim' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'id_sala.exists' => 'A sala Informada não existe.',
            'id_usuario.exists' => 'O Usuário Informado não existe.',
            'id_turma.exists' => 'A Turma informada não existe.',
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
