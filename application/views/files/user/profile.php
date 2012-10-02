<div class="page-header">

	<h4>Perfil de Usuario</h4>

</div>

<div class="row">

	<div class="span2">

		<ul class="thumbnails">

			<li class="span2">

				<a href="#" class="thumbnail">

					<img src="http://placehold.it/170x170" alt="" />

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
			<?php echo anchor('#', icon('envelope') . ' Actualizar Correo', array('class' => 'btn')); ?>
			<?php echo anchor('#', icon('picture') . ' Cambiar Imágen de Perfil', array('class' => 'btn')); ?>

		</div>

	</div>

</div>