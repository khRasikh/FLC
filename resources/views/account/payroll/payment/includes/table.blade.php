<div class="row">
    <div class="col-xs-12">
        <h4 class="header large lighter blue"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;{{ $panel }} List</h4>
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
                    <th>S.N.</th>
                    <th>Reg. Number.</th>
                    <th>Name</th>
                    <th>Contact Num.</th>
                    <th>Designation</th>
                    <th>Qualification</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if (isset($data['staff']) && $data['staff']->count() > 0)
                    @php($i=1)
                    @foreach($data['staff'] as $staff)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ ViewHelper::getStaffById($staff->id)}}</td>
                            <td>{{ $staff->first_name.' '.$staff->middle_name.' '.$staff->last_name }} </td>
                            <td><div class="label label-info arrowed">{{ $staff->mobile_1 }} </div></td>
                            <td>{{ ViewHelper::getDesignationId($staff->designation) }}</td>
                            <td>{{ $staff->qualification }}</td>
                            <td>
                                <div class="btn btn-primary btn-minier action-buttons ">
                                    <a class="white" href="{{ route($base_route.'.view', ['id' => $staff->id]) }}">
                                        <i class="ace-icon fa fa-calculator bigger-130"></i>&nbsp;
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @php($i++)
                    @endforeach
                @else
                    <tr>
                        <td colspan="11">No {{ $panel }} data found.</td>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>