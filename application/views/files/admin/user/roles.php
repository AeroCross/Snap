<!-- notifications -->
<?php echo $this->presenter->notification->show(); ?>

<div class="page-header">

	<h4>Asignar roles</h4>

</div>

<div class="row">

	<?php echo form_open('admin/user/roles', array('class' => 'form-horizontal')); ?>

		<div class="span6">

			<div class="control-group">

				<label for="users" class="control-label">Asignar rol a</label>

				<div class="controls">

					<select name="user[]" id="users" multiple="multiple" class="span4" style="height: 500px; overflow: auto">

						<?php echo $this->presenter->role->users(); ?>

					</select>

				</div>

			</div>

			<div class="control-group">

				<label for="assign" class="control-label">Asignar rol de</label>

				<div class="controls">

					<div class="btn-group">

						<button type="submit" name="action" value="1" class="btn btn-warning">Administrador</button>
						<button type="submit" name="action" value="2" class="btn">Soporte Técnico</button>
						<button type="submit" name="action" value="3" class="btn">Cliente</button>

					</div>

				</div>

			</div>

		</div>

		<div class="span5 offset1">

			<div class="row">	

			<legend>Administradores</legend>

				<?php foreach($admins as $admin): ?>
				
					<div class="span1">

						<div class="thumbnail">

							<?php echo $this->presenter->user->avatar($admin->id, 64); ?>
						
						</div>

					</div>

					<div class="span4">

						<h4><?php echo $admin->name; ?> <small><?php echo $admin->company->name; ?></small></h4>

						<p><?php echo safe_mailto($admin->email); ?></p>

					</div>

					<!-- hax -->
					<div class="row">&nbsp;</div>

				<?php endforeach; ?>
			
			</div>

			<!-- hax -->
			<div class="row">&nbsp;</div>
			<!-- endhax -->

			<div class="row">

				<legend>Soporte Técnico</legend>

				<!-- support personel -->
				<?php echo $this->presenter->role->support(); ?>

			</div>

		</div>

	<?php echo form_close(); ?>

</div>