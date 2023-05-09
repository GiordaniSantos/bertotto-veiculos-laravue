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
        Schema::create('veiculos', function (Blueprint $table) {
            $table->id();
            $table->text('descricao')->nullable();
            $table->string('nome', 350)->nullable();
            $table->string('ano_modelo', 25)->nullable();
            $table->string('preco', 25)->nullable();
            $table->integer('portas')->nullable();
            $table->string('cor', 25)->nullable();
            $table->string('km', 25)->nullable();
            $table->smallInteger('cambio')->nullable();
            $table->boolean('tipo_combustivel')->nullable()->default(0);
            $table->boolean('aceita_troca')->nullable()->default(0);
            $table->boolean('ipva_pago')->nullable()->default(0);
            $table->boolean('licenciado')->nullable()->default(0);
            $table->boolean('air_bag')->nullable()->default(0);
            $table->boolean('air_bag_duplo')->nullable()->default(0);
            $table->boolean('alarme')->nullable()->default(0);
            $table->boolean('ar_condicionado_digital')->nullable()->default(0);
            $table->boolean('banco_couro')->nullable()->default(0);
            $table->boolean('banco_regulavel_altura')->nullable()->default(0);
            $table->boolean('chave_reserva')->nullable()->default(0);
            $table->boolean('computador_bordo')->nullable()->default(0);
            $table->boolean('desembacador_traseiro')->nullable()->default(0);
            $table->boolean('direcao_eletrica')->nullable()->default(0);
            $table->boolean('direcao_escamoteavel')->nullable()->default(0);
            $table->boolean('direcao_multifuncional')->nullable()->default(0);
            $table->boolean('farois_auxiliares')->nullable()->default(0);
            $table->boolean('farois_led')->nullable()->default(0);
            $table->boolean('freios_abs')->nullable()->default(0);
            $table->boolean('interface')->nullable()->default(0);
            $table->boolean('limpador_traseiro')->nullable()->default(0);
            $table->boolean('manual_proprietario')->nullable()->default(0);
            $table->boolean('porta_malas_eletrico')->nullable()->default(0);
            $table->boolean('retrovisor_eletrico')->nullable()->default(0);
            $table->boolean('liga_leve')->nullable()->default(0);
            $table->boolean('sensor_chuva')->nullable()->default(0);
            $table->boolean('sensor_estacionamento')->nullable()->default(0);
            $table->boolean('som_volante')->nullable()->default(0);
            $table->boolean('som_original')->nullable()->default(0);
            $table->boolean('teto_panoramico')->nullable()->default(0);
            $table->boolean('teto_solar')->nullable()->default(0);
            $table->boolean('travas_eletricas')->nullable()->default(0);
            $table->boolean('vidros_eletricos')->nullable()->default(0);
            $table->boolean('ativo')->nullable()->default(0);
            $table->boolean('destaque')->nullable()->default(0);
            $table->boolean('recomendado')->nullable()->default(0);
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
        Schema::dropIfExists('veiculos');
    }
};
