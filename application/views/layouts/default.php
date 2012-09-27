<?php  $this->load->view('assets/inc/header'); ?>

<!-- navbar -->
<div class="navbar navbar-fixed-top">

	<div class="navbar-inner">

		<div class="container">

			<?php echo anchor('dashboard', '<img src="' . $this->resource->img('logo.png') . '" class="logo" alt="" />', array('class' => 'brand')); ?>

			<ul class="nav">

				<li class="dropdown">

					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Nueva <b class="caret"></b></a>

					<ul class="dropdown-menu">

						<li><?php echo anchor('tickets/add', 'Consulta'); ?></li>
						<li><?php echo anchor('#', 'Solicitud de Servicio'); ?></li>

					</ul>

				</li>

				<li><?php echo anchor('tickets/all', 'Consultas'); ?></li>
				
				<?php if ($this->saav_user->permission('support')): ?>

					<li class="dropdown">

						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Administración <b class="caret"></b></a>

						<ul class="dropdown-menu">

							<li class="nav-header">Consultas</li>
							<li><?php echo anchor('admin/tickets/all', 'Listado de Consultas'); ?></li>

							<?php if ($this->saav_user->permission('admin')): ?>
							
								<li class="divider"></li>
								<li class="nav-header">Configuración</li>
								<li><?php echo anchor('settings', 'Opciones del Sistema'); ?></li>
								<li><?php echo anchor('upgrade', 'Actualizar Base de Datos'); ?></li>

							<?php endif; ?>

						</ul>

					</li>

				<?php endif; ?>

				<li class="divider-vertical"></li>
				<li><?php echo anchor('report', icon('wrench') . ' Reportar un Problema'); ?></li>

			</ul>

			<p class="navbar-text pull-right">Sesión iniciada como <strong><?php echo $this->session->userdata('name'); ?></strong> &mdash; <?php echo anchor('logout', 'salir'); ?></p>

		</div>

	</div>

</div>

<!-- content -->
<div class="container">

	<?php echo $content; ?>

</div>

<!-- footer -->
<?php $this->load->view('assets/inc/footer'); ?>