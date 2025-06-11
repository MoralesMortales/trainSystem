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
            <form id="reservingForm" action="{{ route('reservingTravelStep2.submit' ) }}" class="tw:h-full tw:w-full tw:flex tw:flex-col tw:justify-center tw:items-center" method="post">
            @csrf
            <table class="min-w-full text-left text-sm font-light text-surface dark:text-white tw:mr-10px">
                <thead class="border-b border-neutral-200 font-medium dark:border-white/10">
                    <tr>
                        <th colspan="5" class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">{{$travel->origin}} to {{$travel->destiny}}</th>
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
                            <input type="text" value="{{ old('Reserva') }}"  name="Reserva" class="tw:w-48" id="inputReserva" max="20" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '');">
                        </td>
                        <td class="tw:text-center">
                            <input type="text" name="Num_passport" value="{{ old('Num_passport') }}" class="tw:w-48" id="inputPassport" maxlength="9" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                        </td>
                        <td class="tw:text-center">
                            <input type="text" value="{{ old('depart') }}" name="depart" class="tw:w-40" readonly placeholder="{{ \carbon\carbon::parse($travel->departureDay)->format('d/m/Y') }} at {{ $travel->departureHour }}">
                        </td>
                        <td class="tw:text-center">
                            <select id="genderSelect" name="Gender">
                                <option value="">Select</option>
                                <option value="M">Masculine</option>
                                <option value="F">Femenine</option>
                            </select>
                        </td>
                        <td class="tw:text-center">
                            <input type="number" value="{{ old('Age') }}" maxlength="2" name="Age" class="tw:w-16" min="1" max="100" step="1" id="inputAge" oninput="this.value = Math.max(1, Math.min(100, parseInt(this.value) || 1))">

                            <input type="hidden" name="travelData" value="{{ json_encode($travel) }}">

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

        if (inputAge && (inputAge.value === '' || parseFloat(inputAge.value) <= 0)) {
            inputAge.value = 1;
        }

        function showError(title, text) {
            Swal.fire({
                icon: 'error',
                title: title,
                text: text,
                confirmButtonText: 'Entendido'
            });
        }

        inputReserva.addEventListener('input', function() {
            if (/[^a-zA-Z\s]/.test(this.value)) {
            }
        });

        inputAge.addEventListener('keydown', function(event) {
            // Permite las flechas de arriba/abajo (keyCode 38, 40)
            if (event.keyCode !== 38 && event.keyCode !== 40) {
                event.preventDefault();
            }
        });

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
                showError('Validation Error', errorMessage);
                return;
            }

            };


});
</script>

</body>
</html>
