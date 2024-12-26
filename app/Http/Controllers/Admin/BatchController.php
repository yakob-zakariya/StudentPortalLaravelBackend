<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Batch;

class BatchController extends Controller
{
    public function index()
    {
        $batches = Batch::all();
        return response()->json([
            'batches' => $batches,
        ]);
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'department_id' => ['required'],
            'name' => ['required', 'string'],
        ]);

        $batch = Batch::create($validated);
        return response()->json([
            'batch' => $batch,
        ]);
    }
}
