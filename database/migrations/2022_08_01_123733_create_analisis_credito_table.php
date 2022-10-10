<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalisisCreditoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analisis_credito', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('solicituds_id')->nullable();
            $table->string('users_id')->nullable();
            $table->string('usuario_desembolso')->nullable();
            $table->integer('monto_solicitado')->nullable();
            $table->integer('monto_autorizado')->nullable();
            $table->string('total')->nullable();
            $table->string('pago_semanal')->nullable();
            $table->string('capacidad_pago')->nullable();
            $table->string('score_riesgo')->nullable();
            $table->string('probabilidad_incumplimiento')->nullable();
            $table->string('indice_severidad')->nullable();
            $table->string('calculo_severidad')->nullable();
            $table->string('perdida_esperada')->nullable();
            $table->string('var')->nullable();
            $table->enum('desembolso',['Pendiente','Desembolsado'])->default('Pendiente');
            $table->enum('estatus',['Aprobado','Rechazado'])->nullable();
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
        Schema::dropIfExists('analisis_credito');
    }
}
