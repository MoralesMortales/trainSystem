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

                <div class="tabla tw:flex tw:w-full tw:justify-center tw:items-start "> 
                    <div class="tw:p-4 tw:bg-white tw:rounded-lg tw:shadow-md tw:overflow-hidden">
                        <table class="tw:min-w-full">
                            <tbody id="cityListContainer" class="tw:block tw:max-h-[300px] tw:overflow-y-auto">
                                <tr id="noCitiesRow" class="tw:text-center">
                                    <td colspan="1" class="tw:py-3">No hay ciudades para mostrar.</td>
                                </tr>
                                @forelse($cities as $city)
                                    <tr class="city-row tw:border-b tw:border-gray-200 last:tw:border-b-0" data-city-id="{{ $city->id }}">
                                        <td class="tw:p-3 tw:text-lg tw:cursor-pointer hover:tw:bg-gray-100" data-city-name="{{ $city->name }}">{{ $city->name }}</td>
                                    </tr>
                                @empty
                                    <tr id="noCitiesRow" class="tw:text-center">
                                        <td colspan="1" class="tw:py-3">No hay ciudades para mostrar.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <table class="button-group tw:flex tw:flex-col tw:items-center tw:pl-13 tw:justify-center tw:space-y-4 tw:min-h-[300px]">
                        <tbody>
                            <div> 
                                <td>
                                    <button type="button" id="addCityBtn" class="tw:w-48 tw:h-13 tw:bg-green-200 tw:text-2xl tw:font-bold tw:rounded-lg hover:tw:bg-green-300">
                                        Add City
                                    </button>
                                </td>
                            </div>
                        </tbody>
                        <tbody>
                            <div>
                                <td>
                                    <button type="button" id="removeCityBtn" class="tw:w-48 tw:h-13 tw:bg-red-200 tw:text-2xl tw:font-bold tw:rounded-lg hover:tw:bg-green-300">
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
        let selectedCityRow = null; // Para mantener la referencia a la fila seleccionada

        // Función para actualizar el estado de "noCitiesRow"
        function updateNoCitiesRow() {
            const noCitiesRow = document.getElementById('noCitiesRow');
            if (cityListContainer.children.length === 0) {
                if (!noCitiesRow) {
                    const row = document.createElement('tr');
                    row.id = 'noCitiesRow';
                    row.classList.add('tw:text-center');
                    row.innerHTML = '<td colspan="1" class="tw:py-3">No hay ciudades para mostrar.</td>';
                    cityListContainer.appendChild(row);
                }
            } else {
                if (noCitiesRow) {
                    noCitiesRow.remove();
                }
            }
        }


        // Función para manejar la selección de una ciudad
        function attachCityRowClickListener(row) {
            row.addEventListener('click', function() {
                // Remover la selección de la fila anterior si existe
                if (selectedCityRow) {
                    selectedCityRow.classList.remove('tw:bg-blue-200');
                }
                // Seleccionar la nueva fila
                selectedCityRow = this;
                selectedCityRow.classList.add('tw:bg-blue-200');
            });
        }

        // Adjuntar event listeners a las filas de ciudades existentes al cargar la página
        document.querySelectorAll('.city-row').forEach(row => {
            attachCityRowClickListener(row);
        });

        // Asegúrate de que la fila de "No hay ciudades" se muestre/oculte correctamente al inicio
        updateNoCitiesRow();

        // Event listener para el botón "Add City"
        addCityBtn.addEventListener('click', function() {
            Swal.fire({
                title: 'Agregar Nueva Ciudad',
                input: 'text',
                inputLabel: 'Nombre de la Ciudad:',
                inputPlaceholder: 'Ej: Barcelona',
                showCancelButton: true,
                confirmButtonText: 'Agregar',
                cancelButtonText: 'Cancelar',
                inputValidator: (value) => {
                    if (!value) {
                        return '¡Necesitas escribir algo!';
                    }
                    if (!/^[a-zA-Z\s]+$/.test(value)) {
                        return 'El nombre de la ciudad solo debe contener letras y espacios.';
                    }
                    // Validación en el cliente para evitar duplicados en la lista actual
                    const existingCities = Array.from(cityListContainer.querySelectorAll('.city-row td')).map(td => td.dataset.cityName.toLowerCase());
                    if (existingCities.includes(value.toLowerCase())) {
                        return 'Esta ciudad ya existe en la lista.';
                    }
                    return null;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const cityName = result.value;

                    // Enviar solicitud AJAX para agregar la ciudad
                    fetch('{{ route('cities.store') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Token CSRF de Laravel
                        },
                        body: JSON.stringify({ name: cityName })
                    })
                    .then(response => {
                        // Verifica si la respuesta es JSON antes de intentar parsearla
                        const contentType = response.headers.get("content-type");
                        if (contentType && contentType.indexOf("application/json") !== -1) {
                            return response.json();
                        } else {
                            // Si no es JSON, asume que es un error del servidor y lanza un error
                            return response.text().then(text => { throw new Error(text || "Respuesta no JSON del servidor"); });
                        }
                    })
                    .then(data => {
                        if (data.message) {
                            Swal.fire('¡Agregada!', data.message, 'success');
                            // Añadir la nueva ciudad a la tabla del DOM
                            const newRow = document.createElement('tr');
                            newRow.classList.add('city-row', 'tw:border-b', 'tw:border-gray-200', 'last:tw:border-b-0');
                            newRow.setAttribute('data-city-id', data.city.id); // Guardar el ID de la BD
                            newRow.innerHTML = `<td class="tw:p-3 tw:text-lg tw:cursor-pointer hover:tw:bg-gray-100" data-city-name="${data.city.name}">${data.city.name}</td>`;
                            cityListContainer.appendChild(newRow);
                            cityListContainer.scrollTop = cityListContainer.scrollHeight; // Scroll al final
                            attachCityRowClickListener(newRow); // Adjuntar listener a la nueva fila
                            updateNoCitiesRow(); // Actualizar el mensaje de no ciudades
                        } else if (data.errors) {
                            // Manejar errores de validación del servidor
                            const errorMessages = Object.values(data.errors).flat().join('\n');
                            Swal.fire('Error de Validación', errorMessages, 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error al agregar la ciudad:', error);
                        Swal.fire('Error', 'Ocurrió un error al intentar agregar la ciudad. ' + error.message, 'error');
                    });
                }
            });
        });

        // Event listener para el botón "Remove City"
        removeCityBtn.addEventListener('click', function() {
            if (selectedCityRow) {
                const cityId = selectedCityRow.dataset.cityId; // Obtener el ID de la base de datos
                const cityName = selectedCityRow.querySelector('td').dataset.cityName;

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: `¿Quieres eliminar la ciudad "${cityName}"?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33', // Rojo para eliminar
                    cancelButtonColor: '#3085d6', // Azul para cancelar
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Enviar solicitud AJAX para eliminar la ciudad
                        fetch(`/cities/${cityId}`, { // Usar el ID para la URL
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Token CSRF
                            }
                        })
                        .then(response => {
                            const contentType = response.headers.get("content-type");
                            if (contentType && contentType.indexOf("application/json") !== -1) {
                                return response.json();
                            } else {
                                return response.text().then(text => { throw new Error(text || "Respuesta no JSON del servidor"); });
                            }
                        })
                        .then(data => {
                            if (data.message) {
                                Swal.fire('¡Eliminada!', data.message, 'success');
                                // Eliminar la fila del DOM
                                selectedCityRow.remove();
                                selectedCityRow = null; // Limpiar la selección
                                updateNoCitiesRow(); // Actualizar el mensaje de no ciudades
                            } else if (data.errors) {
                                const errorMessages = Object.values(data.errors).flat().join('\n');
                                Swal.fire('Error', errorMessages, 'error');
                            }
                        })
                        .catch(error => {
                            console.error('Error al eliminar la ciudad:', error);
                            Swal.fire('Error', 'Ocurrió un error al intentar eliminar la ciudad. ' + error.message, 'error');
                        });
                    }
                });
            } else {
                Swal.fire({
                    icon: 'info',
                    title: 'Ninguna ciudad seleccionada',
                    text: 'Por favor, selecciona una ciudad de la lista para eliminarla.',
                    confirmButtonText: 'Entendido'
                });
            }
        });
    });

    // Script de SweetAlert2 para mensajes de éxito (Laravel session)
    // Esto es útil si rediriges con un mensaje en algún punto.
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: '¡Amazing!',
            text: '{{ session('success') }}',
            confirmButtonText: 'Accept'
        });
    @endif
</script>

</body>
</html>