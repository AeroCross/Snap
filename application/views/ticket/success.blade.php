@layout('layouts/default')

@section('content')

<!-- form div -->
<div class="offset3 span6">

	<div class="page-header">

		<h4>Consulta Recibida</h4>

	</div>
	
	<p>Su número de consulta es el <strong>#{{ $ticket->id }}</strong> — este es su número identificador para que pueda hacerle seguimiento luego mediante el {{ HTML::link('tickets', 'listado') }}.</p>

	<p>Recibirá una notificación a su correo electrónico en el momento en que sea respondida.</p>

	<br />

	<!-- options -->
	<div class="btn-group pagination-centered">

		<a href="{{ URL::to('ticket/add') }}" class="btn">{{ Helper::icon('plus') }} Crear otra consulta</a>
		<a href="{{ URL::to('tickets') }}" class="btn">{{ Helper::icon('reorder') }} Listado de consultas</a>
		<a href="{{ URL::to('dashboard') }}" class="btn">{{ Helper::icon('home') }} Ir al inicio</a>

	</div>
	<!-- end options -->

</div>

@endsection