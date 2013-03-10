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

						<ul class="nav nav-tabs nav-stacked">

							@foreach($latest as $ticket)

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

				<div class="tab-pane" id="assigned">

					@if (empty($assigned))
					
						<div class="alert alert-info">

							No hay consultas abiertas asignadas.

						</div>

					@else

						<ul class="nav nav-tabs nav-stacked">

							@foreach($assigned as $ticket)

								<li class="{{ $ticket->status }}">

									<a href="{{ URL::to('ticket/view/' . $ticket->id)">
										{{ $ticket->subject }} <span class="pull-right">{{ Helper::icon('chevron-right') }}</span><br />
										<small class="muted">{{ $ticket->date_created }}</small>
									</a>
								
								</li>

							@endforeach

						</ul>

					@endif

				</div>

			</div>
		
		</div>

	</div>

</div>

@endsection