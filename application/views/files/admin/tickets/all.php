<div class="page-header">

	<h4>Todas las Consultas</h4>

</div>

<!-- search form -->
<?php echo form_open('admin/tickets/all', array('class' => 'form-search')); ?>
	
	<!-- search fields -->
	<select name="search" id="search" class="span2">

		<option value="id"># de Consulta</option>
		<option value="subject">Asunto</option>
		<option value="department">Departamento</option>
		<option value="status">Estatus</option>

	</select>
	<!-- end search fields -->

	<select name="value-departments" id="department" class="hide">
		
		<?php echo $this->presenter->form->departments();?>
	
	</select>

	<select name="value-status" id="status" class="hide">
		
		<option value=""></option>
		<option value="open">Abierto</option>
		<option value="closed">Cerrado</option>
	
	</select>

	<!-- submit -->
	<div class="input-append" id="value">

		<input type="text" name="value" id="value" class="span2" /><button class="btn" class="submit"><?php echo icon('search'); ?></button>

	</div>
	<!-- submit -->

<?php echo form_close(); ?>
<!-- end search form -->

<!-- table -->
<div class="row">

	<div class="span12">

		<?php echo $tickets; ?>

	</div>

</div>
<!-- end table -->