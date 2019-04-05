<?php

namespace App\Repositories;

use App\Carrinho;
use App\CarrinhoProduto;

class CarrinhoRepository implements CarrinhoRepositoryInterface
{

    public function get($carrinho_id)
    {
        return Carrinho::where('id', $carrinho_id)->with('produtos')->first();
    }

    public function all()
    {
        return Carrinho::select(['id'])->with('produtos')->get();
    }

    public function insert(array $produto, $id)
    {
        if (empty($id)) {
            $carrinho = Carrinho::create([]);
        } else {
            $carrinho = Carrinho::find($id);
        }

        $carrinho_produto = CarrinhoProduto::where('carrinho_id', $carrinho->id)
            ->where('produto_id', $produto['produto_id'])
            ->first();

        if (empty($carrinho_produto)) {
            $carrinho_produto = new CarrinhoProduto($produto);
            $carrinho_produto->carrinho_id = $carrinho->id;
            $carrinho_produto->save();

            return $carrinho;
        }

        return false;
    }

    public function update($carrinho_id, array $produto)
    {
        $carrinho_produto = CarrinhoProduto::where('carrinho_id', $carrinho_id)
            ->where('produto_id', $produto['produto_id'])
            ->first();

        if (!empty($carrinho_produto)) {
            $carrinho_produto->quantidade = $produto['quantidade'];
            $carrinho_produto->save();

            $carrinho = Carrinho::where('id', $carrinho_id)->with('produtos')->first();

            return $carrinho;
        }

        return false;
    }

    public function delete($carrinho_id, array $produto)
    {
        $carrinho_produto = CarrinhoProduto::where('carrinho_id', $carrinho_id)
            ->where('produto_id', $produto['produto_id'])
            ->first();

        if (!empty($carrinho_produto)) {
            return $carrinho_produto->delete();
        }

        return false;
    }
}
