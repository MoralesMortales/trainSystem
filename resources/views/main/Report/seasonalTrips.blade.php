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
                        <div class="tw:flex tw:items-center tw:pr-2">
                            <label for="totalAmount" class="tw:mr-2 tw:text-lg tw:font-semibold">Total Passengers:</label>
                            <input type="text" id="totalAmount" class="tw:w-13 tw:rounded tw:border tw:border-gray-400 tw:bg-white tw:text-gray-800" readonly>
                        </div>
                        <div class="tw:relative tw:flex tw:items-center tw:pr-2">
                            <label for="periodStarts" class="tw:mr-2 tw:text-center tw:text-lg tw:font-semibold">Period Starts:</label>
                            <select id="periodStarts" class="tw:mr-2 tw:block tw:bg-white tw:border tw:border-gray-400 tw:text-gray-800 tw:px-2 tw:rounded tw:shadow leading-tight focus:tw:outline-none focus:tw:shadow-outline">
                                <option value="">Seleccione</option>
                                <option value="Ohio">Ohio</option>
                                {{-- Aquí puedes agregar más opciones dinámicamente si es necesario --}}
                                <option value="Option1">Option 1</option>
                                <option value="Option2">Option 2</option>
                            </select>
                        </div>
                        <div class="tw:relative tw:flex tw:items-center tw:pr-2">
                            <label for="periodEnds" class="tw:mr-2 tw:text-center tw:text-lg tw:font-semibold">Period Ends:</label>
                            <select id="periodEnds" class="tw:mr-2 tw:block tw:bg-white tw:border tw:border-gray-400 tw:text-gray-800 tw:px-2 tw:rounded tw:shadow leading-tight focus:tw:outline-none focus:tw:shadow-outline">
                                <option value="">Seleccione</option>
                                <option value="Ohio">Ohio</option>
                                {{-- Aquí puedes agregar más opciones dinámicamente si es necesario --}}
                                <option value="Option1">Option 1</option>
                                <option value="Option2">Option 2</option>
                            </select>
                        </div>
                        <div class="tw:relative tw:flex tw:items-center">
                            <label for="statusSelect" class="tw:mr-2 tw:text-lg tw:font-semibold">Status:</label>
                            <select id="statusSelect" class="tw:mr-2 tw:block tw:bg-white tw:border tw:border-gray-400 tw:text-gray-800 tw:px-3 tw:rounded tw:shadow leading-tight focus:tw:outline-none focus:tw:shadow-outline">
                                <option value="">Seleccione</option>
                                <option value="">Active</option>
                                <option value="">Inactive</option>
                                <option value="">Both</option>
                            </select>
                        </div>
                    </div>
                    <table class="tw:min-w-full tw:bg-gray-300 tw:rounded-lg tw:shadow-md tw:overflow-hidden">
                        <thead class="tw:bg-gray-400 tw:text-gray-800 tw:uppercase tw:text-sm tw:leading-normal">
                            <tr>
                                <th class="tw:py-3 tw:text-left">Reserving Number</th>
                                <th class="tw:py-3 tw:px-6 tw:text-left">Reserving Date</th>
                                <th class="tw:py-3 tw:px-6 tw:text-left">Train Type</th>
                                <th class="tw:py-3 tw:px-6 tw:text-left">Travel Code</th>
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
                                        Man
                                    </label>
                                </td>
                                <td class="tw:text-center">
                                    <label class="tw:w-44">
                                        123456789
                                    </label>
                                </td>
                            </tr>
                        </tbody>
                        <thead class="tw:bg-gray-400 tw:text-gray-800 tw:uppercase tw:text-sm tw:leading-normal">
                            <tr>
                                <th colspan="4" class="tw:py-3 tw:text-left tw:pl-6">
                                    Passengers
                                </th>
                            </tr>
                        </thead>
                        {{-- Aquí se agregan las casillas de pasajeros --}}
                        <tbody class="tw:text-gray-900 tw:text-sm tw:font-light">
                            @php
                                $passengers = [
                                    "Carlos Morales", "Maria Sanchez", "Juan Perez", "Ana Garcia",
                                    "Luis Rodriguez", "Sofia Hernandez", "Diego Lopez", "Elena Martinez",
                                    "Miguel Gonzales", "Laura Diaz", "Pablo Flores", "Isabel Ramirez",
                                    "Jose Garcia", "Andrea Torres", "Fernando Acosta", "Gabriela Soto"
                                ];
                            @endphp
                            @foreach(array_chunk($passengers, 4) as $row)
                                @php
                                    $count = 1; // Se reinicia $count para cada nueva fila
                                @endphp
                                <tr class="tw:border-b tw:border-gray-200 hover:tw:bg-gray-100">
                                    @foreach($row as $passenger)
                                        <td class="tw:py-2 tw:px-6 tw:text-left">
                                            <label class="tw:block tw:p-2 tw:rounded tw:text-gray-800 tw:font-medium">
                                                {{ $count++ }}# {{ $passenger }}
                                            </label>
                                        </td>
                                    @endforeach
                                    {{-- Rellenar celdas vacías si la última fila tiene menos de 4 elementos --}}
                                    @for ($i = 0; $i < (4 - count($row)); $i++)
                                        <td class="tw:py-2 tw:px-6 tw:text-left"></td>
                                    @endfor
                                </tr>
                            @endforeach
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
            const passengerLabels = document.querySelectorAll('tbody .tw\\:py-2.tw\\:px-6.tw\\:text-left label');
            let totalPassengers = 0;

            passengerLabels.forEach(label => {
                totalPassengers++;
            });

            const totalAmountInput = document.getElementById('totalAmount');
            if (totalAmountInput) {
                totalAmountInput.value = totalPassengers; // Muestra la cantidad total de pasajeros como un entero
            }
        });
    </script>
</body>

</html>