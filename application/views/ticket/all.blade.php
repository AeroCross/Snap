@layout('layouts/default')

@section('content')

<div class="row padded">
	
	<table class="table table-striped table-hover table-bordered table-tickets">

		<thead>

			<tr>

				<th>#</th>
				<th>Asunto</th>
				<th>Reportado por</th>
				<th>Asignado a</th>
				<th>Estatus</th>

			</tr>

		</thead>

		<tbody>

			@foreach($tickets as $ticket)

				<?php 
					foreach($users as $user) {
						if ($user->id == $ticket->reported_by) {
							$reported = $user;
							$reported->name = $reported->firstname . ' ' . $reported->lastname;
						}
					}

					// to prevent conflicts with next loop
					unset($user);

					if (!empty($ticket->assigned_to)) {
						foreach($users as $user) {
							if ($user->id == $ticket->assigned_to) {
								$assigned = $user;
								$assigned->name = $assigned->firstname . ' ' . $assigned->lastname;
							}
						}
					} else {
							$assigned = new StdClass;
							$assigned->name = '<span class="muted">Nadie</span>';
					}

					// for consistency
					unset($user);
				?>

				<tr>

					<td>{{ $ticket->id }}</td>
					<td><p>{{ HTML::link('ticket/' . $ticket->id, $ticket->subject) }}</p><small><strong>Creado:</strong>{{ $ticket->created_at }}</small><br /><small><strong>Última actualización:</strong> {{ $ticket->updated_at }}</small></td>
					<td>{{ $reported->name }}</td>
					<td>{{ $assigned->name }}</td>
					<td>{{ Helper::status($ticket->status) }}</td>

				</tr>
				
			@endforeach

		</tbody>

	</table>

</div>

@endsection