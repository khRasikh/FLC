<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('created_by');
            $table->unsignedInteger('last_updated_by')->nullable();

            $table->string('reg_no', '15')->unique();
            $table->dateTime('reg_date');
            $table->string('university_reg', '100')->nullable();

            $table->unsignedInteger('faculty')->nullable();
            $table->unsignedInteger('semester')->nullable();
            $table->unsignedInteger('academic_status')->nullable();

            $table->string('first_name', '15');
            $table->string('middle_name', '15')->nullable();
            $table->string('last_name', '15');
            $table->dateTime('date_of_birth');
            $table->string('gender', '10');
            $table->string('blood_group', '10')->nullable();
            $table->string('nationality', '15')->nullable();

            $table->string('mother_tongue', '15')->nullable();
            $table->string('email', '100')->nullable();

            $table->string('extra_info', '100')->nullable();

            $table->text('student_image')->nullable();
            $table->boolean('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
