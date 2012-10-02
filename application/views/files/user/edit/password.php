<!-- notifications -->
<?php echo $this->presenter->notification->show(); ?>

<div class="page-header">

	<h4>Cambiar Contraseña</h4>

</div>

<div class="row">

	<?php echo form_open('user/edit/password', array('class' => 'form-horizontal')); ?>

		<!-- old password -->
		<div class="control-group">

			<label for="old" class="control-label">Contraseña anterior</label>

			<div class="controls">

				<input type="password" name="old" id="old" value="" />
				<p class="help-block">Introduzca su contraseña, por medidas de seguridad</p>

			</div>

		</div>

		<!-- new password -->
		<div class="control-group">

			<label for="new" class="control-label">Contraseña nueva</label>

			<div class="controls">

				<input type="password" name="new" id="new" value="" />
				<p class="help-block">Recomendamos que use frases con espacios (e.g <em>esta es mi contraseña</em>)</p>

			</div>

		</div>

		<!-- confirm password -->
		<div class="control-group">

			<label for="confirm" class="control-label">Confirmación de Contraseña</label>

			<div class="controls">

				<input type="password" name="confirm" id="confirm" value="" />
				<p class="help-block">Esta y la <strong>nueva</strong> contraseña deben coincidir</p>

			</div>

		</div>

		<!-- submit password -->
		<div class="form-actions">

			<div class="btn-group">

				<button class="submit btn btn-primary"><?php echo icon('ok-sign'); ?> Cambiar Contraseña</button>
				<?php echo anchor('user/profile', icon('circle-arrow-left') . ' Regresar', array('class' => 'btn')); ?>

			</div>

		</div>

	<?php echo form_close(); ?>

</div>