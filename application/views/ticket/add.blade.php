@layout('layouts/default')

@section('content')

<div class="page-header">

	<h4>Nueva Consulta</h4>

</div>

<!-- form div -->
<div class="span6">
	
	{{ Form::open_for_files('ticket/add', 'PUT', array('class' => 'form-horizontal')) }}

		<!-- department -->
		<div class="control-group">

			<label for="department" class="control-label">Departamento</label>

			<div class="controls">

				<select name="department" id="department" class="input-large">

					<option value="">Sitios Web</option>

				</select>

			</div>

		</div>
		<!-- end department -->

		<!-- assign -->
		<div class="control-group">

			<label for="assign" class="control-label">Asignar a</label>

			<div class="controls">

				<select name="assign" id="assign" class="input-large">

					<option value=""></option>

				</select>

			</div>

		</div>
		<!-- end assign -->

		<!-- subject -->
		<div class="control-group">

			<label for="subject" class="control-label">Asunto</label>

			<div class="controls">

				<input type="text" name="subject" id="subject" /><span class="help-block">Describa brevemente su solicitud</span>

			</div>

		</div>
		<!-- end subject -->

		<!-- content -->
		<div class="control-group">

			<label for="content" class="control-label">Contenido</label>

			<div class="controls">

				<textarea name="content" id="content" cols="8" rows="10" class="span4"></textarea>

			</div>

		</div>
		<!-- end content -->

		<!-- file -->
		<div class="control-group">

			<label for="file" class="control-label">Enviar un Archivo</label>

			<div class="controls">

				{{ Form::file('file') }}

			</div>

		</div>
		<!-- end file -->

		<div class="form-actions">

			<button class="btn btn-primary submit">{{ Helper::icon('plus') }} Nueva Consulta</button>

		</div>

	{{ Form::close() }}

</div>
<!-- end form div -->

<!-- help text -->
<div class="span4 offset1">

	<h3>Información</h3>

	<p>Para mejorar el tiempo de respuesta, asegúrese de:</p>

	<ul>

		<li>Seleccionar el departamento correcto</li>
		<li>Escribir de forma clara lo que necesita que se haga</li>
		<li>Proveer la mayor información posible</li>
		<li>Si tiene que enviar más de un archivo, comprímalo</li>

	</ul>

	<p>Esto mejorará significativamente el tiempo de respuesta.</p>

	<!-- extra space -->
	<br />

	<h4>¿Ha reportado este problema antes?</h4>

	<p>Si es la continuación a una consulta previamente abierta, o desea agregar más información, {{ HTML::link('tickets', 'vea el listado') }} y dirijase a su consulta para poder brindarle un mejor servicio.</p>

</div>

@endsection