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
		
			<li><strong>Departamento:</strong> <?php echo $this->saav_department->getDepartment($ticket->department)->name; ?></li>
		
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

		<p><?php echo nl2br($ticket->content); ?></p>

	</div>

</div>
<!-- end first message -->

<!-- other messages here -->
<?php foreach($messages as $message): ?>
<?php $user = $this->saav_user->data('firstname, lastname, email')->id($message->user_id)->get(); ?>

<div class="row">

	<div class="span3">

		<ul>

			<li><?php echo $user->firstname . ' ' . $user->lastname; ?></li>
			<li><?php echo $message->date; ?></li>

		</ul>

	</div>

	<div class="span8 well">

		<p><?php echo nl2br($message->content); ?></p>

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

			<?php if ($this->saav_user->permission('support')): ?>

			<!-- department -->
			<div class="control-group">

				<label for="department" class="control-label">Departamento</label>

				<div class="controls">

					<select name="department" id="department">

						<?php echo $this->presenter->form->departments(); ?>

					</select>

				</div>

			</div>

			<!-- assign to -->
			<div class="control-group">

				<label for="assign_to" class="control-label">Asignar a</label>

				<div class="controls">

					<select name="assign_to" id="assign_to">

						<option></option>

					</select>

				</div>

			</div>

			<!-- assign to -->
			<div class="control-group">

				<label for="eta" class="control-label">Tiempo Estimado</label>

				<div class="controls">

					<input type="text" class="span1" name="eta-value" id="eta" />
					
					<select name="eta-range" class="span2">

						<option>Minuto/s</option>
						<option>Hora/s</option>
						<option>Día/s</option>
						<option>Semana/s</option>

					</select>

					<p class="help-block">Para completar o responder la consulta.</p>

				</div>

			</div>

			<?php endif; ?>

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