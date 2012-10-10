<?php  $this->load->view('assets/inc/header'); ?>

<!-- navbar -->
<div class="navbar navbar-fixed-top">

	<div class="navbar-inner">

		<div class="container">

			<?php echo anchor('dashboard', '<img src="' . $this->resource->img('logo.png') . '" class="logo" alt="" />', array('class' => 'brand')); ?>

			<ul class="nav">

				<li class="dropdown">

					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Consultas<b class="caret"></b></a>

					<ul class="dropdown-menu">

						<li><?php echo anchor('tickets/add', 'Nueva Consulta'); ?></li>
						<li><?php echo anchor('tickets/all', 'Mis Consultas'); ?></li>

					</ul>

				</li>

				<?php if ($this->saav_user->permission('support')): ?>

					<li class="dropdown">

						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Administración <b class="caret"></b></a>

						<ul class="dropdown-menu">

							<li class="nav-header">Consultas</li>
							<li><?php echo anchor('admin/tickets/all', 'Todas las Consultas'); ?></li>

							<?php if ($this->saav_user->permission('admin')): ?>

								<li class="divider"></li>
								<li class="nav-header">Usuarios</li>
								<li><?php echo anchor('admin/user/add', 'Agregar Usuario'); ?></li>
								<li><?php echo anchor('admin/user/roles', 'Asignar Roles'); ?></li>
								<li><?php echo anchor('admin/companies', 'Compañías'); ?></li>

								<li class="divider"></li>
								<li class="nav-header">Sistema</li>
								<li><?php echo anchor('settings', 'Configuración'); ?></li>
								<li><?php echo anchor('upgrade', 'Actualizar'); ?></li>

							<?php endif; ?>

						</ul>

					</li>

				<?php endif; ?>

				<li class="divider-vertical"></li>
				<li><?php echo anchor('report', icon('wrench') . ' Soporte'); ?></li>

			</ul>

			<ul class="nav pull-right">

				<li class="dropdown">

					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo icon('user'); ?> Sesión iniciada como <strong><?php echo $this->session->userdata('name'); ?></strong><b class="caret"></b></a>

					<ul class="dropdown-menu">

						<li><?php echo anchor('user/profile', icon('edit') . ' Editar Perfil'); ?></li>
						<li><?php echo anchor('logout', icon('signout') . ' Cerrar Sesión'); ?></li>

					</ul>

				</li>

			</ul>

		</div>

	</div>

</div>

<!-- content -->
<div class="container">

	<?php echo $content; ?>

</div>

<!-- footer -->
<?php $this->load->view('assets/inc/footer'); ?>