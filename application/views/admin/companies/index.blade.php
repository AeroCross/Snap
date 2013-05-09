@layout('layouts/default')

@section('content')

<div class="row">

    <div class="span4">

        <div class="page-header">

            <h4>Compañías</h4>

        </div>

        {{ Form::open('admin/companies/new', 'POST') }}

            <div class="input-append">
                
                <input type="text" id="name" name="name" placeholder="Nombre de Compañía" />
                <button class="btn btn-success">{{ Helper::icon('plus-sign') }}</button>

            </div>

        {{ Form::close() }}

        <ul class="nav nav-tabs nav-stacked">

            @foreach ($companies as $company)

                <li>    

                    <a href="#">
                    {{ $company->name }}<br />
                    <small class="muted"><strong>Miembros:</strong> 0</small>
                    </a>

                </li>

            @endforeach

        </ul>

    </div> 

    <!-- company members -->

    <div class="span8">

        <div class="page-header">

            <h4>Agregar a compañía</h4>

        </div>

        {{ Form::open('admin/companies/edit', 'PUT', array('class' => 'form-horizontal')) }}

            <!-- companies to add users -->
            <div class="control-group">

                <label for="to" class="control-label">Agregar a</label>

                <div class="controls">

                    <select id="to" name="to" class="input-xlarge">

                        @foreach($companies as $company) 

                            <option value="{{ $company->id }}">{{ $company->name }}</option>

                        @endforeach

                    </select>

                </div>

            </div>
            <!-- end companies -->

            <!-- users -->
            <div class="control-group">

                <label for="users" class="control-label">Estos usuarios</label>

                <div class="controls">

                    <select id="users" name="users" class="input-xlarge" multiple>

                        @foreach($users as $user) 

                            <option value="{{ $user->id }}">
                                    {{ $user->firstname . ' ' . $user->lastname }}
                            </option>

                        @endforeach

                    </select>

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