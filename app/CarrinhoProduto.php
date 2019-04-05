<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarrinhoProduto extends Model
{
    protected $table = 'carrinho_produto';

    protected $fillable = [
        'carrinho_id',
        'produto_id',
        'quantidade'
    ];
}
