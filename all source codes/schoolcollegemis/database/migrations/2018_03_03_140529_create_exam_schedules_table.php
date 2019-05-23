<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('created_by');
            $table->unsignedInteger('last_updated_by')->nullable();

            $table->unsignedInteger('years_id');
            $table->unsignedInteger('months_id');
            $table->unsignedInteger('exams_id');
            $table->unsignedInteger('faculty_id');
            $table->unsignedInteger('semesters_id');
            $table->unsignedInteger('subjects_id');
            $table->dateTime('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('full_mark_theory')->nullable();
            $table->integer('pass_mark_theory')->nullable();
            $table->integer('full_mark_practical')->nullable();
            $table->integer('pass_mark_practical')->nullable();

            $table->unsignedInteger('sorting_order');

            $table->boolean('publish_status')->default(0);
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
        Schema::dropIfExists('exam_schedules');
    }
}
