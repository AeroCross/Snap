<div class="row">

	<div class="page-header">

		<h4>Últimas consultas</h4>

	</div>

	<p>No tiene consultas recientes &mdash; <?php echo anchor('tickets/add', 'Cree una nueva consulta'); ?>.</p>

	<div class="row">

		<!-- tickets -->
		<div class="span4">

			<fieldset>

				<legend>Consultas</legend>

				<p><?php echo anchor('tickets/add', 'Nueva Consulta', array('class' => 'btn btn-large btn-block btn-primary')); ?></p>

				<p>Una <strong>consulta</strong> es una solicitud de soporte, una pregunta o un problema que presente. Si su caso es:</p>

				<ul>

					<li>Un nuevo objeto de aprendizaje</li>
					<li>Un cambio / modificación a su sitio web</li>
					<li>Una falla de su aula virtual o sitio web</li>
					<li>Una pregunta</li>

				</ul>

				<p>Entonces cree una <?php echo anchor('ticket/add', 'nueva consulta'); ?>.</p>

				<p><span class="label label-info">Nota</span> Si usted ya tiene una consulta abierta sobre lo que va a reportar, ingrese a ella y actualize su consulta, para poder ofrecerle un mejor servicio.</p>

			</fieldset>

		</div>

		<!-- requests -->
		<div class="span4">

			<fieldset>

				<legend>Solicitud de Servicio</legend>

				<p><?php echo anchor('#', 'Nueva Solicitud', array('class' => 'btn btn-large btn-block btn-primary')); ?></p>

				<p>Una <strong>Solicitud de Servicio</strong> es un servicio completo que la empresa le ofrece a su cliente. Si su caso es:</p>

				<ul>

					<li>Un nuevo sitio web</li>
					<li>Una nueva aula virtual</li>
					<li>Un nuevo módulo para su sitio web</li>
					<li>Un diseño digital o físico</li>

				</ul>

				<p>Entonces cree una <?php echo anchor('#', 'nueva solicitud de servicio'); ?>.</p>

				<p><span class="label label-info">Nota</span> Las solicitudes de servicio tienen que ser analizadas por la administración. La administración se pondrá en contacto con usted de ser necesario.</p>

			</fieldset>

		</div>

		<!-- listings -->
		<div class="span4">

			<fieldset>

				<legend>Listados</legend>

				<p><?php echo anchor('#', 'Ver Listado', array('class' => 'btn btn-large btn-block btn-primary')); ?></p>

				<p>En el <strong>listado de consultas</strong> podrá hacer seguimiento de las solicitudes y las consultas que ha hecho con nosotros, además de actualizarlas. Si necesita:</p>

				<ul>

					<li>Agregar información a una consulta</li>
					<li>Ver el estado de su consulta o solicitud</li>
					<li>Cerrar o reabrir una consulta</li>
		
				</ul>

				<p>Entonces ingrese al <?php echo anchor('#', 'listado de consultas'); ?>.</p>

			</fieldset>

		</div>
		<!-- end listings -->

	</div>
	<!-- end row -->

</div>
<!-- end row -->