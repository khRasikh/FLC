<h4 class="header large lighter blue"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search Student</h4>
<div class="form-horizontal">
    <div class="form-group">
        <label class="col-sm-2 control-label">Year</label>
        <div class="col-sm-4">
            {!! Form::select('year', $data['years'], null, ['class' => 'form-control']) !!}

        </div>

        <label class="col-sm-2 control-label">Month</label>
        <div class="col-sm-4">
            {!! Form::select('month', $data['months'], null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('reg_no', 'REG. NO.', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">
            {!! Form::text('reg_no', null, ["placeholder" => "", "class" => "form-control border-form input-mask-registration", "autofocus"]) !!}
        </div>

        <label class="col-sm-2 control-label">Designation</label>
        <div class="col-sm-4">
            {!! Form::select('designation', $data['designation'], null, ['class' => 'form-control', 'onChange' => 'loadStaff(this);']) !!}
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


