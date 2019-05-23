<?php
namespace App\Traits;

use App\Models\Exam;
use App\Models\Subject;

trait ExaminationScope{
    public function getExamById($id)
    {
        $exam = Exam::find($id);
        if ($exam) {
            return $exam->title;
        }else{
            return "Unknown";
        }
    }

    public function getSubjectById($id)
    {
        $subject = Subject::find($id);
        if ($subject) {
            return $subject->title;
        }else{
            return "Unknown";
        }
    }

    public function getSubjectCodeById($id)
    {
        $subject = Subject::find($id);
        if ($subject) {
            return $subject->code;
        }else{
            return "Unknown";
        }
    }

    public function getSubCreditById($id)
    {
        $subject = Subject::find($id);
        if ($subject) {
            return $subject->credit_hour;
        }else{
            return "Unknown";
        }
    }




    public function getGrade($semester, $percentage)
    {
        $score ="*MG";
        $gradingType = $semester->gradingType()->first();
        if(!$gradingType) return $score;
        $gradingScale = $gradingType->gradingScale()->get();
        foreach ($gradingScale as $grade){
            if($percentage >= $grade->percentage_from && $percentage <= $grade->percentage_to){
                $score = $grade->name;
            }
        }
        return $score;
    }

    public function getPoint($semester, $percentage)
    {
        $score ="*MP";
        $gradingType = $semester->gradingType()->first();
        if(!$gradingType) return $score;
        $gradingScale = $gradingType->gradingScale()->get();
        foreach ($gradingScale as $grade){
            if($percentage >= $grade->percentage_from && $percentage <= $grade->percentage_to){
                $score = $grade->grade_point;
            }
        }
        return $score;
    }

    public function getRemark($semester, $percentage)
    {
        $score ="";
        $gradingType = $semester->gradingType()->first();
        if(!$gradingType) return $score;
        $gradingScale = $gradingType->gradingScale()->get();
        foreach ($gradingScale as $grade){
            if($percentage >= $grade->percentage_from && $percentage <= $grade->percentage_to){
                $score = $grade->description;
            }
        }
        return $score;
    }
}