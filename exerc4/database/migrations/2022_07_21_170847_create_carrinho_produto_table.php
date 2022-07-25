<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrinho_produto', function (Blueprint $table) {
            $table->unsignedBigInteger('carrinho_id');
            $table->unsignedBigInteger('produto_id');
            $table->unsignedTinyInteger('quantidade');
            $table->foreign('carrinho_id')->references('id')->on('carrinhos');
            $table->foreign('produto_id')->references('id')->on('produtos');
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
};
