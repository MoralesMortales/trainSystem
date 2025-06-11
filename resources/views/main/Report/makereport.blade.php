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
    <div id="boxContainer" class="tw:h-11/12 tw:w-full tw:flex tw:justify-center tw:items-center tw:pt-28">
        <div class="box">
            <form id="reservingForm" action="" class="tw:h-full tw:w-full tw:flex tw:flex-col tw:justify-center tw:items-center" method="get">
            @csrf
            <table class="min-w-full text-left text-sm font-light text-surface dark:text-white tw:mr-10px">
                <tbody>
                    <tr>

                        <td colspan="6" class="tw:text-center">
                            <div id="btnBottom" class="tw:flex tw:justify-center tw:items-center tw:pt-2 tw:pb-2 tw:w-full">
                                <button id="reservationsButton" type="button" class="tw:w-54 tw:h-13 tw:bg-gray-400 tw:text-2xl tw:font-bold tw:rounded-lg hover:tw:bg-green-300">
                                    Reservations
                                </button>
                            </div>
                        </td>
                        <td colspan="6" class="tw:text-center">
                            <div id="btnBottom" class="tw:flex tw:justify-center tw:items-center tw:pt-2 tw:pb-2 tw:w-full">
                                <button id="seasonalTripsButton" type="button" class="tw:w-54 tw:h-13 tw:bg-gray-400 tw:text-2xl tw:font-bold tw:rounded-lg hover:tw:bg-green-300">
                                    Seasonal Trips
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>


            <table class="min-w-full text-left text-sm font-light text-surface dark:text-white tw:mr-10px">

                <tbody>
                    <tr>
                        <td colspan="6" class="tw:text-center">
                            <div id="btnBottom" class="tw:flex tw:justify-center tw:items-center tw:pt-2 tw:pb-2 tw:w-full">
                                <button id="canceledButton" type="button" class="tw:w-54 tw:h-13 tw:bg-gray-400 tw:text-2xl tw:font-bold tw:rounded-lg hover:tw:bg-green-300">
                                    Canceled
                                </button>
                            </div>
                        </td>
                        <td colspan="6" class="tw:text-center">
                            <div id="btnBottom" class="tw:flex tw:justify-center tw:items-center tw:pt-2 tw:pb-2 tw:w-full">
                                <button id="destinyButton" type="button" class="tw:w-54 tw:h-13 tw:bg-gray-400 tw:text-2xl tw:font-bold tw:rounded-lg hover:tw:bg-green-300">
                                    Destiny
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Obtenemos una referencia a cada botón por su ID único
        const reservationsButton = document.getElementById('reservationsButton');
        const seasonalTripsButton = document.getElementById('seasonalTripsButton');
        const canceledButton = document.getElementById('canceledButton');
        const destinyButton = document.getElementById('destinyButton');

        // Agregamos un event listener para el click a cada botón
        if (reservationsButton) {
            reservationsButton.addEventListener('click', function() {
                window.location.href = '/menu/reports/reservations';
            });
        }

        if (seasonalTripsButton) {
            seasonalTripsButton.addEventListener('click', function() {
                window.location.href = '/menu/reports/seasonaltrips';
            });
        }

        if (canceledButton) {
            canceledButton.addEventListener('click', function() {
                window.location.href = '/menu/reports/canceled';
            });
        }

        if (destinyButton) {
            destinyButton.addEventListener('click', function() {
                window.location.href = '/menu/reports/destiny';
            });
        }
    });
</script>

</body>
</html>