<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrainSystem - Manage Cities</title>
    @vite(['resources/css/app.css'])
    @vite(['resources/css/MyTrains.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div id="container" class="tw:min-h-screen tw:bg-cover tw:bg-center tw:bg-no-repeat tw:fixed tw:inset-0">
        <x-navbar />
        <div id="boxContainer" class="tw:h-full tw:w-full tw:flex tw:justify-center tw:items-center tw:pt-20">
            <div class="box tw:w-10/12 md:tw:w-8/12 tw:h-auto tw:min-h-[70vh] tw:bg-gray-200 tw:bg-opacity-80 tw:rounded-lg tw:p-6 tw:shadow-lg tw:flex tw:flex-col tw:items-center tw:justify-center">

<div class="tabla tw:flex tw:h-1/2 tw:overflow-y-hidden tw:w-full tw:justify-center tw:items-start">
    <div style="height: 400px;" class="tw:w-full tw:p-4 tw:bg-white tw:rounded-lg tw:shadow-md tw:overflow-y-auto">
                        <table class="tw:min-w-full tw:h-full tw:overflow-y-hidden">
                            <tbody id="cityListContainer" class="tw:max-h-[300px] tw:w-full ">
  @foreach($cities as $city)
                    <tr class="city-row tw:border-b tw:border-gray-200 last:tw:border-b-0" data-city-id="{{ $city->id }}">
                        <td class="tw:p-3 tw:text-lg tw:cursor-pointer hover:tw:bg-gray-100">
                            {{ $city->name }}
                        </td>
                    </tr>
                    @endforeach
                            </tbody>
                        </table>
                    </div>

                    <table class="button-group tw:flex tw:flex-col tw:items-center tw:pl-13 tw:justify-center tw:space-y-4 tw:min-h-[300px]">
                        <tbody>
                            <div>
                                <td>
                                    <button type="button" id="addCityBtn" class="tw:w-48 tw:h-16 tw:bg-green-500 tw:text-white tw:text-xl tw:font-bold tw:rounded-lg hover:tw:bg-green-600 tw:transition-colors">
                                        Add City
                                    </button>
                                </td>
                            </div>
                        </tbody>
                        <tbody>
                            <div>
                                <td>
                                    <button type="button" id="removeCityBtn" class="tw:w-48 tw:h-16 tw:bg-red-500 tw:text-white tw:text-xl tw:font-bold tw:rounded-lg hover:tw:bg-red-600 tw:transition-colors">
                                        Remove City
                                    </button>
                                </td>
                            </div>
                        </tbody>
                    </table>
                </div>

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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const cityListContainer = document.getElementById('cityListContainer');
    const addCityBtn = document.getElementById('addCityBtn');
    const removeCityBtn = document.getElementById('removeCityBtn');
    let selectedCityId = null;

    // Función para agregar nueva ciudad (AJAX)
    addCityBtn.addEventListener('click', function() {
        Swal.fire({
            title: 'Agregar Nueva Ciudad',
            input: 'text',
            inputLabel: 'Nombre de la Ciudad:',
            showCancelButton: true,
            confirmButtonText: 'Agregar',
            cancelButtonText: 'Cancelar',
            inputValidator: (value) => {
                if (!value) return '¡Necesitas escribir algo!';
                if (!/^[a-zA-Z\sáéíóúÁÉÍÓÚñÑ]+$/.test(value)) {
                    return 'El nombre solo debe contener letras y espacios';
                }
                return null;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("{{ route('cities.store') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({name: result.value})
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const newRow = document.createElement('tr');
                        newRow.className = 'city-row tw:border-b tw:border-gray-200 last:tw:border-b-0';
                        newRow.dataset.cityId = data.city.id;
                        newRow.innerHTML = `
                            <td class="tw:p-3 tw:text-lg tw:cursor-pointer hover:tw:bg-gray-100">
                                ${data.city.name}
                            </td>`;
                        cityListContainer.appendChild(newRow);
                        attachRowEvents(newRow);
                        Swal.fire('¡Éxito!', data.message, 'success');
                    }
                })
                .catch(error => {
                    Swal.fire('Error', 'Ocurrió un error al agregar la ciudad', 'error');
                });
            }
        });
    });

    // Función para eliminar ciudad (AJAX)
removeCityBtn.addEventListener('click', function() {
    if (!selectedCityId) {
        Swal.fire('Info', 'Selecciona una ciudad primero', 'info');
        return;
    }

    Swal.fire({
        title: '¿Eliminar ciudad?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/menu/managecitys/${selectedCityId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    document.querySelector(`tr[data-city-id="${selectedCityId}"]`).remove();
                    selectedCityId = null;
                    Swal.fire('¡Eliminada!', data.message, 'success');
                } else {
                    Swal.fire('Error', data.message || 'Error al eliminar la ciudad', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error', 'No se pudo eliminar la ciudad', 'error');
            });
        }
    });
});

    // Función para manejar selección de filas
    function attachRowEvents(row) {
        row.addEventListener('click', function() {
            document.querySelectorAll('.city-row').forEach(r => {
                r.classList.remove('tw:bg-blue-200');
            });
            this.classList.add('tw:bg-blue-200');
            selectedCityId = this.dataset.cityId;
        });
    }

    // Adjuntar eventos a las filas existentes
    document.querySelectorAll('.city-row').forEach(row => {
        attachRowEvents(row);
    });
});
</script>

</body>
</html>
