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

    <div class="tw:h-full tw:flex tw:w-full tw:justify-center">

        <div class="tw:grid tw:grid-cols-2 tw:w-5/6 tw:pt-14 tw:gap-y-10 tw:justify-items-center">

            <div class="tw:w-2/3 tw:h-full tw:flex tw:flex-col">
                <div id="inputBox_4_1" class="tw:text-center">
                    <a href="/menu/menuemployee/manageemployees" class="tw:inline-block">
                        <img src="../img/images/10.png" alt="Descripción de la imagen" width="500" height="300">
                    </a>
                </div>
            </div>

            <div class="tw:w-2/3 tw:h-full tw:flex tw:flex-col">
                <div id="inputBox_4_2" class="tw:text-center ">
                    <a href="/menu/menuemployee/createEmployee" class="tw:inline-block">
                        <img src="../img/images/11.png" alt="Descripción de la imagen" width="500" height="300">
                    </a>
                </div>
            </div>

        </div>

    </div>
</div>
  <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: '¡Amazing!',
                text: '{{ session('success') }}',
                confirmButtonText: 'Accept'
            });
         {{ Session::forget('success') }}
        @endif

    </script>

</body>


</html>

