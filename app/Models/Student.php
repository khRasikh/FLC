<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'reg_no', 'reg_date', 'university_reg','faculty','semester',
        'academic_status', 'first_name', 'middle_name', 'last_name', 'date_of_birth', 'gender', 'blood_group', 'nationality',
        'mother_tongue', 'email', 'extra_info', 'student_image','status'];

    public function address()
    {
        return $this->hasOne(Addressinfo::class,'students_id', 'id');
    }

    public function parents()
    {
        return $this->hasOne(ParentDetail::class, 'students_id', 'id');
    }

    public function guardian()
    {
        return $this->hasOne(StudentGuardian::class, 'students_id', 'id');
    }

   /* public function guardian()
    {
        return $this->belongsTo(StudentGuardian::class);
    }*/

    public function academicInfo()
    {
        return $this->hasMany(AcademicInfo::class, 'students_id', 'id');
    }

    public function feeMaster()
    {
        return $this->hasMany(FeeMaster::class, 'students_id', 'id');
    }

    public function feeCollect()
    {
        return $this->hasMany(FeeCollection::class, 'students_id', 'id');
    }


    public function markLedger()
    {
        return $this->hasMany(ExamMarkLedger::class, 'students_id', 'id');
    }

}
