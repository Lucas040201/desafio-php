<?php

namespace App\Repositories\Interfaces;

interface RepositoryInterface
{

    /**
     * Lista todos os Items.
     * @param array $data Filtro de Busca
     */
    public function index(array $data);

    /**
     * Pega um Item especifico.
     * @param int $id Id do item.
     */
    public function show(int $id);

    /**
     * Cria um Item.
     * @param array $data Informações do Item.
     */
    public function store(array $data);

    /**
     * Atualiza um Item.
     * @param int $id Id do Item.
     * @param array $data Informações do Item.
     */
    public function update(int $id, array $data);

    /**
     * Deleta um Item.
     * @param int $id Id do Item.
     */
    public function delete(array $id);
}
