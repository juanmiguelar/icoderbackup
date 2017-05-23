@extends(Auth::user()->tipo)

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Editar Categoría {{$categoria->nombre}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('categorias.update', $categoria->id_categoria) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

               
                <div class="row">
                    <div class="form-group col-md-3">
                	    <label for="deporte-field">Seleccione el Deporte</label>
                            <select  class="selectpicker form-control" id="deporte-field" name="deporte" required>
                                @foreach($deportes as $deporte)
                                    <option value= "{{ $deporte->id_deporte }}" {{ $categoria->id_deporte == $deporte->id_deporte ? 'selected' : '' }}>{{$deporte->nombre}}</option>
                                @endforeach
                           </select>
                        </div>
                    </div>

                <div class="form-group">
                	<label for="nombre-field">Nombre</label>
                	<input class="form-control" type="text" name="nombre" id="nombre-field" value="{{  $categoria->nombre  }}" required/>
                </div>
                <div class="row">
                    <div class="form-group col-md-1">
                	    <label for="anno_inicio-field">Año inicial</label>
                            <select  class="selectpicker form-control" id="anno_inicio-field" name="anno_inicio" required>
                                @for ($i = $anno-20 ; $i < $anno+10 ; $i++)
                                    <option value= "{{ $i }}" {{ $categoria->anno_inicio == $i ? 'selected' : '' }}>{{$i}}</option>
                                @endfor
                           </select>
                        </div>
                    </div>
                <div class="row">
                    <div class="form-group col-md-1">
                	    <label for="anno_fin-field">Año Final</label>
                            <select  class="selectpicker form-control" id="anno_fin-field" name="anno_fin" required>
                                @for ($i = $anno-19 ; $i < $anno+11 ; $i++)
                                    <option value= "{{ $i }}" {{ $categoria->anno_final == $i ? 'selected' : '' }}>{{$i}}</option>
                                @endfor
                           </select>
                        </div>
                    </div>
                <div class="form-group">
                	    <label for="numero_maximo_atletas-field">Número máximo de atletas</label>
                	    <div class="row">
                	        <div class="col-md-1">
                                <div class="numero_maximo_atletas">
                                    <select   class="selectpicker form-control" id="numero_maximo_atletas-field" name="numero_maximo_atletas" required>
                                        @for ($i = 1; $i < 51; $i++)
                                            <option value="{{ $i }}"  {{ $categoria->numero_maximo_atletas == $i ? 'selected' : '' }}>{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('categorias.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection