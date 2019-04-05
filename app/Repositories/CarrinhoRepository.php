<?php

namespace App\Repositories;

use App\Carrinho;
use App\CarrinhoProduto;
use Illuminate\Support\Facades\DB;

class CarrinhoRepository implements CarrinhoRepositoryInterface
{

    /**
     * @param $carrinho_id
     * @return mixed
     */
    public function get($carrinho_id)
    {
        /** @var Carrinho $carrinho */
        $carrinho = Carrinho::where('id', $carrinho_id)
            ->with('produtos')
            ->first(['carrinho.id']);

        /** @var CarrinhoProduto $produtos */
        $produtos = CarrinhoProduto::where('carrinho_id', $carrinho_id)
            ->join('produtos', 'produto_id', 'produtos.id')
            ->select([DB::raw('sum(valor * quantidade) as valor_total')])->first();

        $carrinho->valor_total = $produtos->valor_total;

        return $carrinho;
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return Carrinho::select(['id'])->with('produtos')->get();
    }

    /**
     * @param array $produto
     * @param       $id
     * @return bool
     */
    public function insert(array $produto, $id)
    {
        if (empty($id)) {
            /** @var Carrinho $carrinho */
            $carrinho = Carrinho::create([]);
        } else {
            /** @var Carrinho $carrinho */
            $carrinho = Carrinho::find($id);
        }

        /** @var CarrinhoProduto $carrinho_produto */
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

    /**
     * @param       $carrinho_id
     * @param array $produto
     * @return bool
     */
    public function update($carrinho_id, array $produto)
    {
        /** @var CarrinhoProduto $carrinho_produto */
        $carrinho_produto = CarrinhoProduto::where('carrinho_id', $carrinho_id)
            ->where('produto_id', $produto['produto_id'])
            ->first();

        if (!empty($carrinho_produto)) {
            $carrinho_produto->quantidade = $produto['quantidade'];
            $carrinho_produto->save();

            /** @var Carrinho $carrinho */
            $carrinho = Carrinho::where('id', $carrinho_id)->with('produtos')->first();

            return $carrinho;
        }

        return false;
    }

    /**
     * @param       $carrinho_id
     * @param array $produto
     * @return bool
     */
    public function delete($carrinho_id, array $produto)
    {
        /** @var CarrinhoProduto $carrinho_produto */
        $carrinho_produto = CarrinhoProduto::where('carrinho_id', $carrinho_id)
            ->where('produto_id', $produto['produto_id'])
            ->first();

        if (!empty($carrinho_produto)) {
            return $carrinho_produto->delete();
        }

        return false;
    }
}
