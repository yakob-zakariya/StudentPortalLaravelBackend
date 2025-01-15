<?php

namespace App\Http\Controllers\Registrar;

use App\Http\Controllers\Controller;

use App\Models\AcademicYear;
use App\Models\Semester;

use App\Http\Requests\StoreSemesterRequest;
use App\Http\Requests\UpdateSemesterRequest;

class SemesterController extends Controller
{
    public function index(AcademicYear $academicYear)
    {
        $semesters = $academicYear->semesters;
        return response()->json([
            'semesters' => $semesters
        ]);
    }

    public function store(StoreSemesterRequest $request, AcademicYear $academicYear)
    {
        $validated = $request->validated();

        $semester = $academicYear->semesters()->create($validated);

        return response()->json([
            'message' => 'Semester created successfully',
            'semester' => $semester
        ]);
    }


    public function show(AcademicYear $academicYear, Semester $semester)
    {
        if ($semester->academicYear->id !== $academicYear->id) {
            return response()->json([
                'message' => 'Semester not found'
            ], 404);
        }

        return response()->json([
            'semester' => $semester
        ]);
    }

    public function update(UpdateSemesterRequest $request, AcademicYear $academicYear, Semester $semester)
    {
        if ($semester->academicYear->id !== $academicYear->id) {
            return response()->json([
                'message' => 'Semester not found'
            ], 404);
        }

        $validated = $request->validated();

        $semester->update($validated);

        return response()->json([
            'message' => 'Semester updated successfully',
            'semester' => $semester
        ]);
    }

    public function destroy(AcademicYear $academicYear, Semester $semester)
    {
        if ($semester->academicYear->id !== $academicYear->id) {
            return response()->json([
                'message' => 'Semester not found'
            ], 404);
        }

        $semester->delete();

        return response()->json([
            'message' => 'Semester deleted successfully'
        ]);
    }
}
