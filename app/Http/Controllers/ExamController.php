<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\Subjects;
use App\Models\Exams;
use App\Models\Marks;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        $exams      = Exams::all();
        $subjects   = Subjects::pluck('name', 'id');

        return view('exam.list', [
            'exams' => $exams,
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
       return view('exam.create', compact('students','subjects'));
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
        return redirect('exam');
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
        $students = Students::pluck('name', 'id');
        $subjects = Subjects::pluck('name', 'id');

        $exam = Exams::find($id); 

        return view('exam.edit', [
            'exam' => $exam,
            'students' => $students,
            'subjects' => $subjects,
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
        $exam               = Exams::find($id); 
        $exam->student_id  = (int)$request->input('student_id');
        $exam->term        = $request->input('term');
        $exam->save();

        Marks::where('exam_id', $id)->delete();

        if($subjects = $request->input('subject_id')){
            foreach ($subjects as $key => $subject) {
                $marks              = new Marks;
                $marks->exam_id     = $exam->id;
                $marks->subject_id  = $subject;
                $marks->mark        = $request->input('mark')[$key];
                $marks->save();
            }
        }
        return redirect('exam');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Exams::find($id)->delete();
        Marks::where('exam_id', $id)->delete();
        return redirect('exam')->with('success','Exam deleted successfully');
    }
}
