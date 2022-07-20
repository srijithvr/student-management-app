<!-- layout.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Student Management</title>
  
      <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


    <style>
        body {
            font-family: 'Nunito';
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>
<body>
    <div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                    <h1 class="display-one"><a href="{{url('student')}}">Student Manager</a></h1>
            </div>
        </div>
        <div class="col-sm-12" style="text-align: right;">
            <a href="{{url('student')}}" class="link-primary"><b>Students</b></a>
                     | 
            <a href="{{url('exam')}}" class="link-primary"><b>Exams</b></a>
            <hr>
        </div>
    </div>

    @yield('content')

</div>

</body>

</html>
