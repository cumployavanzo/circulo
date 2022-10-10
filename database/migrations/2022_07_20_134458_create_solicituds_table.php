<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicituds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('users_id')->nullable();
            $table->string('users_id_analisis')->nullable();
            $table->string('asociado_id')->nullable();
            $table->string('cliente_id')->nullable();
            $table->string('producto_id')->nullable();
            $table->string('fecha_solicitud')->nullable();
            $table->string('dependientes_economicos')->nullable();
            $table->integer('ingreso_mensual')->nullable();
            $table->integer('gasto_mensual')->nullable();
            $table->string('ciclo')->nullable();
            $table->integer('monto_solicitado')->nullable();
            $table->string('capacidad_pago')->nullable();
            $table->string('tasa')->nullable();
            $table->string('plazo')->nullable();
            $table->string('cuota')->nullable();
            $table->string('frecuencia_pago')->nullable();
            $table->string('fecha_desembolso')->nullable();
            $table->string('fecha_primer_pago')->nullable();
            $table->string('fecha_vencimiento')->nullable();
            $table->string('tipo_cliente')->nullable();
            $table->enum('estatus',['Pendiente','Proceso','Rechazado','Autorizado','Cancelado'])->nullable();
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
        Schema::dropIfExists('solicituds');
    }
}
