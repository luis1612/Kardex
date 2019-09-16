@extends ('layouts.admin')
@section ('contenido')

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Categorías
			@if(Auth::user()->tipo_usuario == 'administrador')
			<a href="categoria/create">
				<button class="btn btn-success">Nuevo</button>
			</a>
			@endif
		</h3>
		@include('almacen.categoria.search')
	</div>	
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table id="testTable" class="table table-striped table-bordered table-condensed table-hover">

				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Descripción</th>
					<th>Opciones</th>
				</thead>

				@foreach ($categorias as $cat)
				<tr>
					<td>{{$cat->idcategoria}}</td>
					<td>{{$cat->nombre}}</td>
					<td>{{$cat->descripcion}}</td>
					<td>@if(Auth::user()->tipo_usuario == 'administrador')
						<a href="{{URL::action('CategoriaController@edit',$cat->idcategoria)}}"><button class="btn btn-info">Editar</button></a>
						<!--Referenciamos al modal para eliminar categorias-->
						<a href="" data-target="#modal-delete-{{$cat->idcategoria}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
						@endif
					</td>
				</tr>
				<!--Incluimos el modal para generar-->
				@include('almacen.categoria.modal')
				@endforeach

			</table>
		</div>
		<!--Mostramos la paginacion-->
		{{$categorias->render()}}
	</div>		

</div>

@endsection
