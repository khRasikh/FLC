<div class="row">
    <div class="col-xs-12">
        @include('includes.data_table_header')
        <!-- div.table-responsive -->
        <div class="table-responsive">
            {!! Form::open(['route' => $base_route.'.bulk-action', 'id' => 'bulk_action_form']) !!}
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th class="center">
                        <label class="pos-rel">
                            <input type="checkbox" class="ace" />
                            <span class="lbl"></span>
                        </label>
                    </th>
                    <th>S.N.</th>
                    <th>{{ $panel }}</th>
                    <th>Marking</th>
                    <th>Info</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if (isset($data['subject']) && $data['subject']->count() > 0)
                    @php($i=1)
                    @foreach($data['subject'] as $subject)
                        <tr>
                            <td class="center first-child">
                                <label>
                                    <input type="checkbox" name="chkIds[]" value="{{ $subject->id }}" class="ace" />
                                    <span class="lbl"></span>
                                </label>
                            </td>
                            <td>{{ $i }}</td>
                            <td>
                                {{ $subject->title }}
                                <hr class="hr hr-2  ">
                                <div class="label label-primary arrowed-right arrowed-in">
                                    {{ $subject->code }}
                                </div>
                            </td>
                            <td>
                                <table>
                                    <tr>
                                        <td>FM (T) - </td>
                                        <td>
                                            <div class="label label-info arrowed-right arrowed-in">
                                                {{ $subject->full_mark_theory }}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>PM (T) - </td>
                                        <td>
                                            <div class="label label-info arrowed-right arrowed-in">
                                                {{ $subject->pass_mark_theory }}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>FM (P) - </td>
                                        <td>
                                            <div class="label label-warning arrowed-right arrowed-in">
                                                {{ $subject->full_mark_practical }}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>PM (P) - </td>
                                        <td>
                                            <div class="label label-warning arrowed-right arrowed-in">
                                                {{ $subject->pass_mark_practical }}
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td >
                                <table>
                                    <tr>
                                        <td>Credit Hour - </td>
                                        <td>
                                            <div class="label label-info arrowed-right arrowed-in">
                                                {{ $subject->credit_hour }}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Subject Type - </td>
                                        <td>
                                            <div class="label label-info arrowed-right arrowed-in">
                                                {{ $subject->sub_type }}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Class Type - </td>
                                        <td>
                                            <div class="label label-info arrowed-right arrowed-in">
                                                {{ $subject->class_type }}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Teacher/Staff - </td>
                                        <td>
                                            <div class="label label-info arrowed-right arrowed-in">
                                                {{ ViewHelper::getStaffNameById($subject->staff_id) }}
                                            </div>
                                        </td>
                                    </tr>

                                </table>
                            </td>
                            <td class="hidden-480 ">
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-primary btn-minier dropdown-toggle {{ $subject->status == 'active'?"btn-info":"btn-warning" }}" >
                                        {{ $subject->status == 'active'?"Active":"In Active" }}
                                        <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                                    </button>

                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('subject.active', ['id' => $subject->id]) }}"><i class="fa fa-check" aria-hidden="true"></i></a>
                                        </li>

                                        <li>
                                            <a href="{{ route('subject.in-active', ['id' => $subject->id]) }}"><i class="fa fa-remove" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>

                            </td>
                            <td>
                                <div class="hidden-sm hidden-xs action-buttons">
                                    <a class="green" href="{{ route($base_route.'.edit', ['id' => $subject->id]) }}">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>

                                    <a href="{{ route($base_route.'.delete', ['id' => $subject->id]) }}" class="red bootbox-confirm">
                                        <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                    </a>
                                </div>
                                <div class="hidden-md hidden-lg">
                                    <div class="inline pos-rel">
                                        <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                            <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                            <li>
                                                <a href="{{ route($base_route.'.edit', ['id' => $subject->id]) }}" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                    <span class="green">
                                                        <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                    </span>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="{{ route($base_route.'.delete', ['id' => $subject->id]) }}" class="tooltip-error bootbox-confirm" data-rel="tooltip" title="Delete">
                                                    <span class="red ">
                                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                    </span>
                                                 </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @php($i++)
                    @endforeach
                @else
                    <tr>
                        <td colspan="7">No {{ $panel }} data found.</td>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
            {!! Form::close() !!}
        </div>
    </div>
</div>