<p>{{ HTML::mailto($reporter->email, $reporter->firstname . ' ' . $reporter->lastname) }} ha creado una nueva consulta.</p>

<blockquote>
	
	<h4>{{ HTML::link('ticket/' . $ticket, $input['subject']) }}</h4>

	<p>{{ $input['content'] }}</p>

</blockquote>

<p>Para acceder a la consulta, ingrese a la siguiente dirección: {{ HTML::link('ticket/' . $ticket); }}</p>