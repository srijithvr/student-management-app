<!-- create.blade.php -->

@extends('layout')

@section('content')
  
    <div class="row">
          <div class="col-sm-4"></div>
          <div class="col-sm-4">
            
                <div class="row" >
                    <div class="col-12 " style="padding-bottom: 20px;">
                      <h3>Edit - Exam Details</h3>
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
                      <form method="post" action="{{ route('exam.update', $exam) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="cases">Student :</label>
                            <select class="form-control" name="student_id" required >
                                <option value="">Select Student</option>
                                @foreach ($students as $key => $student)
                                    <option value="{{ $key }}" @if($exam->student_id == $key) selected @endif> 
                                        {{ $student }} 
                                    </option>
                                @endforeach    
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cases">Term :</label>
                            <select class="form-control" name="term" required >
                                    <option value="">Select Term</option>
                                    <option value="One" @if($exam->term == 'One') selected @endif>One</option>
                                    <option value="Two" @if($exam->term == 'Two') selected @endif>Two</option>
                                    <option value="Three" @if($exam->term == 'Three') selected @endif>Three</option>
                                    <option value="Four" @if($exam->term == 'Four') selected @endif>Four</option>
                            </select>
                        </div>

                        @foreach($exam->marks as $markKey => $marks)
                        <div class="form-group" id="subject_item{{ $markKey }}" >
                            <div class="row">
                                <div class="col-sm-5">
                                    <label for="country_name">Subject:</label>
                                    <select class="form-control" name="subject_id[]" required >
                                        <option value="">Select Subject</option>
                                        @foreach ($subjects as $key => $subject)
                                            <option value="{{ $key }}" @if($marks->subject_id == $key) selected @endif>
                                                {{ $subject }} 
                                            </option>
                                        @endforeach    
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="mark[]">Mark:</label>
                                    <input type="number" class="form-control" name="mark[]" value="{{ $marks->mark }}" required />
                                </div>
                                <div class="col-sm-4">
                                    @if($markKey == 0) 
                                    <a href="javascript:;" class="btn btn-default" id="add_subject_item" style="margin-top: 25px;">Add More (+)</a>
                                    @else
                                    <a href="javascript:;" class="btn btn-default remove_subject_item" id="add_subject_item" style="margin-top: 25px;" onclick="removesubjectItem('subject_item{{ $markKey }}')">Remove (x)</a>

                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{url('exam')}}" class="btn btn-default">Cancel</a>
                      </form>
                    </div>
                </div>


          </div>
          <div class="col-sm-4"></div>


    </div>

    <script type="text/javascript">
        var cnt = {{ $markKey }};
        cnt++;
        $("#add_subject_item").click(function(){
            
            $("#subject_item0").clone().attr("id", "subject_item"+cnt)
                              .insertAfter("#subject_item0");

            $("#subject_item"+cnt).find("#add_subject_item").text('Remove (x)')
                                  .addClass('remove_subject_item')
                                  .attr("onclick", "removesubjectItem('subject_item"+cnt+"')");
            
            $("#subject_item"+cnt).find("input[type=text],input[type=number], textarea, select").val("");

        });
        function removesubjectItem(element) {
            $('#'+element).remove();
        }
    </script>

@endsection
