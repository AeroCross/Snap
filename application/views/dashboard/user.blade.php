@layout('layouts/default')

@section('content')

<div class="row">

	<div class="span12">

		<div class="page-header">

			<h4>Listado de consultas efectuadas</h4>

		</div>

	</div>

</div>

<div class="row">

	@if (!empty($tickets->total))

		<div class="span12">

			<table class="table table-bordered table-hover table-tickets">

				<thead>

					<tr>

						<th>ID</th>
						<th>Asunto</th>
						<th>Departamento</th>
						<th>Asignada a</th>
						<th>Estatus</th>

					</tr>

				</thead>

				<tbody>

					@foreach($tickets->results as $ticket)

					<?php
						// @TODO: automate
						switch($ticket->status) {
								case 'open':			$type = 'warning';		break;
								case 'hold':			$type = 'info';			break;
								case 'in-progress':	$type = 'in-progress';	break;
								case 'closed':			$type = '';					break;
							}
					?>
					<tr class="{{ $type }}">

						<td>{{ $ticket->id }}</td>
						<td>
							<p>{{ HTML::link('ticket/' . $ticket->id, $ticket->subject) }}</p>
							
							<small><strong>Creada:</strong> {{ $ticket->created_at }}</small><br />
							<small><strong>Última modificación:</strong> {{ $ticket->updated_at }}</small>

						</td>
						<td>{{ $departments[$ticket->department] }}</td>
						
						@if (empty($ticket->assigned_to))

							<td><span class="muted">Nadie</span></td>

						@else

							<td>{{ $users[$ticket->assigned_to]['name'] }}</td>

						@endif

						<td>{{ Helper::status($ticket->status) }}</td>

					</tr>

					@endforeach

				</tbody>

			</table>

			<!-- pagination links -->
			{{ $tickets->links() }}

		</div>

	@else

		<div class="span12">

			<div class="alert alert-info">

				<h4>¡Sin consultas!</h4>
				<br />

				Parece que es primera vez que está por aquí. ¿Desea abrir una {{ HTML::link('ticket/add', 'nueva consulta') }}?

			</div>

		</div>

	@endif
	
</div>

@endsection