<div class="row">
    <div class="col-xs-12">
        <h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i> Fees Receive History </h4>
        <div class="clearfix">
            <span class="pull-right tableTools-container"></span>
        </div>
        <div class="table-header">
            {{ $panel }}  Record list on table. Filter list using search box as your Wish.
        </div>
        <!-- div.table-responsive -->
        <div class="table-responsive">
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th >S.N.</th>
                            <th>RegNo</th>
                            <th>Name</th>
                            <th>Sem/Sec</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Method</th>
                            <th>User</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if (isset($data['feesCollection']) && $data['feesCollection']->count() > 0)
                        @php($i=1)
                        @foreach($data['feesCollection'] as $feesCollection)
                            <tr>
                                <td>{{ $i }}</td>
                                <td> <a href="{{ route('student.view', ['id' => $feesCollection->students_id]) }}">{{ $feesCollection->reg_no }}</a></td>
                                <td> <a href="{{ route('student.view', ['id' => $feesCollection->students_id]) }}">{{ $feesCollection->first_name.' '.$feesCollection->middle_name.' '. $feesCollection->last_name }}</a></td>
                                <td> {{  ViewHelper::getSemesterTitle( $feesCollection->semester ) }}</td>
                                <td> {{  ViewHelper::getFeeHeadById( $feesCollection->fee_masters_id ) }}</td>
                                <td>{{ \Carbon\Carbon::parse($feesCollection->date)->format('Y-m-d')}} </td>
                                <td>{{ $feesCollection->paid_amount }}</td>
                                <td>{{ $feesCollection->payment_mode }}</td>
                                <td> {{  ViewHelper::getUserNameId( $feesCollection->created_by ) }}</td>
                            @php($i++)
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10">No {{ $panel }} data found.</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
        </div>
        {!! Form::close() !!}
    </div>
</div>


