<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">

    <title>Snap | {{ $title }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    {{ Asset::styles(); }}

  </head>

  <body>
    
    <div id="wrap">

      <!-- navbar -->
      <div class="navbar navbar-fixed-top navbar-googlebar">

        <div class="navbar-inner">

          <div class="container">

            <a class="brand" href="{{ URL::to('dashboard') }}">{{ HTML::image('img/logo.png', 'SAAV Logo', array('width' => '24', 'height' => '24')) }}</a>

            <ul class="nav navbar-googlebar">

              <li class="dropdown">

                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Consultas <b class="caret"></b></a>

                <ul class="dropdown-menu">

                  <li>{{ HTML::link('ticket/add', 'Nueva consulta') }}</li>
                  <li><a href="#">Mis consultas</a></li>

                </ul>

              </li>

              <li class="dropdown">

                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administración <b class="caret"></b></a>

                <ul class="dropdown-menu">

                  <li class="nav-header">Consultas</li>

                  <li><a href="#">Todas las Consultas</a></li>

                    <li class="divider"></li>
                    <li class="nav-header">Usuarios</li>

                    <li><a href="#">Agregar Usuario</a></li>
                    <li><a href="#">Asignar Roles</a></li>
                    <li><a href="#">Compañías</a></li>

                    <li class="divider"></li>
                    <li class="nav-header">Sistema</li>

                    <li>{{ HTML::link('settings', 'Configuración') }}</li>
                    <li><a href="#">Actualizar</a></li>
                  
                </ul>

              </li>

              <li class="divider-vertical"></li>

              <li><a href="#"><i class="icon-wrench"></i> Soporte</a></li>

            </ul>

            <ul class="nav navbar-googlebar pull-right">

              <li class="dropdown">

                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> Sesión iniciada como <strong>{{ Session::get('name') }}</strong> <b class="caret"></b></a>

                <ul class="dropdown-menu">

                  <li><a href="#"><i class="icon-edit"></i> Editar Perfil</a></li>
                  <li><a href="{{ URL::to('logout') }}"><i class="icon-signout"></i> Cerrar Sesión</a></li>

                </ul>

              </li>

            </ul>

          </div>

        </div>

      </div>
      <!-- navbar end -->

      <!-- container -->
      <div class="container" id="main-container">
          
          @yield('content')

      </div>
      <!-- container end -->

      <div id="push"></div>
    
    </div>

    <!-- footer -->
    <div id="footer">

      <div class="container">

        <p class="muted credit">

          <strong>Snap</strong> versión <strong>0.5a</strong> — Sistema Automatizado de Asistencia Virtual<br />
          Copyright 2012-2013 &copy; {{ HTML::link('http://mariocuba.net', 'Mario Cuba') }} — Todos los derechos reservados.

        </p>

      </div>

    </div>
    <!-- footer end -->

    {{ Asset::scripts(); }}

  </body>

</html>
