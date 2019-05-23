<tr class="option_value">
    <td width="30%">
        {!! Form::select('tr_head[]', $tr_heads, null, ['class' => 'form-control', 'required']) !!}
    </td>
    <td width="20%">
        {!! Form::number('amount[]', null, ["class" => "col-xs-10 col-sm-11", "required"]) !!}
    </td>
    <td width="45%">
        {!! Form::text('description[]', null, ["class" => "col-xs-10 col-sm-11"]) !!}
    </td>
    <td width="5%">
        <div class="btn-group">
            <button type="button" class="btn btn-xs btn-danger" onclick="$(this).closest('tr').remove();">
                <i class="ace-icon fa fa-trash-o bigger-120"></i>
            </button>
        </div>

    </td>
</tr>

@include('includes.scripts.inputMask_script')