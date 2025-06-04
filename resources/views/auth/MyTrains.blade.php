<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrainSystem - My Trains</title>
    @vite(['resources/css/app.css'])
    <!-- Puedes crear un CSS específico para MyTrains si lo necesitas, similar a CreateTrain.css -->
    @vite(['resources/css/MyTrains.css'])
</head>

<body>
<div id="container" class="tw:min-h-screen tw:bg-cover tw:bg-center tw:bg-no-repeat tw:fixed tw:inset-0">
    <x-navbar/>
    
    <div id="boxContainer" class="tw:h-full tw:w-full tw:flex tw:justify-center tw:items-center tw:pt-20">
        <div class="box tw:w-10/12 md:tw:w-8/12 tw:h-auto tw:min-h-[70vh] tw:bg-gray-200 tw:bg-opacity-80 tw:rounded-lg tw:p-6 tw:shadow-lg tw:flex tw:flex-col">

            <!-- Tabla de trenes -->
            <div class="tw:overflow-x-auto tw:flex-grow">
                <table class="tw:min-w-full tw:bg-gray-300 tw:rounded-lg tw:shadow-md tw:overflow-hidden"> 
                    <thead class="tw:bg-gray-400 tw:text-gray-800 tw:uppercase tw:text-sm tw:leading-normal">
                        <tr>
                            <th class="tw:py-3 tw:px-6 tw:text-left">Status</th>
                            <th class="tw:py-3 tw:px-6 tw:text-left">Name Train</th>
                            <th class="tw:py-3 tw:px-6 tw:text-left">Capacity</th>
                            <th class="tw:py-3 tw:px-6 tw:text-left">Type</th>
                            <th class="tw:py-3 tw:px-6 tw:text-left">Max Velocity</th>
                            <th class="tw:py-3 tw:px-6 tw:text-center">Edit</th>
                            <th class="tw:py-3 tw:px-6 tw:text-center">Delete</th>
                        </tr>
                    </thead>

                    <tbody class="tw:text-gray-900 tw:text-sm tw:font-light">
                        <!-- Fila de ejemplo 1 -->
                        <tr class="tw:border-b tw:border-gray-200 hover:tw:bg-gray-100 tw:font-bold">
                            <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">Unused</td>
                            <td class="tw:py-3 tw:px-6 tw:text-left">Ohio</td>
                            <td class="tw:py-3 tw:px-6 tw:text-left">4000</td>
                            <td class="tw:py-3 tw:px-6 tw:text-left">Sakura</td>
                            <td class="tw:py-3 tw:px-6 tw:text-left">90 km/h</td>
                            <td class="tw:py-3 tw:px-6 tw:text-center">

                            <button class="tw:text-blue-500 hover:tw:text-blue-700">
                                <!-- Icono de Editar (SVG) -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="tw:h-5 tw:w-5" fill="none" viewBox="3 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>

                            </td>

                            <td class="tw:py-3 tw:px-6 tw:text-center">

                                <button class="tw:text-red-500 hover:tw:text-red-700">
                                    <!-- Icono de Eliminar (SVG) -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="tw:h-5 tw:w-5 tw:mr-5" fill="none" viewBox="3 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                                
                            </td>

                        </tr>
                        <!-- Puedes añadir más filas de trenes aquí -->
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

</body>
</html>
