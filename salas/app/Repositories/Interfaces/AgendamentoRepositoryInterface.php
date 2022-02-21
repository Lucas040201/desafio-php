<?php

namespace App\Repositories\Interfaces;

interface AgendamentoRepositoryInterface
{

    /**
     * Procura a sala na lista do agendamento com a hora de inicio e termino.
     * @param int $id_sala Id da Sala a Ser agendada. 
     * @param array $data Informações do agendamento
     */
    public function getAgendamentoComHorario(int $id_sala, array $data);

}
