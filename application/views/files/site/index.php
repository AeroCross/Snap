<!-- intro -->
<div class="banner">

	<div class="container">

		<div class="row">

			<div class="span6" id="intro">

				<div>

					<h1>Soporte Automatizado 100% en Línea</h1>

					<p>No vuelva a preocuparse nunca más por soporte técnico.</p>

					<br />

					<div class="btn-group">

						<?php echo anchor('login', icon('signin') . ' Ingresar', array('class' => 'btn btn-warning')); ?>
						<a href="#more-info" role="button" class="btn" data-toggle="modal"><?php echo icon('question-sign'); ?> ¿Cómo ingresar?</a>

					</div>

				</div>

			</div>

			<div class="span6">

				<img src="<?php echo $this->resource->img('display.png');?>" alt="SAAV" />

			</div>

		</div>

	</div>

</div>
<!-- content -->
<div class="container" id="main-content">

	<div class="row text-center">

		<div class="span4">

			<h1><?php echo icon('globe'); ?></h1>

			<h4>Asistencia en Línea</h4>

			<p>Toda la ayuda que necesite se la podremos ofrecer directamente desde su computador. Lleve un registro detallado de todas sus preguntas y nuestras respuestas a través de nuestro sistema de soporte técnico.</p>

		</div>

		<div class="span4">

			<h1><?php echo icon('group'); ?></h1>

			<h4>Para nuestros clientes</h4>

			<p>Al ser nuestro cliente, automáticamente podrá ingresar a nuestro sistema de asistencia virtual y hacer cualquier consulta o solicitud que necesite, sin tener que ni siquiera moverse de donde está.</p>

		</div>

		<div class="span4">

			<h1><?php echo icon('cogs'); ?></h1>

			<h4>Siempre mejorando</h4>

			<p>Siempre trabajamos para la mejora continua de nuestros conocimientos y de nuestros sistemas, siempre escuchando a nuestro cliente.</p>

		</div>

	</div>

</div>

<!-- more information -->
<div class="modal hide fade" id="more-info">

	<div class="modal-header">
		
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		
		<h3>Ingresando al Sistema</h3>
	
	</div>

	<div class="modal-body">
	
		<p>Cada cliente de <?php echo anchor('http://ingenium-dv.com', 'Ingenium: Desarrollo Virtual'); ?> tiene acceso al sistema automáticamente.</p>

		<p>Si este no es su caso, contáctenos directamente a <?php echo safe_mailto('soporte@ingenium-dv.com'); ?> con sus datos personales y el nombre de su empresa para poder asignarle uno o varios usuarios, depende de cuantos sean necesarios, y le enviaremos su información vía correo electrónico.</p>
	
	</div>

	<div class="modal-footer">
	
		<a href="#" data-dismiss="modal" class="btn">Cerrar</a>

	</div>

</div>
