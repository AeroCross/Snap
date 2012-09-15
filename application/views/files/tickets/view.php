<div class="page-header">

	<h4>Consulta # <?php echo $ticket->id; ?> <small>&mdash; <?php echo $ticket->subject; ?></small></h4>

</div>

<!-- ticket status -->
<div class="row">

	<div class="span12">

		<!-- info -->
		<table class="table table-striped table-bordered table-hover">

			<thead>
				<tr>
					<th>Hecha por</th>
					<th>Estatus</th>
					<th>Aperturada</th>
					<th>Modificada</th>
					<th>Departamento</th>
					<th>Asignada a</th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td><?php echo safe_mailto($reporter->email, $reporter->firstname . ' ' . $reporter->lastname); ?></td>
					<td><?php echo status($ticket->status); ?></td>
					<td><?php echo $ticket->date_created; ?></td>
					<td><?php echo $ticket->date_modified; ?></td>
					<td><?php echo $this->saav_department->getDepartment($ticket->department)->name; ?></td>
					<td><?php echo $this->presenter->ticket->showAssignedTo($ticket->id); ?></td>
				</tr>

			</tbody>

		</table>
		<!-- end info -->

		<!-- files -->
		<table class="table table-striped table-bordered table-hover">

			<thead>
				<tr>
					<th>Archivo</th>
					<th>Tipo</th>
					<th>Modificado</th>
					<th>Acción</th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td>Ley del Ejercicio de la Ingeniería.pdf</td>
					<td>PDF</td>
					<td></td>
					<td></td>
				</tr>
			</tbody>

		</table>

	</div>

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

		<p><?php echo nl2br(htmlentities($ticket->content, ENT_NOQUOTES, 'UTF-8')); ?></p>

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

					<select name="assigned_to" id="assigned_to">

						<?php echo $this->presenter->form->admins(); ?>
						<?php echo $this->presenter->form->support(FALSE); ?>

					</select>

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