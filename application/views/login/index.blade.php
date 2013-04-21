@layout('layouts/login')

@section('content')

  <div class="signin">

    <!-- notifications -->
    {{ Notification::show() }}

    <div class="signin-box">

      <!-- login form -->
      {{ Form::open('login', 'POST') }}

        <fieldset>

          <label for="username">Nombre de Usuario</label>
          <input type="text" class="input-block-level" name="username" id="username">

          <label for="password">Contraseña</label>
          <input type="password" class="input-block-level" name="password" id="password">

          <button type="submit" class="btn btn-primary">Iniciar Sesión</button>

        </fieldset>

      {{ Form::close() }}

    </div> <!-- /signin-box -->

  </div> <!-- /signin -->

@endsection