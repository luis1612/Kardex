<?php

namespace sisKardex;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table = 'articulo'; //tabla con la que se conecta
    protected $primaryKey = 'idarticulo'; //primaryKey de la tabla

    public $timestamps = false; //columnas de creación y actualización de registro

    protected $fillable = [
        'idcategoria',
        'codigo',
        'contenido',
        'bodega',
        'nombre',
        'stock',
        'descripcion',
        'imagen',
        'estado'
        ]; // cuando si queremos que se guarden en el modelo

    protected $guarded = [

    ]; // cuando no queremos que se asignen al modelo
}
