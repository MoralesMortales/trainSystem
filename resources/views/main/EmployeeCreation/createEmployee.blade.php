<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrainSystem</title>
@vite(['resources/css/app.css'])
@vite(['resources/css/CreateEmployee.css'])
</head>

<body>
<div id="container" class="tw:flex tw:justify-center tw:items-center">
    <x-navbar/>
        @if ($showPassword)
            <div class="box tw:w-8/12 tw:h-10/12">
                <div id="TopTitle" class="tw:text-4xl tw:pt-10 tw:flex tw:justify-center tw:items-center tw:h-1/6">
                    <h4 style="font-size:2.732rem; font-weight:bold;">Restringed Area!</h4>
                </div>

                <form action="{{ route('restringed.submit') }}" class="tw:h-full" method="post">
                    @csrf
                    <div id="inputs" class="tw:h-4/6 tw:pt-14 tw:flex tw:items-center tw:justify-center tw:flex-col">

                        <div id="mainInput" style="margin-top:-5em;"
                            class="tw:flex tw:justify-around tw:h-4/6 tw:items-center tw:flex-col tw:w-full">

                            <div id="inputBox_2" class="input">
                                <label for="" class="tw:text-3xl tw:mr-28">Password</label>
                                <input name="password" class="tw:px-3 tw:py-1" type="password">
                            </div>

                            @error('email')
                                <span class="tw:text-red-500 error">{{ $message }}</span>
                            @enderror

                        </div>


                    </div>

                    <div id="btnBottom" class="tw:h-1/6 tw:flex tw:justify-center tw:items-center tw:pb-36 tw:w-full">
                        <button class="tw:w-54  tw:h-13 tw:bg-green-200 tw:text-2xl tw:font-bold">
                            Confirm
                        </button>
                    </div>
                </form>
    @else

    <div id="boxContainer" class="tw:h-9/12 tw:w-full tw:flex tw:justify-center tw:items-center tw:pt-13">
        <div class="box">
            <form action="{{ route('register.submit') }}" class="tw:h-full tw:w-full tw:flex tw:flex-col tw:justify-center tw:items-center" method="post">
            @csrf
            <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                <thead class="border-b border-neutral-200 font-medium dark:border-white/10">
                    <tr>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">User Email</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">With Privileges?</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                             <td class="tw:text-center">
                                 <input type="text" name="email" class="tw:w-64">
                             </td>
                        <td class="tw:py-2 tw:text-center  tw:border-2">
                            <input type="checkbox" name="Privileges" class="tw:w-6 tw:h-6">
                        </td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td colspan="2" class="tw:text-center tw:py-2">
                            <div id="btnBottom" class="tw:flex tw:justify-center tw:items-center tw:pt-4 tw:pb-4 tw:w-full">
                                <button type="button" id="confirmRedirectButton"
                                   class="tw:w-54 tw:h-13 tw:bg-red-200 tw:text-2xl tw:font-bold tw:rounded-lg hover:tw:bg-green-300">
                                    Confirm
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            @if ($errors->any())
                <div class="tw:text-red-700 tw:font-bold tw:mb-4 tw:text-center tw:mt-4">
                    Please correct the following errors:
                    <ul class="tw:list-disc tw:list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            </form>

        </div>

    @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: '¡Amazing!',
            text: '{{ session('success') }}',
            confirmButtonText: 'Accept'
        });
    @endif

    // Script para la redirección del botón
    document.addEventListener('DOMContentLoaded', function() {
        const confirmButton = document.getElementById('confirmRedirectButton');
        if (confirmButton) {
            confirmButton.addEventListener('click', function() {
                window.location.href = 'http://localhost:8000/menu/createEmployee/confirmEmployee';
            });
        }
    });
</script>

</body>
</html>
