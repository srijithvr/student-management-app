<!-- create.blade.php -->

@extends('layout')

@section('content')
  
    <div class="row">
          <div class="col-sm-4"></div>
          <div class="col-sm-4">
            
                <div class="row" >
                    <div class="col-12 " style="padding-bottom: 20px;">
                      <h3>Add - Exam Details</h3>
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
                      <form method="post" action="{{ route('exam.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="cases">Student :</label>
                            <select class="form-control" name="student_id" required >
                                <option value="">Select Student</option>
                                @foreach ($students as $key => $student)
                                    <option value="{{ $key }}" > 
                                        {{ $student }} 
                                    </option>
                                @endforeach    
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cases">Term :</label>
                            <select class="form-control" name="term" required >
                                    <option value="">Select Term</option>
                                    <option value="One" >One</option>
                                    <option value="Two" >Two</option>
                                    <option value="Three" >Three</option>
                                    <option value="Four" >Four</option>
                            </select>
                        </div>

                        <div class="form-group" id="subject_item" >

                            <div class="row">
                                <div class="col-sm-5">
                                    <label for="country_name">Subject:</label>
                                    <select class="form-control" name="subject_id[]" required >
                                        <option value="">Select Subject</option>
                                        @foreach ($subjects as $key => $subject)
                                            <option value="{{ $key }}" > 
                                                {{ $subject }} 
                                            </option>
                                        @endforeach    
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="mark[]">Mark:</label>
                                    <input type="number" class="form-control" name="mark[]" required />
                                </div>
                                <div class="col-sm-4">
                                    <a href="javascript:;" class="btn btn-default" id="add_subject_item" style="margin-top: 25px;">Add More (+)</a>

                                </div>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                        <a href="{{url('exam')}}" class="btn btn-default">Cancel</a>
                      </form>
                    </div>
                </div>


          </div>
          <div class="col-sm-4"></div>


    </div>

    <script type="text/javascript">
        var cnt = 0;
        $("#add_subject_item").click(function(){
            
            $("#subject_item").clone().attr("id", "subject_item"+cnt)
                              .insertAfter("#subject_item");

            $("#subject_item"+cnt).find("#add_subject_item").text('Remove (x)')
                                  .addClass('remove_subject_item')
                                  .attr("onclick", "removesubjectItem('subject_item"+cnt+"')");
            
            $("#subject_item"+cnt).find("input[type=text],input[type=number], textarea, select").val("");
            cnt++;

        });
        function removesubjectItem(element) {
            $('#'+element).remove();
        }
    </script>

@endsection
