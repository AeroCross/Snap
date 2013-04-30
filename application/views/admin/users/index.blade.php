@layout('layouts/default')

@section('content')

<div class="row">

	<div class="span5">

		<div class="page-header">

			<h4>Nuevo Usuario</h4>

		</div>

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
					<th>Nombres y Apellido</th>
					<th>Correo Electrónico</th>
					<th>Acciones</th>

				</tr>

			</thead>

			<tbody>

				@foreach($users as $user)

				<tr>

					<td>{{ $user->id }}</td>
					<td>{{ $user->username }}</td>
					<td>{{ $user->firstname . ' ' . $user->lastname }}</td>
					<td>{{ HTML::mailto($user->email) }}</td>
					<td><div class="btn-group"><button class="btn" title="Modificar">{{ Helper::icon('user') }}</button>

				</tr>

				@endforeach

			</tbody>

		</table>

	</div>	

</div>

@endsection