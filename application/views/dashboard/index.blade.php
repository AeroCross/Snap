@layout('layouts/default')

@section('content')

<div class="row padded">
	
	<!-- tabsgroup -->
	<div class="span5">
		
		<!-- tabs -->
		<div class="tabbable">
		
			<ul class="nav nav-tabs">
				
				<li class="active"><a href="#latest" data-toggle="tab">Recientes</a></li>
				<li><a href="#assigned" data-toggle="tab">Asignadas <span class="badge badge-{{ $data->badge }}">{{ $data->totalAssigned }}</span></a></li>

			</ul>
			
			<!-- tabcontent -->
			<div class="tab-content">

				<!-- latest -->
				<div class="tab-pane active" id="latest">

					@if (empty($data->latest))

					<div class="alert alert-info">

						<p>No hay consultas abiertas asignadas.</p>

					</div>

					@else

						<ul class="nav nav-tabs nav-stacked">

							@foreach($data->latest as $ticket)

								<li class="{{ $ticket->status }}">
								
									<a href="{{ URL::to('ticket/' . $ticket->id) }}">
										{{ $ticket->subject }} <span class="pull-right">{{ Helper::icon('chevron-right') }}</span><br />
										<small class="muted">{{ $ticket->created_at }}</small>
									</a>
								
								</li>

							@endforeach

						</ul>

						<small class="pull-right"><strong>Consultas:</strong> {{ $data->total }} — <strong>Abiertas:</strong> {{ $data->open }}</small>

					@endif

				</div>
				<!-- end latest -->

				<!-- assigned -->
				<div class="tab-pane" id="assigned">

					@if (empty($data->assigned))
					
						<div class="alert alert-info">

							No hay consultas abiertas asignadas.

						</div>

					@else

						<ul class="nav nav-tabs nav-stacked">

							@foreach($data->assigned as $ticket)

								<li class="{{ $ticket->status }}">

									<a href="{{ URL::to('ticket/' . $ticket->id) }}">
										{{ $ticket->subject }} <span class="pull-right">{{ Helper::icon('chevron-right') }}</span><br />
										<small class="muted">{{ $ticket->created_at }}</small>
									</a>
								
								</li>

							@endforeach

						</ul>

					@endif

				</div>
				<!-- end assigned -->

			</div>
			<!-- end tabcontent -->
		
		</div>
		<!-- end tabs -->

	</div>
	<!-- end tabsgroup -->

	<!-- graphs -->
	<div class="span6 offset1">

		<div class="row" id="graph-week">

		</div>

		<div class="row" id="graph-people">

		</div>


	</div>
	<!-- end graphs -->
	
</div>

@endsection

@section('postscripts')
	<script>

		jQuery(document).ready(function() {
			$('#graph-week').highcharts({
				chart: {
					type: 'area'
				},
				title: {
					text: 'Total de Consultas (Últimos 7 días)',
				},
				xAxis: {
					title: {
						text: 'Días'
					},
					categories: ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'],
				},
				yAxis: {
					title: {
						text: 'Consultas'
					}
				},
				series: [{ // people and amount of tickets
					name: 'Mario',
					data: [4, 17, 50, 17, 2, 22, 2]
				}, {
					name: 'Juliet',
					data: [1, 10, 4, 1, 5, 11, 32]
				}]
			});
		});

		jQuery(document).ready(function() {
			$('#graph-people').highcharts({
				chart: {
					type: 'column'
				},
				title: {
					text: 'Cantidad de Consultas por Persona',
				},
				xAxis: {
					title: {
						text: 'Días'
					},
					categories: ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'],
				},
				yAxis: {
					title: {
						text: 'Consultas'
					}
				},
				series: [{ // people and amount of tickets
					name: 'Mario',
					data: [4, 17, 50, 17, 2, 22, 2]
				}, {
					name: 'Juliet',
					data: [1, 10, 4, 1, 5, 11, 32]
				}]
			});
		});

	</script>
@endsection