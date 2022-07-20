<!-- create.blade.php -->

@extends('layout')

@section('content')
  
    <div class="row">
          <div class="col-sm-4"></div>
          <div class="col-sm-4">
            
                <div class="row" >
                    <div class="col-12 " style="padding-bottom: 20px;">
                      <h3>Edit - Student Data</h3>
                    </div>


                    @if ($errors->any())
                    <div >
                      <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                      </div>
                    </div><br />
                    @endif

                    <div >
                      <form method="post" action="{{ route('student.update', $student) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="country_name">Student Name:</label>
                            <input type="text" class="form-control" name="name" value="{{ $student->name }}" required />
                        </div>
                        <div class="form-group">
                            <label for="cases">Age :</label>
                            <input type="number" class="form-control" name="age" value="{{ $student->age }}" required />
                        </div>
                        <div class="form-group">
                            <label for="cases">Gender :</label>
                            <select class="form-control" name="gender" required >
                                <option>Select Gender</option>
                                    <option value="Male" @if($student->gender == 'Male') selected @endif>Male</option>
                                    <option value="Female" @if($student->gender == 'Female') selected @endif>Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cases">Reporting Teacher :</label>
                            <select class="form-control" name="teacher_id" required >
                                <option>Select Teacher</option>
                                @foreach ($teachers as $key => $value)
                                    <option value="{{ $key }}" @if($student->teacher_id == $key) selected @endif> 
                                        {{ $value }} 
                                    </option>
                                @endforeach    
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{url('student')}}" class="btn btn-default">Cancel</a>
                      </form>
                    </div>
                </div>


          </div>
          <div class="col-sm-4"></div>


    </div>



@endsection
