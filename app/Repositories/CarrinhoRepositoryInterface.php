<?php

namespace App\Repositories;

use App\Carrinho;

interface CarrinhoRepositoryInterface
{
    public function get($carrinho_id);

    public function all();

    public function insert(array $carrinho_produto, $id);

    public function update($carrinho_id, array $carrinho_produto);

    public function delete($carrinho_id, array $produto);
}
