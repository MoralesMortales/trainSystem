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

                <form id="reservationForm" {{ route('reservingMeAndOthersPost') }} class="tw:overflow-x-auto tw:flex-grow" method="post">
                @csrf
                    <div>
                        <table class="tw:min-w-full tw:bg-gray-300 tw:rounded-lg tw:shadow-md tw:overflow-hidden" name="Tabla de Reservas">
                            <thead class="tw:bg-gray-400 tw:text-gray-800 tw:uppercase tw:text-sm tw:leading-normal">
                                <tr>
                                    <th colspan="7" class="tw:text-center tw:py-2 tw:text-xl">Ohio - Train (A113) </th>
                                </tr>
                            </thead>
                            <thead class="tw:bg-gray-400 tw:text-gray-800 tw:uppercase tw:text-sm tw:leading-normal" name="Datos de la persona">
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
                                <tr class="person-row">
                                    <td class="tw:text-center">
                                        <input type="text" name="persons[0][fullname]" class="tw:w-48" value="{{ $DataReserve['Reserva'] }}" readonly>
                                    </td>
                                    <td class="tw:text-center">
                                        <select name="persons[0][gender]" disabled>
                                            <option value=""></option>
                                            <option value="M" {{ ($DataReserve['Gender'] ?? '') == 'M' ? 'selected' : '' }}>Masculino</option>
                                            <option value="F" {{ ($DataReserve['Gender'] ?? '') == 'F' ? 'selected' : '' }}>Femenino</option>
                                            <option value="O" {{ ($DataReserve['Gender'] ?? '') == 'O' ? 'selected' : '' }}>Otro</option>
                                        </select>
                                        <input type="hidden" name="persons[0][gender]" value="{{ $DataReserve['Gender'] ?? '' }}">
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
                                        <button type="button" class="delete-row-btn tw:text-black tw:font-bold tw:py-2 tw:px-4 tw:rounded tw:inline-flex tw:items-center">
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

const seatCosts = {
    'Turist': parseFloat("{{ $travelData['CostTurists'] ?? 0 }}"),
    'Normal': parseFloat("{{ $travelData['CostNormal'] ?? 0 }}"),
    'VIP': parseFloat("{{ $travelData['CostVIP'] ?? 0 }}")
};

// Asientos disponibles por clase
const availableSeats = @json($availableSeats ?? []);

// Actualizar asientos disponibles cuando cambia la clase
function updateAvailableSeats(selectElement) {
    const row = selectElement.closest('tr');
    const seatSelect = row.querySelector('select[name$="[seat]"]');
    const seatCostInput = row.querySelector('input[name$="[seat_cost]"]');
    const selectedClass = selectElement.value;

    // Habilitar/deshabilitar selector de asientos
    seatSelect.disabled = !selectedClass;

    // Limpiar opciones anteriores
    seatSelect.innerHTML = '';

    if (selectedClass) {
        // Agregar opción por defecto
        const defaultOption = document.createElement('option');
        defaultOption.value = '';

        // Verificar si hay asientos disponibles
        const seats = availableSeats[selectedClass] || [];
        if (seats.length === 0) {
            defaultOption.textContent = 'No hay asientos disponibles';
            seatSelect.appendChild(defaultOption);
            seatSelect.disabled = true;

            // Mostrar alerta al usuario
            Swal.fire({
                icon: 'warning',
                title: 'No hay disponibilidad',
                text: `No hay asientos disponibles en clase ${selectedClass}`,
                confirmButtonText: 'Entendido'
            });

            // Resetear la selección de clase
            selectElement.value = '';
            seatCostInput.value = '0';
        } else {
            defaultOption.textContent = 'Seleccione un asiento';
            seatSelect.appendChild(defaultOption);

            // Agregar asientos disponibles
            seats.forEach(seat => {
                const option = document.createElement('option');
                option.value = seat;
                option.textContent = seat;
                seatSelect.appendChild(option);
            });

            // Actualizar costo
            seatCostInput.value = seatCosts[selectedClass].toFixed(2);
        }
    } else {
        const defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.textContent = 'Seleccione clase primero';
        seatSelect.appendChild(defaultOption);
        seatCostInput.value = '0';
    }

    calculateTotalCost();
}

// Modificar la función calculateTotalCost para usar los precios dinámicos
function calculateTotalCost() {
    let currentTotal = 0;
    const personRows = personRowsContainer.querySelectorAll('.person-row');

    personRows.forEach(row => {
        const classSelect = row.querySelector('select[name$="[class]"]');
        const seatCostInput = row.querySelector('input[name$="[seat_cost]"]');
        const selectedClass = classSelect.value;

        if (selectedClass) {
            const cost = seatCosts[selectedClass] || 0;
            seatCostInput.value = cost.toFixed(2);
            currentTotal += cost;
        }
    });

    totalCostSpan.textContent = currentTotal.toFixed(2);
}

    document.addEventListener('DOMContentLoaded', function () {
        const reservationForm = document.getElementById('reservationForm');
        const personRowsContainer = document.getElementById('personRowsContainer');
        const totalCostSpan = document.getElementById('totalCost');
        // Precios de ejemplo por clase
        const seatCosts = {
            'Turist': 50.00,
            'Normal': 80.00,
            'VIP': 120.00
        };
        function calculateTotalCost() {
            let currentTotal = 0;
            const personRows = personRowsContainer.querySelectorAll('.person-row');
            personRows.forEach(row => {
                const classSelect = row.querySelector('select[name$="[class]"]');
                const seatCostInput = row.querySelector('input[name$="[seat_cost]"]');

                const selectedClass = classSelect.value;
                const cost = seatCosts[selectedClass] || 0;
                seatCostInput.value = cost.toFixed(2); // Muestra el costo individual del asiento
                currentTotal += cost;
            });
            totalCostSpan.textContent = currentTotal.toFixed(2);
        }
        // Delegación de eventos para inputs y selects dentro de personRowsContainer
        personRowsContainer.addEventListener('input', function(event) {
            const target = event.target;
            if (target.matches('input[name$="[age]"]')) {
                // Validar edad: no negativos/decimales, máximo 3 dígitos
                let value = target.value;
                if (value < 0) {
                    target.value = Math.abs(value); // Convertir a positivo
                }
                if (value.includes('.')) {
                    target.value = parseInt(value); // Eliminar decimales
                }
                if (target.value.length > 3) {
                    target.value = target.value.slice(0, 3); // Limitar a 3 dígitos
                }
            } else if (target.matches('input[name$="[seat]"]')) {
                // Validar asiento: no negativos/decimales, máximo 3 dígitos
                let value = target.value;
                if (value < 0) {
                    target.value = Math.abs(value); // Convertir a positivo
                }
                if (value.includes('.')) {
                    target.value = parseInt(value); // Eliminar decimales
                }
                if (target.value.length > 3) {
                    target.value = target.value.slice(0, 3); // Limitar a 3 dígitos
                }
            } else if (target.matches('input[name$="[fullname]"]')) {
                // Validar fullname: solo letras y espacios
                target.value = target.value.replace(/[^a-zA-Z\s]/g, '');
            }
        });
        personRowsContainer.addEventListener('change', function(event) {
            const target = event.target;
            if (target.matches('select[name$="[class]"]')) {
                calculateTotalCost(); // Recalcular costo al cambiar la clase
            }
        });
        // Inicializar el costo al cargar la página para la fila existente
        calculateTotalCost();
        // Manejo del envío del formulario
        reservationForm.addEventListener('submit', function (event) {
            event.preventDefault(); // Detener el envío por defecto del formulario
            let isValid = true;
            const errors = [];
            const currentRow = personRowsContainer.querySelector('.person-row'); // Solo una fila
            const fullnameInput = currentRow.querySelector('input[name$="[fullname]"]');
            const genderSelect = currentRow.querySelector('select[name$="[gender]"]');
            const ageInput = currentRow.querySelector('input[name$="[age]"]');
            const classSelect = currentRow.querySelector('select[name$="[class]"]');
            const seatInput = currentRow.querySelector('input[name$="[seat]"]');
            // Validación de Fullname
            if (fullnameInput.value.trim() === '') {
                isValid = false;
                errors.push('El nombre completo no puede estar vacío.');
            } else if (!/^[a-zA-Z\s]+$/.test(fullnameInput.value)) {
                isValid = false;
                errors.push('El nombre completo solo debe contener letras y espacios.');
            }
            // Validación de Género
            if (genderSelect.value === '') {
                isValid = false;
                errors.push('Debe seleccionar un género.');
            }
            // Validación de Edad
            const age = parseInt(ageInput.value);
            if (isNaN(age) || age < 1 || age > 999) { // Limite de 3 dígitos
                isValid = false;
                errors.push('La edad debe ser un número entero positivo, sin decimales, y tener máximo 3 dígitos.');
            }
            // Validación de Clase
            if (classSelect.value === '') {
                isValid = false;
                errors.push('Debe seleccionar una clase.');
            }
            // Validación de Asiento
            const seat = parseInt(seatInput.value);
            if (isNaN(seat) || seat < 1 || seat > 999) { // Limite de 3 dígitos
                isValid = false;
                errors.push('El número de asiento debe ser un número entero positivo, sin decimales, y tener máximo 3 dígitos.');
            }
            if (isValid) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Reserva Confirmada!',
                    text: 'Tu reserva ha sido procesada exitosamente.',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    // Redirigir a la página de mis reservas
                    window.location.href = 'http://localhost:8000/menu/myreservation';
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Errores de Validación',
                    html: errors.map(error => `<li>${error}</li>`).join(''),
                    confirmButtonText: 'Corregir'
                });
            }
        });
        // Código para los botones "Agregar otro" y "Eliminar último"
        // Se deshabilitan porque la petición es para una sola persona.
        document.getElementById('addPersonBtn').addEventListener('click', function() {
            Swal.fire({
                icon: 'info',
                title: 'Funcionalidad Deshabilitada',
                text: 'Esta página está diseñada para una sola reserva. No se pueden agregar más personas.',
                confirmButtonText: 'Entendido'
            });
        });
        document.getElementById('removePersonBtn').addEventListener('click', function() {
            Swal.fire({
                icon: 'info',
                title: 'Funcionalidad Deshabilitada',
                text: 'Esta página está diseñada para una sola reserva. No se pueden eliminar personas.',
                confirmButtonText: 'Entendido'
            });
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addAnotherBtn = document.getElementById('addAnotherPerson');
        const personRowsContainer = document.getElementById('personRowsContainer');
        const MAX_ROWS = 4; // Límite de filas (1 inicial + 3 adicionales)
        let personIndex = 0;
        // Inicializa personIndex si ya hay filas precargadas
        if (personRowsContainer.children.length > 0) {
            personIndex = personRowsContainer.children.length - 1;
        }
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
            });
            // Actualizar personIndex para que siempre refleje el último índice disponible
            personIndex = personRowsContainer.children.length > 0 ? personRowsContainer.children.length - 1 : 0;
            updateAddButtonState(); // Actualizar el estado del botón después de reindexar
        }
        // Llamar al inicio para establecer el estado inicial del botón "Agregar otro"
        updateAddButtonState();
        addAnotherBtn.addEventListener('click', function() {
            if (personRowsContainer.children.length < MAX_ROWS) {
                personIndex++; // Incrementa el índice para la nueva persona
                const originalRow = personRowsContainer.lastElementChild;
                if (!originalRow) return;
                const newRow = originalRow.cloneNode(true);
                newRow.querySelectorAll('input, select').forEach(input => {
                    // Solo limpiar los campos editables (no los de la primera fila)
                    if (!input.hasAttribute('readonly') && !input.disabled) {
                        input.value = (input.tagName === 'SELECT' ? input.options[0].value : '');
                    }
                    const currentName = input.getAttribute('name');
                    if (currentName) {
                        input.setAttribute('name', currentName.replace(/\[\d+\]/, '[' + personIndex + ']'));
                    }
                    if (input.name.includes('[seat_cost]')) {
                        input.setAttribute('readonly', 'true');
                    } else {
                        input.removeAttribute('readonly');
                    }
                });
                // Habilitar los campos en la nueva fila (excepto seat_cost)
                newRow.querySelectorAll('input:not([name$="[seat_cost]"]), select').forEach(input => {
                    if (input.disabled) input.disabled = false;
                    if (input.readOnly) input.readOnly = false;
                });
                // Reasigna el event listener al nuevo botón de eliminar en la fila clonada
                const newDeleteButton = newRow.querySelector('.delete-row-btn');
                if (newDeleteButton) {
                    newDeleteButton.disabled = false;
                    newDeleteButton.addEventListener('click', function() {
                        if (personRowsContainer.children.length > 1) { // Asegura que no se elimine la última fila
                            newRow.remove();
                            reindexRows(); // Reindexar después de eliminar una fila
                        } else {
                            // Opcional: mostrar un mensaje si intentan eliminar la última fila
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
                updateAddButtonState(); // Actualizar el estado del botón después de agregar una fila
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
        personRowsContainer.querySelectorAll('.delete-row-btn').forEach(button => {
            button.addEventListener('click', function() {
                if (personRowsContainer.children.length > 1) { // Asegura que no se elimine la última fila
                    button.closest('.person-row').remove();
                    reindexRows(); // Reindexar después de eliminar una fila
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
    });
</script>

<style>
    .person-row:first-child .delete-row-btn {
        opacity: 0.5;
        display:none;
        cursor: not-allowed;
    }
    input[readonly], select[disabled] {
        background-color: #f3f4f6;
        cursor: not-allowed;
    }
</style>

</body>
</html>
