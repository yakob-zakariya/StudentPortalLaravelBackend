<?php

namespace App\Http\Controllers\Registrar;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Http\Requests\StoreBatchRequest;
use App\Http\Requests\UpdateBatchRequest;

class BatchController extends Controller
{
    public function index()
    {
        $batches = Batch::all();
        return response()->json([
            'batches' => $batches,
        ]);
    }

    public function store(StoreBatchRequest $request)
    {
        $validated = $request->validated();
        $batch = Batch::create($validated);

        return response()->json([
            'batch' => $batch,
        ]);
    }

    public function show(Batch $batch)
    {
        return response()->json([
            'batch' => $batch
        ]);
    }

    public function update(UpdateBatchRequest $request, Batch $batch)
    {
        $validated = $request->validated();
        $batch->update($validated);
        return $batch;
    }

    public function destroy(Batch $batch)
    {
        $batch->delete();
        return response()->json([
            'message' => "Batch Deleted Successfully"
        ]);
    }
}
