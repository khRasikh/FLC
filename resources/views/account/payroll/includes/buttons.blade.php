<div class="clearfix hidden-print ">
    <div class="easy-link-menu">
        <a class="{!! request()->is('account/payroll/master')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('account.payroll.master') }}"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Payroll Detail</a>
        <a class="{!! request()->is('account/payroll/master/add')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('account.payroll.master.add') }}"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add Salary</a>
        <a class="{!! request()->is('account/salary/payment*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('account.salary.payment') }}"><i class="fa fa-calculator" aria-hidden="true"></i>&nbsp;Pay Salary</a>
        <a class="{!! request()->is('account/payroll/balance')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('account.payroll.balance') }}"><i class="fa fa-money" aria-hidden="true"></i>&nbsp;Due Salary</a>
        <a class="{!! request()->is('account/payroll/head')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('account.payroll.head') }}"><i class="fa fa-header" aria-hidden="true"></i>&nbsp;Payroll Head</a>
    </div>
</div>
<hr class="hr-6">