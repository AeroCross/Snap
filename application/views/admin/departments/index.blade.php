@layout('layouts/default')

@section('content')

<div class="row">

	<div class="span4">

		<div class="page-header">

			<h4>Departamentos</h4>

		</div>

		<!-- new department -->
		{{ Form::open('admin/departments/new', 'POST') }}

			<div class="input-append">

				<input type="text" name="department" id="department" placeholder="Nuevo departamento" />
				<button class="btn btn-success">{{ Helper::icon('plus-sign') }}</button>

			</div>

		{{ Form::close() }}

		<ul class="nav nav-tabs nav-stacked">

			@foreach($departments as $department)

			<li><a href="#">{{ $department->name }}<br /><small class="muted"><strong>Miembros:</strong> 0</small></a></li>

			@endforeach

		</ul>

	</div>

	<div class="span8">

		<div class="page-header">

			<h4>Modificar Usuarios</h4>

		</div>

		{{ Form::open('admin/department/update/users', 'PUT', array('class' => 'form-horizontal')) }}

            <!-- departments to add users -->
            <div class="control-group">

                <label for="to" class="control-label">Agregar a</label>

                <div class="controls">

                    <select id="to" name="to" class="input-xlarge" multiple>

                        @foreach($departments as $department) 

                            <option value="{{ $department->id }}">{{ $department->name }}</option>

                        @endforeach

                    </select>

                </div>

            </div>
            <!-- end companies -->

            <!-- users -->
            <div class="control-group">

                <label for="users" class="control-label">Estos usuarios</label>

                <div class="controls">

                    <select id="users" name="users[]" class="input-xlarge" multiple>

                        @foreach($users as $user) 

                            <option value="{{ $user->id }}">
                                    {{ $user->firstname . ' ' . $user->lastname }}
                            </option>

                        @endforeach

                    </select>
                    <span class="help-block"><small class="muted"><strong>Aviso:</strong> Se sobreescribirán todas las asignaciones a departamentos</small></span>

                </div>

            </div>
            <!-- end users -->

            <div class="form-actions">

                <button type="submit" class="btn btn-primary">Agregar {{ Helper::icon('plus') }}</button>

            </div>

        {{ Form::close() }}

	</div>

</div>

@endsection