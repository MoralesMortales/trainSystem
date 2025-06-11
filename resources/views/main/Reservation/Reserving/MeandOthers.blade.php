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
            <div class="box tw:w-10/12 md:tw:w-8/12 tw:h-auto tw:min-h-[70vh] tw:bg-gray-200 tw:bg-opacity-80 tw:rounded-lg tw:p-6 tw:shadow-lg tw:flex tw:flex-col">

                <form id="reservationForm" action="{{ route('reservingMeAndOthersPost') }}" class="tw:overflow-x-auto tw:flex-grow" method="post">
                @csrf
                    <div>
                        <table class="tw:min-w-full tw:bg-gray-300 tw:rounded-lg tw:shadow-md tw:overflow-hidden" name="Tabla de Reservas">
                            <thead class="tw:bg-gray-400 tw:text-gray-800 tw:uppercase tw:text-sm tw:leading-normal">
                                <tr>
                                    <th colspan="7" class="tw:text-center tw:py-2 tw:text-xl"> </th>
                                </tr>
                            </thead>
                            <thead class="tw:bg-gray-400 tw:text-gray-800 tw:uppercase tw:text-sm tw:leading-normal" name="Datos de la persona">
                                <tr>
                                    <th class="tw:py-3 tw:px-6 tw:text-left">Fullname</th>
                                                                <input type="hidden" name="travelData" value="{{ json_encode($travelData) }}">

                                    <th class="tw:py-3 tw:px-6 tw:text-left">Gender</th>
                                    <th class="tw:py-3 tw:px-6 tw:text-left">Age</th>
                                    <th class="tw:py-3 tw:px-6 tw:text-left">Class</th>
                                    <th class="tw:py-3 tw:px-6 tw:text-left">Seat</th>
                                    <th class="tw:py-3 tw:px-6 tw:text-left">Seat Cost</th>
                                    <th class="tw:py-3 tw:px-6 tw:text-left">Delete</th>
                                </tr>
                            </thead>

                            <tbody id="personRowsContainer">
                                <tr class="person-row">
                                    <td class="tw:text-center">
                                        <input type="text" name="persons[0][fullname]" class="tw:w-48" value="{{ $DataReserve['Reserva'] ?? '' }}" readonly>
                                    </td>
                                    <td class="tw:text-center">
                                        <select name="persons[0][gender]" {{ isset($DataReserve['Gender']) ? 'disabled' : '' }}>
                                            <option value="">Seleccione</option>
                                            <option value="M" {{ ($DataReserve['Gender'] ?? '') == 'M' ? 'selected' : '' }}>Masculino</option>
                                            <option value="F" {{ ($DataReserve['Gender'] ?? '') == 'F' ? 'selected' : '' }}>Femenino</option>
                                            <option value="O" {{ ($DataReserve['Gender'] ?? '') == 'O' ? 'selected' : '' }}>Otro</option>
                                        </select>
                                        {{-- Si el select está deshabilitado por Blade, enviamos el valor con un input hidden --}}
                                        @if(isset($DataReserve['Gender']))
                                        <input type="hidden" name="persons[0][gender]" value="{{ $DataReserve['Gender'] }}">
                                        @endif
                                    </td>
                                    <td class="tw:text-center">
                                        <input type="number" name="persons[0][age]" class="tw:w-16" min="1" max="999" step="1" oninput="this.value = parseInt(this.value);" value="{{ $DataReserve['Age'] ?? '' }}" readonly>
                                    </td>
                                    <td class="tw:text-center">
                                        <select name="persons[0][class]" onchange="updateAvailableSeats(this)">
                                            <option value="">Seleccione</option>
                                            <option value="Turist">Turist</option>
                                            <option value="Normal">Economic</option>
                                            <option value="VIP">VIP</option>
                                        </select>
                                    </td>
                                    <td class="tw:text-center">
                                        <select name="persons[0][seat]" class="seat-select" disabled>
                                            <option value="">Seleccione clase primero</option>
                                        </select>
                                    </td>
                                    <td class="tw:text-center">
                                        <input type="text" name="persons[0][seat_cost]" class="tw:w-40" placeholder="0" readonly>
                                    </td>
                                    <td class="tw:text-center">
                                        <button type="button" class="delete-row-btn tw:text-black tw:font-bold tw:py-2 tw:px-4 tw:rounded tw:inline-flex tw:items-center" disabled>
                                            <i class="fa-solid fa-trash" style="color: #000000;"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td colspan="7" class="tw:text-center">
                                        <button type="button" id="addAnotherPerson" class="tw:w-54 tw:h-13 tw:bg-green-200 tw:text-2xl tw:font-bold tw:rounded-lg hover:tw:bg-green-300">
                                            Agregar otro
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="7" class="tw:text-right tw:py-2 tw:text-xl tw:font-bold">
                                        Total a pagar:
                                        $<span id="totalCost">0.00</span>
                                    </th>
                                </tr>
                                <tr>
                                    <td colspan="7" class="tw:text-center">
                                        <div id="btnBottom" class="tw:flex tw:justify-center tw:items-center tw:pt-2 tw:pb-2 tw:w-full">
                                            <button type="submit" class="tw:w-54 tw:h-13 tw:bg-green-200 tw:text-2xl tw:font-bold tw:rounded-lg hover:tw:bg-green-300">
                                                Confirm
                                            </button>
                                        </div>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Definición de costos de asientos (desde Blade)
        const seatCosts = {
            'Turist': parseFloat("{{ $travelData['CostTurists'] ?? 0 }}"),
            'Normal': parseFloat("{{ $travelData['CostNormal'] ?? 0 }}"),
            'VIP': parseFloat("{{ $travelData['CostVIP'] ?? 0 }}")
        };

        // Asientos disponibles por clase (desde Blade)
        const availableSeats = @json($availableSeats ?? []);

        // Función para actualizar asientos disponibles y costos
        function updateAvailableSeats(selectElement) {
            const row = selectElement.closest('tr');
            const seatSelect = row.querySelector('select[name$="[seat]"]');
            const seatCostInput = row.querySelector('input[name$="[seat_cost]"]');
            const selectedClass = selectElement.value;

            seatSelect.disabled = !selectedClass; // Deshabilita el select de asiento si no hay clase seleccionada
            seatSelect.innerHTML = ''; // Limpia opciones anteriores

            if (selectedClass) {
                const defaultOption = document.createElement('option');
                defaultOption.value = '';

                const seats = availableSeats[selectedClass] || [];
                if (seats.length === 0) {
                    defaultOption.textContent = 'No hay asientos disponibles';
                    seatSelect.appendChild(defaultOption);
                    seatSelect.disabled = true;

                    Swal.fire({
                        icon: 'warning',
                        title: 'No hay disponibilidad',
                        text: `No hay asientos disponibles en clase ${selectedClass}`,
                        confirmButtonText: 'Entendido'
                    });

                    selectElement.value = ''; // Resetear la selección de clase
                    seatCostInput.value = '0.00'; // Asegúrate de que sea string '0.00'
                } else {
                    defaultOption.textContent = 'Seleccione un asiento';
                    seatSelect.appendChild(defaultOption);

                    seats.forEach(seat => {
                        const option = document.createElement('option');
                        option.value = seat;
                        option.textContent = seat;
                        seatSelect.appendChild(option);
                    });

                    seatCostInput.value = seatCosts[selectedClass].toFixed(2);
                }
            } else {
                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = 'Seleccione clase primero';
                seatSelect.appendChild(defaultOption);
                seatCostInput.value = '0.00'; // Asegúrate de que sea string '0.00'
            }
            calculateTotalCost();
        }

        // Función para calcular el costo total
        function calculateTotalCost() {
            let currentTotal = 0;
            const personRows = document.querySelectorAll('.person-row');

            personRows.forEach(row => {
                const classSelect = row.querySelector('select[name$="[class]"]');
                const seatCostInput = row.querySelector('input[name$="[seat_cost]"]');
                const selectedClass = classSelect ? classSelect.value : ''; // Asegura que classSelect exista

                if (selectedClass) {
                    const cost = seatCosts[selectedClass] || 0;
                    seatCostInput.value = cost.toFixed(2);
                    currentTotal += cost;
                } else {
                    seatCostInput.value = '0.00'; // Resetear costo si la clase no está seleccionada
                }
            });

            document.getElementById('totalCost').textContent = currentTotal.toFixed(2);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const addAnotherBtn = document.getElementById('addAnotherPerson');
            const personRowsContainer = document.getElementById('personRowsContainer');
            const MAX_ROWS = 4; // Límite de filas (1 inicial + 3 adicionales)
            let personIndex = personRowsContainer.children.length - 1; // Inicializa personIndex

            // Función para actualizar el estado del botón "Agregar otro"
            function updateAddButtonState() {
                if (personRowsContainer.children.length >= MAX_ROWS) {
                    addAnotherBtn.disabled = true;
                    addAnotherBtn.classList.add('tw:opacity-50', 'tw:cursor-not-allowed');
                } else {
                    addAnotherBtn.disabled = false;
                    addAnotherBtn.classList.remove('tw:opacity-50', 'tw:cursor-not-allowed');
                }
            }

            // Función para reindexar los nombres de los inputs en todas las filas
            function reindexRows() {
                Array.from(personRowsContainer.children).forEach((row, index) => {
                    row.querySelectorAll('input, select').forEach(input => {
                        const currentName = input.getAttribute('name');
                        if (currentName) {
                            input.setAttribute('name', currentName.replace(/\[\d+\]/, '[' + index + ']'));
                        }
                    });

                    // Deshabilitar botón de eliminar en la primera fila si solo hay una
                    const deleteButton = row.querySelector('.delete-row-btn');
                    if (deleteButton) {
                        if (personRowsContainer.children.length === 1 && index === 0) {
                            deleteButton.disabled = true;
                            deleteButton.classList.add('tw:opacity-50', 'tw:cursor-not-allowed');
                        } else {
                            deleteButton.disabled = false;
                            deleteButton.classList.remove('tw:opacity-50', 'tw:cursor-not-allowed');
                        }
                    }
                });
                personIndex = personRowsContainer.children.length > 0 ? personRowsContainer.children.length - 1 : 0;
                updateAddButtonState();
            }

            // Llamar al inicio para establecer el estado inicial del botón "Agregar otro" y el botón de eliminar
            updateAddButtonState();
            reindexRows(); // Para asegurar que el botón de eliminar de la primera fila esté deshabilitado si aplica.

            addAnotherBtn.addEventListener('click', function() {
                if (personRowsContainer.children.length < MAX_ROWS) {
                    personIndex++; // Incrementa el índice para la nueva persona
                    const originalRow = personRowsContainer.lastElementChild;
                    if (!originalRow) return;

                    const newRow = originalRow.cloneNode(true);

                    // Limpiar y configurar campos de la nueva fila
                    newRow.querySelectorAll('input, select').forEach(input => {
                        const currentName = input.getAttribute('name');
                        if (currentName) {
                            input.setAttribute('name', currentName.replace(/\[\d+\]/, '[' + personIndex + ']'));
                        }

                        // Resetear valores de los campos
                        if (input.tagName === 'SELECT') {
                            input.selectedIndex = 0; // Selecciona la primera opción (vacía o por defecto)
                        } else {
                            input.value = ''; // Limpiar el valor del input
                        }

                        // Habilitar campos que deben ser editables en las filas adicionales
                        // Estos campos son fullname, gender y age en las nuevas filas
                        if (input.name.includes('[fullname]') || input.name.includes('[gender]') || input.name.includes('[age]')) {
                            input.readOnly = false; // Asegurarse de que no sea readonly
                            input.disabled = false; // Asegurarse de que no sea disabled
                        } else if (input.name.includes('[class]')) {
                            input.disabled = false;
                        } else if (input.name.includes('[seat]')) {
                            input.disabled = true; // El campo de asiento debe estar deshabilitado hasta seleccionar la clase
                            input.innerHTML = '<option value="">Seleccione clase primero</option>'; // Restablecer opciones de asiento
                        } else if (input.name.includes('[seat_cost]')) {
                            input.value = '0.00'; // Costo inicial
                            input.readOnly = true; // Asegurar que sea readonly
                        }

                        // Remover el input hidden para gender si existe en la nueva fila
                        if (input.name.includes('[gender]') && input.type === 'hidden') {
                            input.remove();
                        }
                    });

                    // Habilitar el botón de eliminar en la nueva fila
                    const newDeleteButton = newRow.querySelector('.delete-row-btn');
                    if (newDeleteButton) {
                        newDeleteButton.disabled = false;
                        newDeleteButton.classList.remove('tw:opacity-50', 'tw:cursor-not-allowed');
                        newDeleteButton.addEventListener('click', function() {
                            if (personRowsContainer.children.length > 1) {
                                newRow.remove();
                                reindexRows();
                                calculateTotalCost();
                            } else {
                                Swal.fire({
                                    icon: 'info',
                                    title: '¡Atención!',
                                    text: 'Debe haber al menos una persona registrada.',
                                    confirmButtonText: 'Aceptar'
                                });
                            }
                        });
                    }

                    personRowsContainer.appendChild(newRow);
                    updateAddButtonState();
                    calculateTotalCost();
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: '¡Límite alcanzado!',
                        text: 'No puedes agregar más de ' + MAX_ROWS + ' personas.',
                        confirmButtonText: 'Entendido'
                    });
                }
            });

            // Añadir event listeners a los botones de "Delete" existentes al cargar la página
            // Esto solo para la primera fila si tuviera que eliminarse por alguna razón (y si no hay una sola fila)
            personRowsContainer.querySelectorAll('.delete-row-btn').forEach(button => {
                button.addEventListener('click', function() {
                    if (personRowsContainer.children.length > 1) {
                        button.closest('.person-row').remove();
                        reindexRows();
                        calculateTotalCost();
                    } else {
                        Swal.fire({
                            icon: 'info',
                            title: '¡Atención!',
                            text: 'Debe haber al menos una persona registrada.',
                            confirmButtonText: 'Aceptar'
                        });
                    }
                });
            });

            // Delegación de eventos para inputs y selects para validación en tiempo real y lógica
            personRowsContainer.addEventListener('input', function(event) {
                const target = event.target;
                if (target.matches('input[name$="[age]"]')) {
                    let value = target.value;
                    if (value < 0) {
                        target.value = Math.abs(value);
                    }
                    if (value.includes('.')) {
                        target.value = parseInt(value);
                    }
                    if (target.value.length > 3) {
                        target.value = target.value.slice(0, 3);
                    }
                } else if (target.matches('input[name$="[seat]"]')) {
                    // Si el asiento es un input de texto para un valor manual
                    let value = target.value;
                    if (value < 0) {
                        target.value = Math.abs(value);
                    }
                    if (value.includes('.')) {
                        target.value = parseInt(value);
                    }
                    if (target.value.length > 3) {
                        target.value = target.value.slice(0, 3);
                    }
                } else if (target.matches('input[name$="[fullname]"]')) {
                    // Permitir solo letras y espacios
                    target.value = target.value.replace(/[^a-zA-Z\s]/g, '');
                }
            });

            personRowsContainer.addEventListener('change', function(event) {
                const target = event.target;
                if (target.matches('select[name$="[class]"]')) {
                    updateAvailableSeats(target);
                }
            });

            // Validar formulario antes de enviar (client-side)
            const reservationForm = document.getElementById('reservationForm');
            reservationForm.addEventListener('submit', function (event) {
                event.preventDefault(); // Detener el envío por defecto del formulario
                let allValid = true;
                const errors = [];

                const personRows = personRowsContainer.querySelectorAll('.person-row');
                personRows.forEach((row, index) => {
                    const fullnameInput = row.querySelector('input[name$="[fullname]"]');
                    const genderSelect = row.querySelector('select[name$="[gender]"]');
                    const ageInput = row.querySelector('input[name$="[age]"]');
                    const classSelect = row.querySelector('select[name$="[class]"]');
                    const seatSelect = row.querySelector('select[name$="[seat]"]');
                      if (seatSelect && (seatSelect.value === "0" || seatSelect.value === "")) {
            errors.push(`El asiento de la persona ${index + 1} no puede ser 0 y debe ser seleccionado.`);
            allValid = false;
        }

                    // Validación de fullname
                    if (!fullnameInput.value.trim()) {
                        errors.push(`El nombre completo de la persona ${index + 1} es requerido.`);
                        allValid = false;
                    }

                    // Validación de gender
                    if (!genderSelect.value) {
                        errors.push(`El género de la persona ${index + 1} es requerido.`);
                        allValid = false;
                    }

                    // Validación de age
                    if (!ageInput.value || parseInt(ageInput.value) <= 0) {
                        errors.push(`La edad de la persona ${index + 1} debe ser un número positivo.`);
                        allValid = false;
                    }

                    // Validación de class
                    if (!classSelect.value) {
                        errors.push(`La clase de la persona ${index + 1} es requerida.`);
                        allValid = false;
                    }

                    // Validación de seat
                    if (!seatSelect.value && !seatSelect.disabled) { // Solo si no está deshabilitado
                        errors.push(`El asiento de la persona ${index + 1} es requerido.`);
                        allValid = false;
                    }
                });

                if (allValid) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Amazing!',
                        text: 'Todos los datos son válidos. Enviando formulario...',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        reservationForm.submit(); // Enviar el formulario si todo es válido
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: '¡Errores de validación!',
                        html: 'Por favor, corrige los siguientes errores:<br>' + errors.map(e => `- ${e}`).join('<br>'),
                        confirmButtonText: 'Entendido'
                    });
                }
            });

            // Inicializar el costo total al cargar la página
            calculateTotalCost();
        });

        // SweetAlert2 para mensajes de sesión
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: '¡Amazing!',
                text: '{{ session('success') }}',
                confirmButtonText: 'Accept'
            });
        @endif
    </script>

    <style>
        /* Oculta y deshabilita el botón de borrar de la primera fila */
        .person-row:first-child .delete-row-btn {
            opacity: 0.5;
            cursor: not-allowed;
        }
        /* Estilos para campos de solo lectura/deshabilitados */
        input[readonly], select[disabled] {
            background-color: #e2e8f0; /* un gris más claro para que se vea deshabilitado */
            cursor: not-allowed;
        }
    </style>
</body>
</html>
