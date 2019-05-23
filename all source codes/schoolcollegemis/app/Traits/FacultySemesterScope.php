<?php
namespace App\Traits;

use App\Models\Faculty;
use App\Models\Semester;

trait FacultySemesterScope{

    public function activeFaculties()
    {
        $faculty = Faculty::where('status',1)->pluck('faculty','id')->toArray();
         return array_prepend($faculty,'Select Faculty','0');
    }

    public function getFacultyTitle($id)
    {
        $faculty = Faculty::find($id);
        if ($faculty) {
            return $faculty->faculty;
        }else{
            return "Unknown";
        }
    }

    public function getSemesterById($id)
    {
        $semester = Semester::find($id);
        if ($semester) {
            return $semester->semester;
        }else{
            return "";
        }
    }

    public function getSemesterTitle($id)
    {
        $semester = Semester::find($id);
        if ($semester) {
            return $semester->semester;
        }else{
            return "Unknown";
        }
    }

}