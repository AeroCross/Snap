<div class="page-header">

	<h4>Cambiar Contraseña</h4>

</div>

<div class="row">

	<?php echo form_open('user/profile/password', array('class' => 'form-horizontal')); ?>

		<div class="control-group">

			<label for="old" class="control-label">Contraseña Anterior</label>

			<div class="controls">

				<input type="password" name="old" id="old" value="" />
				<p class="help-block">¿No recuerda su contraseña? <?php echo anchor('login/password', 'Recupérela'); ?></p>

			</div>

		</div>

		<div class="control-group">

			<label for="new" class="control-label">Contraseña Nueva</label>

			<div class="controls">

				<input type="password" name="new" id="new" value="" />
				<p class="help-block">Recomendamos que use frases con espacios (e.g <em>esta es mi contraseña</em>)</p>

			</div>

		</div>

		<div class="control-group">

			<label for="confirm" class="control-label">Confirmación</label>

			<div class="controls">

				<input type="password" name="confirm" id="confirm" value="" />
				<p class="help-block">Esta y la <strong>nueva</strong> contraseña deben coincidir</p>

			</div>

		</div>

		<div class="form-actions">

			<div class="btn-group">

				<button class="submit btn btn-primary"><?php echo icon('key'); ?> Cambiar Contraseña</button>
				<?php echo anchor('user/profile', icon('chevron-left') . ' Regresar', array('class' => 'btn')); ?>

			</div>

		</div>

	<?php echo form_close(); ?>

</div>