<h4 class="header large lighter blue"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;General</h4>
<div class="form-group">
    {!! Form::label('institute', 'Institute', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-5">
        {!! Form::text('institute', null, ["class" => "form-control border-form", "required", "autofocus"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'institute'])
    </div>

    {!! Form::label('salogan', 'Salogan', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-5">
        {!! Form::text('salogan', null, ["class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'salogan'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('address', 'Address', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-5">
        {!! Form::text('address', null, ["class" => "form-control border-form", "required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'address'])
    </div>

    <label class="col-sm-1 control-label">
        <i class="fa fa-phone bigger-120 white" aria-hidden="true"></i>
    </label>
    <div class="col-sm-5">
        {!! Form::text('phone', null, ["class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'phone'])
    </div>


</div>
<div class="form-group">
    <label class="col-sm-1 control-label">
        <i class="fa fa-envelope bigger-120 white" aria-hidden="true"></i>
    </label>
    <div class="col-sm-5">
        {!! Form::email('email', null, ["class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'email'])
    </div>

    <label class="col-sm-1 control-label">
        <i class="fa fa-globe bigger-120 white" aria-hidden="true"></i>
    </label>
    <div class="col-sm-5">
        {!! Form::text('website', null, ["class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'website'])
    </div>
</div>

<div class="form-group">
    <div class="col-md-6">
        {!! Form::label('logo_image', 'Logo', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::file('logo_image', ["class" => "form-control border-form"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'logo_image'])
        </div>

        @if (isset($data['row']))
            @if ($data['row']->logo)
                <img id="avatar"  src="{{ asset('images'.DIRECTORY_SEPARATOR.'setting'.DIRECTORY_SEPARATOR.'general'.DIRECTORY_SEPARATOR.$data['row']->logo) }}" class="img-responsive" >
            @endif
        @endif
    </div>
    <div class="col-md-6">
        {!! Form::label('favicon_image', 'Favicon', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::file('favicon_image', ["class" => "form-control border-form"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'favicon_image'])
        </div>

        @if (isset($data['row']))
            @if ($data['row']->favicon)
                <img id="avatar"  src="{{ asset('images'.DIRECTORY_SEPARATOR.'setting'.DIRECTORY_SEPARATOR.'general'.DIRECTORY_SEPARATOR.$data['row']->favicon) }}" class="img-responsive" >
            @endif
        @endif
    </div>
</div>

<h4 class="header large lighter blue"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Print</h4>
<div class="form-group">
    <label class="col-sm-1 control-label">
        <i class="fa fa-print bigger-120 white" aria-hidden="true"></i> Head
    </label>
    <div class="col-sm-5">
        {!! Form::textarea('print_header', null, ["class" => "form-control border-form","id"=>"summernote"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'print_header'])
    </div>

    <label class="col-sm-1 control-label">
        <i class="fa fa-print bigger-120 white" aria-hidden="true"></i> Foot
    </label>
    <div class="col-sm-5">
        {!! Form::textarea('print_footer', null, ["class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'print_footer'])
    </div>
</div>

<h4 class="header large lighter blue"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Social Media</h4>
<div class="form-group">
    <label class="col-sm-1 control-label">
        <i class="fa fa-facebook bigger-120 white" aria-hidden="true"></i>
    </label>
    <div class="col-sm-5">
        {!! Form::text('facebook', null, ["class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'facebook'])
    </div>

    <label class="col-sm-1 control-label">
        <i class="fa fa-twitter bigger-120 white" aria-hidden="true"></i>
    </label>
    <div class="col-sm-5">
        {!! Form::text('twitter', null, ["class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'twitter'])
    </div>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label">
        <i class="fa fa-linkedin bigger-120 white" aria-hidden="true"></i>
    </label>
    <div class="col-sm-5">
        {!! Form::text('linkedIn', null, ["class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'linkedIn'])
    </div>

    <label class="col-sm-1 control-label">
        <i class="fa fa-youtube bigger-120 white" aria-hidden="true"></i>
    </label>
    <div class="col-sm-5">
        {!! Form::text('youtube', null, ["class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'youtube'])
    </div>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label">
        <i class="fa fa-google-plus bigger-120 white" aria-hidden="true"></i>
    </label>
    <div class="col-sm-5">
        {!! Form::text('googlePlus', null, ["class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'googlePlus'])
    </div>

    <label class="col-sm-1 control-label">
        <i class="fa fa-instagram bigger-120 white" aria-hidden="true"></i>
    </label>
    <div class="col-sm-5">
        {!! Form::text('instagram', null, ["class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'instagram'])
    </div>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label">
        <i class="fa fa-whatsapp bigger-120 white" aria-hidden="true"></i>
    </label>
    <div class="col-sm-5">
        {!! Form::text('whatsApp', null, ["class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'whatsApp'])
    </div>

    <label class="col-sm-1 control-label">
        <i class="fa fa-skype bigger-120 white" aria-hidden="true"></i>
    </label>
    <div class="col-sm-5">
        {!! Form::text('skype', null, ["class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'skype'])
    </div>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label">
        <i class="fa fa-pinterest bigger-120 white" aria-hidden="true"></i>
    </label>
    <div class="col-sm-5">
        {!! Form::text('pinterest', null, ["class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'pinterest'])
    </div>

    <label class="col-sm-1 control-label">
        <i class="fa fa-wordpress bigger-120 white" aria-hidden="true"></i>
    </label>
    <div class="col-sm-5">
        {!! Form::text('wordpress', null, ["class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'wordpress'])
    </div>
</div>