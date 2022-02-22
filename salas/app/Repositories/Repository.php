<?php

namespace App\Repositories;

use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Support\Facades\Log;

abstract class Repository implements RepositoryInterface
{

    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Cria um novo Item
     * @param array $data
     * @return array 
     */
    public function store(array $data)
    {
        try {

            $store = $this->model->create($data);

            if ($store) {
                return [
                    'error' => 0,
                    'data' => $store
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

    /**
     * Listagem de itens com paginação
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

    /**
     * Retorna uma item especifico.
     * @param int $id Id do item.
     * @return array
     */
    public function show(int $id)
    {
        try {

            $item = $this->model->find($id);

            if ($item) {
                return [
                    'error' => 0,
                    'data' => $item
                ];
            }

            return [
                'error' => 1,
                'description' => 'Item não encontrada.'
            ];
        } catch (\Exception $e) {
            Log::error('REPOSITORY_SHOW', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Erro ao Procurar Item.'
            ];
        }
    }

    public function update(int $id_item, array $data)
    {
        try {

            $update = $this->model->where('id', $id_item)->update($data);

            if ($update) {
                return [
                    'error' => 0,
                    'data' => $update
                ];
            }

            return [
                'error' => 1,
                'description' => 'Erro enquanto atualizava o item.'
            ];
        } catch (\Exception $e) {
            Log::error('REPOSITORY_UPDATE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Erro ao tentar atualizar o Item.'
            ];
        }
    }

    /**
     * Deleta o item.
     * @param int $ids
     * @return mixed
     */
    public function delete(mixed $ids)
    {
        try {

            $delete = $this->model->whereIn('id', $ids)->delete();

            if ($delete) {
                return [
                    'error' => 0,
                    'data' => $delete
                ];
            }

            return [
                'error' => 1,
                'description' => 'Não há itens para deletar.'
            ];
        } catch (\Exception $e) {
            Log::error('REPOSITORY_DELETE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Erro ao tentar deletar o item.'
            ];
        }
    }
}
