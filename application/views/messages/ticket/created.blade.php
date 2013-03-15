<p>{{ HTML::mailto($reporter->email, $reporter->firstname . ' ' . $reporter->lastname) }} ha creado una nueva consulta.</p>

<blockquote>
	
	<h4>{{ HTML::link('ticket/view/' . $ticket, $input['subject']) }}</h4>

	<p>{{ $input['content'] }}</p>

</blockquote>

<p>Para acceder a la consulta, a la siguiente dirección: {{ HTML::link('ticket/view/' . $ticket); }}</p>