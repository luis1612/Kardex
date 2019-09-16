<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta', function (Blueprint $table) {
            $table->increments('idventa');

            $table->integer('idcliente')->unsigned();
            // $table->integer('id_usuario')->unsigned();

            $table->string('tipo_comprobante', 50);
            $table->string('num_comprobante', 50);
           // $table->dateTime('fecha_hora');
            $table->decimal('total_P', 11,2);
            $table->string('estado', 20);

            $table->timestamps();

            //Relations
            $table->foreign('idcliente')->references('idpersona')->on('persona')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('venta');
    }
}
