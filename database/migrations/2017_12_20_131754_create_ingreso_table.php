<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngresoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingreso', function (Blueprint $table) {
            $table->increments('idingreso');

            $table->integer('idproveedor')->unsigned();
            $table->string('tipo_comprobante', 50);
            $table->string('num_comprobante');
            $table->string('estado', 50);

            $table->timestamps();

            //Relation
            $table->foreign('idproveedor')->references('idpersona')->on('persona')
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
        Schema::dropIfExists('ingreso');
    }
}
