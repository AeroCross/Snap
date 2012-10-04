<div class="page-header">

	<h4>Agregar Usuario</h4>

</div>

	<?php echo form_open('admin/user/add', array('class' => 'form-horizontal')); ?>

		<!-- firstname -->
		<div class="control-group">

			<label for="firstname" class="control-label">Nombres</label>

			<div class="controls">
					
				<input type="text" name="firstname" id="firstname" />

			</div>

		</div>

		<!-- lastname -->
		<div class="control-group">

			<label for="lastname" class="control-label">Apellidos</label>

			<div class="controls">
					
				<input type="text" name="lastname" id="lastname" />

			</div>

		</div>

		<!-- email -->
		<div class="control-group">

			<label for="email" class="control-label">Correo Electrónico</label>

			<div class="controls">
					
				<input type="text" name="email" id="email" />
				<p class="help-block">Asegúrese de que sea una dirección <strong>válida</strong> y <strong>activa</strong></p>

			</div>

		</div>

		<!-- username -->
		<div class="control-group">

			<label for="username" class="control-label">Nombre de Usuario</label>

			<div class="controls">
					
				<input type="text" name="username" id="username" />

			</div>

		</div>

		<!-- password -->
		<div class="control-group">

			<label for="password" class="control-label">Contraseña</label>

			<div class="controls">
					
				<input type="text" name="password" id="password" />

			</div>

		</div>

		<div class="page-header">

			<h4>Administración</h4>

		</div>

		<!-- role -->
		<div class="control-group">

			<label for="" class="control-label">Rol</label>

			<div class="controls">

				<select name="role" id="role">

					<?php echo $this->presenter->form->roles(); ?>

				</select>

			</div>

		</div>
		
		<!-- company -->
		<div class="control-group">

			<label for="company" class="control-label">Compañía</label>

			<div class="controls">

				<select name="company" id="company">

					<?php echo $this->presenter->form->companies(); ?>

				</select>

			</div>

		</div>


		<div class="form-actions">

			<div class="btn-group">

				<button class="btn btn-primary"><?php echo icon('plus'); ?> Agregar Usuario</button>
				<a href="" class="btn"><?php echo icon('circle-arrow-left'); ?> Regresar</a>

			</div>

		</div>

	<?php echo form_close(); ?>