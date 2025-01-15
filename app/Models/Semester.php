<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $fillable = ['name', 'academic_year_id'];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function batchCourseSemesters()
    {
        return $this->hasMany(BatchCourseSemester::class);
    }
}
