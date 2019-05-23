<h4 class="header large lighter blue"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search</h4>

    <div class="form-group">
        {!! Form::label('book', 'Book', ['class' => 'col-sm-1 control-label']) !!}
        <div class="col-sm-4">
            {!! Form::select('book', $data['books'], null, ['class' => 'form-control']) !!}
        </div>

        {!! Form::label('category', 'Category', ['class' => 'col-sm-1 control-label']) !!}
        <div class="col-sm-3">
            {!! Form::select('category', $data['categories'], null, ['class' => 'form-control']) !!}
        </div>

        <label class="col-sm-1 control-label">Status</label>
        <div class="col-sm-2">
            <select class="form-control border-form" name="status">
                <option value="all"> Select Semester </option>
                <option value="issue" >Issued</option>
                <option value="return" >Return</option>
            </select>
        </div>
    </div>

<div class="form-group">
    {!! Form::label('issued', 'Issued', ['class' => 'col-sm-1 control-label']) !!}
    <div class=" col-sm-3">
        <div class="input-group ">
            {!! Form::text('issued_start', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
            <span class="input-group-addon">
                        <i class="fa fa-exchange"></i>
                    </span>
            {!! Form::text('issued_end', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
        </div>
    </div>

    {!! Form::label('return_on', 'Return', ['class' => 'col-sm-1 control-label']) !!}
    <div class=" col-sm-3">
        <div class="input-group ">
            {!! Form::text('return_start', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
            <span class="input-group-addon">
                        <i class="fa fa-exchange"></i>
                    </span>
            {!! Form::text('return_end', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
        </div>
    </div>

    {!! Form::label('due', 'Due', ['class' => 'col-sm-1 control-label']) !!}
    <div class=" col-sm-3">
        <div class="input-group ">
            {!! Form::text('due_start', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
            <span class="input-group-addon">
                        <i class="fa fa-exchange"></i>
                    </span>
            {!! Form::text('due_end', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd"]) !!}
        </div>
    </div>


</div>
<div class="clearfix form-actions">
    <div class="align-right">
        <button class="btn btn-info" type="submit" id="filter-btn">
            <i class="fa fa-filter bigger-110"></i>
            Search
        </button>
    </div>
</div>