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
            <div class="box tw:w-10/12 md:tw:w-8/12 tw:h-auto tw:min-h-[70vh] tw:bg-gray-200 tw:bg-opacity-80 tw:rounded-lg tw:p-6 tw:shadow-lg tw:flex tw:flex-col">

                <form id="reservationForm" class="tw:overflow-x-auto tw:flex-grow">
                    <div>
                        <table class="tw:min-w-full tw:bg-gray-300 tw:rounded-lg tw:shadow-md tw:overflow-hidden" name="Tabla de Reservas">
                            <thead class="tw:bg-gray-400 tw:text-gray-800 tw:uppercase tw:text-sm tw:leading-normal" name="Datos de la persona">
                                <tr>
                                    <th class="tw:py-3 tw:px-6 tw:text-left">Cedula</th>
                                    <th class="tw:py-3 tw:px-6 tw:text-left">Email</th>
                                    <th class="tw:py-3 tw:px-6 tw:text-left">Charge</th>
                                    <th class="tw:py-3 tw:px-6 tw:text-left">Delete</th>
                                </tr>
                            </thead>
            
                            <tbody id="personRowsContainer">
                                <tr class="person-row">
                                    <td class="tw:text-center">
                                        <input type="text" name="persons[0][cedula]" class="tw:w-48" readonly>
                                    </td>
                                    <td class="tw:text-center">
                                        <input type="text" name="persons[0][email]" class="tw:w-48" readonly>
                                    </td>
                                    <td class="tw:text-center">
                                        <input type="text" name="persons[0][charge]" class="tw:w-48" readonly>
                                    </td>
                                    <td class="tw:text-center">
                                        <button type="button" class="delete-row-btn tw:text-black tw:font-bold tw:py-2 tw:px-4 tw:rounded tw:inline-flex tw:items-center">
                                            <i class="fa-solid fa-trash" style="color: #000000;"></i>
                                        </button>
                                    </td>                                     
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>

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



</body>
</html>