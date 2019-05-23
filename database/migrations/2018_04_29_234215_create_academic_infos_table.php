<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcademicInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('created_by');
            $table->unsignedInteger('last_updated_by')->nullable();

            $table->unsignedInteger('students_id');
            $table->string('institution', '100');
            $table->string('board', '50');
            $table->string('pass_year', '4');
            $table->string('symbol_no', '15')->nullable();
            $table->integer('percentage');
            $table->string('division_grade', '10');
            $table->string('major_subjects', '50')->nullable();
            $table->text('remark')->nullable();

            $table->unsignedInteger('sorting_order')->nullable();
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
        Schema::dropIfExists('academic_infos');
    }
}
