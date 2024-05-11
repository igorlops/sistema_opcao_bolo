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
            $table->decimal('vendas_extras');
            $table->decimal('desconto',10,2);
            $table->decimal('vendas_abc',10,2);
            $table->decimal('total_caixa',10,2);
            $table->decimal('env',10,2);
            $table->decimal('cartao_cred',10,2);
            $table->decimal('cartao_deb',10,2);
            $table->decimal('pix',10,2);
            $table->decimal('diferenca',10,2);
            $table->text('observacao')->nullable();
            $table->string('ativo',2);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->on('users')->references('id');
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
