<h4 class="header large lighter blue"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search Student</h4>
<div class="form-horizontal">
    <div class="form-group">
        <label class="col-sm-1 control-label">Year</label>
        <div class="col-sm-3">
            {!! Form::select('year', $data['years'], null, ['class' => 'form-control']) !!}

        </div>

        <label class="col-sm-1 control-label">Month</label>
        <div class="col-sm-3">
            {!! Form::select('month', $data['months'], null, ['class' => 'form-control']) !!}
        </div>

        {!! Form::label('reg_no', 'REG. NO.', ['class' => 'col-sm-1 control-label']) !!}
        <div class="col-sm-3">
            {!! Form::text('reg_no', null, ["placeholder" => "", "class" => "form-control border-form input-mask-registration", "autofocus"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'reg_no'])
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Faculty</label>
        <div class="col-sm-4">
            {!! Form::select('faculty', $data['faculties'], null, ['class' => 'form-control', 'onChange' => 'loadSemesters(this);']) !!}

        </div>

        <label class="col-sm-2 control-label">Semester</label>
        <div class="col-sm-4">
            <select name="semester_select" class="form-control semester_select" onChange="loadStudent(this);">
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
            <button class="btn btn-info" type="submit" id="submit-attendance">
                <i class="icon-ok bigger-110"></i>
                Search
            </button>
        </div>
    </div>
</div>
<!-- Option Values -->


