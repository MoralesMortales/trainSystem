<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrainSystem</title>
@vite(['resources/css/app.css'])
@vite(['resources/css/Reserving.css'])
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
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Status</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Name Travel</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Quantity Tickets</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Date</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Class</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">View More</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Edit</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td class="tw:text-center">
                                <label class="tw:w-32"> 
                                    Active
                                </label>
                            </td>
                            <td class="tw:text-center">
                                <label class="tw:w-32"> 
                                    Ohio
                                </label>
                            </td>        
                            <td class="tw:text-center">
                                <label class="tw:w-24"> 
                                    4
                                </label>
                            </td>
                            <td class="tw:text-center">
                                <label class="tw:w-40"> 
                                    20/20/20
                                </label>
                            </td>     
                            <td class="tw:text-center">
                                <label class="tw:w-16"> 
                                    first
                                </label>
                            </td>
                            <td class="tw:text-center">
                                <button type="submit" class=" tw:text-black tw:font-bold tw:py-2 tw:px-4 tw:rounded tw:inline-flex tw:items-center">
                                    <i class="fa-solid fa-eye" style="color: #000000;"></i>
                               </button>
                            </td>  
                            <td class="tw:text-center">
                                <button type="submit" class=" tw:text-black tw:font-bold tw:py-2 tw:px-4 tw:rounded tw:inline-flex tw:items-center">
                                    <i class="fa-solid fa-pen-to-square" style="color: #000000;"></i>
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