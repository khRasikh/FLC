<?php
namespace App\Traits;

use App\Models\Student;
use App\Models\StudentStatus;

trait StudentScopes{
    public function getStudentById($id)
    {
        $student = Student::find($id);
        if ($student) {
            return $student->reg_no;
        }else{
            return "Unknown";
        }
    }

    public function getStudentIdByReg($reg_no)
    {
        $student = Student::where('reg_no',$reg_no)->first();
        if ($student) {
            return $student->id;
        }else{
            return "Unknown";
        }
    }

    public function getStudentNameById($id)
    {
        $student = Student::find($id);
        if ($student) {
            return $student->first_name .' '.$student->middle_name.' '.$student->last_name;
        }else{
            return "Unknown";
        }
    }

   
    public function getStudentRegById($reg)
    {
        $student = Student::where('reg_no',$reg)->first();
        if ($student) {
            return $student->reg_no;
        }else{
            return "Unknown";
        }
    }

    public function getStudentNameByReg($reg)
    {
        $student = Student::where('reg_no',$reg)->first();
        if ($student) {
            return $student->first_name .' '.$student->middle_name.' '.$student->last_name;
        }else{
            return "Unknown";
        }
    }

    public function getStudentAcademicStatusId($id)
    {
        $student = StudentStatus::find($id);
        if ($student) {
            return $student->title;
        }else{
            return "Unknown";
        }
    }



    /*view student's profile*/

}