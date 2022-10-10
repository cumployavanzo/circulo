<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('users_id')->nullable();
            $table->string('proveedores_id')->nullable();
            $table->string('personals_id')->nullable();
            $table->date('fecha_compra')->nullable();
            $table->string('num_factura')->nullable();
            $table->text('detalle_compra')->nullable();
            $table->string('importe')->nullable();
            $table->string('iva')->nullable();
            $table->string('r_iva')->nullable();
            $table->string('r_isr')->nullable();
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
        Schema::dropIfExists('compras');
    }
}
