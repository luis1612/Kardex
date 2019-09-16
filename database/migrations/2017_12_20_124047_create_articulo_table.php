<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticuloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulo', function (Blueprint $table) {
            $table->increments('idarticulo');

            //unsigned() no permite num negativos
            $table->integer('idcategoria')->unsigned();
            $table->string('nombre', 50);
            $table->text('codigo')->nullable(); 
            $table->text('contenido')->nullable();
            $table->text('bodega');
            $table->decimal('stock', 11,2);
            $table->string('descripcion',128)->nullable();
            $table->string('imagen', 128)->nullable();
            $table->string('estado', 50)->nullable();

            $table->timestamps();

            //Relations
            $table->foreign('idcategoria')->references('idcategoria')->on('categoria')
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
        Schema::dropIfExists('articulo');
    }
}
