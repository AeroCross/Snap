@layout('layouts/default')

@section('content')

<div class="page-header">
	
	<!-- notifications -->
	{{ Notification::show() }}

	<h4>Opciones Generales</h4>

</div>

<!-- settings form -->
{{ Form::open('settings', 'PUT', array('class' => 'form-horizontal')) }}
	
	<!-- per page -->
	<div class="control-group">

		<label for="per_page" class="control-label">Resultados por Página</label>

		<div class="controls">

			<input type="text" name="per_page" id="per_page" value="{{ $setting->per_page }}" /><span class="help-inline"><strong>Defecto:</strong> 50</span>
			<span class="help-block">Número de resultados que tendrá cada listado y búsqueda por página</span>

		</div>

	</div>
	<!-- end per page -->

	<!-- hax -->
	<br />
	<!-- end hax -->

	<!-- system message -->
	<div class="page-header">

		<h4>Mensaje del Sistema</h4>

	</div>

	<!-- title -->
	<div class="control-group">

		<label for="system-message-title" class="control-label">Título</label>

		<div class="controls">

			<input type="text" name="system-message-title" id="system-message-title" />
			<span class="help-block"> Aunque este campo no es necesario para el mensaje del sistema, es recomendado</span>

		</div>

	</div>
	<!-- end title -->

	<!-- content -->
	<div class="wmd-panel">

		<div class="control-group">

			<!-- no label in here -->
			<div class="controls">

				<div id="wmd-button-bar"></div>

				<textarea name="system-message" id="wmd-input" cols="10" rows="10" class="span6 wmd-input"></textarea><span class="help-block">Este mensaje le aparecerá a todos los usuarios al iniciar sesión</span>

			</div>

		</div>

	</div>
	<!-- end system message -->

	<!-- hax -->
	<br />
	<!-- end hax -->

	<!-- email settings -->
	<div class="page-header">

		<h4>Correo Electrónico</h4>

	</div>

	<!-- smtp server -->
	<div class="control-group">

		<label for="smtp_host" class="control-label">Servidor SMTP</label>

		<div class="controls">

			<input type="text" name="smtp_host" id="smtp_host" value="{{ $setting->smtp_host }}" /><span>&nbsp;</span>
			<span class="help-block">El servidor de correo electrónico que se utilizará para enviar mensajes del sistema</span>

		</div>

	</div>
	<!-- end smtp server -->

	<!-- smtp port -->
	<div class="control-group">

		<label for="smtp_port" class="control-label">Puerto SMTP</label>

		<div class="controls">

			<input type="text" name="smtp_port" id="smtp_port" value="{{ $setting->smtp_port }}" /><span class="help-inline"><strong>Defecto:</strong> 25</span>
			<span class="help-block">El puerto saliente habilitado para enviar correo electrónicos</span>

		</div>

	</div>
	<!-- end smtp port -->

	<!-- smtp user -->
	<div class="control-group">

		<label for="smtp_user" class="control-label">Usuario SMTP</label>

		<div class="controls">

			<input type="text" name="smtp_user" id="smtp_user" value="{{ $setting->smtp_user }}" /><span>&nbsp;</span>
			<span class="help-block">El usuario del servidor SMTP para enviar correos — usualmente una dirección de correo electrónico</span>

		</div>

	</div>
	<!-- end smtp user -->

	<!-- smtp password -->
	<div class="control-group">

		<label for="smtp_pass" class="control-label">Contraseña SMTP</label>

		<div class="controls">

			<input type="password" name="smtp_pass" id="smtp_pass" value="{{ $setting->smtp_pass }}" /><span>&nbsp;</span>
			<span class="help-block">La contraseña del usuario SMTP.</span>

		</div>

	</div>
	<!-- end smtp password -->

	<!-- smtp name -->
	<div class="control-group">

		<label for="smtp_name" class="control-label">Nombre del Usuario SMTP</label>

		<div class="controls">

			<input type="text" name="smtp_name" id="smtp_name" value="{{ $setting->smtp_name }}" /><span>&nbsp;</span>
			<span class="help-block">Este nombre aparecerá en los correos electrónicos enviados por el sistema</span>

		</div>

	</div>
	<!-- end smtp name -->

	<!-- smtp crypto -->
	<div class="control-group">

		<label for="smtp_crypto_off" class="control-label">Método de Encriptación</label>

		<div class="controls">

			<label class="radio">

				<input type="radio" name="smtp_crypto" id="smtp_crypto_off" value="off" <?php if ($setting->smtp_crypto === 'off'): echo 'checked'; endif; ?>> Sin encriptación — <strong>Defecto:</strong> Sin encriptación

			</label>

			<label class="radio">

				<input type="radio" name="smtp_crypto" id="smtp_crypto_tls" value="tls" <?php if ($setting->smtp_crypto === 'tls'): echo 'checked'; endif; ?>> TLS

			</label>

			<label class="radio">

				<input type="radio" name="smtp_crypto" id="smtp_crypto_ssl" value="ssl" <?php if ($setting->smtp_crypto === 'ssl'): echo 'checked'; endif; ?>> SSL

			</label>

			<p class="help-block">Seleccione el tipo de encriptación que posee el servidor de correos electrónicos</p>

		</div>

	</div>
	<!-- end smtp crypto -->

	<!-- form actions -->
	<div class="form-actions">

		<button class="btn send">{{ Helper::icon('ok-sign') }} Actualizar</button>

	</div>
	<!-- end form action -->

{{ Form::close() }}
<!-- end settings form -->

@endsection