<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallesComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_compras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('compras_id')->nullable();
            $table->string('articulos_id')->nullable();
            $table->string('numero_serie')->nullable();
            $table->string('cantidad')->nullable();
            $table->string('costo_unitario')->nullable();
            $table->string('p_iva')->nullable();
            $table->string('p_riva')->nullable();
            $table->string('p_risr')->nullable();
            $table->string('importe')->nullable();
            $table->string('total')->nullable();
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
        Schema::dropIfExists('detalles_compras');
    }
}
