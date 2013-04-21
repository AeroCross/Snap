<p>{{ HTML::mailto($from->email, $from->firstname . ' ' . $from->lastname) }} le ha asignado una nueva consulta:</p>

<blockquote>
	
	<h4>{{ HTML::link('ticket/' . $ticket->id, $ticket->subject) }}</h4>

	<p>{{ $content }}</p>

</blockquote>

<p>Para acceder a la consulta, ingrese a la siguiente dirección: {{ HTML::link('ticket/' . $ticket->id); }}</p>