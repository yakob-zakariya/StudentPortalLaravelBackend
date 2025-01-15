<?php

namespace App\Http\Controllers\DepartmentCoordinator;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Models\BatchCourseSemester;
use Illuminate\Support\Facades\Auth;
use App\Models\Batch;
use App\Models\Semester;
use App\Http\Requests\StoreCourseAllocationRequest;

class CourseAllocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Batch $batch, Semester $semester)
    {

        $allocations = BatchCourseSemester::where('semester_id', $semester->id)->where('batch_id', $batch->id)->get();

        return response()->json([
            'allocations' => $allocations
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseAllocationRequest $request, Batch $batch, Semester $semester)
    {
        $validated = $request->validated();

        foreach ($validated['courses'] as $course_id) {
            BatchCourseSemester::create([
                'batch_id' => $batch->id,
                "semester_id" => $semester->id,
                "course_id" => $course_id
            ]);
        }
        return response()->json([
            'message' => 'Courses allocated successfully'
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
    public function destroy(BatchCourseSemester $allocation)
    {
        // return $allocation;
        $allocation->delete();
        return response()->json([
            'message' => 'Course deallocated successfully'
        ]);
    }
}
