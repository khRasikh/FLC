<tr class="option_value">
    <td width="5%">
        <div class="btn-group">
                <span class="btn btn-xs btn-primary" >
                    <i class="fa fa-arrows" aria-hidden="true"></i>
                </span>
        </div>
    </td>
    <td width="40%">
        {!! Form::select('fee_head[]', $fee_heads, null, ['class' => 'form-control', 'required']) !!}
    </td>
    <td width="25%">
        {!! Form::text('fee_due_date[]', null, ["placeholder" => "YYYY-MM-DD", "class" => "col-xs-10 col-sm-11 input-mask-date date-picker", "required"]) !!}
    </td>
    <td width="25%">
        {!! Form::text('fee_amount[]', null, ["placeholder" => "", "class" => "col-xs-10 col-sm-11" , "required"]) !!}
    </td>
    <td width="10%">
        <div class="btn-group">
            <button type="button" class="btn btn-xs btn-danger" onclick="$(this).closest('tr').remove();">
                <i class="ace-icon fa fa-trash-o bigger-120"></i>
            </button>
        </div>

    </td>
</tr>

@include('includes.scripts.inputMask_script')