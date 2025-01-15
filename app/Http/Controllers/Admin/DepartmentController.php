<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        // sleep(3);
        $departments = Department::all();
        return response()->json([
            'departments' => $departments,
        ]);
    }

    public function store(StoreDepartmentRequest $request)
    {
        $validated = $request->validated();

        $department = Department::create($validated);

        return response()->json([
            'department' => $department
        ]);
    }

    public function show(Department $department)
    {
        // sleep(3);
        return response()->json([
            'department' => $department,
        ]);
    }

    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $validated = $request->validated();
        $department->update($validated);

        return response()->json([
            'department' => $department,
        ]);
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return response()->json([
            'Department Deleted Successfully'
        ]);
    }
}
