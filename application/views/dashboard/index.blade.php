@layout('layouts/default')

@section('content')

<div class="row padded">

	<div class="span4">
	
		<div class="tabbable">
		
			<ul class="nav nav-tabs">
				
				<li class="active"><a href="#latest" data-toggle="tab">Recientes</a></li>
				<li><a href="#assigned" data-toggle="tab">Asignadas <span class="badge badge-{{ $badge }}">{{ $totalAssigned }}</span></a></li>

			</ul>
			
			<div class="tab-content">

				<div class="tab-pane active" id="latest">
				
					@if (empty($latest))

					<div class="alert alert-info">

						<p>No hay consultas abiertas asignadas.</p>

					</div>

					@else

						<table class="table table-bordered table-striped">

							<thead>

								<tr>

									<th>#</th>
									<th>Asunto</th>
									<th class="center">Estatus</th>

								</tr>

							</thead>

							<tbody>

								@foreach($latest as $ticket)

									<tr>

										<td>{{ HTML::link('ticket/view/' . $ticket->id, $ticket->id) }}</td>
										<td class="subject">{{ HTML::link('ticket/view/' . $ticket->id, $ticket->subject) }}</td>
										<td class="status">{{ Helper::status($ticket->status) }}</td>

									</tr>

								@endforeach

							</tbody>

						</table>

					@endif

				</div>

				<div class="tab-pane" id="assigned">

					@if (empty($assigned))
					
						<div class="alert alert-info">

							No hay consultas abiertas asignadas.

						</div>

					@else

						<table class="table table-bordered table-striped">

							<thead>

								<tr>

									<th>#</th>
									<th>Asunto</th>
									<th class="center">Estatus</th>

								</tr>

							</thead>

							<tbody>

								@foreach($assigned as $ticket)

									<tr>

										<td>{{ HTML::link('ticket/view/' . $ticket->id, $ticket->id) }}</td>
										<td class="subject">{{ HTML::link('ticket/view/' . $ticket->id, $ticket->subject) }}</td>
										<td class="status">{{ Helper::status($ticket->status) }}</td>

									</tr>
								
								@endforeach

							</tbody>

						</table>

					@endif

				</div>

			</div>
		
		</div>

	</div>

</div>

@endsection