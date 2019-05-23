<h4 class="header large lighter blue" id="filterBox"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search {{ $panel }}</h4>
<div class="form-horizontal" id="filterDiv">
    <div class="form-group">
        {!! Form::label('user_type', 'Type', ['class' => 'col-sm-1 control-label']) !!}
        <div class="col-sm-2">
            {!! Form::select('user_type', ["0"=>"Select Type","1"=>"Student","2"=>"Staff"], null, ['class' => 'form-control']) !!}
        </div>

        {!! Form::label('reg_no', 'REG No.', ['class' => 'col-sm-1 control-label']) !!}
        <div class="col-sm-2">
            {!! Form::text('reg_no', null, ["placeholder" => "", "class" => "form-control border-form","autofocus"]) !!}
        </div>


        {!! Form::label('route', 'Route', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">
            {!! Form::select('route', $data['routes'], null, ['class' => 'form-control', "onChange" => "loadAllVehicles(this)"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'route'])
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">Vehicle</label>
        <div class="col-sm-4">
            <select name="vehicle_select" class="form-control vehicle_select">
                <option value="0"> Select Vehicle </option>
            </select>
        </div>

        {!! Form::label('status', 'Status', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">
            {!! Form::select('status', ["0"=>"Select Status...", "1"=>"Active","2"=>"In-Active"], null, ['class' => 'form-control']) !!}
            @include('includes.form_fields_validation_message', ['name' => 'status'])
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