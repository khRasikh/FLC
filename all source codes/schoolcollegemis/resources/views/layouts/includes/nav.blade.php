<div id="navbar" class="navbar navbar-default    navbar-collapse       h-navbar ace-save-state">
    <div class="navbar-container ace-save-state" id="navbar-container">
        <div class="navbar-header pull-left">
            <a href="{{ route('home') }}" class="navbar-brand">
                <small class="text-capitalize">
                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                    @if(isset($generalSetting->institute))
                        {{$generalSetting->institute}}
                    <strong class="text-capitalize orange2"> IMS </strong>
                    @else
                        UNLIMITED Edu Firm
                    @endif
                </small>
            </a>

            <button class="pull-right navbar-toggle navbar-toggle-img collapsed" type="button" data-toggle="collapse" data-target=".navbar-buttons,.navbar-menu">
                <span class="sr-only">Toggle user menu</span>

                <img src="{{ asset('assets/images/avatars/user.jpg') }}" alt="Jason's Photo" />
            </button>

            <button class="pull-right navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#sidebar">
                <span class="sr-only">Toggle sidebar</span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="navbar-buttons navbar-header pull-right  collapse navbar-collapse" role="navigation">
            <ul class="nav ace-nav">
                <li class="light-blue dropdown-modal user-min">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <img class="nav-user-photo" src="{{ asset('assets/images/avatars/user.jpg') }}" alt="Jason's Photo" />
                        <span class="user-info">
									<small>Welcome,</small>
									{{isset(auth()->user()->name)?auth()->user()->name:""}}
								</span>

                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>

                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li>
                            <a href="{{--{{ route('user.edit', ['id' => Crypt::encryptString(auth()->user()->id)]) }}--}}">
                                <i class="ace-icon fa fa-user"></i>
                                Profile
                            </a>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="ace-icon fa fa-power-off"></i>
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        @ability('super-admin','expand-action-menu')
        <div class="navbar-buttons navbar-header pull-left  collapse navbar-collapse" role="navigation">
            <div class="collapse navbar-collapse js-navbar-collapse col-md-12">
                <ul class="nav navbar-nav navbar-nav-mega col-md-12">
                    <li class="dropdown mega-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-expand"></span>&nbsp;&nbsp;Expand Actions</a>
                        <ul class="dropdown-menu mega-dropdown-menu row">
                            <li class="col-sm-3">
                                <ul>
                                    <li class="dropdown-header"><i class="fa fa-users" aria-hidden="true"></i> Student</li>
                                    <li><a href="{{ route('student') }}">Detail</a></li>
                                    <li><a href="{{ route('student.registration') }}">Registration</a></li>
                                    <li><a href="{{ route('student.transfer') }}">Transfer</a></li>
                                    <li><a href="{{ route('student.document') }}">Documents</a></li>
                                    <li><a href="{{ route('student.note') }}">Notes</a></li>
                                    <li class="divider"></li>
                                    <li class="dropdown-header"><i class="fa fa-user-secret" aria-hidden="true"></i> Staff</li>
                                    <li><a href="{{ route('staff') }}">Detail</a></li>
                                    <li><a href="{{ route('staff.add') }}">Registration</a></li>
                                    <li><a href="{{ route('staff.document') }}">Documents</a></li>
                                    <li><a href="{{ route('staff.note') }}">Notes</a></li>
                                    <li class="divider"></li>
                                    <li class="dropdown-header"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Attendance</li>
                                    <li><a href="{{ route('attendance.student') }}">Student</a></li>
                                    <li><a href="{{ route('attendance.staff') }}">Staff</a></li>

                                </ul>
                            </li>
                            <li class="col-sm-3">
                                <ul>
                                    <li class="dropdown-header"><i class="fa fa-calculator" aria-hidden="true"></i> Account</li>
                                    <li><a href="{{ route('account.fees.master.add') }}">Add Fees</a></li>
                                    <li><a href="{{ route('account.fees.collection') }}">Collect Fees</a></li>
                                    <li><a href="{{ route('account.fees.balance') }}">Balance Fees</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{ route('account.payroll.master.add') }}">Add Salary</a></li>
                                    <li><a href="{{ route('account.salary.payment') }}">Pay Salary</a></li>
                                    <li><a href="{{ route('account.payroll.balance') }}">Balance Salary</a></li>
                                    <li class="divider"></li>
                                    <li class="dropdown-header"><i class="fa fa-book" aria-hidden="true"></i> Library</li>
                                    <li><a href="{{ route('library.book') }}">Books Detail</a></li>
                                    <li><a href="{{ route('library.student') }}">Student Member</a></li>
                                    <li><a href="{{ route('library.staff') }}">Staff Member</a></li>
                                    <li><a href="{{ route('library.issue-history') }}">Issue History</a></li>
                                    <li><a href="{{ route('library.return-over') }}">Return Period Over</a></li>
                                </ul>
                            </li>
                            <li class="col-sm-3">
                                <ul>
                                    <li class="dropdown-header"><i class="fa fa-certificate" aria-hidden="true"></i> Examination</li>
                                    <li><a href="{{ route('exam.schedule') }}">Exam Schedule </a></li>
                                    <li><a href="{{ route('exam.mark-ledger') }}">Mark Ledger</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{ route('exam.admit-card') }}">Admit Card</a></li>
                                    <li><a href="{{ route('exam.routine') }}">Routine</a></li>
                                    <li><a href="{{ route('exam.mark-sheet') }}">MarkSheet/Score</a></li>
                                    <li class="divider"></li>
                                    <li class="dropdown-header"><i class="fa fa-car" aria-hidden="true"></i> Transport</li>
                                    <li><a href="{{ route('transport.user.history') }}">User Hstory</a></li>
                                    <li><a href="{{ route('transport.user') }}">Traveller/User</a></li>
                                    <li><a href="{{ route('transport.route') }}">Route</a></li>
                                    <li><a href="{{ route('transport.vehicle') }}">Vehicle</a></li>
                                    <li class="divider"></li>
                                    <li class="dropdown-header"><i class="fa fa-bed" aria-hidden="true"></i> Hostel</li>
                                    <li><a href="{{ route('hostel.resident') }}">Resident</a></li>
                                    <li><a href="{{ route('hostel.resident.history') }}">Resident History</a></li>
                                    <li><a href="{{ route('hostel') }}">Hostel Detail</a></li>
                                    <li><a href="{{ route('hostel.food') }}">Food & Meal</a></li>
                                </ul>
                            </li>
                            <li class="col-sm-3">
                                <ul>
                                    <li class="dropdown-header"><i class="fa fa-bullhorn" aria-hidden="true"></i> Alert</li>
                                    <li><a href="{{ route('info.notice') }}">User Notice</a></li>
                                    <li><a href="{{ route('info.smsemail') }}">Send SMS/Email</a></li>
                                    <li><a href="{{ route('setting.alert') }}">Alert Templating</a></li>
                                    <li class="divider"></li>
                                    <li class="dropdown-header"><i class="fa fa-th-list" aria-hidden="true"></i> More</li>
                                    <li><a href="{{ route('info.notice') }}">Assignment</a></li>
                                    <li><a href="{{ route('info.smsemail') }}">Upload/Download</a></li>
                                </ul>
                            </li>

                        </ul>
                    </li>
                </ul>

            </div>
        </div>
        @endability
        <nav role="navigation" class="navbar-menu pull-right collapse navbar-collapse">
            <ul class="nav navbar-nav">
                @ability('super-admin', 'admin-control')
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Admin Control
                            &nbsp;
                            <i class="ace-icon fa fa-angle-down bigger-110"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-light-blue dropdown-caret">
                            <li>
                                <a href="{{ route('user') }}">
                                    <i class="ace-icon fa fa-user bigger-110 blue"></i>
                                    Users & Roles
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('setting.general') }}">
                                    <i class="ace-icon fa fa-cogs bigger-110 blue"></i>
                                    Settings
                                </a>
                            </li>
                        </ul>
                    </li>
                @endability
            </ul>
        </nav>

    </div><!-- /.navbar-container -->
</div>