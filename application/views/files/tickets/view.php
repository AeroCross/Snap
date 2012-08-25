<!-- reporter -->
<div class="span4">

	<h4>Consulta # <?php echo $ticket->id; ?></h4>
	
	<ul>
		<li><strong>Reportado por:</strong> <?php echo safe_mailto($reporter->email, $reporter->firstname . ' ' . $reporter->lastname); ?></li>
	</ul>

</div>

<!-- ticket -->
<div class="span8">

</div>