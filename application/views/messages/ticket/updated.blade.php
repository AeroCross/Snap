<p>{{ HTML::mailto($from->email, $from->firstname . ' ' . $from->lastname) }} ha actualizado la consulta {{ HTML::link('ticket/' . $ticket->id, $ticket->subject) }}:</p>

<blockquote>
  
  <p>{{ $content }}</p>

</blockquote>

<p>Para acceder a la consulta, ingrese a la siguiente dirección: {{ HTML::link('ticket/' . $ticket->id) }}</p>