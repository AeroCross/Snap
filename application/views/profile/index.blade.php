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
			<button type="button" class="btn" data-toggle="tooltip" title="Cambiar correo electrónico" data-placement="bottom">{{ Helper::icon('envelope-alt') }}</button>
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

		{{ Form::open('profile/update/password', 'PUT', array('class' => 'form-horizontal')) }}

			<div class="alert hide" id="alert-change-password"></div>

			<div class="control-group">

				<label class="control-label" for="old">Contraseña anterior</label>

				<div class="controls">

					<input type="password" name="password" id="old" />
					<span class="help-block"><small class="muted">Si no recuerda su contraseña, {{ HTML::link('password/forget', 'recupérela') }}</small></span>

				</div>

			</div>

			<div class="control-group">

				<label class="control-label" for="new">Nueva contraseña</label>

				<div class="controls">

					<input type="password" name="password" id="new" />

				</div>

			</div>

			<div class="control-group">

				<label class="control-label" for="repeat">Repetir contraseña</label>

				<div class="controls">

					<input type="password" name="password" id="repeat" />

				</div>

			</div>

		{{ Form::close() }}

	</div>

	<div class="modal-footer">

		<a href="#" class="btn btn-primary" id="send-change-password">{{ Helper::icon('ok-sign') }} Cambiar contraseña</a>

	</div>

</div>
<!-- end change password -->
<!-- end modals -->

@endsection

@section('postscripts')

<!-- scripts -->
<script>

// base url
var base = '{{ URL::base() }}';

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
			new: $('#new').val(),
			repeat: $('#repeat').val()	
		},
		success: function(data) {
			$('#alert-change-password').html(data.message).addClass('alert-' + data.type).fadeIn(200).removeClass('hide');
		},
		dataType: 'json'
	});
});

</script>
<!-- end scripts -->

@endsection