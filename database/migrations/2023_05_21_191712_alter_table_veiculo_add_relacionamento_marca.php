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
        Schema::table('veiculos', function (Blueprint $table) {

            $table->unsignedBigInteger('marca_id')->nullable();

            $table->foreign('marca_id')->references('id')->on('marcas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('veiculos', function(Blueprint $table){
            //remover a foreignKey
            $table->dropForeign('veiculos_marca_id_foreign');
            $table->dropColumn('marca_id');
        });
    }
};
