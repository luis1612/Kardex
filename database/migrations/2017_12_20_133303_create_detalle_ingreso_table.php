<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleIngresoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_ingreso', function (Blueprint $table) {
            $table->increments('iddetalle_ingreso');

            $table->integer('idingreso')->unsigned();
            $table->integer('idarticulo')->unsigned();

            $table->integer('cantidad');

            $table->timestamps();

            //Relations
            $table->foreign('idingreso')->references('idingreso')->on('ingreso')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('idarticulo')->references('idarticulo')->on('articulo')
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
        Schema::dropIfExists('detalle_ingreso');
    }
}
