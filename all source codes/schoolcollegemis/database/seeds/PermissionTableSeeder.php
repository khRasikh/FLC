<?php
use App\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions=[
        /*Menu*/
            [
                'group'=>'Menu',
                'name' => 'expand-action-menu',
                'display_name' => 'Expand Nav Menu',
                'description' => 'Expand Nav Menu'
            ],
            [
                'group'=>'Menu',
                'name' => 'admin-control',
                'display_name' => 'Admin Control',
                'description' => 'Admin Control Menu'
            ],
            [
                'group'=>'Menu',
                'name' => 'dashboard',
                'display_name' => 'Dashboard',
                'description' => 'Dashboard Menu'
            ],
            [
                'group'=>'Menu',
                'name' => 'student-staff',
                'display_name' => 'Student-Staff',
                'description' => 'Student-Staff Menu'
            ],
            [
                'group'=>'Menu',
                'name' => 'account',
                'display_name' => 'Account',
                'description' => 'Account Menu'
            ],
            [
                'group'=>'Menu',
                'name' => 'library',
                'display_name' => 'Library',
                'description' => 'Libaray Menu'
            ],
            [
                'group'=>'Menu',
                'name' => 'attendance',
                'display_name' => 'Attendance',
                'description' => 'Attendance Menu'
            ],
            [
                'group'=>'Menu',
                'name' => 'examination',
                'display_name' => 'Examination',
                'description' => 'Examination Menu'
            ],
            [
                'group'=>'Menu',
                'name' => 'hostel',
                'display_name' => 'Hostel',
                'description' => 'Hostel Menu'
            ],
            [
                'group'=>'Menu',
                'name' => 'transport',
                'display_name' => 'Transport',
                'description' => 'Transport Menu'
            ],
            [
                'group'=>'Menu',
                'name' => 'assignment',
                'display_name' => 'Assignment',
                'description' => 'Assignment Menu'
            ],
            [
                'group'=>'Menu',
                'name' => 'download',
                'display_name' => 'Download',
                'description' => 'Download Menu'
            ],
            [
                'group'=>'Menu',
                'name' => 'report',
                'display_name' => 'Report',
                'description' => 'Report Menu'
            ],
            [
                'group'=>'Menu',
                'name' => 'alert-center',
                'display_name' => 'Alert Center',
                'description' => 'Alert Center Menu'
            ],
            [
                'group'=>'Menu',
                'name' => 'academic',
                'display_name' => 'Academic Setup',
                'description' => 'Academic Setup Menu'
            ],

        /*Roles*/
            [
                'group'=>'Role',
                'name' => 'role-index',
                'display_name' => 'Index',
                'description' => 'Role Index'
            ],
            [
                'group'=>'Role',
                'name' => 'role-add',
                'display_name' => 'Add',
                'description' => 'Role Add'
            ],
            [
                'group'=>'Role',
                'name' => 'role-view',
                'display_name' => 'View',
                'description' => 'View Role'
            ],
            [
                'group'=>'Role',
                'name' => 'role-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Role'
            ],
            [
                'group'=>'Role',
                'name' => 'role-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Role'
            ],

        /*User*/
            [
                'group'=>'User',
                'name' => 'user-index',
                'display_name' => 'Index',
                'description' => 'User Index'
            ],
            [
                'group'=>'User',
                'name' => 'user-add',
                'display_name' => 'Add',
                'description' => 'User Add'
            ],
            [
                'group'=>'User',
                'name' => 'user-edit',
                'display_name' => 'Edit',
                'description' => 'Edit User'
            ],
            [
                'group'=>'User',
                'name' => 'user-delete',
                'display_name' => 'Delete',
                'description' => 'Delete User'
            ],
            [
                'group'=>'User',
                'name' => 'user-active',
                'display_name' => 'Active',
                'description' => 'Active User'
            ],
            [
                'group'=>'User',
                'name' => 'user-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active User'
            ],
            [
                'group'=>'User',
                'name' => 'user-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'User Bulk Action'
            ],

        /*General Setting*/
            [
                'group'=>'General Setting',
                'name' => 'general-setting-index',
                'display_name' => 'Index',
                'description' => 'General Setting Index'
            ],
            [
                'group'=>'General Setting',
                'name' => 'general-setting-add',
                'display_name' => 'Add',
                'description' => 'General Setting Add'
            ],
            [
                'group'=>'General Setting',
                'name' => 'general-setting-edit',
                'display_name' => 'Edit',
                'description' => 'Edit General Setting'
            ],

         /*Alert Setting*/
            [
                'group'=>'Alert Setting',
                'name' => 'alert-setting-index',
                'display_name' => 'Index',
                'description' => 'Alert Setting Index'
            ],
            [
                'group'=>'Alert Setting',
                'name' => 'alert-setting-add',
                'display_name' => 'Add',
                'description' => 'Alert Setting Add'
            ],
            [
                'group'=>'Alert Setting',
                'name' => 'alert-setting-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Alert Setting'
            ],

        /*SMS Setting*/
            [
                'group'=>'SMS Setting',
                'name' => 'sms-setting-index',
                'display_name' => 'Index',
                'description' => 'SMS Setting Index'
            ],
            [
                'group'=>'SMS Setting',
                'name' => 'sms-setting-add',
                'display_name' => 'Add',
                'description' => 'SMS Setting Add'
            ],
            [
                'group'=>'SMS Setting',
                'name' => 'sms-setting-edit',
                'display_name' => 'Edit',
                'description' => 'Edit SMS Setting'
            ],
            [
                'group'=>'SMS Setting',
                'name' => 'sms-setting-active',
                'display_name' => 'Active',
                'description' => 'Active SMS'
            ],
            [
                'group'=>'SMS Setting',
                'name' => 'sms-setting-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active SMS'
            ],

        /*Email Setting*/
            [
                'group'=>'Email Setting',
                'name' => 'email-setting-index',
                'display_name' => 'Index',
                'description' => 'Email Setting Index'
            ],
            [
                'group'=>'Email Setting',
                'name' => 'email-setting-add',
                'display_name' => 'Add',
                'description' => 'Email Setting Add'
            ],
            [
                'group'=>'Email Setting',
                'name' => 'email-setting-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Email Setting'
            ],
            [
                'group'=>'Email Setting',
                'name' => 'email-setting-status-change',
                'display_name' => 'Status',
                'description' => 'Change Status'
            ],

        /*Payment Gateway Setting*/
            [
                'group'=>'Payment Gateway Setting',
                'name' => 'payment-gateway-setting-index',
                'display_name' => 'Index',
                'description' => 'Payment Gateway Setting Index'
            ],
            [
                'group'=>'Payment Gateway Setting',
                'name' => 'payment-gateway-setting-add',
                'display_name' => 'Add',
                'description' => 'Payment Gateway Setting Add'
            ],
            [
                'group'=>'Payment Gateway Setting',
                'name' => 'payment-gateway-setting-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Payment Gateway Setting'
            ],
            [
                'group'=>'Payment Gateway Setting',
                'name' => 'payment-gateway-active',
                'display_name' => 'Active',
                'description' => 'Active Payment Gateway'
            ],
            [
                'group'=>'Payment Gateway Setting',
                'name' => 'payment-gateway-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Payment Gateway'
            ],


        /*Student*/
            [
                'group'=>'Student',
                'name' => 'student-index',
                'display_name' => 'Index',
                'description' => 'Student Index'
            ],
            [
                'group'=>'Student',
                'name' => 'student-registration',
                'display_name' => 'Registration',
                'description' => 'Student Registration'
            ],
            [
                'group'=>'Student',
                'name' => 'student-view',
                'display_name' => 'View',
                'description' => 'View Student'
            ],
            [
                'group'=>'Student',
                'name' => 'student-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Student'
            ],
            [
                'group'=>'Student',
                'name' => 'student-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Student'
            ],
            [
                'group'=>'Student',
                'name' => 'student-active',
                'display_name' => 'Active',
                'description' => 'Active Student'
            ],
            [
                'group'=>'Student',
                'name' => 'student-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Student'
            ],
            [
                'group'=>'Student',
                'name' => 'student-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Student Bulk Action'
            ],
            [
                'group'=>'Student',
                'name' => 'student-delete-academic-info',
                'display_name' => 'Delete Academic Info',
                'description' => 'Student Delete Academic Info'
            ],
            [
                'group'=>'Student',
                'name' => 'student-transfer',
                'display_name' => 'Transfer',
                'description' => 'Transfer Student'
            ],


        /*Student Document*/
            [
                'group'=>'Student Document',
                'name' => 'student-document-index',
                'display_name' => 'Index',
                'description' => 'Student Document Index'
            ],
            [
                'group'=>'Student Document',
                'name' => 'student-document-add',
                'display_name' => 'Add',
                'description' => 'Student Document Add'
            ],
            [
                'group'=>'Student Document',
                'name' => 'student-document-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Student Document'
            ],
            [
                'group'=>'Student Document',
                'name' => 'student-document-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Student Document'
            ],
            [
                'group'=>'Student Document',
                'name' => 'student-document-active',
                'display_name' => 'Active',
                'description' => 'Active Student Document'
            ],
            [
                'group'=>'Student Document',
                'name' => 'student-document-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Student Document'
            ],
            [
                'group'=>'Student Document',
                'name' => 'student-document-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Student Document Bulk Action'
            ],

        /*Student Note*/
            [
                'group'=>'Student Note',
                'name' => 'student-note-index',
                'display_name' => 'Index',
                'description' => 'Student Note Index'
            ],
            [
                'group'=>'Student Note',
                'name' => 'student-note-add',
                'display_name' => 'Add',
                'description' => 'Student Note Add'
            ],
            [
                'group'=>'Student Note',
                'name' => 'student-note-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Student Note'
            ],
            [
                'group'=>'Student Note',
                'name' => 'student-note-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Student Note'
            ],
            [
                'group'=>'Student Note',
                'name' => 'student-note-active',
                'display_name' => 'Active',
                'description' => 'Active Student Note'
            ],
            [
                'group'=>'Student Note',
                'name' => 'student-note-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Student Note'
            ],
            [
                'group'=>'Student Note',
                'name' => 'student-note-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Student Note Bulk Action'
            ],

        /*Staff*/
            [
                'group'=>'Staff',
                'name' => 'staff-index',
                'display_name' => 'Index',
                'description' => 'Staff Index'
            ],
            [
                'group'=>'Staff',
                'name' => 'staff-add',
                'display_name' => 'Add',
                'description' => 'Staff Registration'
            ],
            [
                'group'=>'Staff',
                'name' => 'staff-view',
                'display_name' => 'View',
                'description' => 'View Staff'
            ],
            [
                'group'=>'Staff',
                'name' => 'staff-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Staff'
            ],
            [
                'group'=>'Staff',
                'name' => 'staff-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Staff'
            ],
            [
                'group'=>'Staff',
                'name' => 'staff-active',
                'display_name' => 'Active',
                'description' => 'Active Staff'
            ],
            [
                'group'=>'Staff',
                'name' => 'staff-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Staff'
            ],
            [
                'group'=>'Staff',
                'name' => 'staff-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Staff Bulk Action'
            ],


        /*Staff Document*/
            [
                'group'=>'Staff Document',
                'name' => 'staff-document-index',
                'display_name' => 'Index',
                'description' => 'Staff Document Index'
            ],
            [
                'group'=>'Staff Document',
                'name' => 'staff-document-add',
                'display_name' => 'Add',
                'description' => 'Staff Document Add'
            ],
            [
                'group'=>'Staff Document',
                'name' => 'staff-document-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Staff Document'
            ],
            [
                'group'=>'Staff Document',
                'name' => 'staff-document-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Staff Document'
            ],
            [
                'group'=>'Staff Document',
                'name' => 'staff-document-active',
                'display_name' => 'Active',
                'description' => 'Active Staff Document'
            ],
            [
                'group'=>'Staff Document',
                'name' => 'staff-document-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Staff Document'
            ],
            [
                'group'=>'Staff Document',
                'name' => 'staff-document-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Staff Document Bulk Action'
            ],

        /*Staff Note*/
            [
                'group'=>'Staff Note',
                'name' => 'staff-note-index',
                'display_name' => 'Index',
                'description' => 'Staff Note Index'
            ],
            [
                'group'=>'Staff Note',
                'name' => 'staff-note-add',
                'display_name' => 'Add',
                'description' => 'Staff Note Add'
            ],
            [
                'group'=>'Staff Note',
                'name' => 'staff-note-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Staff Note'
            ],
            [
                'group'=>'Staff Note',
                'name' => 'staff-note-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Staff Note'
            ],
            [
                'group'=>'Staff Note',
                'name' => 'staff-note-active',
                'display_name' => 'Active',
                'description' => 'Active Staff Note'
            ],
            [
                'group'=>'Staff Note',
                'name' => 'staff-note-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Staff Note'
            ],
            [
                'group'=>'Staff Note',
                'name' => 'staff-note-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Staff Note Bulk Action'
            ],

        /*Staff Designation*/
            [
                'group'=>'Staff Designation',
                'name' => 'staff-designation-index',
                'display_name' => 'Index',
                'description' => 'Staff Designation Index'
            ],
            [
                'group'=>'Staff Designation',
                'name' => 'staff-designation-add',
                'display_name' => 'Add',
                'description' => 'Staff Designation Add'
            ],
            [
                'group'=>'Staff Designation',
                'name' => 'staff-designation-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Staff Designation'
            ],
            [
                'group'=>'Staff Designation',
                'name' => 'staff-designation-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Staff Designation'
            ],
            [
                'group'=>'Staff Designation',
                'name' => 'staff-designation-active',
                'display_name' => 'Active',
                'description' => 'Active Staff Designation'
            ],
            [
                'group'=>'Staff Designation',
                'name' => 'staff-designation-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Staff Designation'
            ],
            [
                'group'=>'Staff Designation',
                'name' => 'staff-designation-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Staff Designation Bulk Action'
            ],

        /*Account Fees*/
            [
                'group'=>'Fees',
                'name' => 'fees-index',
                'display_name' => 'Index',
                'description' => 'Student Fees Index'
            ],
            [
                'group'=>'Fees',
                'name' => 'fees-balance',
                'display_name' => 'Balance',
                'description' => 'Fees Balance'
            ],

        /*Fees Head*/
            [
                'group'=>'Fees Head',
                'name' => 'fees-head-index',
                'display_name' => 'Index',
                'description' => 'Fees Head Index'
            ],
            [
                'group'=>'Fees Head',
                'name' => 'fees-head-add',
                'display_name' => 'Add',
                'description' => 'Fees Head Add'
            ],
            [
                'group'=>'Fees Head',
                'name' => 'fees-head-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Fees Head'
            ],
            [
                'group'=>'Fees Head',
                'name' => 'fees-head-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Fees Head'
            ],
            [
                'group'=>'Fees Head',
                'name' => 'fees-head-active',
                'display_name' => 'Active',
                'description' => 'Active Fees Head'
            ],
            [
                'group'=>'Fees Head',
                'name' => 'fees-head-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Fees Head'
            ],
            [
                'group'=>'Fees Head',
                'name' => 'fees-head-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Fees Head Bulk Action'
            ],

        /*Fees Master*/
            [
                'group'=>'Fees Master',
                'name' => 'fees-master-index',
                'display_name' => 'Index',
                'description' => 'Fees Master Index'
            ],
            [
                'group'=>'Fees Master',
                'name' => 'fees-master-add',
                'display_name' => 'Add',
                'description' => 'Fees Master Add'
            ],
            [
                'group'=>'Fees Master',
                'name' => 'fees-master-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Fees Master'
            ],
            [
                'group'=>'Fees Master',
                'name' => 'fees-master-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Fees Master'
            ],
            [
                'group'=>'Fees Master',
                'name' => 'fees-master-active',
                'display_name' => 'Active',
                'description' => 'Active Fees Master'
            ],
            [
                'group'=>'Fees Master',
                'name' => 'fees-master-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Fees Master'
            ],
            [
                'group'=>'Fees Master',
                'name' => 'fees-master-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Fees Master Bulk Action'
            ],

        /*Fees Collection*/
            [
                'group'=>'Fees Collection',
                'name' => 'fees-collection-index',
                'display_name' => 'Index',
                'description' => 'Fees Collection Index'
            ],
            [
                'group'=>'Fees Collection',
                'name' => 'fees-collection-add',
                'display_name' => 'Add',
                'description' => 'Fees Collection Add'
            ],
            [
                'group'=>'Fees Collection',
                'name' => 'fees-collection-view',
                'display_name' => 'View',
                'description' => 'View Fees Collection'
            ],
            [
                'group'=>'Fees Collection',
                'name' => 'fees-collection-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Fees Collection'
            ],

        /*Online Payment*/
            [
                'group'=>'Online Payment',
                'name' => 'fees-payment-stripe-payment',
                'display_name' => 'Stripe',
                'description' => 'Stripe Payment'
            ],
            [
                'group'=>'Online Payment',
                'name' => 'fees-payment-khalti-payment',
                'display_name' => 'Khalti',
                'description' => 'Khalti Payment'
            ],
            [
                'group'=>'Online Payment',
                'name' => 'fees-payment-payumoney-payment',
                'display_name' => 'payUmoney',
                'description' => 'PayUmoney Payment'
            ],

        /*Account Payroll*/
            [
                'group'=>'Payroll',
                'name' => 'payroll-index',
                'display_name' => 'Index',
                'description' => 'Staff Payroll Index'
            ],
            [
                'group'=>'Payroll',
                'name' => 'payroll-balance',
                'display_name' => 'Balance',
                'description' => 'Payroll Balance'
            ],

        /*Payroll Head*/
            [
                'group'=>'Payroll Head',
                'name' => 'payroll-head-index',
                'display_name' => 'Index',
                'description' => 'Payroll Head Index'
            ],
            [
                'group'=>'Payroll Head',
                'name' => 'payroll-head-add',
                'display_name' => 'Add',
                'description' => 'Payroll Head Add'
            ],
            [
                'group'=>'Payroll Head',
                'name' => 'payroll-head-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Payroll Head'
            ],
            [
                'group'=>'Payroll Head',
                'name' => 'payroll-head-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Payroll Head'
            ],
            [
                'group'=>'Payroll Head',
                'name' => 'payroll-head-active',
                'display_name' => 'Active',
                'description' => 'Active Payroll Head'
            ],
            [
                'group'=>'Payroll Head',
                'name' => 'payroll-head-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Payroll Head'
            ],
            [
                'group'=>'Payroll Head',
                'name' => 'payroll-head-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Payroll Head Bulk Action'
            ],

        /*Payroll Master*/
            [
                'group'=>'Payroll Master',
                'name' => 'payroll-master-index',
                'display_name' => 'Index',
                'description' => 'Payroll Master Index'
            ],
            [
                'group'=>'Payroll Master',
                'name' => 'payroll-master-add',
                'display_name' => 'Add',
                'description' => 'Payroll Master Add'
            ],
            [
                'group'=>'Payroll Master',
                'name' => 'payroll-master-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Payroll Master'
            ],
            [
                'group'=>'Payroll Master',
                'name' => 'payroll-master-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Payroll Master'
            ],
            [
                'group'=>'Payroll Master',
                'name' => 'payroll-master-active',
                'display_name' => 'Active',
                'description' => 'Active Payroll Master'
            ],
            [
                'group'=>'Payroll Master',
                'name' => 'payroll-master-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Payroll Master'
            ],
            [
                'group'=>'Payroll Master',
                'name' => 'payroll-master-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Payroll Master Bulk Action'
            ],

        /*Salary Pay*/
            [
                'group'=>'Salary Pay',
                'name' => 'salary-payment-index',
                'display_name' => 'Index',
                'description' => 'Salary Pay Index'
            ],
            [
                'group'=>'Salary Pay',
                'name' => 'salary-payment-add',
                'display_name' => 'Add',
                'description' => 'Salary Pay Add'
            ],
            [
                'group'=>'Salary Pay',
                'name' => 'salary-payment-view',
                'display_name' => 'View',
                'description' => 'View Salary Pay'
            ],
            [
                'group'=>'Salary Pay',
                'name' => 'salary-payment-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Salary Pay'
            ],

        /*Transaction Head*/
            [
                'group'=>'Transaction Head',
                'name' => 'transaction-head-index',
                'display_name' => 'Index',
                'description' => 'Transaction Head Index'
            ],
            [
                'group'=>'Transaction Head',
                'name' => 'transaction-head-add',
                'display_name' => 'Add',
                'description' => 'Transaction Head Add'
            ],
            [
                'group'=>'Transaction Head',
                'name' => 'transaction-head-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Transaction Head'
            ],
            [
                'group'=>'Transaction Head',
                'name' => 'transaction-head-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Transaction Head'
            ],
            [
                'group'=>'Transaction Head',
                'name' => 'transaction-head-active',
                'display_name' => 'Active',
                'description' => 'Active Transaction Head'
            ],
            [
                'group'=>'Transaction Head',
                'name' => 'transaction-head-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Transaction Head'
            ],
            [
                'group'=>'Transaction Head',
                'name' => 'transaction-head-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Payroll Head Bulk Action'
            ],

        /*Transaction*/
            [
                'group'=>'Transaction',
                'name' => 'transaction-index',
                'display_name' => 'Index',
                'description' => 'Transaction Index'
            ],
            [
                'group'=>'Transaction',
                'name' => 'transaction-add',
                'display_name' => 'Add',
                'description' => 'Transaction Add'
            ],
            [
                'group'=>'Transaction',
                'name' => 'transaction-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Transaction'
            ],
            [
                'group'=>'Transaction',
                'name' => 'transaction-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Transaction'
            ],
            [
                'group'=>'Transaction',
                'name' => 'transaction-active',
                'display_name' => 'Active',
                'description' => 'Active Transaction'
            ],
            [
                'group'=>'Transaction',
                'name' => 'transaction-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Transaction'
            ],
            [
                'group'=>'Transaction',
                'name' => 'transaction-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Transaction Bulk Action'
            ],

        /*Account Print*/
            [
                'group'=>'Account Print',
                'name' => 'fee-print-master',
                'display_name' => 'Master Slip',
                'description' => 'Fee Master Slip'
            ],
            [
                'group'=>'Account Print',
                'name' => 'fee-print-collection',
                'display_name' => 'Collection',
                'description' => 'Print Fee Collection'
            ],
            [
                'group'=>'Account Print',
                'name' => 'fee-print-today-receipt',
                'display_name' => 'Today Short Receipt',
                'description' => 'Print Today Short Receipt'
            ],
            [
                'group'=>'Account Print',
                'name' => 'fee-print-today-detail-receipt',
                'display_name' => 'Today Detail Receipt',
                'description' => 'Print Today Detail Receip'
            ],
            [
                'group'=>'Account Print',
                'name' => 'fee-print-student-ledger',
                'display_name' => 'Student Ledger',
                'description' => 'Print Student Ledger'
            ],
            [
                'group'=>'Account Print',
                'name' => 'fee-print-student-due',
                'display_name' => 'Due Short Slip',
                'description' => 'Print Due Short Slip'
            ],
            [
                'group'=>'Account Print',
                'name' => 'fee-print-student-due-detail',
                'display_name' => 'Due Detail Slip',
                'description' => 'Print Due Detail Slip'
            ],
            [
                'group'=>'Account Print',
                'name' => 'fee-print-bulk-due-slip',
                'display_name' => 'Bulk Due Short Slip',
                'description' => 'Print Bulk Due Short Slip'
            ],
            [
                'group'=>'Account Print',
                'name' => 'fee-print-bulk-due-detail-slip',
                'display_name' => 'Bulk Due Detail SLip',
                'description' => 'Print Bulk Due Detail SLip'
            ],

        /*Library */
            [
                'group'=>'Library',
                'name' => 'library-index',
                'display_name' => 'Index',
                'description' => 'Library Index'
            ],
            [
                'group'=>'Library',
                'name' => 'library-book-issue',
                'display_name' => 'Book Issue',
                'description' => 'Book Issue'
            ],
            [
                'group'=>'Library',
                'name' => 'library-book-return',
                'display_name' => 'Book Return',
                'description' => 'Return Book'
            ],
            [
                'group'=>'Library',
                'name' => 'library-return-over',
                'display_name' => 'Return Period Over',
                'description' => 'Return Period Over'
            ],
            [
                'group'=>'Library',
                'name' => 'library-issue-history',
                'display_name' => 'History',
                'description' => 'Issue History'
            ],

         /*Book*/
            [
                'group'=>'Book',
                'name' => 'book-index',
                'display_name' => 'Index',
                'description' => 'Book Index'
            ],
            [
                'group'=>'Book',
                'name' => 'book-add',
                'display_name' => 'Add',
                'description' => 'Book Add'
            ],
            [
                'group'=>'Book',
                'name' => 'book-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Book'
            ],
            [
                'group'=>'Book',
                'name' => 'book-view',
                'display_name' => 'View',
                'description' => 'View Book'
            ],
            [
                'group'=>'Book',
                'name' => 'book-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Book'
            ],
            [
                'group'=>'Book',
                'name' => 'book-active',
                'display_name' => 'Active',
                'description' => 'Active Book'
            ],
            [
                'group'=>'Book',
                'name' => 'book-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Book'
            ],
            [
                'group'=>'Book',
                'name' => 'book-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Book Bulk Action'
            ],
            [
                'group'=>'Book',
                'name' => 'book-add-copies',
                'display_name' => 'Add Book Copies',
                'description' => 'Add Book Copies'
            ],
            [
                'group'=>'Book',
                'name' => 'book-status',
                'display_name' => 'Status',
                'description' => 'Book Status'
            ],
            [
                'group'=>'Book',
                'name' => 'book-bulk-copies-delete',
                'display_name' => 'Delete Bulk Copies',
                'description' => 'Delete Bulk Copes'
            ],

        /*Book Category*/
            [
                'group'=>'Book Category',
                'name' => 'book-category-index',
                'display_name' => 'Index',
                'description' => 'Book Category Index'
            ],
            [
                'group'=>'Book Category',
                'name' => 'book-category-add',
                'display_name' => 'Add',
                'description' => 'Book Category Add'
            ],
            [
                'group'=>'Book Category',
                'name' => 'book-category-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Book Category'
            ],
            [
                'group'=>'Book Category',
                'name' => 'book-category-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Book Category'
            ],
            [
                'group'=>'Book Category',
                'name' => 'book-category-active',
                'display_name' => 'Active',
                'description' => 'Active Book Category'
            ],
            [
                'group'=>'Book Category',
                'name' => 'book-category-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Book Category'
            ],
            [
                'group'=>'Book Category',
                'name' => 'book-category-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Book Category Bulk Action'
            ],

        /*Circulation*/
            [
                'group'=>'Library Circulation',
                'name' => 'library-circulation-index',
                'display_name' => 'Index',
                'description' => 'Library Circulation Index'
            ],
            [
                'group'=>'Library Circulation',
                'name' => 'library-circulation-add',
                'display_name' => 'Add',
                'description' => 'Library Circulation Add'
            ],
            [
                'group'=>'Library Circulation',
                'name' => 'library-circulation-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Library Circulation'
            ],
            [
                'group'=>'Library Circulation',
                'name' => 'library-circulation-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Library Circulation'
            ],
            [
                'group'=>'Library Circulation',
                'name' => 'library-circulation-active',
                'display_name' => 'Active',
                'description' => 'Active Library Circulation'
            ],
            [
                'group'=>'Library Circulation',
                'name' => 'library-circulation-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Library Circulation'
            ],
            [
                'group'=>'Library Circulation',
                'name' => 'library-circulation-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Library Circulation Bulk Action'
            ],

        /*Library Member*/
            [
                'group'=>'Library Member',
                'name' => 'library-member-index',
                'display_name' => 'Index',
                'description' => 'Library Member Index'
            ],
            [
                'group'=>'Library Member',
                'name' => 'library-member-add',
                'display_name' => 'Add',
                'description' => 'Library Member Add'
            ],
            [
                'group'=>'Library Member',
                'name' => 'library-member-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Library Member'
            ],
            [
                'group'=>'Library Member',
                'name' => 'library-member-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Library Member'
            ],
            [
                'group'=>'Library Member',
                'name' => 'library-member-active',
                'display_name' => 'Active',
                'description' => 'Active Library Member'
            ],
            [
                'group'=>'Library Member',
                'name' => 'library-member-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Library Member'
            ],
            [
                'group'=>'Library Member',
                'name' => 'library-member-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Library Member Bulk Action'
            ],
            [
                'group'=>'Library Member',
                'name' => 'library-member-staff',
                'display_name' => 'Staff Index',
                'description' => 'Library Member Staff'
            ],
            [
                'group'=>'Library Member',
                'name' => 'library-member-staff-view',
                'display_name' => 'Staff View',
                'description' => 'Library Member Staff'
            ],
            [
                'group'=>'Library Member',
                'name' => 'library-member-student',
                'display_name' => 'Student Index',
                'description' => 'Library Member Student'
            ],
            [
                'group'=>'Library Member',
                'name' => 'library-member-student-view',
                'display_name' => 'Student View',
                'description' => 'Library Member Student'
            ],

        /*Attendance*/
        /*Attendance Master*/
            [
                'group'=>'Attendance Master',
                'name' => 'attendance-master-index',
                'display_name' => 'Index',
                'description' => 'Attendance Master Index'
            ],
            [
                'group'=>'Attendance Master',
                'name' => 'attendance-master-add',
                'display_name' => 'Add',
                'description' => 'Attendance Master Add'
            ],
            [
                'group'=>'Attendance Master',
                'name' => 'attendance-master-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Attendance Master'
            ],
            [
                'group'=>'Attendance Master',
                'name' => 'attendance-master-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Attendance Master'
            ],
            [
                'group'=>'Attendance Master',
                'name' => 'attendance-master-active',
                'display_name' => 'Active',
                'description' => 'Active Attendance Master'
            ],
            [
                'group'=>'Attendance Master',
                'name' => 'attendance-master-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Attendance Master'
            ],
            [
                'group'=>'Attendance Master',
                'name' => 'attendance-master-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Attendance Master Bulk Action'
            ],

        /*Student Attendance */
            [
                'group'=>'Student Attendance',
                'name' => 'student-attendance-index',
                'display_name' => 'Index',
                'description' => 'Student Attendance Index'
            ],
            [
                'group'=>'Student Attendance',
                'name' => 'student-attendance-add',
                'display_name' => 'Add',
                'description' => 'Student Attendance Add'
            ],
            [
                'group'=>'Student Attendance',
                'name' => 'student-attendance-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Student Attendance'
            ],
            [
                'group'=>'Student Attendance',
                'name' => 'student-attendance-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Student Attendance Bulk Action'
            ],

        /*Staff Attendance */
            [
                'group'=>'Staff Attendance',
                'name' => 'staff-attendance-index',
                'display_name' => 'Index',
                'description' => 'Staff Attendance Index'
            ],
            [
                'group'=>'Staff Attendance',
                'name' => 'staff-attendance-add',
                'display_name' => 'Add',
                'description' => 'Staff Attendance Add'
            ],
            [
                'group'=>'Staff Attendance',
                'name' => 'staff-attendance-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Staff Attendance'
            ],
            [
                'group'=>'Staff Attendance',
                'name' => 'staff-attendance-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Staff Attendance Bulk Action'
            ],

        /*Exam*/
            [
                'group'=>'Exam',
                'name' => 'exam-index',
                'display_name' => 'Index',
                'description' => 'Exam Index'
            ],
            [
                'group'=>'Exam',
                'name' => 'exam-add',
                'display_name' => 'Add',
                'description' => 'Exam Add'
            ],
            [
                'group'=>'Exam',
                'name' => 'exam-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Exam'
            ],
            [
                'group'=>'Exam',
                'name' => 'exam-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Exam'
            ],
            [
                'group'=>'Exam',
                'name' => 'exam-active',
                'display_name' => 'Active',
                'description' => 'Active Exam'
            ],
            [
                'group'=>'Exam',
                'name' => 'exam-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Exam'
            ],
            [
                'group'=>'Exam',
                'name' => 'exam-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Exam Bulk Action'
            ],
            [
                'group'=>'Exam',
                'name' => 'exam-admit-card',
                'display_name' => 'Admit Card',
                'description' => 'Exam Admit Card'
            ],
            [
                'group'=>'Exam',
                'name' => 'exam-exam-routine',
                'display_name' => 'Routin/Schedule',
                'description' => 'Exam Routine/Schedule'
            ],
            [
                'group'=>'Exam',
                'name' => 'exam-mark-sheet',
                'display_name' => 'MarkSheet',
                'description' => 'Exam Mark Sheet'
            ],
            [
                'group'=>'Exam',
                'name' => 'exam-result-publish',
                'display_name' => 'Result Publish',
                'description' => 'Exam Result Publish'
            ],
            [
                'group'=>'Exam',
                'name' => 'exam-result-un-publish',
                'display_name' => 'Result UnPublish',
                'description' => 'Exam Result UnPublish'
            ],

        /*Exam Schedule*/
            [
                'group'=>'Exam Schedule',
                'name' => 'exam-schedule-index',
                'display_name' => 'Index',
                'description' => 'Exam Schedule Index'
            ],
            [
                'group'=>'Exam Schedule',
                'name' => 'exam-schedule-add',
                'display_name' => 'Add',
                'description' => 'Exam Schedule Add'
            ],
            [
                'group'=>'Exam Schedule',
                'name' => 'exam-schedule-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Exam Schedule'
            ],
            [
                'group'=>'Exam Schedule',
                'name' => 'exam-schedule-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Exam Schedule'
            ],
            [
                'group'=>'Exam Schedule',
                'name' => 'exam-schedule-active',
                'display_name' => 'Active',
                'description' => 'Active Exam Schedule'
            ],
            [
                'group'=>'Exam Schedule',
                'name' => 'exam-schedule-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Exam Schedule'
            ],

        /*Exam Mark Ledger*/
            [
                'group'=>'Exam Mark Ledger',
                'name' => 'exam-mark-ledger-index',
                'display_name' => 'Index',
                'description' => 'Exam Mark Ledger Index'
            ],
            [
                'group'=>'Exam Mark Ledger',
                'name' => 'exam-mark-ledger-add',
                'display_name' => 'Add',
                'description' => 'Exam Mark Ledger Add'
            ],
            [
                'group'=>'Exam Mark Ledger',
                'name' => 'exam-mark-ledger-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Exam Mark Ledger'
            ],
            [
                'group'=>'Exam Mark Ledger',
                'name' => 'exam-mark-ledger-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Exam Mark Ledger'
            ],
            [
                'group'=>'Exam Mark Ledger',
                'name' => 'exam-mark-ledger-active',
                'display_name' => 'Active',
                'description' => 'Active Exam Mark Ledger'
            ],
            [
                'group'=>'Exam Mark Ledger',
                'name' => 'exam-mark-ledger-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Exam Mark Ledger'
            ],

        /*Exam Print*/
            [
                'group'=>'Exam Print',
                'name' => 'exam-print-admitcard',
                'display_name' => 'Admit Card',
                'description' => 'Exam Admit Card'
            ],
            [
                'group'=>'Exam Print',
                'name' => 'exam-print-routine',
                'display_name' => 'Routine/Schedule',
                'description' => 'Exam Routine/Schedule'
            ],
            [
                'group'=>'Exam Print',
                'name' => 'exam-print-mark-sheet',
                'display_name' => 'Mark/Grade Sheet',
                'description' => 'Exam Mark/Grade Sheet'
            ],

        /*Hostel*/
            [
                'group'=>'Hostel',
                'name' => 'hostel-index',
                'display_name' => 'Index',
                'description' => 'Hostel Index'
            ],
            [
                'group'=>'Hostel',
                'name' => 'hostel-add',
                'display_name' => 'Add',
                'description' => 'Hostel Add'
            ],
            [
                'group'=>'Hostel',
                'name' => 'hostel-view',
                'display_name' => 'view',
                'description' => 'Hostel View'
            ],
            [
                'group'=>'Hostel',
                'name' => 'hostel-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Hostel'
            ],
            [
                'group'=>'Hostel',
                'name' => 'hostel-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Hostel'
            ],
            [
                'group'=>'Hostel',
                'name' => 'hostel-active',
                'display_name' => 'Active',
                'description' => 'Active Hostel'
            ],
            [
                'group'=>'Hostel',
                'name' => 'hostel-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Hostel'
            ],
            [
                'group'=>'Hostel',
                'name' => 'hostel-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Hostel Bulk Action'
            ],

        /*Room*/
            [
                'group'=>'Room',
                'name' => 'room-add',
                'display_name' => 'Add',
                'description' => 'Room Add'
            ],
            [
                'group'=>'Room',
                'name' => 'room-view',
                'display_name' => 'View',
                'description' => 'Room View'
            ],
            [
                'group'=>'Room',
                'name' => 'room-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Room'
            ],
            [
                'group'=>'Room',
                'name' => 'room-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Room'
            ],
            [
                'group'=>'Room',
                'name' => 'room-active',
                'display_name' => 'Active',
                'description' => 'Active Room'
            ],
            [
                'group'=>'Room',
                'name' => 'room-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Room'
            ],
            [
                'group'=>'Room',
                'name' => 'room-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Room Bulk Action'
            ],

        /*Bed*/
            [
                'group'=>'Bed',
                'name' => 'bed-add',
                'display_name' => 'Add',
                'description' => 'Bed Add'
            ],
            [
                'group'=>'Bed',
                'name' => 'bed-status',
                'display_name' => 'Status',
                'description' => 'Bed Status'
            ],
            [
                'group'=>'Bed',
                'name' => 'bed-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Bed'
            ],
            [
                'group'=>'Bed',
                'name' => 'bed-active',
                'display_name' => 'Active',
                'description' => 'Active Bed'
            ],
            [
                'group'=>'Bed',
                'name' => 'bed-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Bed'
            ],
            [
                'group'=>'Bed',
                'name' => 'bed-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Bed Bulk Action'
            ],

        /*Room Type*/
            [
                'group'=>'Room Type',
                'name' => 'room-type-index',
                'display_name' => 'Index',
                'description' => 'Room Type Index'
            ],
            [
                'group'=>'Room Type',
                'name' => 'room-type-add',
                'display_name' => 'Add',
                'description' => 'Room Type Add'
            ],
            [
                'group'=>'Room Type',
                'name' => 'room-type-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Room Type'
            ],
            [
                'group'=>'Room Type',
                'name' => 'room-type-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Room Type'
            ],
            [
                'group'=>'Room Type',
                'name' => 'room-type-active',
                'display_name' => 'Active',
                'description' => 'Active Room Type'
            ],
            [
                'group'=>'Room Type',
                'name' => 'room-type-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Room Type'
            ],
            [
                'group'=>'Room Type',
                'name' => 'room-type-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Room Type Bulk Action'
            ],

        /*Resident*/
            [
                'group'=>'Resident',
                'name' => 'resident-index',
                'display_name' => 'Index',
                'description' => 'Resident Index'
            ],
            [
                'group'=>'Resident',
                'name' => 'resident-add',
                'display_name' => 'Add',
                'description' => 'Resident Add'
            ],
            [
                'group'=>'Resident',
                'name' => 'resident-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Resident'
            ],
            [
                'group'=>'Resident',
                'name' => 'resident-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Resident'
            ],
            [
                'group'=>'Resident',
                'name' => 'resident-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Resident Bulk Action'
            ],
            [
                'group'=>'Resident',
                'name' => 'resident-renew',
                'display_name' => 'Renew',
                'description' => 'Renew Resident'
            ],
            [
                'group'=>'Resident',
                'name' => 'resident-leave',
                'display_name' => 'Leave',
                'description' => 'Leave Resident'
            ],
            [
                'group'=>'Resident',
                'name' => 'resident-shift',
                'display_name' => 'Shift',
                'description' => 'Shift Resident'
            ],
            [
                'group'=>'Resident',
                'name' => 'resident-history',
                'display_name' => 'History',
                'description' => 'Resident History'
            ],

        /*Food*/
            [
                'group'=>'Food',
                'name' => 'food-index',
                'display_name' => 'Index',
                'description' => 'Food Index'
            ],
            [
                'group'=>'Food',
                'name' => 'food-add',
                'display_name' => 'Add',
                'description' => 'Food Add'
            ],
            [
                'group'=>'Food',
                'name' => 'food-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Food'
            ],
            [
                'group'=>'Food',
                'name' => 'food-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Food'
            ],
            [
                'group'=>'Food',
                'name' => 'food-active',
                'display_name' => 'Active',
                'description' => 'Active Food'
            ],
            [
                'group'=>'Food',
                'name' => 'food-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Food'
            ],
            [
                'group'=>'Food',
                'name' => 'food-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Food Bulk Action'
            ],

        /*Food Category*/
            [
                'group'=>'Food Category',
                'name' => 'food-category-index',
                'display_name' => 'Index',
                'description' => 'Food Category Index'
            ],
            [
                'group'=>'Food Category',
                'name' => 'food-category-add',
                'display_name' => 'Add',
                'description' => 'Food Category Add'
            ],
            [
                'group'=>'Food Category',
                'name' => 'food-category-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Food Category'
            ],
            [
                'group'=>'Food Category',
                'name' => 'food-category-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Food Category'
            ],
            [
                'group'=>'Food Category',
                'name' => 'food-category-active',
                'display_name' => 'Active',
                'description' => 'Active Food Category'
            ],
            [
                'group'=>'Food Category',
                'name' => 'food-category-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Food Category'
            ],
            [
                'group'=>'Food Category',
                'name' => 'food-category-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Food Category Bulk Action'
            ],
            
        /*Food Item*/
            [
                'group'=>'Food Item',
                'name' => 'food-item-index',
                'display_name' => 'Index',
                'description' => 'Food Item Index'
            ],
            [
                'group'=>'Food Item',
                'name' => 'food-item-add',
                'display_name' => 'Add',
                'description' => 'Food Item Add'
            ],
            [
                'group'=>'Food Item',
                'name' => 'food-item-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Food Item'
            ],
            [
                'group'=>'Food Item',
                'name' => 'food-item-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Food Item'
            ],
            [
                'group'=>'Food Item',
                'name' => 'food-item-active',
                'display_name' => 'Active',
                'description' => 'Active Food Item'
            ],
            [
                'group'=>'Food Item',
                'name' => 'food-item-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Food Item'
            ],
            [
                'group'=>'Food Item',
                'name' => 'food-item-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Food Item Bulk Action'
            ],    

        /*Eating Time*/
            [
                'group'=>'Eating Time',
                'name' => 'eating-time-index',
                'display_name' => 'Index',
                'description' => 'Eating Time Index'
            ],
            [
                'group'=>'Eating Time',
                'name' => 'eating-time-add',
                'display_name' => 'Add',
                'description' => 'Eating Time Add'
            ],
            [
                'group'=>'Eating Time',
                'name' => 'eating-time-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Eating Time'
            ],
            [
                'group'=>'Eating Time',
                'name' => 'eating-time-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Eating Time'
            ],
            [
                'group'=>'Eating Time',
                'name' => 'eating-time-active',
                'display_name' => 'Active',
                'description' => 'Active Eating Time'
            ],
            [
                'group'=>'Eating Time',
                'name' => 'eating-time-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Eating Time'
            ],
            [
                'group'=>'Eating Time',
                'name' => 'eating-time-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Eating Time Bulk Action'
            ],

        /*Transport Route*/
            [
                'group'=>'Transport Route',
                'name' => 'transport-route-index',
                'display_name' => 'Index',
                'description' => 'Transport Route Index'
            ],
            [
                'group'=>'Transport Route',
                'name' => 'transport-route-add',
                'display_name' => 'Add',
                'description' => 'Transport Route Add'
            ],
            [
                'group'=>'Transport Route',
                'name' => 'transport-route-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Transport Route'
            ],
            [
                'group'=>'Transport Route',
                'name' => 'transport-route-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Transport Route'
            ],
            [
                'group'=>'Transport Route',
                'name' => 'transport-route-active',
                'display_name' => 'Active',
                'description' => 'Active Transport Route'
            ],
            [
                'group'=>'Transport Route',
                'name' => 'transport-route-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Transport Route'
            ],
            [
                'group'=>'Transport Route',
                'name' => 'transport-route-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Transport Route Bulk Action'
            ],

        /*Vehicle*/
            [
                'group'=>'Vehicle',
                'name' => 'vehicle-index',
                'display_name' => 'Index',
                'description' => 'Vehicle Index'
            ],
            [
                'group'=>'Vehicle',
                'name' => 'vehicle-add',
                'display_name' => 'Add',
                'description' => 'Vehicle Add'
            ],
            [
                'group'=>'Vehicle',
                'name' => 'vehicle-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Vehicle'
            ],
            [
                'group'=>'Vehicle',
                'name' => 'vehicle-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Vehicle'
            ],
            [
                'group'=>'Vehicle',
                'name' => 'vehicle-active',
                'display_name' => 'Active',
                'description' => 'Active Vehicle'
            ],
            [
                'group'=>'Vehicle',
                'name' => 'vehicle-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Vehicle'
            ],
            [
                'group'=>'Vehicle',
                'name' => 'vehicle-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Vehicle Bulk Action'
            ],

        /*Traveller/User of Transport*/
            [
                'group'=>'Transport User/Traveller',
                'name' => 'transport-user-index',
                'display_name' => 'Index',
                'description' => 'Transport User/Traveller Index'
            ],
            [
                'group'=>'Transport User/Traveller',
                'name' => 'transport-user-add',
                'display_name' => 'Add',
                'description' => 'Transport User/Traveller Add'
            ],
            [
                'group'=>'Transport User/Traveller',
                'name' => 'transport-user-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Transport User/Traveller'
            ],
            [
                'group'=>'Transport User/Traveller',
                'name' => 'transport-user-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Transport User/Traveller'
            ],
            [
                'group'=>'Transport User/Traveller',
                'name' => 'transport-user-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Transport User/Traveller Bulk Action'
            ],
            [
                'group'=>'Transport User/Traveller',
                'name' => 'transport-user-renew',
                'display_name' => 'Renew',
                'description' => 'Renew Transport User/Traveller'
            ],
            [
                'group'=>'Transport User/Traveller',
                'name' => 'transport-user-leave',
                'display_name' => 'Leave',
                'description' => 'Leave Transport User/Traveller'
            ],
            [
                'group'=>'Transport User/Traveller',
                'name' => 'transport-user-shift',
                'display_name' => 'Shift',
                'description' => 'Shift Transport User/Traveller'
            ],
            [
                'group'=>'Transport User/Traveller',
                'name' => 'transport-user-history',
                'display_name' => 'History',
                'description' => 'Resident History'
            ],

        /*Report*/
            [
                'group'=>'Report',
                'name' => 'student-report',
                'display_name' => 'Student',
                'description' => 'Student Report'
            ],
            [
                'group'=>'Report',
                'name' => 'staff-report',
                'display_name' => 'Staff',
                'description' => 'Staff Report'
            ],

        /*Notice*/
            [
                'group'=>'Notice',
                'name' => 'notice-index',
                'display_name' => 'Index',
                'description' => 'Notice Index'
            ],
            [
                'group'=>'Notice',
                'name' => 'notice-add',
                'display_name' => 'Add',
                'description' => 'Notice Add'
            ],
            [
                'group'=>'Notice',
                'name' => 'notice-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Notice'
            ],
            [
                'group'=>'Notice',
                'name' => 'notice-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Notice'
            ],

        /*SMS / EMail*/
            [
                'group'=>'SMS/E-Mail',
                'name' => 'sms-email-index',
                'display_name' => 'Index',
                'description' => 'SMS/E-Mail Index'
            ],
            [
                'group'=>'SMS/E-Mail',
                'name' => 'sms-email-delete',
                'display_name' => 'Delete',
                'description' => 'SMS/E-Mail Delete'
            ],
            [
                'group'=>'SMS/E-Mail',
                'name' => 'sms-email-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Bulk SMS/E-Mail'
            ],
            [
                'group'=>'SMS/E-Mail',
                'name' => 'sms-email-create',
                'display_name' => 'Create',
                'description' => 'Create SMS/E-Mail'
            ],
            [
                'group'=>'SMS/E-Mail',
                'name' => 'sms-email-send',
                'display_name' => 'Send',
                'description' => 'Send SMS/E-Mail'
            ],
            [
                'group'=>'SMS/E-Mail',
                'name' => 'sms-email-student-guardian-send',
                'display_name' => 'Student & Guardian',
                'description' => 'Student & Guardian SMS/E-Mail'
            ],
            [
                'group'=>'SMS/E-Mail',
                'name' => 'sms-email-staff-send',
                'display_name' => 'Staff',
                'description' => 'Staff SMS/E-Mail'
            ],
            [
                'group'=>'SMS/E-Mail',
                'name' => 'sms-email-individual-send',
                'display_name' => 'Individual',
                'description' => 'Individual SMS/E-Mail'
            ],
            [
                'group'=>'SMS/E-Mail',
                'name' => 'sms-email-fee-receipt',
                'display_name' => 'Fee Receipt',
                'description' => 'Fee ReceiptSMS/E-Mail'
            ],
            [
                'group'=>'SMS/E-Mail',
                'name' => 'sms-email-due-reminder',
                'display_name' => 'Due Reminder',
                'description' => 'Due Reminder SMS/E-Mail'
            ],
            [
                'group'=>'SMS/E-Mail',
                'name' => 'sms-email-book-return-reminder',
                'display_name' => 'Book Return Reminder',
                'description' => 'Book Return Reminder'
            ],

        /*Academic Group*/
        /*Faculty*/
            [
                'group'=>'Faculty',
                'name' => 'faculty-index',
                'display_name' => 'Index',
                'description' => 'Faculty Index'
            ],
            [
                'group'=>'Faculty',
                'name' => 'faculty-add',
                'display_name' => 'Add',
                'description' => 'Faculty Add'
            ],
            [
                'group'=>'Faculty',
                'name' => 'faculty-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Faculty'
            ],
            [
                'group'=>'Faculty',
                'name' => 'faculty-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Faculty'
            ],
            [
                'group'=>'Faculty',
                'name' => 'faculty-active',
                'display_name' => 'Active',
                'description' => 'Active Faculty'
            ],
            [
                'group'=>'Faculty',
                'name' => 'faculty-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Faculty'
            ],
            [
                'group'=>'Faculty',
                'name' => 'faculty-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Faculty Bulk Action'
            ],

        /*Semester*/
            [
                'group'=>'Semester',
                'name' => 'semester-index',
                'display_name' => 'Index',
                'description' => 'Semester Index'
            ],
            [
                'group'=>'Semester',
                'name' => 'semester-add',
                'display_name' => 'Add',
                'description' => 'Semester Add'
            ],
            [
                'group'=>'Semester',
                'name' => 'semester-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Semester'
            ],
            [
                'group'=>'Semester',
                'name' => 'semester-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Semester'
            ],
            [
                'group'=>'Semester',
                'name' => 'semester-active',
                'display_name' => 'Active',
                'description' => 'Active Semester'
            ],
            [
                'group'=>'Semester',
                'name' => 'semester-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Semester'
            ],
            [
                'group'=>'Semester',
                'name' => 'semester-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Semester Bulk Action'
            ],

        /*Grading*/
            [
                'group'=>'Grading',
                'name' => 'grading-index',
                'display_name' => 'Index',
                'description' => 'Grading Index'
            ],
            [
                'group'=>'Grading',
                'name' => 'grading-add',
                'display_name' => 'Add',
                'description' => 'Grading Add'
            ],
            [
                'group'=>'Grading',
                'name' => 'grading-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Grading'
            ],
            [
                'group'=>'Grading',
                'name' => 'grading-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Grading'
            ],
            [
                'group'=>'Grading',
                'name' => 'grading-active',
                'display_name' => 'Active',
                'description' => 'Active Grading'
            ],
            [
                'group'=>'Grading',
                'name' => 'grading-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Grading'
            ],
            [
                'group'=>'Grading',
                'name' => 'grading-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Grading Bulk Action'
            ],

        /*Subject / Course / Course*/
            [
                'group'=>'Subject / Course',
                'name' => 'subject-index',
                'display_name' => 'Index',
                'description' => 'Subject / Course Index'
            ],
            [
                'group'=>'Subject / Course',
                'name' => 'subject-add',
                'display_name' => 'Add',
                'description' => 'Subject / Course Add'
            ],
            [
                'group'=>'Subject / Course',
                'name' => 'subject-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Subject / Course'
            ],
            [
                'group'=>'Subject / Course',
                'name' => 'subject-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Subject / Course'
            ],
            [
                'group'=>'Subject / Course',
                'name' => 'subject-active',
                'display_name' => 'Active',
                'description' => 'Active Subject / Course'
            ],
            [
                'group'=>'Subject / Course',
                'name' => 'subject-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Subject / Course'
            ],
            [
                'group'=>'Subject / Course',
                'name' => 'subject-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Subject / Course Bulk Action'
            ],

        /*Student Status*/
            [
                'group'=>'Student Status',
                'name' => 'student-status-index',
                'display_name' => 'Index',
                'description' => 'Student Status Index'
            ],
            [
                'group'=>'Student Status',
                'name' => 'student-status-add',
                'display_name' => 'Add',
                'description' => 'Student Status Add'
            ],
            [
                'group'=>'Student Status',
                'name' => 'student-status-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Student Status'
            ],
            [
                'group'=>'Student Status',
                'name' => 'student-status-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Student Status'
            ],
            [
                'group'=>'Student Status',
                'name' => 'student-status-active',
                'display_name' => 'Active',
                'description' => 'Active Student Status'
            ],
            [
                'group'=>'Student Status',
                'name' => 'student-status-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Student Status'
            ],
            [
                'group'=>'Student Status',
                'name' => 'student-status-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Student Status Bulk Action'
            ],

        /*Book Status*/
            [
                'group'=>'Book Status',
                'name' => 'book-status-index',
                'display_name' => 'Index',
                'description' => 'Book Status Index'
            ],
            [
                'group'=>'Book Status',
                'name' => 'book-status-add',
                'display_name' => 'Add',
                'description' => 'Book Status Add'
            ],
            [
                'group'=>'Book Status',
                'name' => 'book-status-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Book Status'
            ],
            [
                'group'=>'Book Status',
                'name' => 'book-status-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Book Status'
            ],
            [
                'group'=>'Book Status',
                'name' => 'book-status-active',
                'display_name' => 'Active',
                'description' => 'Active Book Status'
            ],
            [
                'group'=>'Book Status',
                'name' => 'book-status-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Book Status'
            ],
            [
                'group'=>'Book Status',
                'name' => 'book-status-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Book Status Bulk Action'
            ],

        /*Bed Status*/
            [
                'group'=>'Bed Status',
                'name' => 'bed-status-index',
                'display_name' => 'Index',
                'description' => 'Bed Status Index'
            ],
            [
                'group'=>'Bed Status',
                'name' => 'bed-status-add',
                'display_name' => 'Add',
                'description' => 'Bed Status Add'
            ],
            [
                'group'=>'Bed Status',
                'name' => 'bed-status-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Bed Status'
            ],
            [
                'group'=>'Bed Status',
                'name' => 'bed-status-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Bed Status'
            ],
            [
                'group'=>'Bed Status',
                'name' => 'bed-status-active',
                'display_name' => 'Active',
                'description' => 'Active Bed Status'
            ],
            [
                'group'=>'Bed Status',
                'name' => 'bed-status-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Bed Status'
            ],
            [
                'group'=>'Bed Status',
                'name' => 'bed-status-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Bed Status Bulk Action'
            ],

        /*Year*/
            [
                'group'=>'Year',
                'name' => 'year-index',
                'display_name' => 'Index',
                'description' => 'Year Index'
            ],
            [
                'group'=>'Year',
                'name' => 'year-add',
                'display_name' => 'Add',
                'description' => 'Year Add'
            ],
            [
                'group'=>'Year',
                'name' => 'year-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Year'
            ],
            [
                'group'=>'Year',
                'name' => 'year-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Year'
            ],
            [
                'group'=>'Year',
                'name' => 'year-active',
                'display_name' => 'Active',
                'description' => 'Active Year'
            ],
            [
                'group'=>'Year',
                'name' => 'year-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Year'
            ],
            [
                'group'=>'Year',
                'name' => 'year-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Year Bulk Action'
            ],
            [
                'group'=>'Year',
                'name' => 'years-active-status',
                'display_name' => 'Make Active',
                'description' => 'Year Make Active'
            ],

        /*Month*/
            [
                'group'=>'Month',
                'name' => 'month-index',
                'display_name' => 'Index',
                'description' => 'Month Index'
            ],
            [
                'group'=>'Month',
                'name' => 'month-add',
                'display_name' => 'Add',
                'description' => 'Month Add'
            ],
            [
                'group'=>'Month',
                'name' => 'month-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Month'
            ],
            [
                'group'=>'Month',
                'name' => 'month-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Month'
            ],
            [
                'group'=>'Month',
                'name' => 'month-active',
                'display_name' => 'Active',
                'description' => 'Active Month'
            ],
            [
                'group'=>'Month',
                'name' => 'month-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Month'
            ],
            [
                'group'=>'Month',
                'name' => 'month-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Month Bulk Action'
            ],

        /*Day*/
            [
                'group'=>'Day',
                'name' => 'day-index',
                'display_name' => 'Index',
                'description' => 'Day Index'
            ],
            [
                'group'=>'Day',
                'name' => 'day-add',
                'display_name' => 'Add',
                'description' => 'Day Add'
            ],
            [
                'group'=>'Day',
                'name' => 'day-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Day'
            ],
            [
                'group'=>'Day',
                'name' => 'day-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Day'
            ],
            [
                'group'=>'Day',
                'name' => 'day-active',
                'display_name' => 'Active',
                'description' => 'Active Day'
            ],
            [
                'group'=>'Day',
                'name' => 'day-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Day'
            ],
            [
                'group'=>'Day',
                'name' => 'day-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Day Bulk Action'
            ],

        /*Assignment*/
            [
                'group'=>'Assignment',
                'name' => 'assignment-index',
                'display_name' => 'Index',
                'description' => 'Assignment Index'
            ],
            [
                'group'=>'Assignment',
                'name' => 'assignment-add',
                'display_name' => 'Add',
                'description' => 'Assignment Add'
            ],
            [
                'group'=>'Assignment',
                'name' => 'assignment-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Assignment'
            ],
            [
                'group'=>'Assignment',
                'name' => 'assignment-view',
                'display_name' => 'View',
                'description' => 'View Assignment'
            ],
            [
                'group'=>'Assignment',
                'name' => 'assignment-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Assignment'
            ],
            [
                'group'=>'Assignment',
                'name' => 'assignment-active',
                'display_name' => 'Active',
                'description' => 'Active Assignment'
            ],
            [
                'group'=>'Assignment',
                'name' => 'assignment-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Assignment'
            ],
            [
                'group'=>'Assignment',
                'name' => 'assignment-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Assignment Bulk Action'
            ],

        /*Assignment Answer*/
            [
                'group'=>'Assignment Answer',
                'name' => 'assignment-answer-view',
                'display_name' => 'View',
                'description' => 'Assignment Answer View'
            ],
            [
                'group'=>'Assignment Answer',
                'name' => 'assignment-answer-approve',
                'display_name' => 'Approve',
                'description' => 'Approve Assignment Answer'
            ],
            [
                'group'=>'Assignment Answer',
                'name' => 'assignment-answer-reject',
                'display_name' => 'Reject',
                'description' => 'Reject Assignment Answer'
            ],
            [
                'group'=>'Assignment Answer',
                'name' => 'assignment-answer-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Assignment Answer'
            ],
            [
                'group'=>'Assignment Answer',
                'name' => 'assignment-answer-bulk-action',
                'display_name' => 'Bulk(Approve, Reject,Delete)',
                'description' => 'Assignment Answer Bulk Action'
            ],

        /*Download*/
            [
                'group'=>'Download',
                'name' => 'download-index',
                'display_name' => 'Index',
                'description' => 'Download Index'
            ],
            [
                'group'=>'Download',
                'name' => 'download-add',
                'display_name' => 'Add',
                'description' => 'Download Add'
            ],
            [
                'group'=>'Download',
                'name' => 'download-edit',
                'display_name' => 'Edit',
                'description' => 'Edit Download'
            ],
            [
                'group'=>'Download',
                'name' => 'download-delete',
                'display_name' => 'Delete',
                'description' => 'Delete Download'
            ],
            [
                'group'=>'Download',
                'name' => 'download-active',
                'display_name' => 'Active',
                'description' => 'Active Download'
            ],
            [
                'group'=>'Download',
                'name' => 'download-in-active',
                'display_name' => 'In-Active',
                'description' => 'In-Active Download'
            ],
            [
                'group'=>'Download',
                'name' => 'download-bulk-action',
                'display_name' => 'Bulk(Active,InActive,Delete)',
                'description' => 'Download Bulk Action'
            ],

        ];


        foreach ($permissions as $key=>$value){
            Permission::create($value);
        }
    }
}
