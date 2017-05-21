@if (count($errors) > 0)
    <div class="ui icon error message">
      <i class="remove icon"></i>
      <div class="content">
        <div class="header">Hay errores con su solicitud.</div>
        <p>Solucione los errores listados a continuación e intente de nuevo.</p>
        <ul class="list">
          @foreach ($errors->all() as $error)
              <li><i class="remove icon"></i> {{ $error }}</li>
          @endforeach
        </ul>
      </div>
    </div>
@endif
