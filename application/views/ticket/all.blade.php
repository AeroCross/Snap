@layout('layouts/default')

@section('content')

<div class="row padded">
	
	<table class="table table-striped table-bordered">

		<thead>

			<tr>

				<th>#</th>
				<th>Asunto</th>
				<th>Reportado por</th>
				<th>Asignado a</th>
				<th>Creado</th>
				<th>Modificado</th>
				<th>Estatus</th>

			</tr>

		</thead>

		<tbody>

			@foreach($tickets as $ticket)

				<?php 
					foreach($users as $user) {
						if ($user->id == $ticket->reported_by) {
							$reported = $user;
						}
					}

					// to prevent conflicts with next loop
					unset($user);

					if (!empty($ticket->assigned_to)) {
						foreach($users as $user) {
							if ($user->id == $ticket->assigned_to) {
								$assigned = $user;
							}
						}
					}

					// for consistency
					unset($user);
				?>

				<tr>

					<td>{{ $ticket->id }}</td>
					<td>{{ HTML::link('ticket/' . $ticket->id, $ticket->subject) }}</td>
					<td>{{ $reported->firstname . ' ' . $reported->lastname }}</td>

					{{-- show nothing if noone's assigned --}}
					@if (isset($assigned))
						<td>{{ $assigned->firstname . ' ' . $assigned->lastname }}</td>
					@else
						<td><span class="muted">Nadie</span></td>
					@endif

					<td>{{ $ticket->created_at }}</td>
					<td>{{ $ticket->updated_at }}</td>
					<td>{{ Helper::status($ticket->status) }}</td>

				</tr>
				
			@endforeach

		</tbody>

	</table>

</div>

@endsection