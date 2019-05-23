<h4 class="header large lighter blue">
    <span class="align-left col-md-10">
        <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Books
    </span>
    <span class="align-right">
        <a class="btn-success btn-sm" href="{{ route('library.book.import') }}"><i class="fa fa-upload" aria-hidden="true"></i> Bulk Import From CSV</a>
    </span>
</h4>
<div class="form-group">
    {!! Form::label('isbn_number', 'ISBN Number', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('isbn_number', null, ["placeholder" => "", "class" => "form-control border-form","autofocus"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'isbn_number'])
    </div>

    {!! Form::label('code', 'Code', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('code', null, ["placeholder" => "", "class" => "form-control border-form", "required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'code'])
    </div>


</div>

<div class="form-group">

    {!! Form::label('title', 'Book Name', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('title', null, ["placeholder" => "", "class" => "form-control border-form", "required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'title'])
    </div>

    {!! Form::label('sub_title', 'Sub Title', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('sub_title', null, ["placeholder" => "", "class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'sub_title'])
    </div>
</div>

<div class="form-group">

    {!! Form::label('categories', 'Category', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('categories', $data['categories'], null, ['class' => 'form-control', 'onChange' => 'loadSemesters(this);', "required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'faculty'])
    </div>

    {!! Form::label('edition', 'Edition', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::text('edition', null, ["placeholder" => "", "class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'edition'])
    </div>

    {!! Form::label('edition_year', 'Edition Year', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::text('edition_year', null, ["placeholder" => "", "class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'edition_year'])
    </div>

</div>

<div class="form-group">
    {!! Form::label('language', 'Language', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('language', null, ["placeholder" => "", "class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'language'])
    </div>

    {!! Form::label('publisher', 'Publisher', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::text('publisher', null, ["placeholder" => "", "class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'publisher'])
    </div>

    {!! Form::label('publish_year', 'Publish Year', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::text('publish_year', null, ["placeholder" => "", "class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'publish_year'])
    </div>
</div>

<div class="form-group">
    {!! Form::label('series', 'Series', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('series', null, ["placeholder" => "", "class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'series'])
    </div>

    {!! Form::label('author', 'Author', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::text('author', null, ["placeholder" => "", "class" => "form-control border-form", "required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'author'])
    </div>

    {!! Form::label('rack_location', 'Rack Location', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::text('rack_location', null, ["placeholder" => "", "class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'rack_location'])
    </div>
</div>

<div class="form-group">


    {!! Form::label('price', 'Price', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::number('price', null, ["placeholder" => "", "class" => "form-control border-form", "required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'price'])
    </div>

    {!! Form::label('total_pages', 'Total Page', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::number('total_pages', null, ["placeholder" => "", "class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'total_pages'])
    </div>

    {!! Form::label('source', 'Source', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('source', null, ["placeholder" => "", "class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'source'])
    </div>
</div>

<div class="form-group">

    {!! Form::label('notes', 'Notes', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::textarea('notes', null, ["placeholder" => "", "class" => "form-control border-form", 'rows'=>"1"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'notes'])
    </div>
@if(!isset($data['row']))
        {!! Form::label('quantity', 'Quantity', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-3">
            {!! Form::number('quantity', null, ["placeholder" => "", "class" => "form-control border-form", "required"]) !!}
            @include('includes.form_fields_validation_message', ['name' => 'quantity'])
        </div>

    {!! Form::label('book_status', 'Books Status', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-2">
        {!! Form::select('book_status', $data['book_status'], null, ['class' => 'form-control', "required"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'book_status'])
    </div>
@endif
</div>

<div class="form-control">
    {!! Form::label('main_image', 'Book Image', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::file('main_image', null, ["placeholder" => "", "class" => "form-control border-form"]) !!}
        @include('includes.form_fields_validation_message', ['name' => 'main_image'])
    </div>
</div>
@if (isset($data['row']))

    <div class="space-4"></div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right">Existing Image</label>
        <div class="col-sm-9">
            @if ($data['row']->image)
                <img src="{{ asset('images/'.$folder_name.'/'.$data['row']->image) }}" width="100">
            @else
                <p>No image.</p>
            @endif

        </div>
    </div>
@endif
