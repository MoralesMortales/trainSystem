<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrainSystem</title>
@vite(['resources/css/app.css'])
@vite(['resources/css/Reserving.css'])
</head>

<body>
<div id="container">
    <x-navbar/>
    <div id="boxContainer" class="tw:h-11/12 tw:w-full tw:flex tw:justify-center tw:items-center tw:pt-28">
        <div class="box">
            <form id="reservingForm" action="" class="tw:h-full tw:w-full tw:flex tw:flex-col tw:justify-center tw:items-center" method="get">
            @csrf
            <table class="min-w-full text-left text-sm font-light text-surface dark:text-white tw:mr-10px">
                <thead class="border-b border-neutral-200 font-medium dark:border-white/10">
                    <tr>
                        <th colspan="5" class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Ohio - Train (A113)</th>
                    </tr>
                </thead>
                <thead class="border-b border-neutral-200 font-medium dark:border-white/10">
                    <tr>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Reserved By</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Passport Number</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Departure</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Gender</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Age</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td class="tw:text-center">
                            <input type="text" name="Reserva" class="tw:w-48" id="inputReserva" max="20" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '');">
                        </td>
                        <td class="tw:text-center">
                            <input type="text" name="Num_passport" class="tw:w-48" id="inputPassport" maxlength="9" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                        </td>        
                        <td class="tw:text-center">
                            <input type="text" name="Depart" class="tw:w-40" readonly>
                        </td>
                        <td class="tw:text-center">
                            <select id="genderSelect" name="Gender"> 
                                <option value="">Seleccione</option>
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                                <option value="O">Otro</option>
                            </select>
                        </td>          
                        <td class="tw:text-center">
                            <input type="number" name="Age" class="tw:w-16" min="1" max="100" step="1" id="inputAge">
                        </td>                        
                    </tr>
                </tbody>
            </table>
            <table>
                <tbody>
                    <tr>
                        <th colspan="5" class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">
                            Reserving For
                        </th>
                    </tr>
                </tbody>

                <tbody>
                    <td class="tw:font-bold">
                        Just me
                    </td>
                    <td class="tw:font-bold">
                        Me and Others
                    </td>
                    <td class="tw:font-bold">
                        Others
                    </td>
                </tbody>

                <tbody>
                    <td class="tw:py-2 tw:text-center tw:border-2">
                        <input type="radio" id="radioOnlyMe" name="reserving_option" value="onlyme" class="tw:w-6 tw:h-6">
                    </td>
                    <td class="tw:py-2 tw:text-center tw:border-2">
                        <input type="radio" id="radioMeAndOthers" name="reserving_option" value="meandothers" class="tw:w-6 tw:h-6">
                    </td>
                    <td class="tw:py-2 tw:text-center tw:border-2">
                        <input type="radio" id="radioOthers" name="reserving_option" value="others" class="tw:w-6 tw:h-6">
                        </td>
                </tbody>

                <tbody>
                    <tr>
                        <td colspan="3" class="tw:text-center">
                            <div id="btnBottom" class="tw:flex tw:justify-center tw:items-center tw:pt-2 tw:pb-2 tw:w-full">
                                <button type="submit" class="tw:w-54 tw:h-13 tw:bg-green-200 tw:text-2xl tw:font-bold tw:rounded-lg hover:tw:bg-green-300">
                                    Confirm
                                </button>
                            </div>
                        </td>
                    </tr>
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

            </form>

        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
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
        const reservingForm = document.getElementById('reservingForm');
        const inputReserva = document.getElementById('inputReserva');
        const inputPassport = document.getElementById('inputPassport');
        const genderSelect = document.getElementById('genderSelect');
        const inputAge = document.getElementById('inputAge');
        const baseUrl = 'http://localhost:8000/menu/newreservation/reserving'; // Ruta base

        // Inicializar el valor de edad en 1 si está vacío
        if (inputAge && (inputAge.value === '' || parseFloat(inputAge.value) <= 0)) {
            inputAge.value = 1;
        }

        // Función para mostrar SweetAlert2 de error
        function showError(title, text) {
            Swal.fire({
                icon: 'error',
                title: title,
                text: text,
                confirmButtonText: 'Entendido'
            });
        }

        // Validación en tiempo real para el nombre del reservante (solo letras y espacios)
        inputReserva.addEventListener('input', function() {
            // Se realiza la limpieza en el HTML con oninput, aquí solo se valida si es válido
            if (/[^a-zA-Z\s]/.test(this.value)) {
                // Opcional: podrías mostrar una pequeña indicación visual aquí sin un Swal.fire constante
                // Por ahora, solo se limpia la entrada no válida.
            }
        });

        // Validación en tiempo real para el número de pasaporte (solo números y máximo 9 dígitos)
        inputPassport.addEventListener('input', function() {
            // Se realiza la limpieza y el límite de longitud en el HTML con oninput y maxlength.
            // Aquí se podría añadir una validación más compleja si fuera necesario,
            // pero el HTML ya maneja lo básico.
        });

        // Prevenir la escritura manual en el campo de edad y solo permitir las flechas
        // Aunque `readonly` ya lo hace, esto asegura un control adicional.
        inputAge.addEventListener('keydown', function(event) {
            // Permite las flechas de arriba/abajo (keyCode 38, 40)
            if (event.keyCode !== 38 && event.keyCode !== 40) {
                event.preventDefault();
            }
        });

        // Validaciones al enviar el formulario
        reservingForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Previene el envío por defecto del formulario

            let isValid = true;
            let errorMessage = '';

            // 1. Validar Nombre del Reservante (solo letras y espacios, no vacío)
            const reservaValue = inputReserva.value.trim();
            if (reservaValue === '') {
                errorMessage = 'El nombre del reservante no puede estar vacío.';
                isValid = false;
            } else if (/[^a-zA-Z\s]/.test(reservaValue)) {
                errorMessage = 'El nombre del reservante solo debe contener letras y espacios.';
                isValid = false;
            }

            // 2. Validar Número de Pasaporte (no vacío, solo números, 9 dígitos)
            const passportValue = inputPassport.value.trim();
            if (isValid && passportValue === '') {
                errorMessage = 'El número de pasaporte no puede estar vacío.';
                isValid = false;
            } else if (isValid && !/^\d{9}$/.test(passportValue)) {
                errorMessage = 'El número de pasaporte debe contener exactamente 9 dígitos numéricos.';
                isValid = false;
            }

            // 3. Validar Género (no vacío)
            const genderValue = genderSelect.value;
            if (isValid && genderValue === '') {
                errorMessage = 'Por favor, selecciona una opción de género.';
                isValid = false;
            }

            // 4. Validar Edad (números enteros, entre 1 y 100)
            const ageValue = parseInt(inputAge.value, 10);
            if (isValid && (isNaN(ageValue) || ageValue < 1 || ageValue > 100)) {
                errorMessage = 'La edad debe ser un número entero entre 1 y 100.';
                isValid = false;
            }

            // Si alguna validación falla, muestra el error y detén el envío
            if (!isValid) {
                showError('Error de Validación', errorMessage);
                return;
            }

            // Si todas las validaciones son correctas, procede con la lógica de los radio buttons
            const selectedOption = document.querySelector('input[name="reserving_option"]:checked');

            if (selectedOption) {
                const optionValue = selectedOption.value;
                let targetUrl = baseUrl;

                if (optionValue === 'onlyme') {
                    targetUrl += '/onlyme';
                } else if (optionValue === 'meandothers') {
                    targetUrl += '/meandothers'; // Asegúrate de que esta opción esté en tus radio buttons si la necesitas
                } else if (optionValue === 'others') {
                    targetUrl += '/others';
                }
                
                // Redirige a la nueva URL
                window.location.href = targetUrl;
            } else {
                // Muestra un mensaje si no se ha seleccionado ninguna opción de reserva
                showError('¡Atención!', 'Por favor, selecciona una opción de reserva.');
            }
        });
    });
</script>

</body>
</html>