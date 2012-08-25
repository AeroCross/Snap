<div class="page-header">

	<h4>Consulta # <?php echo $ticket->id; ?> <small>&mdash; <?php echo $ticket->subject; ?></small></h4>

</div>

<!-- ticket status -->
<div class="row">

	<!-- info -->
	<div class="span3">
			
		<ul>
		
			<li><strong>Hecha por:</strong> <?php echo safe_mailto($reporter->email, $reporter->firstname . ' ' . $reporter->lastname); ?></li>
			<li><strong>Estatus:</strong> <?php echo status($ticket->status); ?></li>
		
		</ul>

	</div>

	<div class="span3">
		
		<ul>
		
			<li><strong>Aperturada:</strong> <?php echo $ticket->date_created; ?></li>
			<li><strong>Modificada:</strong> <?php echo $ticket->date_modified; ?></li>
		
		</ul>

	</div>

	<div class="span3">
		
		<ul>
		
			<li><strong>Departamento:</strong> <?php echo $this->sav_department->getDepartment($ticket->department)->name; ?></li>
		
		</ul>

	</div>
	<!-- end info -->

</div>
<!-- end ticket status -->

<div class="page-header">

	<h4>Detalles de la Consulta</h4>

</div>

<!-- notification -->
<?php echo $this->presenter->notification->show(); ?>

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
<?php foreach($messages as $message): ?>
<?php $user = $this->sav_user->data('firstname, lastname, email')->id($message->user_id)->get(); ?>

<div class="row">

	<div class="span3">

		<ul>

			<li><?php echo $user->firstname . ' ' . $user->lastname; ?></li>
			<li><?php echo $message->date; ?></li>

		</ul>

	</div>

	<div class="span8 well">

		<p><?php echo $message->content; ?></p>

	</div>

</div>

<?php endforeach; ?>
<!-- other messages here -->

<div class="page-header">
	
	<h4>Reabrir consulta</h4>

</div>

<!-- reopen -->
<div class="row">

	<?php echo form_open('tickets/view/' . $ticket->id, array('class' => 'form-horizontal')); ?>

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
				<?php echo anchor('dashboard', 'Regresar', array('class' => 'btn')); ?>

				<!-- extra info -->
				<input type="hidden" name="ticket_id" value="<?php echo $ticket->id; ?>" />

			</div>
			<!-- end actions -->

		</div>
		<!-- end form -->

	<?php echo form_close(); ?>

</div>