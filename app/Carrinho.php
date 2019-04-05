<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CarrinhoProduto;

class Carrinho extends Model
{
    protected $table = 'carrinho';

    public function produtos()
    {
        return $this->belongsToMany(Produto::class)
            ->withPivot('quantidade')
            ->select(['nome', 'valor', 'quantidade']);
    }
}
