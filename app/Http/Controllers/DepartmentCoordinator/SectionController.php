<?php

namespace App\Http\Controllers\DepartmentCoordinator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreSectionRequest;
use App\Http\Requests\UpdateSectionRequest;
use App\Models\Batch;
use App\Models\Section;


class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Batch $batch)
    {
        $department_id = Auth::user()->coordinator->department_id;
        if ($batch->department_id != $department_id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        return response()->json([
            'sections' => $batch->sections
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSectionRequest $request, Batch $batch)
    {
        $department_id = Auth::user()->coordinator->department_id;
        if ($batch->department_id != $department_id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }


        $validated = $request->validated();
        $batch->sections()->create($validated);

        return response()->json([
            'message' => 'Section created successfully',
            'section' => $batch->sections->last()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Batch $batch, Section $section)
    {
        $department_id = Auth::user()->coordinator->department_id;
        if ($batch->department_id != $department_id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        return response()->json([
            'section' => $section->load('students')
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSectionRequest $request, Batch $batch, Section $section)
    {
        $department_id = Auth::user()->coordinator->department_id;
        if ($batch->department_id != $department_id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $validated = $request->validated();
        $section->update($validated);

        return response()->json([
            'message' => 'Section updated successfully',
            'section' => $section
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Batch $batch, Section $section)
    {
        $department_id = Auth::user()->coordinator->department_id;
        if ($batch->department_id != $department_id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $section->delete();

        return response()->json([
            'message' => 'Section deleted successfully'
        ]);
    }
}
