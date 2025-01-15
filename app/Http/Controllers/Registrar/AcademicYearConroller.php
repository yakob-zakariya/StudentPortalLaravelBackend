<?php

namespace App\Http\Controllers\Registrar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcademicYear;

class AcademicYearConroller extends Controller
{
    public function index()
    {
        $academicYears = AcademicYear::all();
        return response()->json([
            'academicYears' => $academicYears
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'unique:academic_years,name', 'string']
        ]);
        $academicYear = AcademicYear::create($validated);
        return response()->json([
            'message' => 'Academic year created successfully',
            'academicYear' => $academicYear
        ]);
    }

    public function show(AcademicYear $academicYear)
    {
        return response()->json([
            'academicYear' => $academicYear
        ]);
    }


    public function update(Request $request, AcademicYear $academicYear)
    {
        $validated = $request->validate([
            'name' => ['required', 'unique:academic_years,name', 'string']
        ]);

        $academicYear->update($validated);
        return response()->json([
            'academicYear' => $academicYear
        ]);
    }

    public function destroy(AcademicYear $academicYear)
    {
        $academicYear->delete();
        return response()->json([
            'message' => 'Academic year deleted successfully'
        ]);
    }
}
