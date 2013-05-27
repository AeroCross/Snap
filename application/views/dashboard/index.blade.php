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
				<li><a href="#assigned" data-toggle="tab">Asignadas <span class="badge badge-{{ $badge }}">{{ $assigned->total }}</span></a></li>

			</ul>
			
			<!-- tabcontent -->
			<div class="tab-content">

				<!-- latest -->
				<div class="tab-pane active" id="latest">

					@if (empty($latest->tickets))

					<div class="alert alert-info">

						<p>No existen consultas abiertas. ¿Desea {{ HTML::link('ticket/add', 'crear una nueva') }}?</p>

					</div>

					@else

						<ul class="nav nav-tabs nav-stacked">

							@foreach($latest->tickets as $ticket)

								<li class="{{ $ticket->status }}">
								
									<a href="{{ URL::to('ticket/' . $ticket->id) }}">
										{{ $ticket->subject }} <span class="pull-right">{{ Helper::icon('chevron-right') }}</span><br />
										<small class="muted">{{ $ticket->created_at }}</small>
									</a>
								
								</li>

							@endforeach

						</ul>

						<small class="pull-right"><strong>Consultas:</strong> {{ $total->amount }} — <strong>Abiertas:</strong> {{ $total->open }}</small>

					@endif

				</div>
				<!-- end latest -->

				<!-- assigned -->
				<div class="tab-pane" id="assigned">

					@if (empty($assigned->tickets))
					
						<div class="alert alert-info">

							No hay consultas asignadas por procesar

						</div>

					@else

						<ul class="nav nav-tabs nav-stacked">

							@foreach($assigned->tickets as $ticket)

								<li class="{{ $ticket->status }}">

									<a href="{{ URL::to('ticket/' . $ticket->id) }}">
										{{ $ticket->subject }} <span class="pull-right">{{ Helper::icon('chevron-right') }}</span><br />
										<small class="muted">{{ $ticket->created_at }}</small>
									</a>
								
								</li>

							@endforeach

						</ul>

					@endif

					<small class="pull-right"><strong>Consultas asignadas:</strong> {{ $assigned->total }} — <strong>Abiertas:</strong> {{ $assigned->open }}</small>

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

		<p class="center"><small><strong>Total de Consultas:</strong> {{ $week->count }} — <strong>Abiertas:</strong> 0</small></p>

		<div class="row padded" id="graph-people">

		</div>

	</div>
	<!-- end graphs -->

	@if ($show == true and !empty($alert->message))

		<!-- system message modal -->
		<div class="modal hide fade" id="system-message">

			@if (!empty($alert->title))

				<div class="modal-header">
				
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			
					<h3>{{ $alert->title}}</h3>

				</div>

			@else

				<br />

			@endif

			<div class="modal-body">
			
				{{ Markdown($alert->message) }}
			
			</div>

			<div class="modal-footer">

				<a href="#" class="btn" id="alert-close-forever">{{ Helper::icon('remove') }} Cerrar y no mostrar de nuevo</a>
				<a href="#" class="btn" id="alert-close">{{ Helper::icon('ok') }} Cerrar</a>
			
			</div>

		</div>
		<!-- end system message modal -->

	@endif

</div>

@endsection

@section('postscripts')

	<script>

		var base = '{{ URL::base() }}';

		// tickets in the last 7 days graph
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
						text: 'Días',
						margin: 20
					},
					categories: {{ $week->days }},
				},
				yAxis: {
					title: {
						text: 'Consultas'
					}
				},
				series: [{ // people and amount of tickets
					name: 'Consultas',
					data: {{ $week->tickets }}
				}],
				credits: {
					enabled: false
				},
				legend: {
					enabled: false
				}
			});
		});

		// total tickets by person graph
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
						text: 'Personas',
					},
					categories: {{ $tickets->users }},
				},
				yAxis: {
					title: {
						text: 'Consultas',
						margin: 20
					}
				},
				series: [{ // people and amount of tickets
					name: 'Consultas',
					data: {{ $tickets->total }}
				}],
				credits: {
					enabled: false
				},
				legend: {
					enabled: false
				}
			});
		});

		jQuery(document).ready(function () {
			$('#system-message').modal({show: true, backdrop: 'static'});

			$('#alert-close').on('click', function() {
				$('#system-message').modal('hide');
			});

			// set cookie that prevent this of being loaded again
			$('#alert-close-forever').on('click', function() {
				$.ajax({
					url: base + '/dashboard/hide/alerts',
					type: 'POST',
					data: {
						hide: true
					},
					success: function() {
						$('#system-message').modal('hide');
					},
					dataType: 'json'
				});
			});
		});

	</script>

@endsection