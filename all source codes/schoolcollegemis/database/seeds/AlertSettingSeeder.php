<?php

use Illuminate\Database\Seeder;

class AlertSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alert_settings')->insert([
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'event' => 'BirthdayWish',
                'sms' => 0,
                'email' => 0,
                'subject' =>'Wish Your Birthday',
                'template' => '',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'event' => 'StudentRegistration',
                'sms' => 0,
                'email' => 0,
                'subject' =>'Registration Information',
                'template' => 'Dear {first_name}, you are successfully registered in our institution with RegNo.{reg_no}. Thank You.',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'event' => 'StudentTransfer',
                'sms' => 0,
                'email' => 0,
                'subject' =>'Transfer Information',
                'template' => '\'Dear Student, we would like to inform you are successfully transferring to {semester}. Thank You.',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'event' => 'FeeReceive',
                'sms' => 0,
                'email' => 0,
                'subject' =>'Fees Receive Information',
                'template' => 'Dear Student, we would like to inform you. we received {amount} on {date}. Thank You.',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'event' => 'BalanceFees',
                'sms' => 0,
                'email' => 0,
                'subject' =>'Balance Fees Information',
                'template' => 'Dear Student, you have some due fees. please deposit on time. contact account for more information. Thank You.',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'event' => 'AttendanceConfirmation',
                'sms' => 0,
                'email' => 0,
                'subject' =>'Attendance Information',
                'template' => 'Dear Guardian, This is to inform you that {{first_name}} is {{status}} on {{date}}.',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'event' => 'LibraryRegistration',
                'sms' => 0,
                'email' => 0,
                'subject' =>'Library Registration Information',
                'template' => '',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'event' => 'LibraryReturnPeriodOver',
                'sms' => 0,
                'email' => 0,
                'subject' =>'Library Clearance Alert',
                'template' => '',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'event' => 'HostelRegistration',
                'sms' => 0,
                'email' => 0,
                'subject' =>'Hostel Registration Information',
                'template' => '',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'event' => 'HostelShift',
                'sms' => 0,
                'email' => 0,
                'subject' =>'Hostel Shift Information',
                'template' => '',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'event' => 'HostelLeave',
                'sms' => 0,
                'email' => 0,
                'subject' =>'Hostel Leave Information',
                'template' => '',
                'status' => 1
            ]
        ]);
    }
}
