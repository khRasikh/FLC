<?php

use Illuminate\Database\Seeder;

class LibraryCirculationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('library_circulations')->insert([
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'user_type' => 'Student',
                'slug' => 'student',
                'code_prefix' => 'STUDLIB',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'user_type' => 'Staff',
                'slug' => 'staff',
                'code_prefix' => 'STALIB',
                'status' => 1
            ]
        ]);
    }
}
