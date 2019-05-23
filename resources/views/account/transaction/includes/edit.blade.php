
@include('includes.flash_messages')
<!-- PAGE CONTENT BEGINS -->
{!! Form::model($data['row'], ['route' => [$base_route.'.update', $data['row']->id], 'method' => 'POST', 'class' => 'form-horizontal',
                'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}
{!! Form::hidden('id', $data['row']->id) !!}
    @include($view_path.'.includes.transaction_tr_edit')

{!! Form::close() !!}
<div class="hr hr-18 dotted hr-double"></div>