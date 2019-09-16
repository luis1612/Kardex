<?php

namespace sisKardex\Http\Controllers;

use Illuminate\Http\Request;
use sisKardex\Http\Requests;
use sisKardex\Articulo;
use sisKardex\Categoria;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisKardex\Http\Requests\ArticuloFormRequest;
use sisKardex\DetalleVenta;
use sisKardex\DetalleIngreso;
use sisKardex\Ingreso;
use Maatwebsite\Excel\Facades\Excel;


use DB;

class ArticuloController extends Controller
{
    public function __construct()
   {
         $this->middleware('auth');
   }
   //Todos estos metodos estan asociados con nuestras rutas resources
   public function index(Request $request)
   {
   		if($request)
   		{
   			//Filtro de Busquedas obtenidas desde el formulario
   			$query=trim($request->get('searchText'));
   			//Obtenemos los datos de la tabla donde le agregamos los parametros de busqueda
   			$articulos =DB::table('articulo as a')
   				->join('categoria as c', 'a.idcategoria','=','c.idcategoria')
   				-> select('a.idarticulo', 'a.nombre', 'a.codigo', 'a.contenido', 'a.bodega', 'a.stock', 'c.nombre as categoria', 'a.descripcion', 'a.imagen', 'a.estado')
   				-> where('a.nombre','LIKE','%'.$query.'%')
          -> orwhere('a.codigo','LIKE','%'.$query.'%')
          -> orwhere('a.contenido','LIKE','%'.$query.'%')
          -> orwhere('a.stock','LIKE','%'.$query.'%')
          -> orwhere('a.bodega','LIKE','%'.$query.'%')
          -> orwhere('c.nombre','LIKE','%'.$query.'%')
   				->orderBy('idarticulo')
   				->paginate(1000);

   			//    Vista(Carpeta/Controlador/Pagina, Parametros que se le envia a la vista)
   			return view('almacen.articulo.index',["articulos"=>$articulos,"searchText"=>$query]);
   		}
   }
   public function create()
   {
   		$categorias = DB::table('categoria')->where('condicion','=','1')->get(); 
   		//[parametro a enviar a la vista]=> Variable para llenar el parámetro a enviar
   		return view("almacen.articulo.create",["categorias"=>$categorias]);
   }
   public function store(ArticuloFormRequest $request)
   {
   	//Creando y guardando un nuevo registros en a tabla Articulo
   	//Los valores dentro del get('x') son los objetos que se encuentran en el formulario HTML
		$articulo = new Articulo;
       $articulo -> idcategoria=$request -> get('idcategoria'); 
      $articulo -> nombre = $request -> get('nombre');
      $articulo -> codigo = $request -> get('codigo');
      $articulo -> contenido = $request -> get('contenido');
      $articulo -> bodega = $request -> get('bodega');

      $articulo -> stock = $request -> get('stock');
      $articulo -> descripcion = $request -> get('descripcion');
      $articulo -> estado = 'Activo';
      
		if(Input::hasFile('imagen'))
		{
			$file=Input::file('imagen');
			//Movemos la imagen a la carpeta public y le colocamos el nombre original de la imagen
			$file->move(public_path().'\imagenes\articulos',$file->getClientOriginalName());
			//Le asignamos el nombre de la ruta al atributo imagen
			$articulo->imagen = $file->getClientOriginalName();
		}
		
		$articulo->save();
		//return Redirect::to('almacen/categoria');
      return \Redirect::to('almacen/articulo');
   }
   public function show($id) //id de la categoria que quiero mostrar
   {
   		return view('almacen.articulo.show',["articulo"=>Articulo::findOrFail($id)]);
   }
   public function edit($id)
   {
   		$articulo=Articulo::FindOrFail($id);
   		$categorias=DB::table('categoria')->where('condicion','=','1')->get();
   		return view('almacen.articulo.edit',["articulo"=>$articulo,"categorias"=>$categorias]);
   }
   public function update(ArticuloFormRequest $request, $id)
   {
      $articulo = Articulo::findOrFail($id);
      $articulo -> idcategoria=$request -> get('idcategoria'); 
      $articulo -> nombre = $request -> get('nombre');
      $articulo -> codigo = $request -> get('codigo');
      $articulo -> contenido = $request -> get('contenido');
      $articulo -> bodega = $request -> get('bodega');

      $articulo -> stock = $request -> get('stock');
      $articulo -> descripcion = $request -> get('descripcion');
      $articulo -> estado = 'Activo';

		if(Input::hasFile('imagen'))
		{
			$file=Input::file('imagen');
			//Movemos la imagen a la carpeta public y le colocamos el nombre original de la imagen
			$file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
			//Le asignamos el nombre de la ruta al atributo imagen
			$articulo->imagen = $file->getClientOriginalName();
		}

   		$articulo->update();
   		return \Redirect::to('almacen/articulo');
   }
   public function destroy($id)
   {
   		$articulo = Articulo::findOrFail($id);
   		$articulo->estado = 'Inactivo';
   		$articulo->update();

   		return \Redirect::to('almacen/articulo');
   }

}
