@layout('layouts/default')

@section('content')

<div class="row">
	
	<!-- tabsgroup -->
	<div class="span5">

		<div class="page-header">

			<h4>Consultas <small>más recientes y asignadas</small><a href="{{ URL::to('tickets') }}" class="btn pull-right" title="Todas las Consultas" data-placement="bottom">{{ Helper::icon('list') }}</a></h4>

		</div>
		
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

		<div class="page-header">

			<h4>Estadísticas <small>sobre actividad reciente</small><a href="#" class="btn pull-right" title="Más estadísticas" data-placement="bottom">{{ Helper::icon('signal') }}</a></h4>

		</div>

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
					text: 'Consultas en los últimos 7 días',
				},
				xAxis: {
					title: {
						text: 'Días'
					},
					categories: {{ $week_days }},
				},
				yAxis: {
					title: {
						text: 'Consultas'
					}
				},
				series: [{ // people and amount of tickets
					name: 'Consultas',
					data: {{ $week_tickets }}
				}]
			});
		});

		jQuery(document).ready(function() {
			$('#graph-people').highcharts({
				chart: {
					type: 'bar'
				},
				title: {
					text: 'Total de consultas por Usuario',
				},
				xAxis: {
					title: {
						text: 'Personas'
					},
					categories: {{ $tickets_users }},
				},
				yAxis: {
					title: {
						text: 'Consultas'
					}
				},
				series: [{ // people and amount of tickets
					name: '# de Consultas',
					data: {{ $tickets_total }}
				}]
			});
		});

	</script>
@endsection