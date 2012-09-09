<div class="page-header">

	<h4>Reportar un Problema</h4>

</div>

<!-- notifications -->
<?php echo $this->presenter->notification->show(); ?>

<div class="row">

	<div class="span7">

		<?php echo form_open('report', array('class' => 'form-horizontal')); ?>

			<div class="control-group">

				<label class="control-label" for="type">Tipo de Reporte</label>

				<div class="controls">

					<label class="radio"><input type="radio" name="type" value="issue" /> <strong>Problema</strong> &mdash; error en el programa, comportamiento no deseado, etc.</label>
					<label class="radio"><input type="radio" name="type" value="suggestion" /> <strong>Sugerencia</strong> &mdash; mejoras, nuevas características, etc.</label>

				</div>

			</div>

			<div class="control-group">

				<label class="control-label" for="message">Mensaje</label>

				<div class="controls">

					<textarea class="span4" rows="10"></textarea>
					<p class="help-block">Asegúrese de ser lo más detallado que pueda.</p>
					<p class="help-block">Soporte técnico se comunicará con usted tan pronto sea posible.</p>

				</div>

			</div>

			<div class="form-actions">

				<input type="submit" value="Reportar" name="submit" class="btn btn-primary" />
				<?php echo anchor('dashboard', 'Regresar', array('class' => 'btn')); ?>

			</div>

		<?php echo form_close(); ?>

	</div>

	<div class="span5">

		<h4>Reportando a Soporte Técnico</h4>

		<p>Puede reportar por esta vía cualquier problema que presente con el sistema mediante este formulario.</p>

		<ul>

			<li>Errores ortográficos</li>
			<li>Mensajes de error</li>
			<li>Calculos incorrectos</li>
			<li>Información faltante</li>
			<li>Enlaces rotos</li>

		</ul>

		<p>Entre otro tipo de errores. El personal de soporte técnico se comunicará con usted personalmente vía correo electrónico para solventar su situación, de necesitar información adicional o para reportar que el error ha sido corregido satisfactoriamente.</p>

		<h5>Sugerencias</h5>

		<p>¿Utiliza el sistema pero necesita alguna característica adicional? ¿Tiene una idea que puede mejorar el sistema y su experiencia en él?</p>

		<p>Escríbanos detallando sus idead y sus necesidades y nos encargaremos de evaluar e implementar las mejoras en el sistema.</p>

</div>