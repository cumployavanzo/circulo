<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cuentas_id')->nullable();
            $table->string('nombre_producto')->nullable();
            $table->string('codigo_producto')->nullable();
            $table->string('unidad_medida')->nullable();
            $table->string('tipo_producto')->nullable();
            $table->string('clasificacion')->nullable();
            $table->string('iva')->nullable();
            $table->string('retencion_iva')->nullable();
            $table->string('retencion_isr')->nullable();
            $table->string('depreciacion')->nullable();
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
        Schema::dropIfExists('articulos');
    }
}
