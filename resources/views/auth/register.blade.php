<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrainSystem</title>
@vite(['resources/css/app.css'])
@vite(['resources/css/register.css'])
</head>

<body>
<div id="container">
        <x-navbar/>
    <div id="boxContainer" class="tw:h-10/12 tw:w-full tw:flex tw:justify-center tw:items-center tw:pt-7">
        <div class="box tw:w-8/12 tw:h-6/12">
            <div id="TopTitle" class="tw:text-4xl tw:pt-4 tw:flex tw:justify-center tw:pb-7 tw:items-center tw:h-1/6">
                <h4>Register</h4>
            </div>

            <form action="{{ route('register.submit') }}" class="tw:h-full" method="post">
            @csrf

                <div id="inputs" class=" tw:h-3/6 tw:pt-14 tw:flex tw:items-center tw:justify-center tw:flex-col">

                    <div id="mainInput" style="margin-top:-5em;" class="tw:flex tw:justify-around tw:h-4/6 tw:items-center tw:flex-col tw:w-full">
                        <div id="inputBox_1" class="input tw:mb-4">
                            <label style="font-size: 18px;">Email</label>
                            <input type="email" value="{{ old('email') }}" name="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="Please enter a valid email address (e.g., example@domain.com)">
                        </div>

                        <div id="inputBox_2" class="input tw:mb-4">
                            <label style="font-size: 18px;">Cedula</label>
                            {{-- Changed type to number, added min="0" and step="1" --}}
                            <input type="number" value="{{ old('cedula') }}" name="cedula" min="0" step="1">
                        </div>

                        <div id="inputBox_3" class="input tw:mb-4">
                            <label style="font-size: 18px;">Password</label>
                            <input type="password" name="password_1" value="{{ old('password_1') }}">
                        </div>

                        <div id="inputBox_4" class="input">
                            <label style="font-size: 18px;">Confirm Password</label>
                            <input type="password" name="password_2" value="{{ old('password_2') }}">
                        </div>
                    </div>

                </div>

                <div id="btnBottom" class="tw:h-3/6 tw:flex tw:justify-center tw:items-center tw:pb-4 tw:pt-2 tw:w-full">
                    <button type="submit" class="tw:w-50 tw:h-15 tw:mb-10 tw:bg-green-200 tw:text-2xl tw:font-bold">Confirm</button>
                </div>

            </form>

        </div>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: '¡Error de Validación!',
                html: `
                    <p>Por favor, corrige los siguientes errores:</p>
                    <ul class="tw:list-disc tw:list-inside tw:text-left">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                `,
                confirmButtonText: 'Entendido'
            });
        @endif

        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: '¡Amazing!',
                text: '{{ session('success') }}',
                confirmButtonText: 'Accept'
            });
        @endif
    });
</script>
</body>
</html>