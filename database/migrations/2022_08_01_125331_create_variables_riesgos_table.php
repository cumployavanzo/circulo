<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariablesRiesgosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variables_riesgos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('variable',['Edad','Sexo','EntidadFederativa','Vivienda','EstadoCivil','DependientesEconomicos','Escolaridad','Ciclo','IngresoMensual','Score'])->nullable();
            $table->string('nombre_variable')->nullable();
            $table->string('maximo')->nullable();
            $table->string('minimo')->nullable();
            $table->string('coeficiente')->nullable();
            $table->string('proporcion')->nullable();
            $table->string('calificacion')->nullable();
            $table->string('var')->nullable();
            $table->string('beta')->nullable();
            $table->string('zeta')->nullable();
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
        Schema::dropIfExists('variables_riesgos');
    }
}
