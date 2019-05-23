<h4 class="header large lighter blue"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search Fees</h4>

<div class="form-group">
    {!! Form::label('reg_no', 'REG. NO.', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::text('reg_no', null, ["placeholder" => "", "class" => "form-control border-form input-mask-registration", "autofocus"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'reg_no'])
    </div>

    {!! Form::label('fee_due_date', 'Due Date', ['class' => 'col-sm-1 control-label']) !!}
    <div class=" col-sm-3">
        <div class="input-group ">
            {!! Form::text('fee_due_date_start', null, ["placeholder" => "2074-01-01", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
            <span class="input-group-addon">
                <i class="fa fa-exchange"></i>
            </span>
            {!! Form::text('fee_due_date_end', null, ["placeholder" => "2074-01-01", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'fee_due_date_start'])
            @include('includes.form_fields_validation_message', ['name' => 'fee_due_date_end'])
        </div>
    </div>
    <label class="col-sm-1 control-label">Fee Head</label>
    <div class="col-sm-4">
        {!! Form::select('fee_heads', $data['fee_heads'], null, ['class' => 'form-control']) !!}

    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Faculty</label>
    <div class="col-sm-4">
        {!! Form::select('faculty', $data['faculties'], null, ['class' => 'form-control', 'onChange' => 'loadSemesters(this);']) !!}

    </div>

    <label class="col-sm-2 control-label">Semester</label>
    <div class="col-sm-4">
        <select name="semester_select[]" class="form-control semester_select" >
            <option> Select Semester </option>
        </select>
    </div>

</div>


<div class="clearfix form-actions">
    <div class="col-md-12 align-right">
        <button class="btn" type="reset">
            <i class="icon-undo bigger-110"></i>
            Reset
        </button>
        &nbsp; &nbsp; &nbsp;
        <button class="btn btn-info" type="submit" id="filter-btn">
            <i class="icon-ok bigger-110"></i>
            Search
        </button>
    </div>
</div>