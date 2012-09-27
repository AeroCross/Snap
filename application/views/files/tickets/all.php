<div class="page-header">

	<h4>Sus consultas <small><?php echo anchor('dashboard', '(regresar)'); ?></small></h4>

</div>

<div class="row">

	<div class="span12">
		<!-- pagination links -->
		<?php echo $this->pagination->create_links(); ?>

		<!-- tickets table -->
		<?php echo $tickets; ?>

		<!-- pagination links -->
		<?php echo $this->pagination->create_links(); ?>

	</div>

</div>