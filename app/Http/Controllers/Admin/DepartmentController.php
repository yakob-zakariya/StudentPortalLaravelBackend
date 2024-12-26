<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return response()->json([
            'departments' => $departments,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:departments,name'],
            'code' => ['required', 'unique:departments,code'],
        ]);

        $department = Department::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return response()->json([
            'department' => $department
        ]);
    }

    public function show(Department $department)
    {

        return response()->json([
            'department' => $department,
        ]);
    }

    public function update(Request $request, Department $department)
    {
        $validated = $request->validate([
            'name' => ['sometimes', 'string', 'unique:departments,name,' . $department->id],
            'code' => ['sometimes', 'string', 'unique:departments,code,' . $department->id]
        ]);

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
