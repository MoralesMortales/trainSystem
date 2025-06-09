<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrainSystem</title>
@vite(['resources/css/app.css'])
@vite(['resources/css/NewReservation.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
<div id="container">
    <x-navbar/>
    <div id="boxContainer" class="tw:h-9/12 tw:w-full tw:flex tw:justify-center tw:items-center tw:pt-28">
        <div class="box">
            <form action="http://localhost:8000/menu/newreservation/reserving" class="tw:h-full tw:w-full tw:flex tw:flex-col tw:justify-center tw:items-center" method="get">
            @csrf
            <table class="min-w-full text-left text-sm font-light text-surface dark:text-white tw:mr-10px">
                <thead class="border-b border-neutral-200 font-medium dark:border-white/10">
                    <tr>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Name Travel</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Available Seats (E,F)</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Date</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Proceed</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td class="tw:text-center">
                                <label class="tw:w-48"> 
                                    Ohio
                                </label>
                            </td>
                            <td class="tw:text-center">
                                <label class="tw:w-48"> 
                                    1 - 4
                                </label>
                            </td>        
                            <td class="tw:text-center">
                                <label class="tw:w-48"> 
                                    20/20/20
                                </label>
                            </td>
                            <td class="tw:text-center">
                                <button type="submit" class=" tw:text-black tw:font-bold tw:py-2 tw:px-4 tw:rounded tw:inline-flex tw:items-center">
                                    <i class="fa-solid fa-check tw:mr-2">
                                    </i>
                               </button>
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