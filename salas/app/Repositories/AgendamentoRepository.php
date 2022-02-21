<?php

namespace App\Repositories;

use App\Models\Agendamento;
use App\Repositories\Interfaces\AgendamentoRepositoryInterface;
use Illuminate\Support\Facades\Log;

class AgendamentoRepository extends Repository implements AgendamentoRepositoryInterface
{

    public function __construct()
    {
        parent::__construct(new Agendamento());
    }

    /**
     * Procura a sala na lista do agendamento com a hora de inicio e termino.
     * @param int $id_sala Id da Sala a Ser agendada. 
     * @param array $data Informações do agendamento
     * @return array
     */
    public function getAgendamentoComHorario(int $id_sala, array $data)
    {
        try {
            $inicio = $data['horario_inicio'];
            $fim = $data['horario_fim'];
            $data = $data['data_agendamento'];

            $agendamento = $this->model
                ->where('id_sala', $id_sala)
                ->where('data_agendamento', $data)
                ->whereBetween('horario_fim', [$inicio, $fim])
                ->orwhere(function ($q) use ($inicio, $fim, $id_sala, $data) {
                    $q->where('horario_inicio', '<=', $inicio)
                    ->where('horario_fim', '>=', $fim)
                    ->where('id_sala', $id_sala)
                    ->where('data_agendamento', $data);
                })
                ->orwhereBetween('horario_inicio', [$inicio, $fim])
                ->where('id_sala', $id_sala)
                ->where('data_agendamento', $data)
                ->first();

            if ($agendamento) {
                return [
                    'error' => 0,
                    'data' => $agendamento
                ];
            }

            return [
                'error' => 1,
                'message' => 'O agendamento não foi encontrado.'
            ];
        } catch (\Exception $e) {
            Log::error('AGENDAMENTO_REPOSITORY_GET_AGENDAMENTO_COM_HORARIO', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Erro ao tentar pegar agendamento.'
            ];
        }
    }

    /**
     * Lista os agendamentos por filtro
     * @param array $data
     * @return array
     */
    public function index(array $data = [])
    {
        try {

            $perPage = (int) (!empty($data['porPage'])) ? $data['porPage'] : 10;
            $lista = [];

            if (!empty($data['filtro']) && $data['filtro'] === 'tudo') {
                $lista = $this->model->get();
            }

            if (!count($lista)) {

                $lista = $this->model;
                if (!empty($data['filtro']) && !empty($data['tipo'])) {
                    $lista = $lista->orderBy($data['tipo'], $data['filtro']);
                }

                $lista = $lista->paginate($perPage, ['*'], 'page', $data['page'] ?? null);
            }


            if ($lista) {
                return [
                    'error' => 0,
                    'data' => $lista
                ];
            }

            return [
                'error' => 1,
                'description' => 'Houve um erro ao criar o item.'
            ];
        } catch (\Exception $e) {
            Log::error('REPOSITORY_STORE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Erro ao tentar criar item.'
            ];
        }
    }
}
