<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrainSystem - My Trains</title>
    @vite(['resources/css/app.css'])
    <!-- Puedes crear un CSS específico para MyTrains si lo necesitas, similar a CreateTrain.css -->
    @vite(['resources/css/MyTrains.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div id="container" class="tw:min-h-screen tw:bg-cover tw:bg-center tw:bg-no-repeat tw:fixed tw:inset-0">
        <x-navbar />
        <div id="boxContainer" class="tw:h-full tw:w-full tw:flex tw:justify-center tw:items-center tw:pt-20">
            <div class="box tw:w-10/12 md:tw:w-8/12 tw:h-auto tw:min-h-[70vh] tw:bg-gray-200 tw:bg-opacity-80 tw:rounded-lg tw:p-6 tw:shadow-lg tw:flex tw:flex-col">

                <!-- Tabla de trenes -->
                <div class="tw:overflow-x-auto tw:flex-grow">
                    <table class="tw:min-w-full tw:bg-gray-300 tw:rounded-lg tw:shadow-md tw:overflow-hidden">
                        <thead class="tw:bg-gray-400 tw:text-gray-800 tw:uppercase tw:text-sm tw:leading-normal">
                            <tr>
                                <th class="tw:py-3 tw:px-6 tw:text-left">Status</th>
                                <th class="tw:py-3 tw:px-6 tw:text-left">Name Travel</th>
                                <th class="tw:py-3 tw:px-6 tw:text-left">Quantity Tickets</th>
                                <th class="tw:py-3 tw:px-6 tw:text-left">Date</th>
                                <th class="tw:py-3 tw:px-6 tw:text-left">View More</th>
                                <th class="tw:py-3 tw:px-6 tw:text-left">Edit</th>
                            </tr>
                        </thead>

                        <tbody class="tw:text-gray-900 tw:text-sm tw:font-light">

                                <tr class="tw:border-b tw:border-gray-200 hover:tw:bg-gray-100 tw:font-bold">
                                    <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">Active</td>
                                    <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">Ohio</td>
                                    <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">4</td>
                                    <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">20/20/20</td>
                                    <td class="tw:text-center">
                                        <button type="button" id="viewMoreButton" class="tw:text-black tw:font-bold tw:py-2 tw:px-4 tw:rounded tw:inline-flex tw:items-center">
                                            <i class="fa-solid fa-eye" style="color: #000000;"></i>
                                            </button>
                                    </td>    
                                    <td class="tw:text-center">
                                        <button type="button" id="editButton" class="tw:text-black tw:font-bold tw:py-2 tw:px-4 tw:rounded tw:inline-flex tw:items-center">
                                            <i class="fa-solid fa-pen-to-square" style="color: #000000;"></i>
                                        </button>
                                    </td>                                       
                                </tr>
                                <!-- Puedes añadir más filas de trenes aquí -->
                            <!-- Fila de ejemplo 1 -->
                        </tbody>
                                                <tbody class="tw:text-gray-900 tw:text-sm tw:font-light">

                                <tr class="tw:border-b tw:border-gray-200 hover:tw:bg-gray-100 tw:font-bold">
                                    <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">Active</td>
                                    <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">Ohio</td>
                                    <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">4</td>
                                    <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">20/20/20</td>
                                    <td class="tw:text-center">
                                        <button type="button" id="viewMoreButton" class="tw:text-black tw:font-bold tw:py-2 tw:px-4 tw:rounded tw:inline-flex tw:items-center">
                                            <i class="fa-solid fa-eye" style="color: #000000;"></i>
                                            </button>
                                    </td>    
                                    <td class="tw:text-center">
                                        <button type="button" id="editButton" class="tw:text-black tw:font-bold tw:py-2 tw:px-4 tw:rounded tw:inline-flex tw:items-center">
                                            <i class="fa-solid fa-pen-to-square" style="color: #000000;"></i>
                                        </button>
                                    </td>                                       
                                </tr>
                                <!-- Puedes añadir más filas de trenes aquí -->
                            <!-- Fila de ejemplo 1 -->
                        </tbody>
                                                <tbody class="tw:text-gray-900 tw:text-sm tw:font-light">

                                <tr class="tw:border-b tw:border-gray-200 hover:tw:bg-gray-100 tw:font-bold">
                                    <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">Active</td>
                                    <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">Ohio</td>
                                    <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">4</td>
                                    <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">20/20/20</td>
                                    <td class="tw:text-center">
                                        <button type="button" id="viewMoreButton" class="tw:text-black tw:font-bold tw:py-2 tw:px-4 tw:rounded tw:inline-flex tw:items-center">
                                            <i class="fa-solid fa-eye" style="color: #000000;"></i>
                                            </button>
                                    </td>    
                                    <td class="tw:text-center">
                                        <button type="button" id="editButton" class="tw:text-black tw:font-bold tw:py-2 tw:px-4 tw:rounded tw:inline-flex tw:items-center">
                                            <i class="fa-solid fa-pen-to-square" style="color: #000000;"></i>
                                        </button>
                                    </td>                                       
                                </tr>
                                <!-- Puedes añadir más filas de trenes aquí -->
                            <!-- Fila de ejemplo 1 -->
                        </tbody>
                                                <tbody class="tw:text-gray-900 tw:text-sm tw:font-light">

                                <tr class="tw:border-b tw:border-gray-200 hover:tw:bg-gray-100 tw:font-bold">
                                    <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">Active</td>
                                    <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">Ohio</td>
                                    <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">4</td>
                                    <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">20/20/20</td>
                                    <td class="tw:text-center">
                                        <button type="button" id="viewMoreButton" class="tw:text-black tw:font-bold tw:py-2 tw:px-4 tw:rounded tw:inline-flex tw:items-center">
                                            <i class="fa-solid fa-eye" style="color: #000000;"></i>
                                            </button>
                                    </td>    
                                    <td class="tw:text-center">
                                        <button type="button" id="editButton" class="tw:text-black tw:font-bold tw:py-2 tw:px-4 tw:rounded tw:inline-flex tw:items-center">
                                            <i class="fa-solid fa-pen-to-square" style="color: #000000;"></i>
                                        </button>
                                    </td>                                       
                                </tr>
                                <!-- Puedes añadir más filas de trenes aquí -->
                            <!-- Fila de ejemplo 1 -->
                        </tbody>
                                                <tbody class="tw:text-gray-900 tw:text-sm tw:font-light">

                                <tr class="tw:border-b tw:border-gray-200 hover:tw:bg-gray-100 tw:font-bold">
                                    <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">Active</td>
                                    <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">Ohio</td>
                                    <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">4</td>
                                    <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">20/20/20</td>
                                    <td class="tw:text-center">
                                        <button type="button" id="viewMoreButton" class="tw:text-black tw:font-bold tw:py-2 tw:px-4 tw:rounded tw:inline-flex tw:items-center">
                                            <i class="fa-solid fa-eye" style="color: #000000;"></i>
                                            </button>
                                    </td>    
                                    <td class="tw:text-center">
                                        <button type="button" id="editButton" class="tw:text-black tw:font-bold tw:py-2 tw:px-4 tw:rounded tw:inline-flex tw:items-center">
                                            <i class="fa-solid fa-pen-to-square" style="color: #000000;"></i>
                                        </button>
                                    </td>                                       
                                </tr>
                                <!-- Puedes añadir más filas de trenes aquí -->
                            <!-- Fila de ejemplo 1 -->
                        </tbody>
                                                <tbody class="tw:text-gray-900 tw:text-sm tw:font-light">

                                <tr class="tw:border-b tw:border-gray-200 hover:tw:bg-gray-100 tw:font-bold">
                                    <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">Active</td>
                                    <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">Ohio</td>
                                    <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">4</td>
                                    <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">20/20/20</td>
                                    <td class="tw:text-center">
                                        <button type="button" id="viewMoreButton" class="tw:text-black tw:font-bold tw:py-2 tw:px-4 tw:rounded tw:inline-flex tw:items-center">
                                            <i class="fa-solid fa-eye" style="color: #000000;"></i>
                                            </button>
                                    </td>    
                                    <td class="tw:text-center">
                                        <button type="button" id="editButton" class="tw:text-black tw:font-bold tw:py-2 tw:px-4 tw:rounded tw:inline-flex tw:items-center">
                                            <i class="fa-solid fa-pen-to-square" style="color: #000000;"></i>
                                        </button>
                                    </td>                                       
                                </tr>
                                <!-- Puedes añadir más filas de trenes aquí -->
                            <!-- Fila de ejemplo 1 -->
                        </tbody>
                        <tbody class="tw:text-gray-900 tw:text-sm tw:font-light">

                                <tr class="tw:border-b tw:border-gray-200 hover:tw:bg-gray-100 tw:font-bold">
                                    <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">Active</td>
                                    <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">Ohio</td>
                                    <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">4</td>
                                    <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">20/20/20</td>
                                    <td class="tw:text-center">
                                        <button type="button" id="viewMoreButton" class="tw:text-black tw:font-bold tw:py-2 tw:px-4 tw:rounded tw:inline-flex tw:items-center">
                                            <i class="fa-solid fa-eye" style="color: #000000;"></i>
                                            </button>
                                    </td>    
                                    <td class="tw:text-center">
                                        <button type="button" id="editButton" class="tw:text-black tw:font-bold tw:py-2 tw:px-4 tw:rounded tw:inline-flex tw:items-center">
                                            <i class="fa-solid fa-pen-to-square" style="color: #000000;"></i>
                                        </button>
                                    </td>                                       
                                </tr>
                                <!-- Puedes añadir más filas de trenes aquí -->
                            <!-- Fila de ejemplo 1 -->
                        </tbody>
                                                <tbody class="tw:text-gray-900 tw:text-sm tw:font-light">

                                <tr class="tw:border-b tw:border-gray-200 hover:tw:bg-gray-100 tw:font-bold">
                                    <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">Active</td>
                                    <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">Ohio</td>
                                    <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">4</td>
                                    <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">20/20/20</td>
                                    <td class="tw:text-center">
                                        <button type="button" id="viewMoreButton" class="tw:text-black tw:font-bold tw:py-2 tw:px-4 tw:rounded tw:inline-flex tw:items-center">
                                            <i class="fa-solid fa-eye" style="color: #000000;"></i>
                                            </button>
                                    </td>    
                                    <td class="tw:text-center">
                                        <button type="button" id="editButton" class="tw:text-black tw:font-bold tw:py-2 tw:px-4 tw:rounded tw:inline-flex tw:items-center">
                                            <i class="fa-solid fa-pen-to-square" style="color: #000000;"></i>
                                        </button>
                                    </td>                                       
                                </tr>
                                <!-- Puedes añadir más filas de trenes aquí -->
                            <!-- Fila de ejemplo 1 -->
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

<script>
function confirmDelete(trainId) {
    Swal.fire({
        title: '¿Are you sure?',
        text: "This action is permanent!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            deleteTrain(trainId);
        }
    });
}

function deleteTrain(trainId) {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = "{{ route('Trains.destroy', ':trainId') }}".replace(':trainId', trainId);

    const csrf = document.createElement('input');
    csrf.type = 'hidden';
    csrf.name = '_token';
    csrf.value = '{{ csrf_token() }}';
    form.appendChild(csrf);

    const method = document.createElement('input');
    method.type = 'hidden';
    method.name = '_method';
    method.value = 'DELETE';
    form.appendChild(method);

    document.body.appendChild(form);
    form.submit();
}
</script>
</body>

</html>
