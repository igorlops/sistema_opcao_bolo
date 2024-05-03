<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImagensFechamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagens_fechamentos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->longText('imagem');
            $table->string('tipo');
            $table->bigInteger('id_fechamento')->unsigned();
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
        Schema::drop('imagens_fechamentos');
    }
}
