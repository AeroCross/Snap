<div class="page-header">

	<h4>Perfil de Usuario</h4>

</div>

<div class="row">

	<div class="span2">

		<ul class="thumbnails">

			<li class="span2">

				<a href="<?php echo base_url('user/edit/picture'); ?>" class="thumbnail">

					<?php echo $this->presenter->user->avatar($this->session->userdata('id'), 170); ?>

				</a>

			</li>

		</ul>

	</div>

	<div class="span9">

		<h2><?php echo $user->firstname . ' ' . $user->lastname; ?> <small><?php echo $company->name; ?></small></h2>

		<dl>

			<dt>Correo electrónico:</dt>
			<dd><?php echo safe_mailto($user->email); ?></dd>

		</dl>

		<div class="btn-group">

			<?php echo anchor('user/edit/password', icon('key') . ' Cambiar Contraseña', array('class' => 'btn')); ?>
			<?php echo anchor('user/edit/email', icon('envelope-alt') . ' Actualizar Correo', array('class' => 'btn')); ?>
			<?php echo anchor('user/edit/picture', icon('picture') . ' Cambiar Imágen de Perfil', array('class' => 'btn')); ?>

		</div>

	</div>

</div>