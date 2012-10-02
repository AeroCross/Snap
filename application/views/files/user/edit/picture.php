<!-- notifications -->
<?php echo $this->presenter->notification->show(); ?>

<div class="page-header">

	<h4>Cambiar Imagen de Perfil</h4>

</div>

<div class="row">

	<?php echo form_open_multipart('user/edit/picture', array('class' => 'form-horizontal')); ?>

		<!-- image -->
		<div class="control-group">

			<label for="password" class="control-label">Imagen de perfil</label>

			<div class="controls">

				<input type="file" name="picture" id="picture" value="" /><span class="help-inline"><strong>Formatos permitidos:</strong> jpg, jpeg, png</span>
				<p class="help-block">La imagen debe ser cuadrada (e.g <strong>200x200</strong>), y no mayor de <strong>2MB</strong>.</p>

			</div>

		</div>

		<!-- current -->
		<div class="control-group">

			<label for="current" class="control-label">Imagen actual</label>

			<div class="controls">

				<ul class="thumbnails">

					<li class="thumbnail">

						<img src="http://placehold.it/200x200" alt="" />

					</li>

				</ul>

			</div>

		</div>

		<!-- submit image -->
		<div class="form-actions">

			<div class="btn-group">

				<button class="submit btn btn-primary"><?php echo icon('ok-sign'); ?> Actualizar Imagen</button>
				<?php echo anchor('user/profile', icon('circle-arrow-left') . ' Regresar', array('class' => 'btn')); ?>

			</div>

		</div>

	<?php echo form_close(); ?>

</div>