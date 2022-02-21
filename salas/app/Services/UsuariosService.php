<?php

namespace App\Services;

use App\Repositories\UsuariosRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UsuariosService extends Service
{

    public function __construct()
    {
        parent::__construct(new UsuariosRepository());
    }

    /**
     * Cadastra um usuário
     * @param array $data
     * @return array
     */
    public function store(array $data)
    {
        try {
            $info = [
                'nome' => $data['nome'],
                'sobrenome' => $data['sobrenome'],
                'email' => $data['email'],
                'senha' => Hash::make($data['senha']),
            ];

            $data = $this->repository->store($info);

            if ($data['error'] == 0) {
                return [
                    'error' => 0,
                    'message' => 'Usuário cadastrado com sucesso.'
                ];
            }

            return [
                'error' => 1,
                'description' => 'Erro ao cadastrar usuário'
            ];
        } catch (\Exception $e) {
            Log::error('USUARIOS_SERVICE_STORE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Erro enquanto Registra Usuário.'
            ];
        }
    }

    /**
     * Cadastra um usuário
     * @param int $id_usuario
     * @param array $data
     * @return array
     */
    public function update(int $id_usuario, array $data)
    {
        try {
            $info = [];
            if (!empty($data)) {

                $info = [
                    'nome' => (isset($data['nome'])) ? $data['nome'] : null,
                    'sobrenome' => (isset($data['sobrenome'])) ? $data['sobrenome'] : null,
                    'email' => (isset($data['email'])) ? $data['email'] : null,
                    'senha' => (isset($data['senha'])) ? Hash::make($data['senha']) : null
                ];

                foreach ($info as $key => $item) {
                    if (!$item) {
                        unset($info[$key]);
                    }
                }
            }
            $data = $this->repository->update($id_usuario, $info);

            if ($data['error'] == 0) {
                return [
                    'error' => 0,
                    'message' => 'Usuário atualziado com sucesso.'
                ];
            }

            return [
                'error' => 1,
                'description' => 'Erro ao atualizar usuário.'
            ];
        } catch (\Exception $e) {
            Log::error('USUARIOS_SERVICE_UPDATE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Erro enquanto atualiza Usuário.'
            ];
        }
    }
}
