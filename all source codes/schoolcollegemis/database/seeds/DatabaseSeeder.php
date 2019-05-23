<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(RoleUserSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(PermissionRole::class);
        $this->call(StudentStatusSeeder::class);
        $this->call(AttendanceStatusSeeder::class);
        $this->call(BookStatusSeeder::class);
        $this->call(LibraryCirculationSeeder::class);
        $this->call(MonthSeeder::class);
        $this->call(DaySeeder::class);
        $this->call(BedStatusSeeder::class);
        $this->call(AlertSettingSeeder::class);
        $this->call(SmsTableSeeder::class);
        $this->call(PaymentTableSeeder::class);
    }
}
