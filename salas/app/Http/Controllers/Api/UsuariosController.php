<?php

namespace App\Http\Controllers\Api;

use App\Facades\UsuariosFacade;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UsuariosStoreRequest;
use App\Http\Requests\UsuariosUpdateRequest;
use Illuminate\Support\Facades\Log;

class UsuariosController extends Controller
{
    /**
     * Cadastra um novo usuário.
     * @param UsuariosStoreRequest $request
     * @return array
     */
    public function store(UsuariosStoreRequest $request)
    {
        try {

            $data = $request->validated();

            $store = UsuariosFacade::store($data);

            if ($store['error'] == 0) {
                return response([
                    'error' => 0,
                    'message' => 'Usuario cadastrado com Sucesso.'
                ], 201);
            }

            return response([
                'error' => 1,
                'message' => 'Erro ao cadastrar usuário.'
            ]);
        } catch (\Exception $e) {
            Log::error('USUARIOS_CONTROLLER_STORE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return response([
                'error' => 1,
                'description' => 'Ocorreu um erro inesperado enquanto tentava cadastrar o usuário'
            ], 500);
        }
    }

    /**
     * Atualiza o usuário.
     * @param UsuariosUpdateRequest $request
     * @param int $id_usuario
     * @return \Illuminate\Http\Response
     */
    public function update(UsuariosUpdateRequest $request, int $id_usuario)
    {
        try {
            $data = $request->validated();

            $update = UsuariosFacade::update($id_usuario, $data);

            if ($update['error'] == 0) {
                return response([
                    'error' => 0,
                    'message' => 'Usuário atualizado com sucesso.'
                ]);
            }

            return response($update);
        } catch (\Exception $e) {
            Log::error('USUARIOS_CONTROLLER_UPDATE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return response([
                'error' => 1,
                'description' => 'Erro ao tentar atualizar o usuário.'
            ], 500);
        }
    }

    /**
     * Deleta o usuário.
     * @param Request $request
     * @param int $id_usuario
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, int $id_usuario = null)
    {
        try {

            $ids = $request->only('id');

            $delete = UsuariosFacade::delete($id_usuario ?? $ids);

            if ($delete['error'] == 0) {
                return response([
                    'error' => 0,
                    'message' => 'Usuário excluido com sucesso.'
                ]);
            }

            return response($delete);
        } catch (\Exception $e) {
            Log::error('USUARIOS_CONTROLLER_DELETE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return response([
                'error' => 1,
                'description' => 'Erro ao tentar excluir o usuário.'
            ], 500);
        }
    }

    /**
     * Retorna um usuario especifico
     * @param int $id_usuario
     * @return \Illuminate\Http\Response
     */
    public function show(int $id_usuario)
    {
        try {


            $usuario = UsuariosFacade::show($id_usuario);

            if ($usuario['error'] == 0) {
                return response($usuario);
            }

            return response([
                'error' => 1,
                'description' => 'Usuário não encontrado.'
            ]);
        } catch (\Exception $e) {
            Log::error('USUARIOS_CONTROLLER_SHOW', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return response([
                'error' => 1,
                'description' => 'Erro ao tentar encontrar o usuárop.'
            ], 500);
        }
    }

    /**
     * Traz uma listagem de usuarios
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $filtroInfo = $request->only(['porPage', 'filtro', 'page', 'tipo']);
            $itens = UsuariosFacade::index($filtroInfo);

            if ($itens['error'] == 0) return response($itens);

            return response([
                'error' => 1,
                'description' => 'Nenhum usuario encontrado.'
            ]);
        } catch (\Exception $e) {
            Log::error('USUARIOS_CONTROLLER_INDEX', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return response([
                'error' => 1,
                'description' => 'Erro ao tentar encontrar o usuario.'
            ], 500);
        }
    }
}
