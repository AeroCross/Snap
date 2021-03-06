@layout('layouts/default')

@section('content')
<div class="row padded">

	<!-- initial thread -->
	<div class="span5">

		<!-- notification -->
		{{ Notification::show() }}

		<!-- opening message -->

		<!-- ticket status -->
		{{ Form::open('ticket/status/' . $ticket->id, 'PUT', array('class' => 'form-status pull-right')) }}

			<div class="btn-group">

				<button class="btn btn-small" name="status" value="closed" title="Cerrar">{{ Helper::icon('ok') }}</button>
				<button class="btn btn-small" name="status" value="open" title="Reabrir">{{ Helper::icon('refresh') }}</button>
				<button class="btn btn-small" name="status" value="hold" title="En espera">{{ Helper::icon('time') }}</button>
				<button class="btn btn-small" name="status" value="in-progress" title="En proceso">{{ Helper::icon('star-half-empty') }}</button>

			</div>

			<!-- update this ticket -->
			<input type="hidden" name="ticket_id" value="{{ $ticket->id }}" />

		{{ Form::close() }}
		
		<!-- subject -->
		<h5>{{ $ticket->subject }}</h5>

		<!-- reporter details -->
		<p>{{ HTML::mailto($reporter->email, $reporter->fullname) }} • <small>{{ $ticket->created_at }}</small></p>

		<!-- separation of info -->
		<br />

		<!-- ticket content -->
		{{ Markdown($ticket->content) }}

		<!-- separation of metadata -->
		<br />

		<!-- metadata -->
		<p class="pull-left"><small><strong>Departamento:</strong> {{ $department->name }}

			@if (!empty($ticket->assigned_to))

				<br /><strong>Asignado a:</strong> {{ $assigned->firstname . ' ' . $assigned->lastname }}

			@endif

		</small></p>

		<p class="pull-right"><small><strong>Estatus:</strong> {{ Helper::status($ticket->status) }}</small></p>

		<!-- separate from form -->
		<br />
		<br />
		<br />

		<fieldset>

			<legend>Actualizar consulta</legend>

			<!-- form -->
			{{ Form::open_for_files('ticket/update/' . $ticket->id, 'POST') }}

				<!-- department -->
				<div class="control-group">

					<label for="department" class="control-label">Departamento</label>

					<div class="controls">

						<select name="department" id="department" class="input-large">

							{{ Fields::departments() }}

						</select>

					</div>

				</div>
				<!-- end department -->

				<!-- assign -->
				<div class="control-group">

					<label for="assign" class="control-label">Asignar a</label>

					<div class="controls">

						<select name="assign" id="assign" class="input-large">

							{{ Fields::members() }}

						</select>

						<span class="help-block">Si asigna a un especialista, no se le notificará al departamento</span>

					</div>

				</div>
				<!-- end assign -->

				<!-- content -->
				<div class="wmd-panel">
				
					<div class="control-group">

						<!-- no label in here -->
						<br />

						<div id="wmd-button-bar"></div>

						<div class="controls">

							<textarea name="content" id="wmd-input" rows="10" class="span5 wmd-input"></textarea>

						</div>

					</div>

				</div>
				<!-- end content -->

				<!-- status -->
				<div class="control-group">

					<label for="status">Estatus</label>

					<div class="controls">

						<select name="status" class="input-large" id="status">

							<option value="closed">Cerrado</option>
							<option value="open">Abierto</option>
							<option value="hold">En espera</option>
							<option value="in-progress">En proceso</option>

						</select>

					</div>

				</div>
				<!-- end status -->

				<!-- file -->
				<div class="control-group hidden" id="file-field">
					
					<!-- hax -->
					<br />

					<label for="file" class="control-label">Enviar un Archivo</label>

					<div class="controls">

						{{ Form::file('file', array('id' => 'file')) }}<span class="help-inline"><strong>Tamaño máximo:</strong> {{ ini_get('upload_max_filesize') }}B</span><br /><span class="help-block">Si tiene que subir más de un archivo, comprímalo primero.</span>

					</div>

				</div>
				<!-- end file -->

				<!-- separation from the last field -->
				<br />

				<div class="btn-group">
						
					<button class="btn btn-primary">{{ Helper::icon('reply') }} Responder</button>
					<button class="btn" id="file-field-show" type="button">{{ Helper::icon('paper-clip') }} Adjuntar</button>

				</div>

				<!-- additional information -->
				<input type="hidden" name="ticket_id" value="{{ $ticket->id }}" />

			{{ Form::close() }}
			<!-- end form -->

		</fieldset>

	</div>
	<!-- end initial thread -->

	<!-- responses -->
	<div class="span6 offset1">

		<div class="tabbable">

			<ul class="nav nav-tabs nav-tabs-google">

				<li class="active"><a href="#messages" data-toggle="tab">{{ Helper::icon('comments-alt') }} Mensajes</a></li>
				<li><a href="#files" data-toggle="tab">{{ Helper::icon('folder-open') }} Archivos <span class="badge badge-important">{{ count($files) }}</span></a></li>

			</ul>

		</div>

		<div class="tab-content">

			<div class="tab-pane active" id="messages">

				@if (empty($messages))

					<div class="alert">

						<span class="block center">No existen respuestas registradas para la consulta</span>

					</div>

				@else

					<?php // @TODO: optimize for users — WHEN I'M DONE
						foreach($messages as $message):
							$sender				= User::find($message->user_id);
							$sender->fullname	= $sender->firstname . ' ' . $sender->lastname;
						?>

						{{ HTML::mailto($sender->email, $sender->fullname) }} • <small>{{ $message->created_at }}</small>

						{{ Markdown($message->content) }}

						<hr />

						<?php
						endforeach;
					?>

				@endif

			</div>

			<div class="tab-pane" id="files">

				@if (!empty($files))

					<table class="table table-bordered table-striped table-files">

						<thead>

							<tr>

								<th>Nombre</th>
								<th>Enviado</th>

							</tr>

						</thead>

						<tbody>

							@foreach($files as $file) 

							<?php
								// all of this must be in a helper function or something
								$user = $file['user'];
								$name = $file['name'];
								$size = number_format((($file['info']['size'] / 1024) / 1024), 2, ',', '.') . ' MB';
								$time = date('Y-m-d G:i:s', $file['info']['mtime']);

								// just in case someone's being funny and tries to upload to a user folder who doesn't exist
								if (!isset($users[$user])) {
									$users[$user]				= new StdClass;
									$users[$user]->found		= false;
									$users[$user]->email		= '';
									$users[$user]->firstname	= 'Usuario';
									$users[$user]->lastname		= 'no encontrado';
								}
							?>
								<tr>

									<td>

										<strong>{{ HTML::link('file/download/' . Helper::encode_safe_base64($ticket->id . '/' . $user . '/' . $name), $name) }}</strong><br />
										<img src="{{ Helper::fileicon($file['ext']) }}" alt="" /> <small>{{ Helper::filetype($file['ext']) }}</small> <br/ >
										<small>{{ $size }}</small>

									</td>

									@if ($users[$user]->found === false)
										<td><span class="muted">{{ $users[$user]->firstname . ' ' . $users[$user]->lastname  }}</span><br />{{ $time }}</td>
									@else
										<td>{{ HTML::mailto($users[$user]->email, $users[$user]->firstname . ' ' . $users[$user]->lastname)  }}<br />{{ $time }}</td>
									@endif

								</tr>

							@endforeach

						</tbody>

					</table>

				@else

					<div class="alert alert-info center">

						No se han subido archivos a la consulta

					</div>

				@endif

			</div>

		</div>

	</div>
	<!-- end responses -->

</div>

@endsection

@section('postscripts')
	
	<script>

		jQuery('#file-field-show').on('click', function() {
			jQuery('#file-field').fadeIn(300);
		});

	</script>

@endsection