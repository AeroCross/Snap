<!DOCTYPE html>
<html lang="en">

	<head>

		<meta charset="utf-8">

		<title>Iniciar Sesión</title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="description" content="" />
		<meta name="author" content="" />

		{{ Asset::styles(); }}
		
	</head>

	<body>
		
		<div class="container">

			@yield('content')

		</div> <!-- /container -->

		{{ Asset::scripts(); }}

	</body>

</html>
