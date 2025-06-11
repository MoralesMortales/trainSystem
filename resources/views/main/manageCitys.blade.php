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
                    <div class="tw:w-48 tw:p-4 tw:bg-white tw:rounded-lg tw:shadow-md tw:overflow-hidden">
                        <table class="tw:min-w-full">
                            <tbody id="cityListContainer" class="tw:block tw:max-h-[300px] tw:overflow-y-auto">
                                <tr class="city-row tw:border-b tw:border-gray-200 last:tw:border-b-0">
                                    <td class="tw:p-3 tw:text-lg tw:cursor-pointer hover:tw:bg-gray-100" data-city-name="Barcelona">Barcelona</td>
                                </tr>
                                <tr class="city-row tw:border-b tw:border-gray-200 last:tw:border-b-0">
                                    <td class="tw:p-3 tw:text-lg tw:cursor-pointer hover:tw:bg-gray-100" data-city-name="Lecheria">Lecheria</td>
                                </tr>
                                <tr class="city-row tw:border-b tw:border-gray-200 last:tw:border-b-0">
                                    <td class="tw:p-3 tw:text-lg tw:cursor-pointer hover:tw:bg-gray-100" data-city-name="Caracas">Caracas</td>
                                </tr>

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
        let selectedCityRow = null; // Para mantener la referencia a la fila seleccionada

        // Función para agregar una nueva ciudad a la lista
        function addCityToList(cityName) {
            const newRow = document.createElement('tr');
            newRow.classList.add('city-row', 'tw:border-b', 'tw:border-gray-200', 'last:tw:border-b-0');
            newRow.innerHTML = `<td class="tw:p-3 tw:text-lg tw:cursor-pointer hover:tw:bg-gray-100" data-city-name="${cityName}">${cityName}</td>`;
            cityListContainer.appendChild(newRow);
            // Hacer scroll al final de la lista para ver la nueva ciudad
            cityListContainer.scrollTop = cityListContainer.scrollHeight;
            attachCityRowClickListener(newRow); // Adjuntar listener a la nueva fila
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
                    // Verificar si la ciudad ya existe (insensible a mayúsculas y minúsculas)
                    const existingCities = Array.from(cityListContainer.querySelectorAll('.city-row td')).map(td => td.dataset.cityName.toLowerCase());
                    if (existingCities.includes(value.toLowerCase())) {
                        return 'Esta ciudad ya existe en la lista.';
                    }
                    return null; // No hay errores
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    addCityToList(result.value);
                    Swal.fire('¡Agregada!', `La ciudad "${result.value}" ha sido agregada.`, 'success');
                }
            });
        });

        // Event listener para el botón "Remove City"
        removeCityBtn.addEventListener('click', function() {
            if (selectedCityRow) {
                const cityName = selectedCityRow.querySelector('td').dataset.cityName;
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: `¿Quieres eliminar la ciudad "${cityName}"?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        selectedCityRow.remove();
                        selectedCityRow = null; // Limpiar la selección
                        Swal.fire(
                            '¡Eliminada!',
                            `La ciudad "${cityName}" ha sido eliminada.`,
                            'success'
                        );
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