<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        return response()->json($subjects);
    }


    public function show($id)
    {
        $subject = Subject::find($id);
        return response()->json($subject);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'ects' => 'required|numeric|min:1|max:10',
            'teacher' => 'required|string|max:255',
        ]);


        $subject = Subject::create($validatedData);


        return response()->json($subject, 201);
    }


    public function update(Request $request, $id)
    {
        $subject = Subject::find($id);


        if (!$subject) {
            return response()->json(['message' => 'Subject not found'], 404);
        }


        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'ects' => 'required|numeric|min:1|max:10',
            'teacher' => 'required|string|max:255',
        ]);


        $subject->update($validatedData);


        return response()->json($subject, 200);
    }


    public function destroy($id)
    {
        $subject = Subject::find($id);


        if (!$subject) {
            return response()->json(['message' => 'Subject not found'], 404);
        }


        $subject->delete();


        return response()->json(['message' => 'Subject deleted'], 204);
    }
}
