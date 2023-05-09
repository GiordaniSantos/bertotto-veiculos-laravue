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
        Schema::create('arquivos', function (Blueprint $table) {
            $table->id();
            $table->string('arquivo', 100);
            $table->string('tipo_mime', 100)->nullable();
            $table->decimal('tamanho', 10)->nullable();
            $table->string('nome_original', 100)->nullable();
            $table->string('legenda', 255)->nullable();
            $table->integer('posicao')->nullable();
            $table->date('data_publicacao')->nullable();
            $table->string('tipo', 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arquivos');
    }
};
