<?php

namespace App\Services;

use App\Repositories\AgendamentoRepository;
use App\Repositories\SalasRepository;

use Illuminate\Support\Facades\Log;

class AgendamentoService extends Service
{

    public function __construct()
    {
        parent::__construct(new AgendamentoRepository());
    }

    /**
     * Cadastra um Novo agendamento.
     * @param array $data
     * @return array
     */
    public function store(array $data)
    {
        try {
            $id_sala = $data['id_sala'];

            $salaRepository = new SalasRepository();
            $sala = $salaRepository->show($id_sala);
            if ($sala['error'] == 1) return $sala;


            $agendamento = $this->repository->getAgendamentoComHorario($id_sala, $data);

            if ($agendamento['error'] == 0) {
                return [
                    'error' => 1,
                    'description' => 'A sala já possuí um agendamento nesse horario.'
                ];
            }

            $data = $this->formatarDadosAgendamento($data);

            $novoAgendamento = $this->repository->store($data);

            if($novoAgendamento['error'] == 0) {
                return [
                    'error' => 0,
                    'message' => 'Agemdamento realizado com sucesso'
                ];
            }

            return [
                'error' => 1,
                'description' => 'Não foi possível realizar o agendamento.'
            ];

        } catch (\Exception $e) {
            Log::error('AGENDAMENTO_SERVICE_STORE', [$e->getMessage(), $e->getFile(), $e->getLine()]);
            return [
                'error' => 1,
                'description' => 'Erro ao tentar cadastrar o Agendamento.'
            ];
        }
    }
    
    /**
     * Atualiza as informações do agendamento.
     * @param int $id_agendamento
     * @param array $data
     * @return array
     */
    public function update(int $id_agendamento, array $data)
    {
        try {

            $info = $this->formatarDadosAgendamento($data);
            $update = $this->repository->update($id_agendamento, $info);

            if ($update['error'] == 0) {
                return [
                    'error' => 0,
                    'message' => 'Agendamento atualizado com sucesso.'
                ];
            }

            return [
                'error' => 1,
                'message' => 'Erro enquanto atualiza o agendamento.'
            ];
        } catch (\Exception $e) {
            Log::error('AGENDAMENTO_REPOSITORY_UPDATE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Erro ao tentar atualizar um agendamento.'
            ];
        }
    }

    /**
     * Formata as informações de hora
     * @param array $data
     * @return array
     */
    private function formatarDadosAgendamento(array $data)
    {
        try {
            $fim = null;

            if(isset($data['horario_fim'])) {
                $fim = $data['horario_fim'];
    
                $minuto_fim = intval(date('i', strtotime($fim)));
    
                if ($minuto_fim % 2 == 0) {
                    $minuto_fim = $minuto_fim - 1;
                    $fim = date('H', strtotime($fim));
                    $fim .= ":$minuto_fim:00";
                }
            }

            $info = [
                'id_sala' => (isset($data['id_sala']))?$data['id_sala'] : null,
                'id_usuario' => (isset($data['id_usuario']))?$data['id_usuario'] : null,
                'id_turma' => (isset($data['id_turma']))?$data['id_turma'] : null,
                'data_agendamento' => (isset($data['data_agendamento']))?$data['data_agendamento'] : null,
                'horario_inicio' => (isset($data['horario_inicio']))?$data['horario_inicio'] : null,
                'horario_fim' => $fim,
            ];

            foreach($info as $key => $item) {
                if(!$item) {
                    unset($info[$key]);
                }
            }

            return $info;
        } catch (\Exception $e) {
            Log::error('AGENDAMENTO_SERVICE_FORMATAR_DADOS_AGENDAMENTO', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Erro ao Formatar os dados.'
            ];
        }
    }
}
