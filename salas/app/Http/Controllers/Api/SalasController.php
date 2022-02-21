<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Facades\SalasFacade;
use App\Http\Requests\SalaRequest;
use Illuminate\Support\Facades\Log;

class SalasController extends Controller
{

    /**
     * Cadastra uma nova Sala.
     * @param SalaRequest $request
     * @return array
     */
    public function store(SalaRequest $request)
    {
        try {

            $data = $request->validated();

            $store = SalasFacade::store($data);

            if ($store['error'] == 0) {
                return response([
                    'error' => 0,
                    'message' => 'Sala cadastrada com Sucesso.'
                ], 201);
            }

            return response([
                'error' => 1,
                'message' => 'Erro ao cadastrar sala.'
            ]);
        } catch (\Exception $e) {
            Log::error('SALAS_CONTROLLER_STORE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return response([
                'error' => 1,
                'description' => 'Ocorreu um erro inesperado enquanto tentava cadastrar a sala'
            ], 500);
        }
    }

    /**
     * Atualiza a Sala.
     * @param SalaRequest $request
     * @param int $id_sala
     * @return \Illuminate\Http\Response
     */
    public function update(SalaRequest $request, int $id_sala)
    {
        try {

            $data = $request->validated();
            $update = SalasFacade::update($id_sala, $data);

            if ($update['error'] == 0) {
                return response([
                    'error' => 0,
                    'message' => 'Sala atualizado com sucesso.'
                ]);
            }

            return response($update);
        } catch (\Exception $e) {
            Log::error('SALA_CONTROLLER_UPDATE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return response([
                'error' => 1,
                'description' => 'Erro ao tentar atualizar um Sala.'
            ], 500);
        }
    }

    /**
     * Deleta a Sala.
     * @param Request $request
     * @param int $id_sala
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, int $id_sala = null)
    {
        try {

            $ids = $request->only('id');

            $delete = SalasFacade::delete($id_sala ?? $ids);

            if ($delete['error'] == 0) {
                return response([
                    'error' => 0,
                    'message' => 'Sala excluida com sucesso.'
                ]);
            }

            return response($delete);
        } catch (\Exception $e) {
            Log::error('SALA_CONTROLLER_DELETE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return response([
                'error' => 1,
                'description' => 'Erro ao tentar excluir a Sala.'
            ], 500);
        }
    }

    /**
     * Retorna uma sala especifico
     * @param int $id_sala
     * @return \Illuminate\Http\Response
     */
    public function show(int $id_sala)
    {
        try {


            $sala = SalasFacade::show($id_sala);

            if ($sala['error'] == 0) {
                return response($sala);
            }

            return response([
                'error' => 1,
                'description' => 'Sala não encontrada'
            ]);
        } catch (\Exception $e) {
            Log::error('SALA_CONTROLLER_SHOW', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return response([
                'error' => 1,
                'description' => 'Erro ao tentar encontrar a sala.'
            ], 500);
        }
    }

    /**
     * Traz uma listagem de salas
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $filtroInfo = $request->only(['porPage', 'filtro', 'page', 'tipo']);
            $itens = SalasFacade::index($filtroInfo);

            if($itens['error'] == 0) return response($itens);

            return response([
                'error' => 1,
                'description' => 'Nenhuma sala encontrado.'
            ]);

        } catch (\Exception $e) {
            Log::error('SALAS_CONTROLLER_INDEX', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return response([
                'error' => 1,
                'description' => 'Erro ao tentar encontrar uma sala.'
            ], 500);
        }

    }
}
