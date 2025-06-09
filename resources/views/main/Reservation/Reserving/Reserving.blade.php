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
    <!-- Este div contendrá la barra de navegación y el contenedor principal del formulario. -->
    <x-navbar/>
    <!-- Contenedor principal para centrar la caja del formulario. -->
    <div id="boxContainer" class="tw:h-9/12 tw:w-full tw:flex tw:justify-center tw:items-center tw:pt-28">
        <!-- La caja gris que contiene el formulario. Se ha ajustado el ancho a tw:w-7/12. -->
        <div class="box">
            <!-- Formulario de registro con la ruta y método especificados. -->
            <!-- Se ha añadido un ID al formulario para poder referenciarlo en JavaScript -->
            <form id="reservingForm" action="" class="tw:h-full tw:w-full tw:flex tw:flex-col tw:justify-center tw:items-center" method="get">
            @csrf
            <!-- La tabla para organizar los inputs y el botón. -->
            <!-- Se han añadido clases de Tailwind para centrar la tabla y sus contenidos. -->
            <table class="min-w-full text-left text-sm font-light text-surface dark:text-white tw:mr-10px">
                <thead class="border-b border-neutral-200 font-medium dark:border-white/10">
                    <tr>
                        <!-- Encabezados de columna, centrados horizontalmente. -->
                        <th colspan="5" class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Ohio - Train (A113)</th>
                    </tr>
                </thead>
                <thead class="border-b border-neutral-200 font-medium dark:border-white/10">
                    <tr>
                        <!-- Encabezados de columna, centrados horizontalmente. -->
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Reserved By</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Passport Number</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Departure</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Gender</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Age</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <!-- Celda para el input de email, ahora con flexbox para centrar su contenido. -->
                             <td class="tw:text-center">
                                 <input type="text" name="Reserva" class="tw:w-48">
                             </td>
                             <td class="tw:text-center">
                                 <input type="text" name="Num_passport" class="tw:w-48">
                             </td>        
                             <td class="tw:text-center">
                                 <input type="text" name="Depart" class="tw:w-40">
                             </td>
                            <td class="tw:text-center">
                                <select id="genderSelect" name="Gender"> <!-- Cambiado id para ser más específico -->
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                    <option value="O">Otro</option>
                                </select>
                            </td>       
                             <td class="tw:text-center">
                                 <input type="number" name="Age" class="tw:w-16">
                             </td>                              
                    </tr>
                </tbody>
            </table>
            <table>
                <tbody>
                    <tr>
                        <!-- Celda para el título "Reserving For", abarcando 5 columnas -->
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
                    <!-- Radio buttons con el mismo 'name' y diferentes 'value' -->
                    <td class="tw:py-2 tw:text-center tw:border-2">
                        <input type="radio" id="radioOnlyMe" name="reserving_option" value="onlyme" class="tw:w-6 tw:h-6">
                        <label for="radioOnlyMe" class="tw:sr-only">Just me</label> <!-- SR-only para accesibilidad, el texto está en el th -->
                    </td>
                    <td class="tw:py-2 tw:text-center tw:border-2">
                        <input type="radio" id="radioMeAndOthers" name="reserving_option" value="meandothers" class="tw:w-6 tw:h-6">
                        <label for="radioMeAndOthers" class="tw:sr-only">Me and Others</label>
                    </td>
                    <td class="tw:py-2 tw:text-center tw:border-2">
                        <input type="radio" id="radioOthers" name="reserving_option" value="others" class="tw:w-6 tw:h-6">
                        <label for="radioOthers" class="tw:sr-only">Others</label>
                    </td>
                </tbody>

                <tbody>
                    <tr>
                        <!-- Celda para el botón "Confirm", que abarca 5 columnas y se centra. -->
                        <td colspan="5" class="tw:text-center">
                            <div id="btnBottom" class="tw:flex tw:justify-center tw:items-center tw:pt-2 tw:pb-2 tw:w-full">
                                <button type="submit" class="tw:w-54 tw:h-13 tw:bg-green-200 tw:text-2xl tw:font-bold tw:rounded-lg hover:tw:bg-green-300">
                                    Confirm
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Sección para mostrar errores de validación, si los hay. -->
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

<!-- Script para mostrar notificaciones de éxito con SweetAlert2. -->
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

<!-- Script para manejar la redirección de los radio buttons -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const reservingForm = document.getElementById('reservingForm');
        const baseUrl = 'http://localhost:8000/menu/newreservation/reserving'; // Ruta base

        reservingForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Previene el envío por defecto del formulario

            const selectedOption = document.querySelector('input[name="reserving_option"]:checked');

            if (selectedOption) {
                const optionValue = selectedOption.value;
                let targetUrl = baseUrl;

                if (optionValue === 'onlyme') {
                    targetUrl += '/onlyme';
                } else if (optionValue === 'meandothers') {
                    targetUrl += '/meandothers';
                } else if (optionValue === 'others') {
                    targetUrl += '/others';
                }
                
                // Redirige a la nueva URL
                window.location.href = targetUrl;
            } else {
                // Opcional: mostrar un mensaje si no se ha seleccionado ninguna opción
                Swal.fire({
                    icon: 'warning',
                    title: '¡Atención!',
                    text: 'Por favor, selecciona una opción de reserva.',
                    confirmButtonText: 'Entendido'
                });
            }
        });
    });
</script>

</body>
</html>