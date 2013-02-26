<!DOCTYPE html>
<html lang="en">

	<head>

		<meta charset="utf-8">

		<title>Iniciar Sesión</title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="description" content="" />
		<meta name="author" content="" />

		{{ Asset::styles(); }}

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
			<script src="../assets/js/html5shiv.js"></script>
		<![endif]-->

	</head>

	<body>

		<div class="container">

			<div class="signin">

				<div class="signin-box">

					<!-- login form -->
					{{ Form::open('login', 'POST') }}

						<fieldset>

							<label for="username">Nombre de Usuario</label>
							<input type="text" class="input-block-level" name="username" id="username">

							<label for="passwd">Contraseña</label>
							<input type="password" class="input-block-level" name="passwd" id="passwd">

							<button type="submit" class="btn btn-primary">Iniciar Sesión</button>

						</fieldset>

					{{ Form::close() }}

				</div> <!-- /signin-box -->

			</div> <!-- /signin -->

		</div> <!-- /container -->

		{{ Asset::scripts(); }}

	</body>

</html>
