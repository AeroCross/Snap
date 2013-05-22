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
			<button type="button" class="btn" data-toggle="tooltip" title="Modificar perfil" data-placement="bottom">{{ Helper::icon('user') }}</button>

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

		<a href="#" class="btn btn-primary" id="send-change-password">{{ Helper::icon('ok-sign') }} Cambiar contraseña</a>

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

		<a href="#" class="btn btn-primary" id="send-change-email">{{ Helper::icon('ok-sign') }} Cambiar correo electrónico</a>

	</div>

</div>
<!-- end change email -->
<!-- end modals -->

@endsection

@section('postscripts')

<!-- scripts -->
<script>

// base url
var base = '{{ URL::base() }}';

// change password
// @TODO: DRY up?
// @TODO: Cache-up!
$('#show-change-password').on('click', function() {
	$('#modal-change-password').modal('show');
});

$('#send-change-password').on('click', function() {
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
});

// change email
$('#show-change-email').on('click', function() {
	$('#modal-change-email').modal('show');
});

$('#send-change-email').on('click', function() {
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
});

</script>
<!-- end scripts -->

@endsection