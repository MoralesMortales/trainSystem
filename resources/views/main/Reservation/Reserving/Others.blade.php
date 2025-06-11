<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrainSystem - Others Reservation</title>
    @vite(['resources/css/app.css'])
    @vite(['resources/css/MyTrains.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    {{-- SweetAlert2 CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css">
</head>

<body>
    <div id="container" class="tw:min-h-screen tw:bg-cover tw:bg-center tw:bg-no-repeat tw:fixed tw:inset-0">
        <x-navbar />
        <div id="boxContainer" class="tw:h-full tw:w-full tw:flex tw:justify-center tw:items-center tw:pt-20">
            <div class="box tw:w-10/12 md:tw:w-8/12 tw:h-auto tw:min-h-[70vh] tw:bg-gray-200 tw:bg-opacity-80 tw:rounded-lg tw:p-6 tw:shadow-lg tw:flex tw:flex-col">

                {{-- FORMULARIO PRINCIPAL --}}
                {{-- CAMBIO CLAVE: Se define la acción y el método del formulario --}}
                <form id="reservationForm" action="{{ route('reservingMeAndOthersPost') }}" method="POST" class="tw:overflow-x-auto tw:flex-grow">
                @csrf
                    {{-- CAMBIO CLAVE: Se añade un input oculto para pasar travelData al controlador --}}
                    <input type="hidden" name="travelData" value="{{ json_encode($travelData) }}">

                    <div>
                        <table class="tw:min-w-full tw:bg-gray-300 tw:rounded-lg tw:shadow-md tw:overflow-hidden">
                            <thead class="tw:bg-gray-400 tw:text-gray-800 tw:uppercase tw:text-sm tw:leading-normal">
                                <tr>
                                    {{-- Encabezado dinámico para mostrar la información del viaje --}}
                                    <th colspan="7" class="tw:text-center tw:py-2 tw:text-xl">
                                        Travel: {{ $travelData['origin'] ?? 'Origin' }} to {{ $travelData['destiny'] ?? 'Destination' }} (Train ID: {{ $travelData['train_id'] ?? 'N/A' }}, Code: {{ $travelData['travelCode'] ?? 'N/A' }})
                                    </th>
                                </tr>
                            </thead>
                            <thead class="tw:bg-gray-400 tw:text-gray-800 tw:uppercase tw:text-sm tw:leading-normal">
                                <tr>
                                    <th class="tw:py-3 tw:px-6 tw:text-left">Fullname</th>
                                    <th class="tw:py-3 tw:px-6 tw:text-left">Gender</th>
                                    <th class="tw:py-3 tw:px-6 tw:text-left">Age</th>
                                    <th class="tw:py-3 tw:px-6 tw:text-left">Class</th>
                                    <th class="tw:py-3 tw:px-6 tw:text-left">Seat</th>
                                    <th class="tw:py-3 tw:px-6 tw:text-left">Seat Cost</th>
                                    <th class="tw:py-3 tw:px-6 tw:text-left">Delete</th>
                                </tr>
                            </thead>

                            <tbody id="personRowsContainer">
                                {{-- Primera fila (completamente editable y eliminable) --}}
                                <tr class="person-row">
                                    <td class="tw:text-center">
                                        {{-- Añadidas clases de Tailwind para consistencia visual --}}
                                        <input type="text" name="persons[0][fullname]" class="tw:w-48 tw:bg-white tw:border tw:border-gray-300 tw:rounded tw:py-2 tw:px-3">
                                    </td>
                                    <td class="tw:text-center">
                                        <select name="persons[0][gender]" class="tw:bg-white tw:border tw:border-gray-300 tw:rounded tw:py-2 tw:px-3">
                                            <option value="">Select</option>
                                            <option value="M">Masculine</option>
                                            <option value="F">Femenine</option>
                                            <option value="O">Other</option>
                                        </select>
                                    </td>
                                    <td class="tw:text-center">
                                        <input type="number" name="persons[0][age]" class="tw:w-16 tw:bg-white tw:border tw:border-gray-300 tw:rounded tw:py-2 tw:px-3" min="1" max="999" step="1" oninput="this.value = parseInt(this.value);">
                                    </td>
                                    <td class="tw:text-center">
                                        <select name="persons[0][class]" class="tw:bg-white tw:border tw:border-gray-300 tw:rounded tw:py-2 tw:px-3" onchange="updateAvailableSeats(this, 0)">
                                            <option value="">Select Class</option>
                                            <option value="Turist">Turist</option>
                                            <option value="Normal">Economic</option>
                                            <option value="VIP">VIP</option>
                                        </select>
                                    </td>
                                    <td class="tw:text-center">
                                        <select name="persons[0][seat]" class="seat-select tw:bg-white tw:border tw:border-gray-300 tw:rounded tw:py-2 tw:px-3" disabled>
                                            <option value="">Select class first</option>
                                        </select>
                                    </td>
                                    <td class="tw:text-center">
                                        <input type="text" name="persons[0][seat_cost]" class="tw:w-40 tw:bg-gray-100 tw:border tw:border-gray-300 tw:rounded tw:py-2 tw:px-3" placeholder="0.00" value="0.00" readonly>
                                    </td>
                                    <td class="tw:text-center">
                                        {{-- El botón de eliminar ahora estará visible en todas las filas --}}
                                        <button type="button" class="delete-row-btn tw:text-black tw:font-bold tw:py-2 tw:px-4 tw:rounded tw:inline-flex tw:items-center">
                                            <i class="fa-solid fa-trash" style="color: #000000;"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td colspan="7" class="tw:text-center">
                                        <button type="button" id="addAnotherPerson" class="tw:w-54 tw:h-13 tw:bg-green-200 tw:text-2xl tw:font-bold tw:rounded-lg hover:tw:bg-green-300 focus:tw:outline-none focus:tw:ring-2 focus:tw:ring-green-400 focus:tw:ring-opacity-75 tw:transition-colors tw:duration-200">
                                            Add Another
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="7" class="tw:text-right tw:py-2 tw:text-xl tw:font-bold">
                                        Total to pay:
                                        $<span id="totalCost">0.00</span>
                                    </th>
                                </tr>
                                <tr>
                                    <td colspan="7" class="tw:text-center">
                                        <div id="btnBottom" class="tw:flex tw:justify-center tw:items-center tw:pt-2 tw:pb-2 tw:w-full">
                                            <button type="submit" class="tw:w-54 tw:h-13 tw:bg-green-200 tw:text-2xl tw:font-bold tw:rounded-lg hover:tw:bg-green-300 focus:tw:outline-none focus:tw:ring-2 focus:tw:ring-green-400 focus:tw:ring-opacity-75 tw:transition-colors tw:duration-200">
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
    // SweetAlert2 para mensajes de sesión (si Laravel los envía)
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: '¡Amazing!',
            text: '{{ session('success') }}',
            confirmButtonText: 'Accept'
        });
    @endif

    // Función para mostrar errores con SweetAlert2
    function showError(title, text) {
        Swal.fire({
            icon: 'error',
            title: title,
            html: text,
            confirmButtonText: 'Entendido'
        });
    }

    // Definiciones de costos de asiento y asientos disponibles
    // Asegúrate de que $travelData se pasa a esta vista desde el controlador
    const seatCosts = {
        'Turist': parseFloat("{{ floatval($travelData['CostTurists'] ?? 0) }}"),
        'Normal': parseFloat("{{ floatval($travelData['CostNormal'] ?? 0) }}"),
        'VIP': parseFloat("{{ floatval($travelData['CostVIP'] ?? 0) }}")
    };

    // Asientos disponibles por clase (pasados desde el controlador)
    const availableSeats = @json($availableSeats ?? []);

    // REFERENCIAS GLOBALES DE ELEMENTOS
    let personRowsContainer;
    let totalCostSpan;
    let addAnotherBtn;
    let reservationForm;

    const MAX_ROWS = 4; // Límite de filas (1 inicial + 3 adicionales)
    let personIndex = 0; // Este será el índice de la *última* fila agregada

    document.addEventListener('DOMContentLoaded', function () {
        personRowsContainer = document.getElementById('personRowsContainer');
        totalCostSpan = document.getElementById('totalCost');
        addAnotherBtn = document.getElementById('addAnotherPerson');
        reservationForm = document.getElementById('reservationForm');

        // Inicializa personIndex para reflejar el número de filas existentes al cargar la página
        personIndex = personRowsContainer.children.length > 0 ? personRowsContainer.children.length - 1 : 0;


        // Función para actualizar los asientos disponibles cuando cambia la clase
        window.updateAvailableSeats = function(selectElement, rowIndex) {
            const row = selectElement.closest('tr');
            // Usamos el rowIndex para seleccionar el input/select con el nombre correcto
            const seatSelect = row.querySelector(`select[name="persons[${rowIndex}][seat]"]`);
            const seatCostInput = row.querySelector(`input[name="persons[${rowIndex}][seat_cost]"]`);
            const selectedClass = selectElement.value;

            seatSelect.disabled = !selectedClass;
            seatSelect.innerHTML = ''; // Limpiar opciones anteriores

            if (selectedClass) {
                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                
                const seats = availableSeats[selectedClass] || [];
                if (seats.length === 0) {
                    defaultOption.textContent = 'No available seats';
                    seatSelect.appendChild(defaultOption);
                    seatSelect.disabled = true;

                    Swal.fire({
                        icon: 'warning',
                        title: 'No availability',
                        text: `No seats available in ${selectedClass} class.`,
                        confirmButtonText: 'Understood'
                    });

                    // Resetear la selección de clase y costo
                    selectElement.value = '';
                    seatCostInput.value = '0.00';
                } else {
                    defaultOption.textContent = 'Select a seat';
                    seatSelect.appendChild(defaultOption);

                    // Agregar asientos disponibles
                    seats.forEach(seat => {
                        const option = document.createElement('option');
                        option.value = seat;
                        option.textContent = seat;
                        seatSelect.appendChild(option);
                    });

                    // Establecer el costo inicial si hay asientos disponibles
                    seatCostInput.value = (seatCosts[selectedClass] || 0).toFixed(2);
                }
            } else {
                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = 'Select class first';
                seatSelect.appendChild(defaultOption);
                seatCostInput.value = '0.00';
            }
            calculateTotalCost();
        };

        // Función para reindexar los nombres de los inputs en todas las filas
        function reindexRows() {
            Array.from(personRowsContainer.children).forEach((row, index) => {
                row.querySelectorAll('input, select').forEach(input => {
                    const currentName = input.getAttribute('name');
                    if (currentName) {
                        input.setAttribute('name', currentName.replace(/\[\d+\]/, '[' + index + ']'));
                    }
                });
                // Actualizar el onchange del select de clase con el nuevo índice
                const classSelect = row.querySelector('select[name$="[class]"]');
                if (classSelect) {
                    classSelect.setAttribute('onchange', `updateAvailableSeats(this, ${index})`);
                }
            });
            personIndex = personRowsContainer.children.length > 0 ? personRowsContainer.children.length - 1 : 0;
            updateAddButtonState();
            calculateTotalCost(); // Recalcular total después de reindexar (por si se eliminó una fila)
        }

        // Función para actualizar el estado del botón "Add Another"
        function updateAddButtonState() {
            if (personRowsContainer.children.length >= MAX_ROWS) {
                addAnotherBtn.disabled = true;
                addAnotherBtn.classList.add('tw:opacity-50', 'tw:cursor-not-allowed');
            } else {
                addAnotherBtn.disabled = false;
                addAnotherBtn.classList.remove('tw:opacity-50', 'tw:cursor-not-allowed');
            }
        }

        // Modificar la función calculateTotalCost para usar los precios dinámicos
        window.calculateTotalCost = function() {
            let currentTotal = 0;
            const personRows = personRowsContainer.querySelectorAll('.person-row');

            personRows.forEach(row => {
                const seatCostInput = row.querySelector('input[name$="[seat_cost]"]');
                const cost = parseFloat(seatCostInput.value) || 0; // Obtener el costo directamente del input
                currentTotal += cost;
            });
            totalCostSpan.textContent = currentTotal.toFixed(2);
        };

        // --- EVENT LISTENERS ---

        // Listener para "Agregar otro"
        addAnotherBtn.addEventListener('click', function() {
            if (personRowsContainer.children.length < MAX_ROWS) {
                const lastRow = personRowsContainer.lastElementChild;
                if (!lastRow) return; // Debería haber al menos una fila

                const newRow = lastRow.cloneNode(true); // Clonar la última fila
                personIndex++; // Incrementar índice para la nueva fila

                // Limpiar campos y actualizar nombres para la nueva fila
                newRow.querySelectorAll('input, select').forEach(input => {
                    const currentName = input.getAttribute('name');
                    if (currentName) {
                        input.setAttribute('name', currentName.replace(/\[\d+\]/, '[' + personIndex + ']'));
                    }
                    if (input.tagName === 'SELECT') {
                        input.value = ''; // Resetear select
                    } else if (!input.hasAttribute('readonly') && !input.disabled) {
                        input.value = ''; // Limpiar inputs editables
                    }
                    if (input.name.includes('[seat_cost]')) {
                        input.value = '0.00'; // Resetear costo de asiento
                        input.setAttribute('readonly', 'true');
                    } else {
                        input.removeAttribute('readonly');
                    }
                    // Asegurar que los campos no están deshabilitados por defecto en las nuevas filas
                    if (input.disabled) input.disabled = false;
                });

                // Re-adjuntar listener al select de clase en la nueva fila con el índice correcto
                const newClassSelect = newRow.querySelector('select[name$="[class]"]');
                if (newClassSelect) {
                    newClassSelect.setAttribute('onchange', `updateAvailableSeats(this, ${personIndex})`);
                }

                // Re-adjuntar listener al select de asiento en la nueva fila y deshabilitarlo
                const newSeatSelect = newRow.querySelector('select[name$="[seat]"]');
                if (newSeatSelect) {
                    newSeatSelect.innerHTML = '<option value="">Select class first</option>';
                    newSeatSelect.disabled = true;
                }

                // Re-adjuntar listener al botón de eliminar en la nueva fila
                const newDeleteButton = newRow.querySelector('.delete-row-btn');
                if (newDeleteButton) {
                    newDeleteButton.disabled = false;
                    newDeleteButton.classList.remove('tw:opacity-50', 'tw:cursor-not-allowed');
                    newDeleteButton.addEventListener('click', function() {
                        if (personRowsContainer.children.length > 1) { // Asegura que no se elimine la última fila
                            newRow.remove();
                            reindexRows(); // Reindexar después de eliminar una fila
                        } else {
                            Swal.fire({
                                icon: 'info',
                                title: '¡Attention!',
                                text: 'At least one person must be registered.',
                                confirmButtonText: 'Accept'
                            });
                        }
                    });
                }
                personRowsContainer.appendChild(newRow);
                updateAddButtonState();
                calculateTotalCost(); // Recalcular total
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Limit Reached!',
                    text: 'You cannot add more than ' + MAX_ROWS + ' people.',
                    confirmButtonText: 'Understood'
                });
            }
        });

        // Event listener para eliminar filas (delegación en el contenedor)
        personRowsContainer.addEventListener('click', function(event) {
            const target = event.target.closest('.delete-row-btn');
            if (target) { // No es necesario comprobar target.disabled ya que ya no lo ocultamos por CSS
                const rowToRemove = target.closest('.person-row');
                if (personRowsContainer.children.length > 1) { // Asegura que no se elimine la última fila
                    rowToRemove.remove();
                    reindexRows(); // Reindexar después de eliminar
                } else {
                    Swal.fire({
                        icon: 'info',
                        title: '¡Attention!',
                        text: 'At least one person must be registered.',
                        confirmButtonText: 'Accept'
                    });
                }
            }
        });

        // Event listener para el submit del formulario
        reservationForm.addEventListener('submit', function (event) {
            event.preventDefault(); // Detener el envío por defecto del formulario

            let isValid = true;
            const errors = [];
            
            // Validar cada fila de persona
            Array.from(personRowsContainer.children).forEach((row, index) => {
                const fullnameInput = row.querySelector(`input[name="persons[${index}][fullname]"]`);
                const genderSelect = row.querySelector(`select[name="persons[${index}][gender]"]`);
                const ageInput = row.querySelector(`input[name="persons[${index}][age]"]`);
                const classSelect = row.querySelector(`select[name="persons[${index}][class]"]`);
                const seatSelect = row.querySelector(`select[name="persons[${index}][seat]"]`);

                // Validación de Fullname
                if (!fullnameInput || fullnameInput.value.trim() === '') {
                    errors.push(`Person ${index + 1}: Full name cannot be empty.`);
                    isValid = false;
                } else if (!/^[a-zA-Z\s]+$/.test(fullnameInput.value)) {
                    errors.push(`Person ${index + 1}: Full name must only contain letters and spaces.`);
                    isValid = false;
                }

                // Validación de Género
                if (genderSelect.value === '') {
                    errors.push(`Person ${index + 1}: Gender must be selected.`);
                    isValid = false;
                }

                // Validación de Edad
                const age = parseInt(ageInput.value);
                if (isNaN(age) || age < 1 || age > 999) {
                    errors.push(`Person ${index + 1}: Age must be a positive integer up to 999.`);
                    isValid = false;
                }

                // Validación de Clase
                if (classSelect.value === '') {
                    errors.push(`Person ${index + 1}: Class must be selected.`);
                    isValid = false;
                }

                // Validación de Asiento
                if (seatSelect.value === '') {
                    errors.push(`Person ${index + 1}: Seat must be selected.`);
                    isValid = false;
                }
                // Si el asiento ya está seleccionado por otra persona en esta misma reserva (validación frontend)
                const selectedSeatsInThisSubmission = {};
                personRowsContainer.querySelectorAll('.person-row').forEach((r, idx) => {
                    const cls = r.querySelector(`select[name="persons[${idx}][class]"]`).value;
                    const seat = r.querySelector(`select[name="persons[${idx}][seat]"]`).value;
                    if (cls && seat) {
                        const key = `${cls}-${seat}`;
                        if (selectedSeatsInThisSubmission[key] && selectedSeatsInThisSubmission[key] !== idx) {
                            errors.push(`Person ${idx + 1}: Seat "${seat}" in class "${cls}" is already selected by another person in this reservation.`);
                            isValid = false;
                        } else {
                            selectedSeatsInThisSubmission[key] = idx;
                        }
                    }
                });

            }); // Fin del forEach para validación de filas

            if (!isValid) {
                showError('Validation Errors', errors.map(error => `<li>${error}</li>`).join(''));
                return;
            }

            // Si todas las validaciones pasan, enviar el formulario
            reservationForm.submit();
        });

        // Inicializar al cargar la página:
        // Asegurar que el input de edad inicial tiene un valor de 1 si está vacío
        const initialAgeInput = document.querySelector('input[name="persons[0][age]"]');
        if (initialAgeInput && (initialAgeInput.value === '' || parseFloat(initialAgeInput.value) <= 0)) {
            initialAgeInput.value = 1;
        }

        // Llamar a reindexRows y calculateTotalCost al inicio para asegurar el estado correcto
        reindexRows(); // Reindexar y actualizar el botón "Add Another" y onchange attributes
        calculateTotalCost(); // Calcular el total inicial

        // Inicializar los select de asientos para las filas existentes (solo la primera que viene precargada)
        const initialClassSelect = document.querySelector('select[name="persons[0][class]"]');
        if (initialClassSelect && initialClassSelect.value) {
            updateAvailableSeats(initialClassSelect, 0);
        }
    });
</script>

</body>
</html>
