<!--<meta http-equiv="refresh" content="0; ventas/venta"  />-->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Sistema Kardex</div>

                <div class="panel-body">
                    @if(Auth::user()->tipo_usuario == 'administrador')
                        <meta http-equiv="refresh" content="2; almacen/articulo"  />
                        <p>Bienvenido {{Auth::user()->name}}  eres  {{Auth::user()->tipo_usuario}} del sistema</p>
                    @elseif(Auth::user()->tipo_usuario == 'asesor')
                        <meta http-equiv="refresh" content="2; almacen/articulo"  />
                        <p>Bienvenid@ {{Auth::user()->name}} eres un(a) {{Auth::user()->tipo_usuario}}(a) </p>
                    @elseif(Auth::user()->tipo_usuario == 'consultor')
                        <meta http-equiv="refresh" content="2; compras/ingreso"  />
                         <p>Bienvenid@ {{Auth::user()->name}} eres un(a) {{Auth::user()->tipo_usuario}}(a) </p>
                    @else
                        <p>No tienes permisos para estar aqui</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
