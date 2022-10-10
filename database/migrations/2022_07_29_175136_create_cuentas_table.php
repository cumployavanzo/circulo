<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre_cuenta')->nullable();
            $table->string('numero_cuenta')->nullable();
            $table->string('naturaleza')->nullable();
            $table->string('tipo')->nullable();
            $table->integer('nivel')->nullable();
            $table->string('codigo_agrupador')->nullable();
            $table->string('nombre_cuenta_ca')->nullable();
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
        Schema::dropIfExists('cuentas');
    }
}
