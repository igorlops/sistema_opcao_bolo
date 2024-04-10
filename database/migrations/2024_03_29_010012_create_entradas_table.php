<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntradasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entradas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('tipo_entrada');
            $table->text('observacao')->nullable();
            $table->decimal('valor',10,2);
            $table->char('metade',1);
            $table->bigInteger('id_tipo_pagamento')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('id_produto')->unsigned();
            $table->foreign('id_tipo_pagamento')->references('id')->on('tipo_pagamentos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_produto')->references('id')->on('produtos')->onDelete('cascade')->onUpdate('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('entradas');
    }
}
