<div class="clearfix hidden-print ">
    <div class=" align-right">
        <a class="{!! request()->is('user-staff/student-attendance*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('user-staff.student-attendance.add') }}"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i> Manage&nbsp;Student Attendance</a>
        <a class="{!! request()->is('user-staff/attendance*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('user-staff.attendance') }}"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i> View My Attendance</a>
    </div>
</div>
<hr class="hr-6">