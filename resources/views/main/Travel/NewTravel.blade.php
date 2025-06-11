<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrainSystem - Nuevo Viaje</title>
    @vite(['resources/css/app.css'])
    @vite(['resources/css/OnlyMe.css'])
    {{-- SweetAlert2 CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css">
</head>

{{-- El body asegurará que la página ocupe toda la altura y posicione su contenido --}}
<body class="tw:min-h-screen tw:flex tw:flex-col tw:items-center tw:justify-start tw:bg-gray-100">

{{-- El componente de la barra de navegación --}}
<x-navbar/>

{{-- Contenedor principal para el contenido del formulario --}}
<div id="container" class="tw:w-full tw:flex tw:flex-col tw:items-center tw:flex-grow">
    {{-- boxContainer es responsable de empujar el contenido hacia abajo de la navbar --}}
    <div id="boxContainer" class="tw:h-9/12 tw:w-full tw:flex tw:justify-center tw:items-center tw:pt-28">
        <div class="box">
            {{-- Formulario para crear un nuevo viaje --}}
            <form id="reservingForm" action="{{ route('travels.store') }}" class="tw:w-full tw:flex tw:flex-col tw:justify-center tw:items-center" method="POST">
                @csrf {{-- Token CSRF necesario para solicitudes POST en Laravel --}}

                {{-- Tabla para información del tren y fecha/hora --}}
                <table class="tw:min-w-full tw:text-left tw:text-sm tw:font-light tw:text-surface dark:tw:text-white">
                    <thead class="tw:border-b tw:border-neutral-200 tw:font-medium dark:tw:border-white/10">
                        <tr>
                            <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Tren</th>
                            <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Día de Salida</th>
                            <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Hora de Salida</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="tw:text-center tw:py-2">
                                {{-- Select para elegir el tren --}}
                                <select name="train_id" class="tw:w-48 tw:bg-white tw:border tw:border-gray-300 tw:rounded tw:py-2 tw:px-3 focus:tw:outline-none focus:tw:ring-2 focus:tw:ring-blue-500">
                                    <option value="" disabled selected>Seleccione un tren</option> 
                                    @foreach($trains as $train)
                                        <option value="{{ $train->train_id }}">{{ $train->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="tw:text-center tw:py-2">
                                {{-- CAMBIO: El nombre del campo ahora coincide con la columna 'departureDay' de la BD --}}
                                <input type="date" name="departureDay" class="tw:w-48 tw:bg-white tw:border tw:border-gray-300 tw:rounded tw:py-2 tw:px-3 focus:tw:outline-none focus:tw:ring-2 focus:tw:ring-blue-500">
                            </td>
                            <td class="tw:text-center tw:py-2">
                                {{-- CAMBIO: El nombre del campo ahora coincide con la columna 'departureHour' de la BD --}}
                                <input type="time" name="departureHour" class="tw:w-48 tw:bg-white tw:border tw:border-gray-300 tw:rounded tw:py-2 tw:px-3 focus:tw:outline-none focus:tw:ring-2 focus:tw:ring-blue-500">
                            </td>
                        </tr>
                    </tbody>
                </table>

                {{-- Tabla para ciudades de origen y destino --}}
                <table class="tw:min-w-full tw:text-left tw:text-sm tw:font-light tw:text-surface dark:tw:text-white">
                    <thead class="tw:border-b tw:border-neutral-200 tw:font-medium dark:tw:border-white/10">
                        <tr>
                            <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Ciudad Origen</th>
                            <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Ciudad Destino</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="tw:text-center tw:py-2">
                                {{-- CAMBIO: El nombre del campo ahora coincide con la columna 'origin' de la BD --}}
                                <select name="origin" class="tw:w-48 tw:bg-white tw:border tw:border-gray-300 tw:rounded tw:py-2 tw:px-3 focus:tw:outline-none focus:tw:ring-2 focus:tw:ring-blue-500">
                                    <option value="" disabled selected>Seleccione origen</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="tw:text-center tw:py-2">
                                {{-- CAMBIO: El nombre del campo ahora coincide con la columna 'destiny' de la BD --}}
                                <select name="destiny" class="tw:w-48 tw:bg-white tw:border tw:border-gray-300 tw:rounded tw:py-2 tw:px-3 focus:tw:outline-none focus:tw:ring-2 focus:tw:ring-blue-500">
                                    <option value="" disabled selected>Seleccione destino</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>

                {{-- Tabla para costos --}}
                <table class="tw:min-w-full tw:text-left tw:text-sm tw:font-light tw:text-surface dark:tw:text-white tw:mt-4">
                    <thead class="tw:border-b tw:border-neutral-200 tw:font-medium dark:tw:border-white/10">
                        <tr>
                            <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Costo VIP</th>
                            <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Costo Normal</th>
                            <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Costo Turistas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="tw:text-center tw:py-2">
                                {{-- Input para costo VIP (tipo number, decimales, valor por defecto) --}}
                                <input type="number" step="0.01" name="cost_vip" class="tw:w-48 tw:bg-white tw:border tw:border-gray-300 tw:rounded tw:py-2 tw:px-3 focus:tw:outline-none focus:tw:ring-2 focus:tw:ring-blue-500" value="">
                            </td>
                            <td class="tw:text-center tw:py-2">
                                {{-- Input para costo Normal (tipo number, decimales, valor por defecto) --}}
                                <input type="number" step="0.01" name="cost_normal" class="tw:w-48 tw:bg-white tw:border tw:border-gray-300 tw:rounded tw:py-2 tw:px-3 focus:tw:outline-none focus:tw:ring-2 focus:tw:ring-blue-500" value="">
                            </td>
                            <td class="tw:text-center tw:py-2">
                                {{-- Input para costo Turistas (tipo number, decimales, valor por defecto) --}}
                                <input type="number" step="0.01" name="cost_turist" class="tw:w-48 tw:bg-white tw:border tw:border-gray-300 tw:rounded tw:py-2 tw:px-3 focus:tw:outline-none focus:tw:ring-2 focus:tw:ring-blue-500" value="">
                            </td>
                        </tr>
                    </tbody>
                </table>

                {{-- Botón de Confirmar --}}
                <table class="tw:mt-4">
                    <tbody>
                        <tr>
                            <td colspan="6" class="tw:text-center">
                                <div id="btnBottom" class="tw:flex tw:justify-center tw:items-center tw:pt-2 tw:pb-2 tw:w-full">
                                    <button id="confirmTravelButton" type="submit" class="tw:w-54 tw:h-13 tw:bg-green-200 tw:text-2xl tw:font-bold tw:rounded-lg hover:tw:bg-green-300 focus:tw:outline-none focus:tw:ring-2 focus:tw:ring-green-400 focus:tw:ring-opacity-75 tw:transition-colors tw:duration-200">
                                        Confirmar
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                {{-- Aquí se mostrarán los errores de validación si el formulario no es AJAX (por ejemplo, si JS está deshabilitado o falla) --}}
                @if ($errors->any())
                    <div class="tw:text-red-700 tw:font-bold tw:mb-4 tw:text-center tw:mt-4">
                        Por favor, corrige los siguientes errores:
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

{{-- SweetAlert2 JS --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('reservingForm');
        const confirmTravelButton = document.getElementById('confirmTravelButton');

        // Mostrar mensajes de sesión con SweetAlert2 (si Laravel los envía)
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                confirmButtonText: 'Aceptar'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: '{{ session('error') }}',
                confirmButtonText: 'Aceptar'
            });
        @endif

        @if(session('warning'))
            Swal.fire({
                icon: 'warning',
                title: '¡Advertencia!',
                text: '{{ session('warning') }}',
                confirmButtonText: 'Aceptar'
            });
        @endif

        if (confirmTravelButton) {
            confirmTravelButton.addEventListener('click', function(event) {
                event.preventDefault(); // Evita el envío de formulario HTML tradicional

                const formData = new FormData(form);
                const data = {};
                {{-- Ahora los nombres de los campos en formData (que vienen del HTML)
                     deberían coincidir con los nombres de las columnas de la BD. --}}
                formData.forEach((value, key) => (data[key] = value));

                let clientErrors = [];

                // Validación de campos vacíos (se usa 'data.<nombre_columna_bd>')
                if (!data.train_id) clientErrors.push('El campo Tren es obligatorio.');
                if (!data.departureDay) clientErrors.push('El campo Día de Salida es obligatorio.');
                if (!data.departureHour) clientErrors.push('El campo Hora de Salida es obligatorio.');
                if (!data.origin) clientErrors.push('El campo Ciudad Origen es obligatorio.');
                if (!data.destiny) clientErrors.push('El campo Ciudad Destino es obligatorio.');
                
                // Validación de campos de costo vacíos
                if (data.cost_vip === null || data.cost_vip === undefined || data.cost_vip === '') clientErrors.push('El campo Costo VIP es obligatorio.');
                if (data.cost_normal === null || data.cost_normal === undefined || data.cost_normal === '') clientErrors.push('El campo Costo Normal es obligatorio.');
                if (data.cost_turist === null || data.cost_turist === undefined || data.cost_turist === '') clientErrors.push('El campo Costo Turistas es obligatorio.');


                // Validación de números estrictamente positivos/decimales
                const numericFields = ['cost_vip', 'cost_normal', 'cost_turist'];
                numericFields.forEach(field => {
                    const value = parseFloat(data[field]);
                    if (isNaN(value) || value <= 0) {
                        // Formatear el nombre del campo para el mensaje de error
                        let fieldName = field.replace('_', ' ');
                        fieldName = fieldName.split(' ').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
                        clientErrors.push(`El campo ${fieldName} debe ser un número mayor a 0.`);
                    }
                });

                // Validación de ciudad de origen y destino
                if (data.origin && data.destiny && data.origin === data.destiny) {
                    clientErrors.push('La Ciudad de Origen y la Ciudad de Destino no pueden ser la misma.');
                }

                // CORRECCIÓN: Validación de fecha de salida (estrictamente después de hoy)
                const now = new Date();
                const tomorrow = new Date(now);
                tomorrow.setDate(now.getDate() + 1);
                tomorrow.setHours(0, 0, 0, 0); 

                if (data.departureDay) { // Se usa 'departureDay' ahora
                    const departureDate = new Date(data.departureDay);
                    departureDate.setHours(0, 0, 0, 0); 

                    if (departureDate < tomorrow) { 
                        clientErrors.push('El Día de Salida debe ser un día después de hoy.');
                    }
                }
                
                if (clientErrors.length > 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Errores de Validación',
                        html: clientErrors.join('<br>'),
                        confirmButtonText: 'Ok'
                    });
                    return;
                }

                // Si las validaciones del cliente pasan, enviar la solicitud al servidor
                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': data._token
                    },
                    body: JSON.stringify(data)
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(errorData => {
                            if (errorData.errors) {
                                const serverErrors = Object.values(errorData.errors).flat().join('<br>');
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Errores de Validación',
                                    html: serverErrors,
                                    confirmButtonText: 'Ok'
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: errorData.message || 'Ocurrió un error en el servidor.',
                                    confirmButtonText: 'Ok'
                                });
                            }
                            throw new Error('Server validation or other error'); 
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Viaje Creado!',
                        text: data.message || 'El viaje ha sido creado exitosamente.',
                        confirmButtonText: 'Ok'
                    }).then(() => {
                        window.location.href = '{{ route('menu') }}';
                    });
                })
                .catch(error => {
                    console.error('Error al enviar el formulario:', error);
                    if (!error.message.includes('Server validation or other error')) { 
                        Swal.fire({
                            icon: 'error',
                            title: 'Error de Red',
                            text: 'No se pudo conectar con el servidor. Intenta de nuevo más tarde.',
                            confirmButtonText: 'Ok'
                        });
                    }
                });
            });
        }
    });
</script>

</body>
</html>
