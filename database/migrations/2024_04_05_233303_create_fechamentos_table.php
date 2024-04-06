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
            $table->double('vendas_extras')->nullable();
            $table->double('desconto')->nullable();
            $table->double('vendas_abc')->nullable();
            $table->double('total_caixa')->nullable();
            $table->double('env')->nullable();
            $table->double('cartao_cred')->nullable();
            $table->double('cartao_deb')->nullable();
            $table->double('pix')->nullable();
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
