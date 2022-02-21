<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Facades\AgendamentoFacade;
use App\Http\Requests\AgendamentoStoreRequest;
use App\Http\Requests\AgendamentoUpdateRequest;
use Illuminate\Support\Facades\Log;

class AgendamentoController extends Controller
{
    /**
     * Cadastra um novo agendamento
     * @param AgendamentoStoreRequest $request
     * @param int $id_sala
     * @return \Illuminate\Http\Response
     */
    public function store(AgendamentoStoreRequest $request, int $id_sala)
    {
        try {

            $data = $request->validated();

            $data['id_sala'] = $id_sala;

            $agendamento = AgendamentoFacade::store($data);

            if ($agendamento['error'] == 0) {
                return response([
                    'error' => 0,
                    'message' => 'Agendamento criado com sucesso.'
                ], 201);
            }

            return response($agendamento);
        } catch (\Exception $e) {
            Log::error('AGENDAMENTO_CONTROLLER_STORE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return response([
                'error' => 1,
                'description' => 'Erro ao tentar cadastrar um Agendamento.'
            ], 500);
        }
    }

    /**
     * Atualiza um agendamento.
     * @param AgendamentoUpdateRequest $request
     * @param int $id_agendamento
     * @return \Illuminate\Http\Response
     */
    public function update(AgendamentoUpdateRequest $request, int $id_agendamento)
    {
        try {

            $data = $request->validated();

            $update = AgendamentoFacade::update($id_agendamento, $data);

            if ($update['error'] == 0) {
                return response([
                    'error' => 0,
                    'message' => 'Agendamento atualizado com sucesso.'
                ]);
            }

            return response($update);
        } catch (\Exception $e) {
            Log::error('AGENDAMENTO_CONTROLLER_UPDATE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return response([
                'error' => 1,
                'description' => 'Erro ao tentar atualizar um Agendamento.'
            ], 500);
        }
    }

    /**
     * Atualiza um agendamento.
     * @param Request $request
     * @param int $id_agendamento
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, int $id_agendamento = null)
    {
        try {

            $ids = $request->only('id');

            $delete = AgendamentoFacade::delete($id_agendamento ?? $ids);

            if ($delete['error'] == 0) {
                return response([
                    'error' => 0,
                    'message' => 'Agendamento excluido com sucesso.'
                ]);
            }

            return response($delete);
        } catch (\Exception $e) {
            Log::error('AGENDAMENTO_CONTROLLER_DELETE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return response([
                'error' => 1,
                'description' => 'Erro ao tentar excluir o Agendamento.'
            ], 500);
        }
    }

    /**
     * Retorna um agendamento especifico
     * @param int $id_agendamento
     * @return \Illuminate\Http\Response
     */
    public function show(int $id_agendamento)
    {
        try {


            $agendamento = AgendamentoFacade::show($id_agendamento);

            if ($agendamento['error'] == 0) {
                return response($agendamento);
            }

            return response([
                'error' => 1,
                'description' => 'Agendamento não encontrado'
            ]);
        } catch (\Exception $e) {
            Log::error('AGENDAMENTO_CONTROLLER_SHOW', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return response([
                'error' => 1,
                'description' => 'Erro ao tentar encontrar o agendamento.'
            ], 500);
        }
    }

    /**
     * Traz ma listagem de agendamentos
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $filtroInfo = $request->only(['porPage', 'filtro', 'page', 'tipo']);
            $itens = AgendamentoFacade::index($filtroInfo);

            if($itens['error'] == 0) return response($itens);

            return response([
                'error' => 1,
                'description' => 'Nenhum agendamento encontrado.'
            ]);

        } catch (\Exception $e) {
            Log::error('AGENDAMENTO_CONTROLLER_INDEX', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return response([
                'error' => 1,
                'description' => 'Erro ao tentar encontrar o agendamento.'
            ], 500);
        }

    }
}
