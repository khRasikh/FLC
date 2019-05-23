<?php
namespace App\Traits;

use App\Models\Staff;
use App\Models\StaffDesignation;

trait StaffScope{

    public function getStaffById($id)
    {
        $staff = Staff::find($id);
        if ($staff) {
            return $staff->reg_no;
        }else{
            return "Unknown";
        }
    }

    public function getStaffByReg($reg)
    {
        $staff = Staff::where('reg_no',$reg)->first();
        if ($staff) {
            return $staff->id;
        }else{
            return "Unknown";
        }
    }

    public function getStaffNameByReg($reg)
    {
        $staff = Staff::where('reg_no',$reg)->first();
        if ($staff) {
            return $staff->first_name .' '.$staff->middle_name.' '.$staff->last_name;
        }else{
            return "Unknown";
        }
    }

    public function getStaffNameById($id)
    {
        $staff = Staff::find($id);
        if ($staff) {
            return $staff->first_name .' '.$staff->middle_name.' '.$staff->last_name;
        }else{
            return "Unknown";
        }
    }

    public function getDesignationId($id)
    {
        $designation = StaffDesignation::find($id);
        if ($designation) {
            return $designation->title;
        }else{
            return "Unknown";
        }
    }


}