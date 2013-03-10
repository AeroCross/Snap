@layout('layouts/default')

@section('content')

<div class="row padded">
	
	<!-- tabsgroup -->
	<div class="span4">
		
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

					<div class="btn-group">

						<button class="btn">{{ Helper::icon('search') }} Buscar</button>

					</div>

					<br /><br />
				
					@if (empty($data->latest))

					<div class="alert alert-info">

						<p>No hay consultas abiertas asignadas.</p>

					</div>

					@else

						<ul class="nav nav-tabs nav-stacked">

							@foreach($data->latest as $ticket)

								<li class="{{ $ticket->status }}">
								
									<a href="{{ URL::to('ticket/view/' . $ticket->id) }}">
										{{ $ticket->subject }} <span class="pull-right">{{ Helper::icon('chevron-right') }}</span><br />
										<small class="muted">{{ $ticket->date_created }}</small>
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

						<div class="btn-group">

							<button class="btn">{{ Helper::icon('search') }} Buscar</button>
							<button class="btn">{{ Helper::icon('th-list') }} Todas</button>

						</div>

						<br /><br />

						<ul class="nav nav-tabs nav-stacked">

							@foreach($data->assigned as $ticket)

								<li class="{{ $ticket->status }}">

									<a href="{{ URL::to('ticket/view/' . $ticket->id) }}">
										{{ $ticket->subject }} <span class="pull-right">{{ Helper::icon('chevron-right') }}</span><br />
										<small class="muted">{{ $ticket->date_created }}</small>
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

</div>

@endsection