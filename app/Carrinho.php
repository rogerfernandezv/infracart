<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CarrinhoProduto;
use Illuminate\Support\Facades\DB;

class Carrinho extends Model
{
    /** @var string  */
    protected $table = 'carrinho';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function produtos()
    {
        return $this->belongsToMany(Produto::class)
            ->withPivot('quantidade')
            ->select(['nome', 'valor', 'quantidade']);
    }

}
