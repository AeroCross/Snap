<div class="span6 offset3">

	<?php echo form_open('login', array('class' => 'form-horizontal')); ?>

		<fieldset>

			<legend>Iniciar Sesión</legend>

			<!-- username -->
			<div class="control-group">

				<label class="control-label" for="username">Usuario</label>

				<div class="controls">

					<input type="text" name="username" id="username" placeholder="Nombre de Usuario" maxlenght="255" />

				</div>

			</div>
			<!-- end username -->
			
			<!-- password -->
			<div class="control-group">

				<label class="control-label" for="password">Contraseña</label>

				<div class="controls">

					<input type="password" name="password" id="password" placeholder="Contraseña" maxlenght="255" />

				</div>

			</div>
			<!-- end password -->

			<!-- submit -->
			<div class="form-actions">

				<input type="submit" class="btn btn-primary" value="Iniciar Sesión" />

			</div>
			<!-- end submit -->

		</fieldset>
		<!-- end fieldset -->

	<?php echo form_close(); ?>

</div>