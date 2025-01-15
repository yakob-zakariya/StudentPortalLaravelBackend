<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BatchCourseSemester extends Model
{
    protected $guarded = [];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
