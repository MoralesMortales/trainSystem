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
            <div class="box tw:overflow-x-hidden md:tw:w-8/12 tw:h-auto tw:min-h-[70vh] tw:bg-gray-200 tw:bg-opacity-80 tw:rounded-lg tw:p-6 tw:shadow-lg tw:flex tw:flex-col">
                <div class="tw:flex-grow">
                    <div class="tw:flex tw:justify-between tw:items-center tw:mb-4">
                        <div class="tw:flex tw:items-center">
                            <label for="totalAmount" class="tw:mr-2 tw:text-lg tw:font-semibold">Total Travels:</label>
                            <input type="text" id="totalAmount" class="tw:w-13 tw:rounded tw:border tw:border-gray-400 tw:bg-white tw:text-gray-800" readonly>
                        </div>
                        <div class="tw:relative tw:flex tw:items-center">
                            <label for="totalAmount" class="tw:mr-2 tw:text-center tw:text-lg tw:font-semibold">City Destiny:</label>
                            <select id="citySelect" class="tw:block  tw:bg-white tw:border tw:border-gray-400 tw:text-gray-800 tw:px-5 tw:rounded tw:shadow leading-tight focus:tw:outline-none focus:tw:shadow-outline">
                                <option value="">Seleccione</option>
                                <option value="Ohio">Ohio</option>
                                {{-- Aquí puedes agregar más opciones dinámicamente si es necesario --}}
                                <option value="Option1">Option 1</option>
                                <option value="Option2">Option 2</option>
                            </select>
                        </div>
                    </div>
                    <table class="tw:min-w-full tw:bg-gray-300 tw:rounded-lg tw:shadow-md tw:overflow-hidden">
                        <thead class="tw:bg-gray-400 tw:text-gray-800 tw:uppercase tw:text-sm tw:leading-normal">
                            <tr>
                                <th class="tw:py-3 tw:text-left">Travel Code</th>
                                <th class="tw:py-3 tw:px-6 tw:text-left">Departure Date</th>
                                <th class="tw:py-3 tw:px-6 tw:text-left">Train Name</th>
                                <th class="tw:py-3 tw:px-6 tw:text-left">Train Type </th>
                                <th class="tw:py-3 tw:px-6 tw:text-left">Reservings</th>
                            </tr>
                        </thead>

                        <tbody class="tw:text-gray-900 tw:text-sm tw:font-light">
                                <tr class="tw:border-b tw:border-gray-200 hover:tw:bg-gray-100 tw:font-bold">
                                    <td class="tw:text-center">
                                        <label class="tw:w-44"> 
                                            123456789
                                        </label>
                                    </td>
                                    <td class="tw:text-center">
                                        <label class="tw:w-48"> 
                                            10/6/2025
                                        </label>
                                    </td>      
                                    <td class="tw:text-center">
                                        <label class="tw:w-48"> 
                                            Ohio
                                        </label>
                                    </td>
                                    <td class="tw:text-center">
                                        <label class="tw:w-13"> 
                                            Ohio
                                        </label>
                                    </td>
                                    <td class="tw:text-center">
                                        <label class="tw:w-48"> 
                                            300 / 800
                                        </label>
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