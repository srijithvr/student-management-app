<!-- create.blade.php -->

@extends('layout')

@section('content')
          <style>
            .tableList td{
                padding: 5px;
                border-bottom: 1px #ccc solid;
            }
        </style>

    <div class="row">
          <div class="col-sm-10"  style="padding-bottom: 20px;">
            <h3>Exams List</h3>
          </div>
          <div class="col-sm-2">
            <a href="{{ route('exam.create') }}" class="btn btn-primary">Add Exam</a>  
          </div>
    </div>


    <div class="row">
          <div class="col-sm-12">
            
            <table class="tableList" cellpadding="10" cellspacing="10" width="100%">
                <tr>
                    <td><label for="title">ID</label></td>
                    <td><label for="title">Name</label></td>
                    @foreach($subjects as $key => $subject)
                    <td><label for="title">{{ $subject }}</label></td>
                    @endforeach
                    <td><label for="title">Totla Marks</label></td>
                    <td><label for="title">Created On</label></td>
                    <td><label for="title">Action</label></td>
                </tr>


                @forelse($exams as $exam)
                    <tr>
                        <td>{{ $exam->id }}</td>
                        <td>{{ ucfirst($exam->student->name) }}</td>
                        @foreach($subjects as $key => $subject)
                        <td>
                          @foreach($exam->marks as $marks)
                            @if($key == $marks->subject_id)  {{ $marks->mark }}  @endif
                          @endforeach
                        </td>
                        @endforeach

                        <td>{{ $exam->totalMarks() }}</td>
                        <td>{{ $exam->created_at }}</td>
                        <td>
                          <a href="{{ route('exam.edit', $exam) }}">Edit</a> | 
                          <a onclick="return confirm('Are you sure?')" href="{{ route('exam.destroy', $exam) }}">Delete</a>
                        </td>
                    </tr>
                @empty
                    <p class="text-warning">No Marks Found!</p>
                @endforelse

            </table>
          </div>
    </div>



@endsection
