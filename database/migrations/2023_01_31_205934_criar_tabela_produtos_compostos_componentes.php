<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaProdutosCompostosComponentes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos_compostos_componentes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_produto_composto');
            $table->unsignedInteger('id_produto_simples');
            $table->integer('quantidade');

            $table->foreign('id_produto_composto')
                ->references('id')
                ->on('produtos_compostos')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            
            $table->foreign('id_produto_simples')
                ->references('id')
                ->on('produtos_simples')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('produtos_compostos_componentes');
    }
}
