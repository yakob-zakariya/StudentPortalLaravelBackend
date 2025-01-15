<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name', 'code', 'credit_hour', 'ETCS'];


    public function batchCourseSemesters()
    {
        return $this->hasMany(BatchCourseSemester::class);
    }
}
