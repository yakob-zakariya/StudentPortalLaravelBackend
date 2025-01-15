<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Semester;
use App\Models\BatchCourseSemester;
use App\Models\CourseRegistration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CourseRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Semester $semester)
    {
        $student = Auth::user()->student;
        $registrations = CourseRegistration::where('semester_id', $semester->id)
            ->where('student_id', $student->id)
            ->select(['id', 'course_id', 'section_id'])
            ->with('course:id,name,code,credit_hour,ETCS')
            ->get();
        if ($registrations->count() > 0) {
            return response()->json([
                'message' => "You have been Registered to the following courses",
                "Academic Year" => $semester->academicYear->name,
                "Semester" => $semester->name,
                "registrations" => $registrations
            ]);
        }

        $allocations = BatchCourseSemester::where('semester_id', $semester->id)
            ->where('batch_id', $student->batch_id)
            ->select('id', 'course_id', 'semester_id')
            ->with('course:id,name,code,credit_hour,ETCS')
            ->get();

        return response()->json([
            'allocations' => $allocations,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Semester $semester)
    {
        $student = Auth::user()->student;
        $allocations = BatchCourseSemester::where('semester_id', $semester->id)
            ->where('batch_id', $student->batch_id)
            ->pluck('course_id')
            ->toArray();



        $validated = $request->validate([
            'courses' => ['required', 'array'],
            'courses.*' => ['required', 'integer', Rule::in($allocations)]
        ]);

        foreach ($validated['courses'] as $course_id) {
            CourseRegistration::create([
                'student_id' => $student->id,
                'course_id' => $course_id,
                'semester_id' => $semester->id,
                'section_id' => $student->section_id,
            ]);
        }

        return response()->json([
            'message' => 'Courses registered successfully',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
