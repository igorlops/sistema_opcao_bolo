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
            $table->decimal('vendas_extras')->nullable();
            $table->decimal('desconto',10,2)->nullable();
            $table->decimal('vendas_abc',10,2)->nullable();
            $table->decimal('total_caixa',10,2)->nullable();
            $table->decimal('env',10,2)->nullable();
            $table->decimal('cartao_cred',10,2)->nullable();
            $table->decimal('cartao_deb',10,2)->nullable();
            $table->decimal('pix',10,2)->nullable();
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
