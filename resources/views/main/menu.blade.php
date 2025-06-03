<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrainSystem</title>
@vite(['resources/css/app.css'])
@vite(['resources/css/EmployeeMainView.css'])
</head>

<body>
<div id="container">
    <x-navbar/>


            @if ( Auth::user()->isEmployee == 0 )
             empleado form
             <a href="{{ route('createTrain') }}">Create Train</a>
             <br>
             <a href="{{ route('Trains') }}">My Trains</a>
         @else
            no empleado form
         @endif
    <div class="tw:h-full tw:flex tw:w-full tw:justify-center">

        <div class="tw:grid tw:grid-cols-2 tw:w-5/6 tw:pt-14 tw:gap-y-10 tw:justify-items-center">

            <div class="tw:w-1/2 tw:h-full tw:flex tw:flex-col">
                <div id="inputBox_4_1" class="tw:text-center">
                    <a href="{{ route('createTrain') }}" class="tw:inline-block tw:h-full">
                        <img src="img/images/01.png" alt="Descripción de la imagen" width="500" height="300">
                    </a>
                </div>
            </div>

            <div class="tw:w-1/2 tw:max-w-md tw:flex tw:flex-col ">
                <div id="inputBox_4_2" class="tw:text-center ">
                    <a href="/login" class="tw:inline-block">
                        <img src="img/images/02.png" alt="Descripción de la imagen" width="500" height="300">
                    </a>
                </div>
            </div>


            <div class="tw:w-1/2 tw:max-w-md tw:flex tw:flex-col">
                <div id="inputBox_4_3" class="tw:text-center ">
                    <a href="/login" class="tw:inline-block">
                        <img src="img/images/03.png" alt="Descripción de la imagen" width="500" height="300">
                    </a>
                </div>
            </div>

            <div class="tw:w-1/2 tw:max-w-md tw:flex tw:flex-col ">
                <div id="inputBox_4_4" class="tw:text-center">
                    <a href="/login" class="tw:inline-block">
                        <img src="img/images/04.png" alt="Descripción de la imagen" width="500" height="300">
                    </a>
                </div>
            </div>

            <div class="tw:w-1/2 tw:max-w-md tw:flex tw:flex-col">
                <div id="inputBox_4_5" class="tw:text-center ">
                    <a href="/login" class="tw:inline-block">
                        <img src="img/images/05.png" alt="Descripción de la imagen" width="500" height="300">
                    </a>
                </div>
            </div>

        </div>

    </div>
</div>

</body>
</html>

