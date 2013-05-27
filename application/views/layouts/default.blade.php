<!DOCTYPE html>
<html lang="en">

	<head>

		<meta charset="utf-8">

		<title>Snap » {{ $title }}</title>

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

									<li class="nav-header">Propias</li>

									<li>{{ HTML::link('ticket/add', 'Nueva consulta') }}</li>
									<li>{{ HTML::link('tickets/mine', 'Mis consultas') }}</li>
									<li><a href="#">Consultas asignadas</a></li>

								</ul>

							</li>

							{{-- only support and admins can see the administration menu--}}
							@if (Session::get('role') != 3)

								<li class="dropdown">

									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Administración <b class="caret"></b></a>

									<ul class="dropdown-menu">

										<li class="nav-header">Consultas</li>

										<li>{{ HTML::link('tickets', 'Todas las Consultas') }}</li>

											{{-- admins only --}}
											@if (Session::get('role') == 1)

												<li class="divider"></li>
												<li class="nav-header">Sistema</li>

												<li>{{ HTML::link('admin/users', 'Usuarios') }}</li>
												<li>{{ HTML::link('admin/roles', 'Roles') }}</li>
												<li>{{ HTML::link('admin/departments', 'Departamentos') }}</li>
												<li>{{ HTML::link('admin/companies', 'Compañías'); }}</li>

												<li class="divider"></li>
												<li class="nav-header">Configuración</li>

												<li>{{ HTML::link('settings', 'Opciones Generales') }}</li>

											@endif
										
									</ul>

								</li>

							@endif

							<li class="divider-vertical"></li>

							<li><a href="#"><i class="icon-wrench"></i> Soporte</a></li>

						</ul>

						<ul class="nav navbar-googlebar pull-right">

							<li class="dropdown">

								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> Sesión iniciada como <strong>{{ Session::get('name') }}</strong> <b class="caret"></b></a>

								<ul class="dropdown-menu">

									<li>{{ HTML::decode(HTML::link('profile', Helper::icon('edit') . ' Editar Perfil')) }}</li>
									<li>{{ HTML::decode(HTML::link('logout', Helper::icon('signout') . ' Cerrar Sesión')) }}</li>

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

				<strong>Snap</strong> versión <strong>{{ APP_VERSION }}</strong> — Sistema Automatizado de Asistencia Virtual<br />
				Copyright 2012-2013 &copy; {{ HTML::link('http://mariocuba.net', 'Mario Cuba') }} — Todos los derechos reservados.

				</p>

			</div>

		</div>
		<!-- footer end -->

		{{ Asset::scripts(); }}

		@yield('postscripts')

	</body>

</html>
