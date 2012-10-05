<!-- notifications -->
<?php echo $this->presenter->notification->show(); ?>

<div class="page-header">

	<h4>Compañías</h4>

</div>

<!-- add new company -->
<?php echo form_open('admin/companies', array('class' => 'form-search')); ?>

	<div class="input-append">

		<input type="text" name="name" id="name" placeholder="Nueva compañía" /><button class="btn btn-primary submit"><?php echo icon('plus'); ?>&nbsp;</button>

	</div>

<?php echo form_close(); ?>

<!-- companies table -->
<div class="row">

	<div class="span8">

		<?php echo $companies; ?>
	
	</div>

</div>