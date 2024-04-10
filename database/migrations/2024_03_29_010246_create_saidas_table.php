<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saidas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->decimal('valor',10,2);
            $table->text('observacao')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('id_descricao')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_descricao')->references('id')->on('tipo_saidas')->onDelete('cascade')->onUpdate('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('saidas');
    }
}
