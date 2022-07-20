<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teachers;
use App\Models\Students;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Students::all();

        return view('student.list', [
            'students' => $students
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $teachers = Teachers::pluck('name', 'id');
       return view('student.create', compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $students = new Students;
        $students->name       = $request->input('name');
        $students->age        = $request->input('age');
        $students->gender     = $request->input('gender');
        $students->teacher_id = $request->input('teacher_id');
        $students->save();
        return redirect('student');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Students::find($id); 
        $teachers = Teachers::pluck('name', 'id');
        return view('student.edit', [
            'student' => $student,
            'teachers' => $teachers,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $student             = Students::find($id); 
        $student->name       = $request->input('name');
        $student->age        = $request->input('age');
        $student->gender     = $request->input('gender');
        $student->teacher_id = $request->input('teacher_id');
        $student->save();
        return redirect('student');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Students::find($id); 
        $student->delete();
        return redirect('student')->with('success','Student deleted successfully');
    }
}
