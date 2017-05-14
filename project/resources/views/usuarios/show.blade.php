@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Usuario / Show #{{$usuario->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('usuarios.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('usuarios.edit', $usuario->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="four wide column">
  <h4><i class="usuario icon"></i>Cedula_usuario</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $usuario->cedula_usuario }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="usuario icon"></i>Nombre1</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $usuario->nombre1 }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="usuario icon"></i>Nombre2</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $usuario->nombre2 }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="usuario icon"></i>Apellido1</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $usuario->apellido1 }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="usuario icon"></i>Apellido2</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $usuario->apellido2 }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="usuario icon"></i>Tipo</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $usuario->tipo }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="usuario icon"></i>Email</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $usuario->email }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="usuario icon"></i>Contrasenna</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $usuario->contrasenna }}</h4>
</div>


        </div>

    </div>
@endsection
