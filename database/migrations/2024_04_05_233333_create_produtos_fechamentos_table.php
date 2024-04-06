<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProdutosFechamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos_fechamentos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('producao')->nullable();
            $table->double('desperdicio')->nullable();
            $table->double('sobra')->nullable();
            $table->double('bolos_vendidos')->nullable();
            $table->double('total_bolos_vendidos')->nullable();
            $table->bigInteger('id_produto')->unsigned();
            $table->bigInteger('id_fechamento')->unsigned();
            $table->foreign('id_produto')->references('id')->on('produtos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_fechamento')->references('id')->on('fechamentos')->onDelete('cascade')->onUpdate('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('produtos_fechamentos');
    }
}
