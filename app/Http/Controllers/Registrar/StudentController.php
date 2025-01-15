<?php

namespace App\Http\Controllers\Registrar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\storeUserRequest;
use App\Models\Student;
use App\Services\UsernameGenerator;
use App\Models\Batch;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('user')->paginate(10);
        return response()->json($students);
    }

    public function store(StoreUserRequest $request)
    {
        $validated_user_data = $request->validated();
        $validated_batch = $request->validate([
            'batch_id' => ['required', 'exists:batches,id']
        ]);

        $batch = Batch::find($validated_batch['batch_id']);
        $username = UsernameGenerator::generate("UNDERGRADUATE", $batch->entry_year);



        $user = User::create([
            'username' => $username,
            "first_name" => $validated_user_data['first_name'],
            "middle_name" => $validated_user_data['middle_name'],
            "last_name" => $validated_user_data['last_name'],
            "email" => $validated_user_data['email'],
            "password" => Hash::make('password'),
        ]);

        $user->assignRole('STUDENT');
        $user->student()->create([
            'batch_id' => $batch->id,
        ]);

        return response()->json([
            'message' => 'Student created successfully',
            'user' => $user
        ]);
    }
}
