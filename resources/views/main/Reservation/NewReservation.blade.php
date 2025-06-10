<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrainSystem - My Trains</title>
    @vite(['resources/css/app.css'])
    @vite(['resources/css/MyTrains.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div id="container" class="tw:min-h-screen tw:bg-cover tw:bg-center tw:bg-no-repeat tw:fixed tw:inset-0">
        <x-navbar />
        <div id="boxContainer" class="tw:h-full tw:w-full tw:flex tw:justify-center tw:items-center tw:pt-20">
            <div class="box tw:w-8/12 md:tw:w-8/12 tw:h-auto tw:min-h-[70vh] tw:bg-gray-200 tw:bg-opacity-80 tw:rounded-lg tw:p-6 tw:shadow-lg tw:flex tw:flex-col">
                <div class="tw:overflow-x-auto tw:flex-grow">
                    <table class="tw:min-w-full tw:bg-gray-300 tw:rounded-lg tw:shadow-md tw:overflow-hidden">
                        <thead class="tw:bg-gray-400 tw:text-gray-800 tw:uppercase tw:text-sm tw:leading-normal">
                            <tr>
                                <th class="tw:py-3 tw:text-left">Name Travel</th>
                                <th class="tw:py-3 tw:px-6 tw:text-left">Available Seats (E,F)</th>
                                <th class="tw:py-3 tw:px-6 tw:text-left">Date</th>
                                <th class="tw:py-3 tw:px-6 tw:text-left">Proceed</th>
                            </tr>
                        </thead>

                        <tbody class="tw:text-gray-900 tw:text-sm tw:font-light">

                                <tr class="tw:border-b tw:border-gray-200 hover:tw:bg-gray-100 tw:font-bold">
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
                                            <button type="button" onclick="redirectToReserving()" class="tw:text-black tw:font-bold tw:py-2 tw:px-4 tw:rounded tw:inline-flex tw:items-center">
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
                </div>

            </div>
        </div>
    </div>

    <script>
        function redirectToReserving() {
            // Redirige al usuario a la nueva URL
            window.location.href = "http://localhost:8000/menu/newreservation/reserving";
        }
    </script>
</body>

</html>