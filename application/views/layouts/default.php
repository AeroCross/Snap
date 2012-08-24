<!-- header -->
<?php  $this->load->view('assets/inc/header'); ?>

<!-- navbar -->
<div class="navbar navbar-static-top navbar-inverse">

	<div class="navbar-inner">

		<div class="container">

			<?php echo anchor('#', 'SAV', array('class' => 'brand')); ?>

			<ul class="nav">

				<li class="dropdown">
					
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Nueva <b class="caret"></b></a>

					<ul class="dropdown-menu">

						<li><?php echo anchor('#', 'Consulta'); ?></li>
						<li><?php echo anchor('#', 'Solicitud de Servicio'); ?></li>

					</ul>

				</li>

				<li><?php echo anchor('#', 'Consultas'); ?></li>
				<li><?php echo anchor('#', 'Soporte'); ?></li>

			</ul>

			<p class="navbar-text pull-right">Sesión iniciada como <strong><?php echo $this->session->userdata('name'); ?></strong> &mdash; <?php echo anchor('logout', 'salir'); ?></p>

		</div>

	</div>

</div>

<!-- content -->
<div class="container">

	<?php echo $yield; ?>

</div>

<!-- footer -->
<?php $this->load->view('assets/inc/footer'); ?>