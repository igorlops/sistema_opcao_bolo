<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFechamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fechamentos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('total_vendas')->nullable();
            $table->text('total_pagamentos')->nullable();
            $table->double('saldo_ini')->nullable();
            $table->double('saldo_fin')->nullable();
            $table->double('diferenca_caixa')->nullable();
            $table->double('observacao')->nullable();
            $table->string('id_imagem')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fechamentos');
    }
}
