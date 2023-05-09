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
        Schema::table('arquivos', function (Blueprint $table) {

            //relacionamento um para um
            $table->unsignedBigInteger('veiculo_id')->nullable();

            //constraint
            $table->foreign('veiculo_id')->references('id')->on('veiculos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //remover o relacionamento com a tabela arquivos
        Schema::table('arquivos', function(Blueprint $table){
            //remover a foreignKey
            $table->dropForeign('arquivos_veiculo_id_foreign');
            //remover a coluna unidade_id
            $table->dropColumn('veiculo_id');
        });
    }
};
