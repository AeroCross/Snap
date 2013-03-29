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

				<button class="btn btn-small" name="status" value="closed">{{ Helper::icon('ok-sign') }} Cerrar</button>
				<button class="btn btn-small" name="status" value="open">{{ Helper::icon('exclamation-sign') }} Reabrir</button>
				<button class="btn btn-small" name="status" value="hold">{{ Helper::icon('time') }} En espera</button>

			</div>

			<!-- update this ticket -->
			<input type="hidden" name="ticket_id" value="{{ $ticket->id }}" />

		{{ Form::close() }}
		
		<h5>{{ $ticket->subject }}</h5>

		<p>{{ HTML::link('user/' . $ticket->reported_by, $reporter->fullname) }} • <small>{{ $ticket->created_at }}</small></p>

		<p>{{ $ticket->content }}</p>

		<p class="pull-right"><small><strong>Estatus:</strong> {{ Helper::status($ticket->status) }}</small></p>

		<!-- separate from form -->
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
				<div class="control-group">

					<label for="content" class="control-label">Contenido</label>

					<div class="controls">

						<textarea name="content" id="content" cols="8" rows="10" class="span4"></textarea>

					</div>

				</div>
				<!-- end content -->

				<!-- file -->
				<div class="hidden control-group" id="file-field">

					<label for="file" class="control-label">Enviar un Archivo</label>

					<div class="controls">

						{{ Form::file('file') }}<span class="help-inline"><strong>Tamaño máximo:</strong> {{ ini_get('upload_max_filesize') }}B</span><br /><span class="help-block">Si tiene que subir más de un archivo, comprímalo primero.</span>

					</div>

				</div>
				<!-- end file -->

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
	<div class="span7">

		<div class="tabbable">

			<ul class="nav nav-tabs nav-tabs-google">

				<li class="active"><a href="#messages" data-toggle="tab">{{ Helper::icon('comments-alt') }} Mensajes</a></li>
				<li><a href="#files" data-toggle="tab">{{ Helper::icon('folder-open') }} Archivos</a></li>

			</ul>

		</div>

		<div class="tab-content">

			<div class="tab-pane active scrollable messages" id="messages">

				<?php // @TODO: optimize for users — WHEN I'M DONE
					foreach($messages as $message):
						$sender				= User::find($message->user_id);
						$sender->fullname	= $sender->firstname . ' ' . $sender->lastname;
					?>

					{{ HTML::link('user/' . $message->user_id, $sender->fullname) }} • <small>{{ $message->created_at }}</small>

					<p>{{ $message->content }}</p>

					<hr />

					<?php
					endforeach;
				?>

			</div>

			<div class="tab-pane" id="files">

				<p>Not implemented</p>

			</div>

		</div>

	</div>
	<!-- end responses -->

</div>
@endsection