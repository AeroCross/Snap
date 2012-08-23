<!-- header -->
<?php  $this->load->view('assets/inc/header'); ?>

<!-- navbar -->
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
				<button class="btn" id="login-submit"><?php echo icon('signin'); ?> Iniciar Sesión</button>

			<?php echo form_close(); ?>

		</div>

	</div>

</div>

<!-- content -->
<div class="container">

	<?php echo $yield; ?>

</div>

<!-- footer -->
<?php $this->load->view('assets/inc/footer'); ?>