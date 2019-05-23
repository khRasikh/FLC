<h4 class="header large lighter blue"><i class="fa fa-calculator" aria-hidden="true"></i>&nbsp;{{ $panel }} Edit Form</h4>

{!! Form::open(['route' => $base_route.'.store', 'id' => 'bulk_action_form']) !!}

<div class="form-group">
    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>Date</th>
            <th>Transaction Head</th>
            <th>Dr. Amount</th>
            <th>Cr. Amount</th>
            <th>Description</th>
        </tr>
        </thead>

        <tbody id="fee_wrapper">

        <tr class="option_value">

            <td width="15%">
                {!! Form::text('date', null, ["placeholder" => "YYYY-MM-DD", "class" => "col-xs-10 col-sm-11 input-mask-date date-picker"]) !!}
            </td>
            <td width="30%">
                {!! Form::hidden('tr_head_id', null, ['class' => 'form-control', "disabled"]) !!}
                {!! Form::text('transaction_title', null, ['class' => 'form-control', "disabled"]) !!}
            </td>
            <td width="10%">
                {!! Form::text('dr_amount', null, ['class' => 'form-control']) !!}
            </td>
            <td width="10%">
                {!! Form::text('cr_amount', null, ['class' => 'form-control']) !!}
            </td>
            <td>
                {!! Form::text('description', null, ["placeholder" => "", "class" => "col-xs-10 col-sm-11" ]) !!}
            </td>

        </tr>

        </tbody>

    </table>
    <div class="clearfix form-actions align-right">
        <div class="col-md-12">
            <button class="btn btn-info" type="submit">
                <i class="icon-ok bigger-110"></i>
                Update
            </button>
        </div>
    </div>
</div>


