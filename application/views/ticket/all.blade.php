@layout('layouts/default')

@section('content')

<div class="row padded">
	
	<div class="btn-toolbar">

		<div class="btn-group">

			<button type="submit" class="btn" value="open">{{ Helper::icon('ok-sign') }} Solo cerradas</button>
			<button type="submit" class="btn" value="open">{{ Helper::icon('time') }} Solo en espera</button>
			<button type="submit" class="btn" value="open">{{ Helper::icon('exclamation-sign') }} Solo abiertas</button>

		</div>

		<div class="input-append pull-right">

			<input type="text" placeholder="Consulta #" />
			<button type="submit" class="btn btn-primary">{{ Helper::icon('search') }}</button>

		</div>

	</div>

	<table class="table table-striped table-hover table-bordered table-tickets">

		<thead>

			<tr>

				<th>#</th>
				<th>Consulta</th>
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

					switch($ticket->status) {
						case 'open':	$type = 'warning'; break;
						case 'hold':	$type = 'info'; break;
						case 'closed':	$type = ''; break;
					}
				?>

				<tr class="{{ $type }}">

					<td>{{ $ticket->id }}</td>

					<td>

						<p>{{ HTML::link('ticket/' . $ticket->id, $ticket->subject) }}</p>
						<small><strong>Creado:</strong>{{ $ticket->created_at }}</small><br />
						<small><strong>Última actualización:</strong> {{ $ticket->updated_at }}</small>

					</td>

					<td>{{ $reported->name }}</td>
					<td>{{ $assigned->name }}</td>
					<td>{{ Helper::status($ticket->status) }}</td>

				</tr>
				
			@endforeach

		</tbody>

	</table>

</div>

@endsection