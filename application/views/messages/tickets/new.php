<p>Una nueva consulta ha sido agregada al sistema por <?php echo $reported_by; ?></p>

<blockquote>

	<pre>
	
		<?php echo $content; ?>
	
	</pre>

</blockquote>

<p>Para acceder a esta consulta: <?php echo anchor('tickets/view/' . $ticket_id); ?></p>