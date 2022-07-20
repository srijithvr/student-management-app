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
            <h3>Students List</h3>
          </div>
          <div class="col-sm-2">
            <a href="{{ route('student.create') }}" class="btn btn-primary">Add Student</a>  
          </div>
    </div>


    <div class="row">
          <div class="col-sm-12">
            
            <table class="tableList" cellpadding="10" cellspacing="10" width="100%">
                <tr>
                    <td><label for="title">ID</label></td>
                    <td><label for="title">Name</label></td>
                    <td><label for="title">Age</label></td>
                    <td><label for="title">Gender</label></td>
                    <td><label for="title">Reporting Teacher</label></td>
                    <td><label for="title">Action</label></td>
                </tr>


                @forelse($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ ucfirst($student->name) }}</td>
                        <td>{{ $student->age }}</td>
                        <td>{{ $student->gender }}</td>
                        <td>{{ $student->teacher->name }}</td>
                        <td>
                          <a href="{{ route('student.edit', $student) }}">Edit</a> | 
                          <a onclick="return confirm('Are you sure?')" href="{{ route('student.destroy', $student) }}">Delete</a>
                        </td>
                    </tr>
                @empty
                    <p class="text-warning">No Students Found!</p>
                @endforelse

            </table>
          </div>
    </div>



@endsection
