<div class="form-group">
    <label class="col-sm-4 control-label">Faculty</label>
    <div class="col-sm-8">
        {!! Form::select('faculty', $data['faculties'], null, ['class' => 'form-control', 'onChange' => 'loadSemesters(this);']) !!}

    </div>
</div>
<div class="form-group">
    <label class="col-sm-4 control-label">Semester</label>
    <div class="col-sm-8">
        <select name="semesters_id" class="form-control semesters_id">
            <option value=""> Select Semester </option>
        </select>
    </div>
</div>

<div class="form-group">
    {!! Form::label('title', 'Title', ['class' => 'col-sm-4 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('title', null, ["placeholder" => "", "class" => "form-control border-form","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'title'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('download_file', 'Select File', ['class' => 'col-sm-4 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::file('download_file', null, ["placeholder" => "", "class" => "form-control border-form","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'download_file'])
    </div>
</div>

@if (isset($data['row']))

    <div class="space-4"></div>

    <div class="form-group">
        {!! Form::label('old_file', 'Old File', ['class' => 'col-sm-4 control-label']) !!}
        <div class="col-sm-8">
            @if ($data['row']->file)
                <a href="{{ asset($folder_name.DIRECTORY_SEPARATOR.'student'.DIRECTORY_SEPARATOR.ViewHelper::getStudentById( $data['row']->member_id ).DIRECTORY_SEPARATOR.$data['row']->file) }}" target="_blank">
                    <i class="ace-icon fa fa-download bigger-120"></i> &nbsp;{{ $data['row']->title }}
                </a>
            @else
                <p>No File.</p>
            @endif
        </div>
    </div>

@endif

<div class="form-group">
    {!! Form::label('description', 'Description', ['class' => 'col-sm-4 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::textarea('description', null, ["placeholder" => "", "class" => "form-control border-form", "rows"=>"2"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'description'])
    </div>
</div>

