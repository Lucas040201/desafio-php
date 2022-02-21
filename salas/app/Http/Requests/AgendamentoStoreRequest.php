<?php

namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class AgendamentoStoreRequest extends FormRequest
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
            'id_usuario' => 'required|exists:usuarios,id',
            'id_turma' => 'required|exists:turmas,id',
            'data_agendamento' => 'required',
            'horario_inicio' => 'required',
            'horario_fim' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'id_usuario.required' => 'O id do Usuário é obrigatório.',
            'id_usuario.exists' => 'O Usuário Informado não existe.',
            'id_turma.required' => 'O id da Turma é obrigatório.',
            'id_turma.exists' => 'A Turma informada não existe.',
            'data_agendamento.required' => 'A data é obrigatória.',
            'horario_inicio.image' => 'A Hora inicial é obrigatória.',
            'horario_fim.mimes' => 'A Hora final é obrigatória.'
        ];
        
    }

    protected function failedValidation(Validator $validator)
	{
		$errors = (new ValidationException($validator))->errors();
		$errors = str_replace("\n", ". \n", implode("\n" , array_map(function ($arr) {
			return implode("\n" , $arr);
		}, $errors)));
		throw new HttpResponseException(
			response()->json(['error' => 1, 'code' => 'Request Inválido', 'description' => $errors], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
		);
    }
}
