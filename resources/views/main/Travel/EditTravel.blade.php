<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrainSystem - My Trains</title>
    @vite(['resources/css/app.css'])
    @vite(['resources/css/travel.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div id="container" class="tw:min-h-screen tw:bg-cover tw:bg-center tw:bg-no-repeat tw:fixed tw:inset-0">
        <x-navbar />
        <div id="boxContainer" class="tw:h-full tw:w-full tw:flex tw:justify-center tw:items-center tw:pt-20">
            <div class="box tw:overflow-x-hidden md:tw:w-8/12 tw:h-auto tw:min-h-[70vh] tw:bg-gray-200 tw:bg-opacity-80 tw:rounded-lg tw:p-6 tw:shadow-lg tw:flex tw:flex-col">
                <div class="tw:flex-grow">
                    <div class="tw:flex tw:justify-between tw:items-center tw:mb-4">
                        <div class="tw:flex tw:items-center">
                            <label for="totalAmount" class="tw:mr-2 tw:text-lg tw:font-semibold">Total Amount:</label>
                            $<input type="text" id="totalAmount" class="tw:w-13 tw:rounded tw:bg-transparent tw:text-gray-800" readonly>
                        </div>
                        <div class="tw:relative tw:flex tw:items-center">
                            <div id="btnBottom" class="tw:flex tw:justify-center tw:items-center     tw:w-full">
                                <button type="submit" class="tw:w-54 tw:h-13 tw:bg-green-200 tw:text-2xl tw:font-bold tw:rounded-lg hover:tw:bg-green-300">
                                    Confirm
                                </button>
                            </div>
                        </div>
                    </div>
                    
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
                                    <th class="tw:py-3 tw:px-6 tw:text-left">City Origin</th>
                                    <th class="tw:py-3 tw:px-6 tw:text-left">City Destiny</th>
                                    <th class="tw:py-3 tw:px-6 tw:text-left">Departure</th>
                                    <th class="tw:py-3 tw:px-6 tw:text-left">Sold Tickets</th>
                                    <th class="tw:py-3 tw:px-6 tw:text-left">Tickets Available</th>
                                </tr>
                            </thead>
            
                            <tbody id="personRowsContainer">
                                <tr class="person-row">
                                    <td class="tw:text-center">
                                        <input type="text" class="tw:w-24">
                                    </td>
                                    <td class="tw:text-center">
                                        <input type="text" class="tw:w-24">
                                    </td> 
                                    <td class="tw:text-center">
                                        <input type="text" class="tw:w-44">
                                    </td>
                                    <td class="tw:text-center">
                                        <label for="statusSelect" class="tw:w-32">Sold Tickets</label>
                                    </td>
                                    <td class="tw:text-center">
                                        <label for="statusSelect" class="tw:w-32">Tickets Available</label>
                                    </td>
                                </tr>
                            

                        </table>

                        <table class="tw:min-w-full tw:bg-gray-300 tw:shadow-md tw:overflow-hidden" name="Tabla de Reservas">
                                <thead class=" tw:text-gray-800 tw:uppercase tw:text-sm tw:leading-normal" name="Datos de la persona">
                                    <tr>
                                            <th class="tw:py-3 tw:px-6 tw:text-left">Capacity</th>
                                            <th class="tw:py-3 tw:px-6 tw:text-left">Train Type</th>
                                            <th class="tw:py-3 tw:px-6 tw:text-left">Train</th>
                                            <th class="tw:py-3 tw:px-6 tw:text-left">Max Velocity</th>
                                            <th class="tw:py-3 tw:px-6 tw:text-left">Travel Code</th>
                                    </tr>
                                </thead>
                            </tbody>

            
                            <tbody id="personRowsContainer" class="tw:text-center">
                                <tr class="person-row">
                                    <td class="tw:text-center">
                                        <label for="statusSelect" class="tw:w-32">904</label>
                                    </td>
                                    <td class="tw:text-center">
                                        <label for="statusSelect" class="tw:w-32">Sakura</label>
                                    </td> 
                                    <td class="tw:text-center">
                                        <input type="text" class="tw:w-24">
                                    </td>
                                    <td class="tw:text-center">
                                        <label for="statusSelect" class="tw:w-32">90 km/h</label>
                                    </td>
                                    <td class="tw:text-center">
                                        <label for="statusSelect" class="tw:w-32">123456789</label>
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
                                        <label for="statusSelect" class="tw:w-32">Mariana Nova</label>
                                    </td>
                                    <td class="tw:text-center">
                                        <label for="statusSelect" class="tw:w-32">Femenine</label>
                                    </td>
                                    <td class="tw:text-center">
                                        <label for="statusSelect" class="tw:w-32">20</label>
                                    </td> 
                                    <td class="tw:text-center">
                                        <label for="statusSelect" class="tw:w-32">A12</label>
                                    </td>
                                    <td class="tw:text-center">
                                        <label for="statusSelect" class="tw:w-32">First</label>
                                    </td>
                                    <td class="tw:text-center">
                                        <label for="statusSelect" class="tw:w-32">$4000</label>
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
    </div>

    <script>
        function redirectToReserving() {
            // Redirige al usuario a la nueva URL
            window.location.href = "http://localhost:8000/menu/newreservation/reserving";
        }

        // Script para calcular y mostrar el total de los costos
        document.addEventListener('DOMContentLoaded', function() {
            const costCells = document.querySelectorAll('tbody .tw\\:text-center label:nth-child(5)'); // Selecciona la 5ta label en cada fila del tbody
            let totalCost = 0;

            costCells.forEach(cell => {
                const costText = cell.textContent.trim();
                const cost = parseFloat(costText);
                if (!isNaN(cost)) {
                    totalCost += cost;
                }
            });

            const totalAmountInput = document.getElementById('totalAmount');
            if (totalAmountInput) {
                totalAmountInput.value = totalCost;//.toFixed(2); // Muestra el total con 2 decimales
            }
        });
    </script>
</body>

</html>