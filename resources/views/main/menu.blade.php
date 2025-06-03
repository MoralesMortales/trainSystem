<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrainMenu</title>

    @vite(['resources/css/app.css'])
@vite(['resources/css/mainView.css'])

</head>
<body>
    <x-navbar/>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
         @if ( Auth::user()->isEmployee == 0 )
             empleado form
             <a href="{{ route('createTrain') }}">Create Train</a>
             <br>
             <a href="{{ route('Trains') }}">My Trains</a>
         @else
            no empleado form
         @endif
</body>
</html>
