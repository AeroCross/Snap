<div class="navbar navbar-static-top">

	<div class="navbar-inner">

		<div class="container">

			<?php echo anchor('#', 'SAV', array('class' => 'brand')); ?>

			<ul class="nav">

				<li><?php echo anchor('#', 'Guía de Usuario'); ?></li>
				<li><?php echo anchor('#', 'Preguntas Frecuentes'); ?></li>
				<li><?php echo anchor('#', 'Soporte'); ?></li>

			</ul>

			<?php echo form_open('login', array('class' => 'navbar-form pull-right')); ?>

				<input type="text" class="span2" name="username" placeholder="Usuario" />
				<input type="text" class="span2" name="password" placeholder="Contraseña" />
				<a class="btn"><?php echo icon('signin'); ?> Iniciar Sesión</a>

			<?php echo form_close(); ?>

		</div>

	</div>

</div>

<div class="container-fluid">

	<div class="page-header text-center">

		<h1>Bienvenido.</h1>

	</div>

	<div class="row-fluid">

		<div class="span9">

			<h4>Sistema de Asistencia Virtual</h4>

			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

		</div>

		<div class="span3">

			<h4>¿Sin usuario?</h4>

			<p>A todos nuestros clientes, al contratar nuestros servicios, se les concede el beneficio de utilizar SAV. Se le enviará un correo electrónico con la información de usuario.</p>

			<p>Si no ha recibido esta información, <?php echo safe_mailto('', 'hágalo saber'); ?> y le enviaremos su información.</p>

		</div>

	</div>

</div>