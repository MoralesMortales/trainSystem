<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrainSystem - My Trains</title>
    @vite(['resources/css/app.css'])
    @vite(['resources/css/ViewReservation.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div id="container" class="tw:min-h-screen tw:bg-cover tw:bg-center tw:bg-no-repeat tw:fixed tw:inset-0">
        <x-navbar />
        <div id="boxContainer" class="tw:h-full tw:w-full tw:flex tw:justify-center tw:items-center tw:pt-20">
            <div class="box overflow-y-auto tw:w-10/12 md:tw:w-8/12 tw:h-auto tw:min-h-[65vh] tw:bg-gray-200 tw:bg-opacity-80 tw:rounded-lg tw:p-6 tw:shadow-lg tw:flex tw:flex-col">

                <form id="reservationForm">
                    <div class="tw:overflow-x-auto tw:flex-grow">
                        <table class="tw:min-w-full tw:bg-gray-300 tw:shadow-md tw:overflow-hidden" name="Tabla de Reservas">
                            <thead class="tw:bg-gray-400 tw:text-gray-800 tw:uppercase tw:text-sm tw:leading-normal">
                                <tr>
                                    <th colspan="6" class="tw:text-center tw:py-2 tw:text-xl">Ohio - Train (A113)</th>
                                </tr>
                            </thead>
                            <thead class=" tw:text-gray-800 tw:uppercase tw:text-sm tw:leading-normal" name="Datos de la persona">
                                <tr>
                                    <th class="tw:py-3 tw:px-6 tw:text-left">Reserved By</th>
                                    <th class="tw:py-3 tw:px-6 tw:text-left">Reserving Number</th>
                                    <th class="tw:py-3 tw:px-6 tw:text-left">Departure</th>
                                    <th class="tw:py-3 tw:px-6 tw:text-left">Passport Number</th>
                                    <th class="tw:py-3 tw:px-6 tw:text-left">Travel Code</th>
                                </tr>
                            </thead>
            
                            <tbody id="personRowsContainer">
                                <tr class="person-row">
                                    <td class="tw:text-center">
                                        <input type="text" name="persons[0][fullname]" class="tw:w-48">
                                    </td>
                                    <td class="tw:text-center">
                                        <input type="text" name="persons[0][fullname]" class="tw:w-24">
                                    </td> 
                                    <td class="tw:text-center">
                                        <input type="text" name="persons[0][fullname]" class="tw:w-32">
                                    </td>
                                    <td class="tw:text-center">
                                        <input type="text" name="persons[0][fullname]" class="tw:w-32">
                                    </td>
                                    <td class="tw:text-center">
                                        <input type="text" name="persons[0][fullname]" class="tw:w-32">
                                    </td>
                                </tr>
                            

                        </table>

                        <table class="tw:min-w-full tw:bg-gray-300 tw:shadow-md tw:overflow-hidden" name="Tabla de Reservas">
                                <thead class=" tw:text-gray-800 tw:uppercase tw:text-sm tw:leading-normal" name="Datos de la persona">
                                    <tr>
                                            <th class="tw:py-3 tw:px-6 tw:text-left">Gender</th>
                                            <th class="tw:py-3 tw:px-6 tw:text-left">Age</th>
                                            <th class="tw:py-3 tw:px-6 tw:text-left">Seat</th>
                                            <th class="tw:py-3 tw:px-6 tw:text-left">Class</th>
                                            <th class="tw:py-3 tw:px-6 tw:text-left">Seat Cost</th>
                                            <th class="tw:py-3 tw:px-6 tw:text-left">Reserved Seats</th>
                                    </tr>
                                </thead>
                            </tbody>

            
                            <tbody id="personRowsContainer" class="tw:text-center">
                                <tr class="person-row">
                                    <td class="tw:text-center">
                                        <input type="text" name="persons[0][gender]" class="tw:w-24">
                                    </td>
                                    <td class="tw:text-center">
                                        <input type="text" name="persons[0][age]" class="tw:w-12">
                                    </td> 
                                    <td class="tw:text-center">
                                        <input type="text" name="persons[0][seat]" class="tw:w-12">
                                    </td>
                                    <td class="tw:text-center">
                                        <input type="text" name="persons[0][class]" class="tw:w-24">
                                    </td>
                                    <td class="tw:text-center">
                                        <input type="text" name="persons[0][seat_cost]" class="tw:w-28">
                                    </td>
                                    <td class="tw:text-center">
                                        <input type="text" name="persons[0][reserver_seats]" class="tw:w-12">
                                    </td>
                                </tr>
                            </tbody>
                        </table>


                        <table class=" tw:min-w-full tw:bg-gray-300 tw:shadow-md tw:overflow-hidden tw:border-t-2" >
                                <thead class=" tw:text-gray-800 tw:uppercase tw:text-sm tw:leading-normal" name="Datos de la persona">
                                    <tr>
                                        <th class="tw:py-3 tw:px-6 tw:text-left">Fullname</th>
                                        <th class="tw:py-3 tw:px-6 tw:text-left">Gender</th>
                                        <th class="tw:py-3 tw:px-6 tw:text-left">Age</th>
                                        <th class="tw:py-3 tw:px-6 tw:text-left">Seat</th>
                                        <th class="tw:py-3 tw:px-6 tw:text-left">Class</th>
                                        <th class="tw:py-3 tw:px-6 tw:text-left">Seat Cost</th>
                                    </tr>
                                </thead>
                            </tbody>

            
                            <tbody id="personRowsContainer" class="tw:text-center">
                                <tr class="person-row">
                                    <td class="tw:text-center">
                                        <input type="text" name="persons[0][reserver_seats]" class="tw:w-40">
                                    </td>
                                    <td class="tw:text-center">
                                        <input type="text" name="persons[0][gender]" class="tw:w-24">
                                    </td>
                                    <td class="tw:text-center">
                                        <input type="text" name="persons[0][age]" class="tw:w-12">
                                    </td> 
                                    <td class="tw:text-center">
                                        <input type="text" name="persons[0][seat]" class="tw:w-12">
                                    </td>
                                    <td class="tw:text-center">
                                        <input type="text" name="persons[0][class]" class="tw:w-24">
                                    </td>
                                    <td class="tw:text-center">
                                        <input type="text" name="persons[0][seat_cost]" class="tw:w-28">
                                    </td>

                                </tr>
                            </tbody>
                        </table>

                        <table class="tw:min-w-full tw:rounded-lg tw:shadow-md tw:overflow-hidden" name="Tabla de Reservas">
                            <tbody>

                                <tr>
                                    <th colspan="6" class="tw:text-right tw:py-2 tw:text-xl tw:font-bold">
                                        Total a pagar:
                                        $<span id="totalCost">0.00</span>
                                    </th>
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