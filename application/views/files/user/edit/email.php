<!-- notifications -->
<?php echo $this->presenter->notification->show(); ?>

<div class="page-header">

	<h4>Actualizar Correo</h4>

</div>

<div class="row">

	<?php echo form_open('user/edit/email', array('class' => 'form-horizontal')); ?>

		<!-- password -->
		<div class="control-group">

			<label for="password" class="control-label">Contraseña</label>

			<div class="controls">

				<input type="text" name="password" id="password" value="" />
				<p class="help-block">Introduzca su contraseña, por medidas de seguridad</p>

			</div>

		</div>

		<!-- new email -->
		<div class="control-group">

			<label for="new" class="control-label">Nueva dirección</label>

			<div class="controls">

				<input type="text" name="new" id="new" value="" />
				<p class="help-block">Ha de ser una <strong>dirección válida</strong> &mdash; de lo contrario, no recibirá notificaciones</p>

			</div>

		</div>

		<!-- confirm new email -->
		<div class="control-group">

			<label for="confirm" class="control-label">Confirmación de dirección</label>

			<div class="controls">

				<input type="password" name="confirm" id="confirm" value="" />
				<p class="help-block">Esta y la <strong>nueva</strong> dirección de correo deben coincidir</p>

			</div>

		</div>

		<!-- submit password -->
		<div class="form-actions">

			<div class="btn-group">

				<button class="submit btn btn-primary"><?php echo icon('ok-sign'); ?> Actualizar Correo</button>
				<?php echo anchor('user/profile', icon('circle-arrow-left') . ' Regresar', array('class' => 'btn')); ?>

			</div>

		</div>

	<?php echo form_close(); ?>

</div>