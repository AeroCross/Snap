<!-- notification -->
<?php echo $this->presenter->notification->show(); ?>

<?php echo form_open('settings', array('class' => 'form-horizontal')); ?>

	<div class="page-header">

		<h4>Opciones Generales</h4>

	</div>

	<!-- per page -->
	<div class="control-group">

		<label for="per_page" class="control-label">Resultados por Página</label>

		<div class="controls">

			<input type="text" name="per_page" id="per_page" value="<?php echo $settings->per_page; ?>" /><span class="help-inline"><strong>Defecto:</strong> 50</span>
			<p class="help-block">Número de resultados que tendrá cada listado y búsqueda por página.</p>

		</div>

	</div>

	<div class="page-header">

		<h4>Correo Electrónico</h4>

	</div>

	<!-- smtp host -->
	<div class="control-group">

		<label for="smtp_host" class="control-label">Servidor SMTP</label>

		<div class="controls">

			<input type="text" name="smtp_host" id="smtp_host" value="<?php echo $settings->smtp_host; ?>" />
			<p class="help-block">El servidor de correo electrónico que se utilizará para enviar mensajes del sistema</p>

		</div>

	</div>

	<!-- smtp port -->
	<div class="control-group">

		<label for="smtp_port" class="control-label">Puerto SMTP</label>

		<div class="controls">

			<input type="text" name="smtp_port" id="smtp_port" value="<?php echo $settings->smtp_port; ?>" /><span class="help-inline"><strong>Defecto:</strong> 587</span>
			<p class="help-block">El puerto saliente habilitado para enviar correos electrónicos.</p>

		</div>

	</div>

	<!-- smtp user -->
	<div class="control-group">

		<label for="smtp_user" class="control-label">Usuario de SMTP</label>

		<div class="controls">

			<input type="text" name="smtp_user" id="smtp_user" value="<?php echo $settings->smtp_user; ?>" />
			<p class="help-block">El usuario del servidor SMTP para enviar correos. Usualmente es una dirección de correo electrónico.</p>

		</div>

	</div>

	<!-- smtp pass -->
	<div class="control-group">

		<label for="smtp_pass" class="control-label">Contraseña SMTP</label>

		<div class="controls">

			<input type="password" name="smtp_pass" id="smtp_pass" value="<?php echo $settings->smtp_pass; ?>" />
			<p class="help-block">La contraseña del usuario SMTP.</p>

		</div>

	</div>

	<!-- smtp name -->
	<div class="control-group">

		<label for="smtp_name" class="control-label">Nombre del Usuario SMTP</label>

		<div class="controls">

			<input type="text" name="smtp_name" id="smtp_name" value="<?php echo $settings->smtp_name; ?>" />
			<p class="help-block">Este nombre aparecerá en los correos electrónicos enviados por el sistema.</p>

		</div>

	</div>

	<!-- smtp crypto -->
	<div class="control-group">

		<label for="smtp_crypto_off" class="control-label">Método de Encriptación</label>

		<div class="controls">

			<label class="radio">

				<input type="radio" name="smtp_crypto" id="smtp_crypto_off" value="off" <?php echo ($settings->smtp_crypto === 'off') ? 'checked' : NULL; ?> /> Sin encriptación &mdash; <strong>Defecto:</strong> Sin encriptación

			</label>

			<label class="radio">

				<input type="radio" name="smtp_crypto" id="smtp_crypto_tls" value="tls" <?php echo ($settings->smtp_crypto === 'tls') ? 'checked' : NULL; ?> /> TLS

			</label>

			<label class="radio">

				<input type="radio" name="smtp_crypto" id="smtp_crypto_ssl" value="ssl" <?php echo ($settings->smtp_crypto === 'ssl') ? 'checked' : NULL; ?> /> SSL

			</label>

			<p class="help-block">Seleccione qué tipo de encriptación tiene el servidor de correos electrónicos.</p>

		</div>

	</div>

	<!-- send emails -->
	<div class="control-group">

		<label for="smtp_enabled_on" class="control-label">Envío de Correos</label>

		<div class="controls">

			<label class="radio">

				<input type="radio" name="smtp_enabled" id="smtp_enabled_on" value="1" <?php echo ($settings->smtp_enabled == 1) ? 'checked' : NULL; ?> /> Activado &mdash; <strong>Defecto:</strong> Activado

			</label>

			<label class="radio">

				<input type="radio" name="smtp_enabled" id="smtp_enabled_off" value="0" <?php echo ($settings->smtp_enabled == 0) ? 'checked' : NULL; ?> /> Desactivado

			</label>

			<p class="help-block">Seleccione si desea que el sistema envíe o no correos electrónicos.</p>

		</div>

	</div>

	<div class="form-actions">

		<button class="submit btn"><?php echo icon('ok-sign'); ?> Actualizar</button>

	</div>

<?php echo form_close(); ?>