<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarrinhoProdutoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrinho_produto', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('carrinho_id');
            $table->unsignedBigInteger('produto_id');
            $table->integer('quantidade');
            $table->timestamps();

            $table->foreign('carrinho_id')
                ->references('id')->on('carrinho')
                ->onDelete('cascade');

            $table->foreign('produto_id')
                ->references('id')->on('produtos')
                ->onDelete('cascade');

            $table->unique(['carrinho_id', 'produto_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carrinho_produto');
    }
}
