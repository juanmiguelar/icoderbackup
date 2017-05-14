@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Persona / Show #{{$persona->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('personas.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('personas.edit', $persona->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="four wide column">
  <h4><i class="persona icon"></i>Cedula_persona</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $persona->cedula_persona }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="persona icon"></i>Nombre1</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $persona->nombre1 }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="persona icon"></i>Nombre2</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $persona->nombre2 }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="persona icon"></i>Apellido1</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $persona->apellido1 }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="persona icon"></i>Apellido2</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $persona->apellido2 }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="persona icon"></i>Fecha_nacimiento</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $persona->fecha_nacimiento }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="persona icon"></i>Nacionalidad</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $persona->nacionalidad }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="persona icon"></i>Telefono</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $persona->telefono }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="persona icon"></i>Direccion</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $persona->direccion }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="persona icon"></i>Estatura</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $persona->estatura }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="persona icon"></i>Peso</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $persona->peso }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="persona icon"></i>Tipo_sangre</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $persona->tipo_sangre }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="persona icon"></i>Tipo</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $persona->tipo }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="persona icon"></i>Email</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $persona->email }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="persona icon"></i>Cedula_frente</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $persona->cedula_frente }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="persona icon"></i>Cedula_atras</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $persona->cedula_atras }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="persona icon"></i>Boleta_inscripcion</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $persona->boleta_inscripcion }}</h4>
</div>


        </div>

    </div>
@endsection
