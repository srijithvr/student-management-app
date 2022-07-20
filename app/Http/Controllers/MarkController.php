<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\Subjects;
use App\Models\Marks;
use App\Models\Exams;

class MarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        $marks      = Marks::all();
        $subjects   = Subjects::pluck('name', 'id');
        return view('mark.list', [
            'marks' => $marks,
            'subjects' => $subjects
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $students = Students::pluck('name', 'id');
       $subjects = Subjects::pluck('name', 'id');
       return view('mark.create', compact('students','subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $exams              = new Exams;
        $exams->student_id  = (int)$request->input('student_id');
        $exams->term        = $request->input('term');
        $exams->save();

        if($subjects = $request->input('subject_id')){
            foreach ($subjects as $key => $subject) {
                $marks              = new Marks;
                $marks->exam_id     = $exams->id;
                $marks->subject_id  = $subject;
                $marks->mark        = $request->input('mark')[$key];
                $marks->save();
            }
        }
        return redirect('mark');
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
        $mark = Marks::find($id); 
        $teachers = Teachers::pluck('name', 'id');
        return view('mark.edit', [
            'mark' => $mark,
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
        $mark             = Marks::find($id); 
        $mark->name       = $request->input('name');
        $mark->age        = $request->input('age');
        $mark->gender     = $request->input('gender');
        $mark->teacher_id = $request->input('teacher_id');
        $mark->save();
        return redirect('mark');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mark = Marks::find($id); 
        $mark->delete();
        return redirect('mark')->with('success','Task deleted successfully');
    }
}
