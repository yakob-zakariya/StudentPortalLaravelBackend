<?php

namespace App\Http\Controllers\DepartmentCoordinator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Batch;

class DepartmentBatches extends Controller
{
    public function index()
    {
        $department_id = Auth::user()->coordinator->department_id;
        $batches = Batch::where('department_id', $department_id)->get();
        return response()->json([
            'batches' => $batches->load('sections'),
        ]);
    }

    public function show(Batch $batch)
    {
        $department_id = Auth::user()->coordinator->department_id;
        if ($batch->department_id != $department_id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        return response()->json([
            'batch' => $batch->load(['sections', 'students'])
        ]);
    }
}
