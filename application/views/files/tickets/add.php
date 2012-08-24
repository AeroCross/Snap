<div class="page-header">

	<h4>Nueva Consulta</h4>

</div>

<div class="row">

	<!-- form container -->
	<div class="span6">

		<?php echo form_open('ticket/process', array('class' => 'form-horizontal')); ?>

			<fieldset>

				<!-- department -->
				<div class="control-group">

					<label for="department" class="control-label">Departamento</label>

					<div class="controls">

						<select name="department" id="department">

							<option value=""></option>
							<option value="1">Soporte Técnico</option>
							<option value="2">Administración</option>

						</select>

					</div>

				</div>
				<!-- end department -->

				<!-- title -->
				<div class="control-group">

					<label for="subject" class="control-label">Asunto</label>

					<div class="controls">

						<input type="text" name="subject" id="subject" value="" />
						<p class="help-block">Describa brevemente su consulta</p>

					</div>

				</div>
				<!-- end title -->

				<!-- content -->
				<div class="control-group">

					<label for="content" class="control-label">Contenido</label>

					<div class="controls">

						<textarea name="content" id="content" rows="5"></textarea>
						<p class="help-block">Detalle la situación que presenta</p>

					</div>

				</div>
				<!-- end content -->

				<!-- carbon copy -->
				<div class="control-group">

					<label for="cc" class="control-label">Copia a</label>

					<div class="controls">

						<input type="text" name="cc" id="cc" value="" />
						<p class="help-block">Solo un correo electrónico</p>

					</div>

				</div>
				<!-- end title -->

				<div class="form-actions">

					<?php echo anchor('dashboard', icon('plus') . ' Nueva Consulta', array('class' => 'btn btn-primary submit')); ?>
					<?php echo anchor('dashboard', 'Regresar', array('class' => 'btn')); ?>

				</div>

			</fieldset>

		<?php echo form_close(); ?>

	</div>
	<!-- end form container-->

	<!-- form help -->
	<div class="span6">

		<h4>Información</h4>

		<p>Ingrese una nueva solicitud si necesita:</p>

		<ul>

			<li>Hacer un cambio o una corrección a su sitio web</li>
			<li>Diseñar o añadir un nuevo objeto de aprendizaje</li>
			<li>Cambiar una configuración de su aula virtual</li>
			<li>Reportar una falla en su sitio o aula virtual</li>
			<li>Efectuar una pregunta</li>

		</ul>

		<p><strong>Soporte Técnico</strong> se encargará de su sitio web, servidor o de su aula virtual y todo lo que esto involucra. En cambio, la <strong>Administración</strong> se encargará de costos, logística y desarrollo del aula virtual y sus contenidos.</p>

		<br />

		<h4>¿Ha reportado este problema antes?</h4>

		<p>Si es la continuación a una consulta previamente abierta, o desea agregar más información, <?php echo anchor('#', 'vea el listado'); ?> y dirijase a su consulta para poder brindarle un mejor servicio.</p>

	</div>

</div>
<!-- end row -->