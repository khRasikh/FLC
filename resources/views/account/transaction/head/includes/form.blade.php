<div class="form-group">
    {!! Form::label('tr_head', 'Tr. Head', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::text('tr_head', null, ["placeholder" => "e.g. Room Rent", "class" => "form-control border-form upper","required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'tr_head'])
    </div>
</div>
<div class="form-group">
    {!! Form::label('type', 'Type', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::select('type', ['' => '','income' => 'Income', 'expenses' => 'Expenses' ], null,
        [ 'class'=>'form-control border-form']); !!}
        @include('includes.form_fields_validation_message', ['name' => 'type'])
    </div>
</div>
