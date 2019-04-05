<?php

namespace App\Repositories;

interface CarrinhoRepositoryInterface
{
    /**
     * @param $carrinho_id
     * @return mixed
     */
    public function get($carrinho_id);

    /**
     * @return mixed
     */
    public function all();

    /**
     * @param array $produto
     * @param       $id
     * @return bool
     */
    public function insert(array $carrinho_produto, $id);

    /**
     * @param       $carrinho_id
     * @param array $produto
     * @return bool
     */
    public function update($carrinho_id, array $carrinho_produto);

    /**
     * @param       $carrinho_id
     * @param array $produto
     * @return bool
     */
    public function delete($carrinho_id, array $produto);
}
