<?php

namespace App\Http\Controllers\Api;

use App\Facades\TurmasFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\TurmaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TurmasController extends Controller
{
    /**
     * Cadastra uma nova Turma.
     * @param TurmaRequest $request
     * @return array
     */
    public function store(TurmaRequest $request)
    {
        try {

            $data = $request->validated();

            $store = TurmasFacade::store($data);

            if ($store['error'] == 0) {
                return response([
                    'error' => 0,
                    'message' => 'Turma cadastrada com Sucesso.'
                ], 201);
            }

            return response([
                'error' => 1,
                'message' => 'Erro ao cadastrar turma.'
            ]);
        } catch (\Exception $e) {
            Log::error('TURMA_CONTROLLER_STORE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return response([
                'error' => 1,
                'description' => 'Ocorreu um erro inesperado enquanto tentava cadastrar a turma'
            ], 500);
        }
    }

    /**
     * Atualiza a turma.
     * @param TurmaRequest $request
     * @param int $id_turma
     * @return \Illuminate\Http\Response
     */
    public function update(TurmaRequest $request, int $id_turma)
    {
        try {

            $data = $request->validated();
            $update = TurmasFacade::update($id_turma, $data);

            if ($update['error'] == 0) {
                return response([
                    'error' => 0,
                    'message' => 'Turma atualizado com sucesso.'
                ]);
            }

            return response($update);
        } catch (\Exception $e) {
            Log::error('TURMA_CONTROLLER_UPDATE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return response([
                'error' => 1,
                'description' => 'Erro ao tentar atualizar a Turma.'
            ], 500);
        }
    }

    /**
     * Deleta a turma.
     * @param Request $request
     * @param int $id_turma
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, int $id_turma = null)
    {
        try {

            $ids = $request->only('id');

            $delete = TurmasFacade::delete($id_turma ?? $ids);

            if ($delete['error'] == 0) {
                return response([
                    'error' => 0,
                    'message' => 'Turma excluida com sucesso.'
                ]);
            }

            return response($delete);
        } catch (\Exception $e) {
            Log::error('TURMA_CONTROLLER_DELETE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return response([
                'error' => 1,
                'description' => 'Erro ao tentar excluir a Turma.'
            ], 500);
        }
    }

    /**
     * Retorna uma turma especifico
     * @param int $id_turma
     * @return \Illuminate\Http\Response
     */
    public function show(int $id_turma)
    {
        try {


            $turma = TurmasFacade::show($id_turma);

            if ($turma['error'] == 0) {
                return response($turma);
            }

            return response([
                'error' => 1,
                'description' => 'Turma não encontrada'
            ]);
        } catch (\Exception $e) {
            Log::error('TURMA_CONTROLLER_SHOW', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return response([
                'error' => 1,
                'description' => 'Erro ao tentar encontrar a turma.'
            ], 500);
        }
    }

    /**
     * Traz uma listagem de turmas
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $filtroInfo = $request->only(['porPage', 'filtro', 'page', 'tipo']);
            $itens = TurmasFacade::index($filtroInfo);

            if($itens['error'] == 0) return response($itens);

            return response([
                'error' => 1,
                'description' => 'Nenhuma turma encontrado.'
            ]);

        } catch (\Exception $e) {
            Log::error('TURMAS_CONTROLLER_INDEX', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return response([
                'error' => 1,
                'description' => 'Erro ao tentar encontrar uma turma.'
            ], 500);
        }

    }
}
