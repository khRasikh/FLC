<h4 class="header large lighter blue"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Test Taker</h4>

<div class="form-group">
    {!! Form::label('name', 'Name', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('name', $test->name, ["placeholder" => "", "class" => "form-control border-form","autofocus", "required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'name'])
    </div>

    {!! Form::label('email', 'Email', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::email('email', $test->email, ["placeholder" => "", "class" => "form-control border-form", "required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'email'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('password', 'Password', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::password('password',  ["placeholder" => "", "class" => "form-control border-form","autofocus","id"=>"pass", "required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'password'])
    </div>

    {!! Form::label('confirmPassword', 'Confirm Password', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::password('confirmPassword',  ["placeholder" => "", "class" => "form-control border-form"/*,"onkeyup"=>"passCheck()"*/,"id"=>"repatpass", "required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'confirmPassword'])
    </div>
</div>
<div class="form-group">

    {!! Form::label('address', 'Address', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('address', $test->address, ["placeholder" => "", "class" => "form-control border-form", "required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'address'])
    </div>

    {!! Form::label('date', 'Join Date', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('date', , [/*"data-date-format" => "yyyy-mm-dd",*/ "class" => "form-control date-picker border-form","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'date'])
    </div>
    
</div>
<div class="form-group">
    

    <label for="placement_test" class="col-sm-2 control-label">Placement Test</label>
    <div class="col-sm-4">
        <select class="form-control" id="placement_test" name="placement_test" required>
            {{get_placement_test(old('placement_test'))}}
        </select>
    </div>

    <label for="score" class="col-sm-2 control-label">Score</label>
    <div class="col-sm-4">
        <input type="number" name="score" id="score" class="form-control">
    </div>

</div>
@if(isset($data['roles']) && $data['roles']->count() > 0)
    <div class="form-group">
        {!! Form::label('Access Level', 'User Access Level', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-9">
            <div class="checkbox">
                @foreach($data['roles'] as $role)
                    <label>
                        @if (!isset($data['row']))
                            {!! Form::checkbox('role[]', $role->id, false, ['class' => 'ace']) !!}
                        @else
                            {!! Form::checkbox('role[]', $role->id, array_key_exists($role->id, $data['active_roles']), ['class' => 'ace']) !!}
                        @endif
                            <span class="lbl"> {{ $role->display_name }} </span>
                    </label>
                @endforeach
                </div>
                <div class="control-group">
            </div>
        </div>
    </div>
@endif


<div class="space-4"></div>