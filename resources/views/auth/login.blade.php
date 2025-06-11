<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrainSystem</title>
    @vite(['resources/css/app.css'])
    @vite(['resources/css/login.css'])
</head>

<body>
    <div id="container">
        <x-navbar />
        <div id="boxContainer" class="tw:h-10/12 tw:w-full tw:flex tw:justify-center tw:items-center">
            <div class="box tw:w-8/12 tw:h-9/12">
                <div id="TopTitle" class="tw:text-4xl tw:flex tw:justify-center tw:items-center tw:h-1/6 tw:pt-7">
                    Sign In
                </div>

                <form action="{{ route('login.submit') }}" class="tw:h-full tw:pb-2" method="post">
                    @csrf
                    <div id="inputs" class="tw:h-4/6 tw:flex tw:items-center tw:justify-center tw:flex-col">

                        <div id="mainInput"
                            class="tw:flex tw:justify-around tw:h-4/6 tw:items-center tw:flex-col tw:w-full">

                            <div id="inputBox_1" class="input">
                                <label for="email">Email</label> {{-- Added for attribute --}}
                                <input name="email" type="email" value="{{ old('email') }}"
                                    pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}"
                                    title="Please enter a valid email address (e.g., example@domain.com)"> {{-- Added pattern and title for client-side email validation --}}
                            </div>

                            <div id="inputBox_2" class="input">
                                <label for="password">Password</label> {{-- Added for attribute --}}
                                <input name="password" type="password">
                            </div>

                            {{-- Removed @error('email') block here as SweetAlert will handle it --}}

                        </div>


                    </div>

                    <div id="btnBottom" class="tw:h-1/6 tw:flex tw:justify-center tw:items-center tw:pb-36 tw:w-full">
                        <button type="submit" class="tw:w-54  tw:h-13 tw:bg-green-200 tw:text-2xl tw:font-bold hover:tw:bg-green-300"> {{-- Added type="submit" and hover effect --}}
                            Confirm
                        </button>
                    </div>


                </form>

            </div>


        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // SweetAlert for validation errors (from formValidation method)
            @if ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Login Error!', // Specific title for login errors
                    html: `
                        <ul class="tw:list-disc tw:list-inside tw:text-left">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    `,
                    confirmButtonText: 'Entendido'
                });
            @endif

            // SweetAlert for general success messages (e.g., after registration)
            @if (session('success'))
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