<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrainSystem</title>
@vite(['resources/css/app.css'])
@vite(['resources/css/OnlyMe.css'])
</head>

<body>
<div id="container">
    <x-navbar/>
    <div id="boxContainer" class="tw:pt-6 tw:w-full tw:flex tw:justify-center tw:items-center">
        <div class="box">
            <form action="{{ route('register.submit') }}" class="tw:h-full tw:w-full tw:flex tw:flex-col tw:justify-center tw:items-center" method="post">
            @csrf
            <table class="min-w-full text-left text-sm font-light text-surface dark:text-white tw:mr-10px">
                <thead>
                    <tr>
                        <th colspan="6" class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Ohio - Train (A113)</th>
                        
                    </tr>
                </thead>
                <thead class="border-b border-neutral-200 font-medium dark:border-white/10">
                    <tr>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Reserved By</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Reserving Number</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Departure</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Passport Number</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Travel Code</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td class="tw:text-center">
                                <input type="text" name="Reserved By" class="tw:w-48" readonly>
                            </td>
                            <td class="tw:text-center">
                                <input type="text" name="Reserving Number" class="tw:w-48" readonly>
                            </td>        
                            <td class="tw:text-center">
                                <input type="text" name="Departure" class="tw:w-40" readonly>
                            </td>
                            <td class="tw:text-center">
                                <input type="text" name="Passport Number" class="tw:w-40" readonly>
                            </td>       
                            <td class="tw:text-center">
                                <input type="text" name="Travel Code" class="tw:w-40" readonly>
                            </td>                         
                    </tr>
                </tbody>

                <thead class="border-b border-neutral-200 font-medium dark:border-white/10">
                    <tr>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Gender</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Age</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Class</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Seat</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Seat Cost</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td class="tw:text-center">
                            <input type="text" name="Gender" class="tw:w-48">
                        </td>
                        <td class="tw:text-center">
                            <input type="text" name="Age" class="tw:w-48">
                        </td>        
                        <td class="tw:text-center">
                            <input type="text" name="Class" class="tw:w-40">
                            
                        </td>
                        <td class="tw:text-center">
                            <input type="text" name="Seat" class="tw:w-40">
                        </td>       
                        <td class="tw:text-center">
                            <input type="text" name="Seat Cost" class="tw:w-40">
                        </td>       
                    </tr>
                </tbody>
            </table>


            <table class="min-w-full text-left text-sm font-light text-surface dark:text-white tw:mr-10px">
                <thead class="border-b border-neutral-200 font-medium dark:border-white/10">
                    <tr>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Fullname</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Gender</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Age</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Class</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Seat</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Seat Cost</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td class="tw:text-center">
                                 <input type="text" name="Fullname" class="tw:w-48">
                             </td>
                        <td class="tw:text-center">
                            <input type="text" name="Gender" class="tw:w-48">
                        </td>
                        <td class="tw:text-center">
                            <input type="text" name="Age" class="tw:w-48">
                        </td>        
                        <td class="tw:text-center">
                            <input type="text" name="Class" class="tw:w-40">
                            
                        </td>
                        <td class="tw:text-center">
                            <input type="text" name="Seat" class="tw:w-40">
                        </td>       
                        <td class="tw:text-center">
                            <input type="text" name="Seat Cost" class="tw:w-40">
                        </td>                           
                    </tr>
                </tbody>
            </table>


            <table>
                <tbody>
                    <tr>
                        <th colspan="6" class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">
                            Total a pagar:
                        </th>
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