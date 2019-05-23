
<div id="sidebar" class="sidebar h-sidebar navbar-collapse collapse ace-save-state hidden-print">
    <script type="text/javascript">
        try{ace.settings.loadState('sidebar')}catch(e){}
    </script>


    <ul class="nav nav-list">
        {{-- Dashboard --}}
        <li class="{!! request()->is('user-guardian')?'active':'' !!}">
            <a href="{{ route('user-guardian') }}" >
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Dashboard </span>
            </a>
        </li>
        {{-- Profile --}}

        {{--<li class="{!! request()->is('user-guardian/profile')?'active':'' !!}">
            <a href="{{ route('user-guardian.profile') }}" >
                <i class="menu-icon fa fa-user"></i>
                <span class="menu-text"> Profile </span>
            </a>
        </li>
--}}
        {{-- Students --}}
        <li class="{!! request()->is('user-guardian/students')?'active':'' !!}">
            <a href="{{ route('user-guardian.students') }}" >
                <i class="menu-icon fa fa-users"></i>
                <span class="menu-text"> Students With Detail </span>
            </a>
        </li>
{{--

        --}}


{{-- Account --}}{{--

        <li class="{!! request()->is('user-guardian/fees*')?'active open':'' !!}  hover">
            <a href="{{ route('user-guardian.fees') }}" >
                <i class="menu-icon fa fa-calculator" aria-hidden="true"></i>
                <span class="menu-text">Fees</span>
            </a>
        </li>

        --}}
{{-- Library --}}{{--

        <li class="{!! request()->is('user-guardian/library*')?'active':'' !!} hover">
            <a href="{{ route('user-guardian.library') }}" >
                <i class="menu-icon fa fa-book" aria-hidden="true"></i>
                <span class="menu-text">Library</span>
            </a>
            <b class="arrow"></b>
        </li>

        --}}
{{-- Attendence --}}{{--

        <li class="{!! request()->is('user-guardian/attendence*')?'active':'' !!} hover">
            <a href="{{ route('user-guardian.attendence') }}">
                <i class="menu-icon fa fa-calendar" aria-hidden="true"></i>
                <span class="menu-text"> Attendence</span>
            </a>
            <b class="arrow"></b>
        </li>

        --}}
{{-- Examination --}}{{--

        <li class="{!! request()->is('user-guardian/exam-score*')?'active':'' !!} hover">
            <a href="{{ route('user-guardian.exam-score') }}">
                <i class="menu-icon fa fa-line-chart"  aria-hidden="true"></i>
                <span class="menu-text"> Examination</span>
            </a>
            <b class="arrow"></b>
        </li>

        --}}
{{-- Hostel --}}{{--

        <li class="{!! request()->is('user-guardian/hostel*')?'active':'' !!} hover">
            <a href="{{ route('user-guardian.hostel') }}">
                <i class="menu-icon  fa fa-bed" aria-hidden="true"></i>
                <span class="menu-text"> Hostels </span>
            </a>
            <b class="arrow"></b>
        </li>

        --}}
{{-- Transport --}}{{--

        <li class="{!! request()->is('transport*')?'active':'' !!} hover">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon  fa fa-bus" aria-hidden="true"></i>
                <span class="menu-text"> Transport </span>
            </a>
            <b class="arrow"></b>
        </li>

        --}}
{{-- Subject --}}{{--

        <li class="{!! request()->is('user-guardian/subject*')?'active':'' !!} hover">
            <a href="{{ route('user-guardian.subject') }}">
                <i class="menu-icon  fa fa-list-alt" aria-hidden="true"></i>
                <span class="menu-text"> Subjects </span>
            </a>
            <b class="arrow"></b>
        </li>
--}}

        {{-- Subject --}}
        <li class="{!! request()->is('user-guardian/notice*')?'active':'' !!} hover">
            <a href="{{ route('user-guardian.notice') }}">
                <i class="menu-icon  fa fa-bullhorn" aria-hidden="true"></i>
                <span class="menu-text"> Notice </span>
            </a>
            <b class="arrow"></b>
        </li>

    </ul><!-- /.nav-list -->
</div>
