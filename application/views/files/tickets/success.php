<div class="span6 offset3">

	<div class="page-header">

		<h4>¡Muchas gracias!</h4>

	</div>

	<p>Su número de consulta es <strong>#<?php echo $ticket; ?></strong> &mdash; este es su número identificador en caso de que quiera buscarla más adelante en el <?php echo anchor('#', 'listado'); ?>.</p>

	<p>Nosotros nos encargaremos de responderle por esta misma vía cuando lo hayamos atendido.</p>

	<p><strong>¡Muchas gracias!</strong></p>

	<br />

	<!-- options -->
	<div class="btn-group pagination-centered">

		<?php echo anchor('tickets/add', icon('plus-sign') . ' Otra Consulta', array('class' => 'btn')); ?>
		<?php echo anchor('#', icon('list-ul') . ' Ir al Listado', array('class' => 'btn')); ?>
		<?php echo anchor('dashboard', icon('home') . ' Ir al Inicio', array('class' => 'btn')); ?>

	</div>
	<!-- end options -->

</div>