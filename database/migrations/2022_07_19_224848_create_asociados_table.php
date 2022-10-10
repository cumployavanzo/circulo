<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsociadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asociados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('users_id')->nullable();
            $table->string('nombre');
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->string('fecha_nacimiento');
            $table->string('ciudad_nacimiento');
            $table->string('estado_nacimiento');
            $table->string('genero');
            $table->string('rfc');
            $table->string('curp');
            $table->string('edad');
            $table->string('tipo_vivienda');
            $table->string('direccion');
            $table->string('anios_residencia')->nullable();
            $table->string('referencia')->nullable();
            $table->string('cp');
            $table->string('colonia');
            $table->string('ciudad');
            $table->string('estado');
            $table->string('celular');
            $table->string('puesto');
            $table->string('fecha_alta');
            $table->string('escolaridad');
            $table->string('profesion');
            $table->string('religion');
            $table->string('estado_civil');
            $table->string('clave_elector');
            $table->string('anio_vencimiento_ine')->nullable();
            $table->string('folio_ine');
            $table->string('ocr');
            $table->string('numero_tarjeta');
            $table->string('numero_cuenta');
            $table->string('clave_interbancaria');
            $table->string('banco');
            $table->string('numero_clientes');
            $table->string('personals_id')->nullable();
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
        Schema::dropIfExists('asociados');
    }
}
