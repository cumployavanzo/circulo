<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('personals_id')->unsigned()->nullable();
            $table->integer('asociado_id')->unsigned()->nullable();
            $table->string('apellido_paterno')->nullable();
            $table->string('apellido_materno')->nullable();
            $table->string('nombre')->nullable();
            $table->string('fecha_nacimiento')->nullable();
            $table->string('ciudad_nacimiento')->nullable();
            $table->string('estado_nacimiento')->nullable();
            $table->string('genero')->nullable();
            $table->string('rfc')->nullable();
            $table->string('curp')->nullable();
            $table->string('edad')->nullable();
            $table->string('tipo_vivienda')->nullable();
            $table->string('direccion')->nullable();
            $table->string('anios_residencia')->nullable();
            $table->string('referencia')->nullable();
            $table->string('cp')->nullable();
            $table->string('colonia')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('estado')->nullable();
            $table->string('celular')->nullable();
            $table->string('fecha_alta')->nullable();
            $table->string('escolaridad')->nullable();
            $table->string('profesion')->nullable();
            $table->string('religion')->nullable();
            $table->string('estado_civil')->nullable();
            $table->string('clave_elector')->nullable();
            $table->string('anio_vencimiento_ine')->nullable();
            $table->string('folio_ine')->nullable();
            $table->string('ocr')->nullable();
            $table->string('numero_tarjeta')->nullable();
            $table->string('numero_cuenta')->nullable();
            $table->string('clave_interbancaria')->nullable();
            $table->string('banco')->nullable();
            $table->string('tipo_cliente')->nullable();

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
        Schema::dropIfExists('clientes');
    }
}
