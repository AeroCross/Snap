@layout('layouts/default')

@section('content')

<div class="row">

	<div class="page-header">

		<h4>Roles</h4>

	</div>

	<!-- assign roles -->
	<div class="span6">

		{{ Form::open('admin/roles/update', 'PUT', array('class' => 'form-horizontal')) }}

			<!-- notifications -->
			{{ Notification::show() }}

			<div class="control-group">

				<label for="users" class="control-label">Asignar a</label>

				<div class="controls">

					<select name="users" id="users" class="input-xlarge" multiple>

						@foreach ($users as $user)

							<option value="{{ $user->id }}">{{ $user->firstname . ' ' . $user->lastname}}</option>

						@endforeach

					</select>

				</div>
				
			</div>

			<div class="form-actions">

				<div class="btn-group">

					<button type="submit" name="action" value="1" class="btn btn-warning">Administrador</button>
					<button type="submit" name="action" value="2" class="btn">Soporte Técnico</button>
					<button type="submit" name="action" value="3" class="btn">Usuario</button>

				</div>

			</div>

		{{ Form::close() }}

	</div>
	<!-- end assign roles -->

	<!-- list roles -->
	<div class="span6">

		<div class="tabbable">

			<ul class="nav nav-tabs">

				<li class="active"><a href="#admins" data-toggle="tab">Administradores</a></li>
				<li><a href="#tech" data-toggle="tab">Soporte Técnico</a></li>
				<li><a href="#regulars" data-toggle="tab">Usuarios</a></li>

			</ul>

			<div class="tab-content">

				<!-- admins -->
				<div class="tab-pane active" id="admins">

					<table class="table table-striped table-bordered table-hover">

						@foreach ($admins as $admin)
							<?php $u = $users[$admin->user_id] ?>
							<tr>

								<td>{{ HTML::mailto($u->email, $u->firstname . ' ' . $u->lastname) }}<br ><small class="muted">{{ $u->username }}</small></td>

							</tr>

						@endforeach

					</table>

				</div>
				<!-- end admins -->

				<!-- tech -->
				<div class="tab-pane" id="tech">

					<table class="table table-striped table-bordered table-condensed table-hover">

						@foreach ($supports as $support)
							<?php $u = $users[$support->user_id] ?>
							<tr>

								<td>{{ HTML::mailto($u->email, $u->firstname . ' ' . $u->lastname) }} <small class="muted">{{ $u->username }}</small></td>

							</tr>

						@endforeach

					</table>

				</div>
				<!-- end tech -->

				<!-- users -->
				<div class="tab-pane" id="regulars">

					<table class="table table-striped table-bordered table-condensed table-hover">

						@foreach ($regulars as $regular)
							<?php $u = $users[$regular->user_id] ?>
							<tr>

								<td>{{ HTML::mailto($u->email, $u->firstname . ' ' . $u->lastname) }} <small class="muted">{{ $u->username }}</small></td>

							</tr>

						@endforeach

					</table>

				</div>
				<!-- end users -->

			</div>
			<!-- end tabcontent -->

		</div>
		<!-- end tabbable -->

	</div>
	<!-- end list roles -->

</div>

@endsection