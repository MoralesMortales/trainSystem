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
        <x-navbar />

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
                                <th class="tw:py-3 tw:px-6 tw:text-center">
                                    <div class="tw:text-center">
                                        Edit
                                    </div>
                                </th>
                                <th class="tw:py-3 tw:px-6 tw:text-center">
                                    <div class="tw:text-center">
                                        Delete
                                    </div>
                                </th>
                            </tr>
                        </thead>

                        <tbody class="tw:text-gray-900 tw:text-sm tw:font-light">
                            @foreach ($trains as $train)

                                <tr class="tw:border-b tw:border-gray-200 hover:tw:bg-gray-100 tw:font-bold">
                                    <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">Unused</td>
                                    <td class="tw:py-3 tw:px-6 tw:text-left">{{ $train->name }}</td>
                                    <td class="tw:py-3 tw:px-6 tw:text-left">{{ $train->capacity }}</td>
                                    <td class="tw:py-3 tw:px-6 tw:text-left">{{ $train->type }}</td>
                                    <td class="tw:py-3 tw:px-6 tw:text-left">{{ $train->maxVelocity }} km/h</td>
                                    <td class="tw:py-3 tw:px-6">
                                        <div class="tw:flex tw:justify-center">

                                            <a href="{{ route('updateTrain', $train->train_id) }}" class="tw:text-blue-500  hover:tw:text-blue-700">
                                                <div class="tw:w-full tw:flex tw:justify-center">
                                                    <!-- Icono de Editar (SVG) -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="tw:h-5 tw:w-5"
                                                        fill="none" viewBox="3 0 24 24" stroke="currentColor"
                                                        stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </div>
                                            </a>

                                        </div>
                                    </td>

                                    <td class="tw:py-3 tw:flex tw:justify-center ">

                                        <button id="deleteBtn" onclick="confirmDelete({{ $train->train_id }})" class="tw:text-red-500 hover:tw:text-red-700">
                                            <div class="tw:w-full tw:flex tw:justify-center">
                                                <!-- Icono de Eliminar (SVG) -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="tw:h-5 tw:w-5"
                                                    fill="none" viewBox="3 0 24 24" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </div>
                                        </button>

                                    </td>

                                </tr>
                                <!-- Puedes añadir más filas de trenes aquí -->
                            @endforeach
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
