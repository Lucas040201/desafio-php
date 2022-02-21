<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class Service
{

    protected $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    /**
     * Cria um novo item
     * @param array $data
     */
    public function store(array $data)
    {
        try {
            $store = $this->repository->store($data);
            if ($store['error'] == 0) return $store;

            return [
                'error' => 1,
                'message' => 'Erro ao cadastrar um novo item.'
            ];
        } catch (\Exception $e) {
            Log::error('SERVICE_STORE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Erro ao tentar criar o item.'
            ];
        }
    }

    /**
     * atualiza o item.
     * @param int $id_item
     * @param array $data
     */
    public function update(int $id_item, array $data)
    {
        try {

            $update = $this->repository->update($id_item, $data);


            if ($update['error'] == 0) return $update;

            return [
                'error' => 1,
                'description' => 'Houve um problema enquanto atualizava o item.'
            ];
        } catch (\Exception $e) {
            Log::error('SERVICE_UPDATE', [$e->getMessage(), $e->getFile(), $e->getLine()]);
            return [
                'error' => 1,
                'description' => 'Erro ao tentar atualizar o item.'
            ];
        }
    }

    /**
     * Deleta os itens.
     * @param mixed $ids
     * @return array
     */
    public function delete(mixed $ids)
    {
        try {

            $data = [];
            if (is_integer($ids) || is_string($ids)) {
                $data[] = (int) $ids;
            }

            if (is_array($ids)) {
                foreach ($ids['id'] as $item) {
                    $data[] = (int) $item;
                }
            }

            $delete = $this->repository->delete($data);

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
            Log::error('SERVICE_DELETE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Erro ao tentar deletar o item.'
            ];
        }
    }

    /**
     * Pega um item especifico.
     * @param int $id_item
     * @return array
     */
    public function show(int $id_item)
    {
        try {

            $item = $this->repository->show($id_item);

            if ($item['error'] == 0) {
                return $item;
            }

            return [
                'error' => 1,
                'description' => 'Item não encontrado'
            ];
        } catch (\Exception $e) {
            Log::error('SERVICE_SHOW', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Erro ao tentar pegar o item.'
            ];
        }
    }

    /**
     * Listagem com paginão de itens.
     * @param array $data
     * @return array
     */
    public function index(array $data = [])
    {
        try {

            $itens = $this->repository->index($data);

            if (!empty($itens['data']->onEachSide)) {
                $itens['data'] = $itens['data']->items();
            }
            if($itens['error'] == 0) return $itens;

            return [
                'error' => 1,
                'description' => 'nenhum item encontrado'
            ];

        } catch (\Exception $e) {
            Log::error('SERVICE_INDEX', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Erro ao tentar pegar a listagem.'
            ];
        }
    }
}
