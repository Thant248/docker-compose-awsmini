<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grade;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::all();
        return response()->json($grades);
    }


    public function show($id)
    {
        $grade = Grade::find($id);
        return response()->json($grade);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'grade' => 'required|numeric|min:1|max:10',
        ]);


        $grade = Grade::create($validatedData);


        return response()->json($grade, 201);
    }


    public function update(Request $request, $id)
    {
        $grade = Grade::find($id);


        if (!$grade) {
            return response()->json(['message' => 'Grade not found'], 404);
        }


        $validatedData = $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'grade' => 'required|numeric|min:1|max:10',
        ]);


        $grade->update($validatedData);


        return response()->json($grade, 200);
    }


    public function destroy($id)
    {
        $grade = Grade::find($id);


        if (!$grade) {
            return response()->json(['message' => 'Grade not found'], 404);
        }


        $grade->delete();


        return response()->json(['message' => 'Grade deleted'], 204);
    }
}
