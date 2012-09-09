<div class="page-header">

	<h4>Todas las Consultas</h4>

</div>

<!-- search form -->
<?php echo form_open('admin/tickets/all', array('class' => 'form-search')); ?>

	<div id="search-box">

		<!-- search fields -->
		<select name="search" id="search" class="span2">

			<option value="id"># de Consulta</option>
			<option value="subject">Asunto</option>
			<option value="reported_by">Reportado por</option>
			<option value="company">Compañía</option>
			<option value="department">Departamento</option>
			<option value="status">Estatus</option>

		</select>
		<!-- end search fields -->

		
		<!-- departments -->
		<select name="value" id="department" class="hide" disabled="disabled">
			
			<?php echo $this->presenter->form->departments();?>
		
		</select>
		<!-- end departments -->

		<!-- status -->
		<select name="value" id="status" class="hide" disabled="disabled">
			
			<option value=""></option>
			<option value="open">Abierto</option>
			<option value="closed">Cerrado</option>
		
		</select>
		<!-- end status -->

		<!-- companies -->
		<select name="value" id="company" class="hide" disabled="disabled">

			<?php echo $this->presenter->form->companies(); ?>

		</select>
		<!-- end companies -->

		<!-- users -->
		<select name="value" id="reported_by" class="hide" disabled="disabled">

			<optgroup label="Administradores">
				<?php echo $this->presenter->form->admins(); ?>
			</optgroup>

			<optgroup label="Soporte Técnico">
				<?php echo $this->presenter->form->support(FALSE); ?>
			</optgroup>

			<optgroup label="Clientes">
				<?php echo $this->presenter->form->users(FALSE); ?>
			</optgroup>

		</select>
		<!-- end users -->

		<input type="text" name="value" id="value" class="span2" autofocus="autofocus" /><span class="help-inline"><button class="btn" class="submit"><?php echo icon('search'); ?> Buscar</button></span>
	
	</div>
<?php echo form_close(); ?>
<!-- end search form -->

<!-- table -->
<div class="row">

	<div class="span12">

		<?php echo $tickets; ?>

	</div>

</div>
<!-- end table -->