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
					$user = $users[$ticket->reported_by];
						
					// information about the current reporter
					$reported = new StdClass;
					$reported->name		= $user->firstname . ' ' . $user->lastname;
					$reported->email	= $user->email;

					if (!empty($ticket->assigned_to)) {
						$user = $users[$ticket->assigned_to];

						// information about the assigned person
						$assigned = new StdClass;
						$assigned->name		= $user->firstname . ' ' . $user->lastname;
						$assigned->email	= $user->email;
					}
				?>

				<tr>

					<td>{{ $ticket->id }}</td>
					<td>{{ HTML::link('ticket/' . $ticket->id, $ticket->subject) }}</td>
					<td>{{ $reported->name }}</td>

					{{-- show nothing if noone's assigned --}}
					@if (isset($assigned))
						<td>{{ $assigned->name }}</td>
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