<div class="page-header">

	<h4>Consulta # <?php echo $ticket->id; ?> <small>&mdash; <?php echo $ticket->subject; ?></small></h4>

</div>

<!-- ticket status -->
<div class="row">

	<!-- reporter -->
	<div class="span3">
			
		<ul>
			<li><strong>Hecha por:</strong> <?php echo safe_mailto($reporter->email, $reporter->firstname . ' ' . $reporter->lastname); ?></li>
			<li><strong>Estatus:</strong> <?php echo $ticket->status; ?></li>
		</ul>

	</div>

	<!-- ticket -->
	<div class="span6">
		<ul>
			<li><strong>Aperturada:</strong> <?php echo $ticket->date_created; ?></li>
			<li><strong>Última modificación:</strong> <?php echo $ticket->date_modified; ?></li>
		</ul>
	</div>

</div>
<!-- end ticket status -->

<div class="page-header">

	<h4>Detalles de la Consulta</h4>

</div>

<!-- first message -->
<div class="row">

	<div class="span3">

		<ul>

			<li><?php echo $reporter->firstname . ' ' . $reporter->lastname; ?></li>
			<li><?php echo $ticket->date_created; ?></li>

		</ul>

	</div>

	<div class="span8 well">

		<p><?php echo $ticket->content; ?></p>

	</div>

</div>
<!-- end first message -->

<!-- other messages here -->

<div class="page-header">
	
	<h4>Reabrir consulta</h4>

</div>

<!-- reopen -->
<div class="row">

	<?php echo form_open('message/add', array('class' => 'form-horizontal')); ?>

		<!-- form -->
		<div class="span12">

			<!-- content -->
			<div class="control-group">

				<label for="content" class="control-label">Mensaje</label>

					<div class="controls">

						<textarea name="content" id="content" class="input-xxlarge" rows="10" value=""></textarea>
						<p class="help-block">Ingrese información adicional a su consulta, sugerida por ud. o por el personal de soporte.</p>

					</div>

				</label>

			</div>
			<!-- end content -->

			<!-- status -->
			<div class="control-group">

				<label for="status" class="control-label">Marcar como Cerrado</label>

				<div class="controls">

					<label class="checkbox">

						<input type="checkbox" name="status" value="closed" id="status" />

					</label>

				</div>

			</div>
			<!-- end status -->

			<!-- actions -->
			<div class="form-actions">

				<input type="submit" class="btn btn-primary" value="Enviar" />

			</div>
			<!-- end actions -->

		</div>
		<!-- end form -->

	<?php echo form_close(); ?>

</div>