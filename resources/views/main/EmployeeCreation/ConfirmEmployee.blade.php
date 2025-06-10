<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrainSystem</title>
@vite(['resources/css/app.css'])
@vite(['resources/css/ConfirmEmployee.css'])
</head>

<body>
<div id="container" class="tw:bg-black">
    <x-navbar/>
    <div id="boxContainer" class="tw:h-9/12  tw:w-full tw:flex tw:justify-center tw:items-center tw:pt-13">
        <div class="box tw:h-10/12 tw:w-8/12 tw:flex tw:justify-center tw:items-center">
            <form action="{{ route('confirmCreateEmployee.submit') }}" class="tw:h-full tw:w-full tw:flex tw:flex-col tw:justify-center tw:items-center" method="post">
            @csrf
                <input type="hidden" name="userData" value="{{ json_encode(session('theUser')) }}">
            <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                <tbody>
                    <tr>
                        <td class="tw:py-2 tw:text-center tw:border-2 tw:font-bold">
                            Password
                            </td>
                            <td class="tw:text-center">
                                <input type="password" name="password" class="tw:w-64">
                            </td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td colspan="2" class="tw:text-center tw:py-2">
                            <div id="btnBottom" class="tw:flex tw:justify-center tw:items-center tw:pt-4 tw:pb-4 tw:w-full">
                                <button type="submit" id="confirmRedirectButton"
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

</script>

</body>
</html>
