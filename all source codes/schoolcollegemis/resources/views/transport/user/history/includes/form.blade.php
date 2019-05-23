<h4 class="header large lighter blue"><i class="fa fa-search" aria-hidden="true"></i>Search History</h4>
<div class="form-horizontal">
    <div class="form-group">
        {!! Form::label('user_type', 'Type', ['class' => 'col-sm-1 control-label']) !!}
        <div class="col-sm-2">
            {!! Form::select('user_type', ["0"=>"Select Type","1"=>"Student","2"=>"Staff"], null, ['class' => 'form-control']) !!}
        </div>

        {!! Form::label('reg_no', 'REG No.', ['class' => 'col-sm-1 control-label']) !!}
        <div class="col-sm-2">
            {!! Form::text('reg_no', null, ["placeholder" => "", "class" => "form-control border-form","autofocus"]) !!}
        </div>

        {!! Form::label('year', 'Year', ['class' => 'col-sm-1 control-label']) !!}
        <div class="col-sm-1">
            {!! Form::select('year', $data['years'], null, ['class' => 'form-control']) !!}
            @include('includes.form_fields_validation_message', ['name' => 'year'])
        </div>

        {!! Form::label('history_type', 'History Type', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-2">
            {!! Form::select('history_type', ["0"=>"Select History...", "Registration"=>"Registration", "Shift"=>"Shift","Leave"=>"Leave", "Renew"=>"Renew"], null, ['class' => 'form-control']) !!}
            @include('includes.form_fields_validation_message', ['name' => 'history_type'])
        </div>
    </div>

    <div class="form-group">

        {!! Form::label('route', 'Route', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">
            {!! Form::select('route', $data['routes'], null, ['class' => 'form-control', "onChange" => "loadVehicle(this)"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'route'])
        </div>

        <label class="col-sm-2 control-label">Vehicle</label>
        <div class="col-sm-4">
            <select name="vehicle_select" class="form-control vehicle_select" >
                <option value="0"> Select Vehicle </option>
            </select>
        </div>

    </div>
    <div class="clearfix form-actions">
        <div class="align-right">            &nbsp; &nbsp; &nbsp;
            <button class="btn btn-info" type="submit" id="filter-btn">
                <i class="fa fa-filter bigger-110"></i>
                Search
            </button>
        </div>
    </div>
</div>