<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;


class StudentController extends Controller
{
    

    public function index()
    {

        return view('students');
    }

    public function studentData()
    {

        $data = Student::get();
        return response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'course' =>  'required',
            'gender' => 'required',
            'dob' => 'required|date',
            'phone' => 'required|numeric',
        ]);


        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'course' => $request->course,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'phone' => $request->phone,
        ]);

        return response()->json(['success' => true, 'student' => $student]);
    }

    public function update(Request $request, $id)
    {
        $user = Student::findOrFail($id);

        
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'course' => $request->course,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'phone' => $request->phone
        ]);

        return response()->json(['message' => 'Student updated successfully']);
    }

    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['success' => false, 'message' => 'Student not found'], 404);
        }

        $student->delete();

        return response()->json(['success' => true, 'message' => 'Student deleted successfully']);
    }
}
