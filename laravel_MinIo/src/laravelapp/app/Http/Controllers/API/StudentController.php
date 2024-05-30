<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    
    public function index()
    {
        $students = Student::all();


        return response()->json([
            'data' => $students,
        ]);
    }


    public function show(Student $student)
    {
        return response()->json([
            'data' => $student,
        ]);
    }


    public function store(Request $request)
    {
        $student = Student::create($request->all());


        return response()->json([
            'data' => $student,
        ], 201);
    }


    public function update(Request $request, Student $student)
    {
        $student->update($request->all());


        return response()->json([
            'data' => $student,
        ]);
    }


    public function destroy(Student $student)
    {
        $student->delete();


        return response()->json([
            'message' => 'Student deleted',
        ]);
    }
}
