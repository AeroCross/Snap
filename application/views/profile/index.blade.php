@layout('layouts/default')

@section('content')

<div class="row padded">
	
	<div class="span2">

		<ul class="thumbnails">

			<li><a href="#" class="thumbnail"><img src="holder.js/160x160" alt="" width="160" height="160" /></a></li>

		</ul>

	</div>

	<div class="span4">

		<h4>{{ $user->firstname . ' ' . $user->lastname }} <small>{{ $company->name }}</small></h4>

		<div class="btn-group">

			<button type="button" class="btn" data-toggle="tooltip" title="Cambiar contraseña" data-placement="bottom" id="show-change-password">{{ Helper::icon('key') }}</button>
			<button type="button" class="btn" data-toggle="tooltip" title="Cambiar correo electrónico" data-placement="bottom" id="show-change-email">{{ Helper::icon('envelope-alt') }}</button>
			<button type="button" class="btn" data-toggle="tooltip" title="Modificar perfil" data-placement="bottom" id="show-change-info">{{ Helper::icon('user') }}</button>

		</div>

	</div>

</div>

<!-- modals -->
<!-- change password -->
<div class="modal hide fade" id="modal-change-password">

	<div class="modal-header">

		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

		<h4>Cambiar contraseña</h4>

	</div>

	<div class="modal-body">

		{{ Form::open('profile/update/password', 'PUT', array('class' => 'form-horizontal', 'id' => 'form-change-password')) }}

			<div class="alert hide" id="alert-change-password"></div>

			<div class="control-group">

				<label class="control-label" for="old">Contraseña anterior</label>

				<div class="controls">

					<input type="password" name="password" id="old" />
					<span class="help-block"><small class="muted">Si no recuerda su contraseña, {{ HTML::link('password/forget', 'recupérela') }}</small></span>

				</div>

			</div>

			<div class="control-group">

				<label class="control-label" for="new-password">Nueva contraseña</label>

				<div class="controls">

					<input type="password" name="password" id="new-password" />

				</div>

			</div>

			<div class="control-group">

				<label class="control-label" for="repeat-password">Repetir contraseña</label>

				<div class="controls">

					<input type="password" name="password" id="repeat-password" />

				</div>

			</div>

		{{ Form::close() }}

	</div>

	<div class="modal-footer">

		<button class="btn btn-primary" id="send-change-password">{{ Helper::icon('ok-sign') }} Cambiar contraseña</button>

	</div>

</div>
<!-- end change password -->

<!-- change email -->
<div class="modal hide fade" id="modal-change-email">

	<div class="modal-header">

		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

		<h4>Cambiar correo electrónico</h4>

	</div>

	<div class="modal-body">

		{{ Form::open('profile/update/email', 'PUT', array('class' => 'form-horizontal', 'id' => 'form-change-email')) }}

			<div class="alert hide" id="alert-change-email"></div>

			<div class="control-group">

				<label class="control-label" for="password-change-email">Contraseña</label>

				<div class="controls">

					<input type="password" name="password" id="password-change-email" />
					<span class="help-block"><small class="muted">Si no recuerda su contraseña, {{ HTML::link('password/forget', 'recupérela') }}</small></span>

				</div>

			</div>

			<div class="control-group">

				<label class="control-label" for="new-email">Nueva dirección</label>

				<div class="controls">

					<input type="email" name="new" id="new-email" />

				</div>

			</div>

			<div class="control-group">

				<label class="control-label" for="repeat-email">Repetir dirección</label>

				<div class="controls">

					<input type="email" name="repeat" id="repeat-email" />

				</div>

			</div>

		{{ Form::close() }}

	</div>

	<div class="modal-footer">

		<button class="btn btn-primary" id="send-change-email">{{ Helper::icon('ok-sign') }} Cambiar correo electrónico</button>

	</div>

</div>
<!-- end change email -->

<!-- change user information -->
<div class="modal hide fade" id="modal-change-info">

	<div class="modal-header">

		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

		<h4>Actualizar información de usuario</h4>

	</div>

	{{ Form::open('profile/update/user', 'PUT', array('class' => 'form-horizontal', 'id' => 'form-change-info')) }}

		<div class="modal-body">

			<div class="alert hide" id="alert-change-info"></div>

			<div class="control-group">

				<label class="control-label" for="password-change-info">Contraseña</label>

				<div class="controls">

					<input type="password" name="password" id="password-change-info" />
					<span class="help-block"><small class="muted">Si no recuerda su contraseña, {{ HTML::link('password/forget', 'recupérela') }}</small></span>

				</div>

			</div>

			<div class="control-group">

				<label class="control-label" for="new-username">Usuario</label>

				<div class="controls">

					<input type="text" name="username" id="new-username" value="{{ Session::get('username') }}" />
					<span class="help-block"><small class="muted">Con este nombre de usuario iniciará sesión</small></span>

				</div>

			</div>

			<div class="control-group">

				<label class="control-label" for="new-firstname">Nombre</label>

				<div class="controls">

					<input type="text" name="firstname" id="new-firstname" value="{{ Session::get('firstname') }}" />

				</div>

			</div>

			<div class="control-group">

				<label class="control-label" for="new-lastname">Apellido</label>

				<div class="controls">

					<input type="text" name="lastname" id="new-lastname" value="{{ Session::get('lastname') }}" />
					<span class="help-block"><small class="muted">Su nombre y apellido aparecerá en los emails y en los listados</small></span>

				</div>

			</div>

		</div>

	{{ Form::close() }}

	<div class="modal-footer">

		<button class="btn btn-primary" id="send-change-info">{{ Helper::icon('ok-sign') }} Actualizar información</button>

	</div>

</div>
<!-- end change user information -->
<!-- end modals -->

@endsection

@section('postscripts')

<!-- scripts -->
<script>

// base url
var base = '{{ URL::base() }}';

// submit forms with enter
$(document).keypress(function(e) {
	if (e.which === 13) {
		var form	=  $(document.activeElement).closest('form');
		submitBtn	= form.find('button[type=submit]');
		submitInput	= form.find('input[type=submit]');
		
		// no submits found
		if (submitBtn.length === 0 && submitInput.length === 0) {
			// just checking...
			console.log(form.attr('id'));

			switch (form.attr('id')) {
				case 'form-change-password':	ajaxChangePassword();	break;
				case 'form-change-email':		ajaxChangeEmail();		break;
				case 'form-change-info':		ajaxChangeInfo();		break;
			}
		}
	}
});

// change password
// @TODO: DRY up and chache this baby
function ajaxChangePassword() {
	$('#alert-change-password').removeClass().addClass('alert hide');
	$.ajax({
		type: 'POST',
		url: base + '/profile/update/password',
		data: {
			old: $('#old').val(),
			new: $('#new-password').val(),
			repeat: $('#repeat-password').val()	
		},
		success: function(data) {
			$('#alert-change-password').html(data.message).addClass('alert-' + data.type).fadeIn(200).removeClass('hide');

			// clear the form data when everything's done
			if (data.type == 'success') {
				$('#form-change-password').find('input').val('');
			}
		},
		dataType: 'json'
	});
}

$('#show-change-password').on('click', function() {
	$('#modal-change-password').modal('show');
});

$('#send-change-password').on('click', function() {
	ajaxChangePassword();
});

// change email
function ajaxChangeEmail() {
	$('#alert-change-email').removeClass().addClass('alert hide');
	$.ajax({
		type: 'POST',
		url: base + '/profile/update/email',
		data: {
			password: $('#password-change-email').val(),
			new: $('#new-email').val(),
			repeat: $('#repeat-email').val()	
		},
		success: function(data) {
			$('#alert-change-email').html(data.message).addClass('alert-' + data.type).fadeIn(200).removeClass('hide');

			// clear the form data when everything's done
			if (data.type == 'success') {
				$('#form-change-email').find('input').val('');
			}
		},
		dataType: 'json'
	});
}

$('#show-change-email').on('click', function() {
	$('#modal-change-email').modal('show');
});

$('#send-change-email').on('click', function() {
	ajaxChangeEmail();
});

// update user information
function ajaxChangeInfo() {
	$('#alert-change-info').removeClass().addClass('alert hide');
	$.ajax({
		type: 'POST',
		url: base + '/profile/update/user',
		data: {
			password:	$('#password-change-info').val(),
			username:	$('#new-username').val(),
			firstname:	$('#new-firstname').val(),
			lastname:	$('#new-lastname').val(),
		},
		success: function(data) {
			$('#alert-change-info').html(data.message).addClass('alert-' + data.type).fadeIn(200).removeClass('hide');
		},
		dataType: 'json'
	});
}

$('#show-change-info').on('click', function() {
	$('#modal-change-info').modal('show');
});

$('#send-change-info').on('click', function() {
	ajaxUpdateUser();
});

</script>
<!-- end scripts -->

@endsection