@layout('layouts/default')

@section('content')

<div class="row">

	<div class="span5">

		<div class="page-header">

			<h4>Nuevo Usuario » <small class="highlight highlight-error">todos los campos son obligatorios</small></h4>

		</div>

		{{ Form::open('admin/users/new', 'POST', array('class' => 'form-horizontal')) }}

			<!-- notifications -->
			{{ Notification::show() }}

			<!-- firstname -->
			<div class="control-group">

				<label for="firstname" class="control-label">Nombres</label>

				<div class="controls">

					<input type="text" name="firstname" id="firstname" value="{{ Input::old('firstname') }}" />

				</div>

			</div>
			<!-- end firstname -->

			<!-- lastname -->
			<div class="control-group">

				<label for="lastname" class="control-label">Apellidos</label>

				<div class="controls">

					<input type="text" name="lastname" id="lastname" value="{{ Input::old('lastname') }}" />

				</div>

			</div>
			<!-- end lastname -->

			<!-- email -->
			<div class="control-group">

				<label for="email" class="control-label">Correo electrónico</label>

				<div class="controls">

					<input type="text" name="email" id="email" placeholder="usuario@dominio.com" value="{{ Input::old('email') }}" />
					<span class="help-block"><small class="muted">Debe ser una dirección válida y activa</small></span>

				</div>

			</div>
			<!-- end email -->

			<fieldset>

				<legend>Información de Usuario</legend>

				<!-- username -->
				<div class="control-group">

					<label for="username" class="control-label">Usuario</label>

					<div class="controls">

						<input type="text" name="username" id="username" value="{{ Input::old('username') }}" />
						<span class="help-block"><small class="muted">Debe ser único — con esto iniciará sesión</small></span>

					</div>

				</div>
				<!-- end username -->

				<!-- password -->
				<div class="control-group">

					<label for="password" class="control-label">Contraseña</label>

					<div class="controls">

						<input type="password" name="password" id="password" />

					</div>

				</div>
				<!-- end password -->

				<!-- repassword -->
				<div class="control-group">

					<label for="repassword" class="control-label">Repetir contraseña</label>

					<div class="controls">

						<input type="password" name="repassword" id="repassword" />
						<span class="help-block"><small class="muted">Las dos contraseñas deben coincidir</small></span>

					</div>

				</div>
				<!-- end repassword -->

				<!-- company -->
				<div class="control-group">

					<label for="company" class="control-label">Compañía</label>

					<div class="controls">

						<select name="company" id="company" class="input-large">

							{{ Fields::companies() }}

						</select>

					</div>

				</div>
				<!-- end company -->

			</fieldset>

			<div class="form-actions">

				<div class="btn-group">

					<button type="submit" class="btn btn-success">{{ Helper::icon('plus') }} Crear usuario</button>

				</div>

			</div>

		{{ Form::close() }}

	</div>

	<div class="span7">

		<div class="page-header">

			<h4>Usuarios existentes</h4>

		</div>

		<table class="table table-striped table-bordered">

			<thead>

				<tr>

					<th>ID</th>
					<th>Usuario</th>
					<th>Correo Electrónico</th>
					<th>Acciones</th>

				</tr>

			</thead>

			<tbody>

				@foreach($users->results as $user)

				<tr>

					<td>{{ $user->id }}</td>
					<td>{{ $user->firstname . ' ' . $user->lastname }}<br /><small class="muted">{{ $user->username }}</small></td>
					<td>{{ HTML::mailto($user->email) }}</td>
					<td>
						<div class="btn-group">
							<a href="users/edit/{{ $user->id }}" class="btn" title="Editar">{{ Helper::icon('user') }}</a>
							<a href="users/delete/{{ $user->id }}" class="btn" title="Eliminar">{{ Helper::icon('ban-circle') }}</a>
						</div>
					</td>

				</tr>

				@endforeach

			</tbody>

		</table>

		{{ $users->links() }}

	</div>	

</div>

@endsection