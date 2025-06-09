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
    <div id="boxContainer" class="tw:h-9/12 tw:w-full tw:flex tw:justify-center tw:items-center tw:pt-13">
        <!-- La caja gris que contiene el formulario. Se ha ajustado el ancho a tw:w-7/12. -->
        <div class="box tw:w-9/12 tw:h-11/12 tw:flex tw:flex-col tw:justify-center tw:items-center tw:p-4">
            <!-- Formulario de registro con la ruta y método especificados. -->
            <form action="{{ route('register.submit') }}" class="tw:h-full tw:w-full tw:flex tw:flex-col tw:justify-center tw:items-center" method="post">
            @csrf
            <!-- La tabla para organizar los inputs y el botón. -->
            <!-- Se han añadido clases de Tailwind para centrar la tabla y sus contenidos. -->
            <table class="min-w-full text-left text-sm font-light text-surface dark:text-white tw:mr-10px">
                <thead>
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
                                 <input type="text" name="Gender" class="tw:w-32">
                             </td>       
                             <td class="tw:text-center">
                                 <input type="text" name="Age" class="tw:w-16">
                             </td>                                            
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <!-- Celda para el botón, que abarca dos columnas (colspan="2") y se centra. -->
                        <td colspan="5" class="tw:text-center">
                            <div id="btnBottom" class="tw:flex tw:justify-center tw:items-center tw:pt-4 tw:pb-4 tw:w-full">
                                <button class="tw:w-54 tw:h-13 tw:bg-red-200 tw:text-2xl tw:font-bold tw:rounded-lg hover:tw:bg-green-300">
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

</body>
</html>
