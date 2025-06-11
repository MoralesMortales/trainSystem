<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrainSystem - Gestionar Empleados</title>
    @vite(['resources/css/app.css'])
    @vite(['resources/css/MyTrains.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        {{-- SweetAlert2 CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css">
    
    {{-- SweetAlert2 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>

</head>

<body>
    <div id="container" class="tw:min-h-screen tw:bg-cover tw:bg-center tw:bg-no-repeat tw:fixed tw:inset-0">
        <x-navbar />
        <div id="boxContainer" class="tw:h-full tw:w-full tw:flex tw:justify-center tw:items-center tw:pt-20">
            <div class="box tw:w-10/12 md:tw:w-8/12 tw:h-auto tw:min-h-[70vh] tw:bg-gray-200 tw:bg-opacity-80 tw:rounded-lg tw:p-6 tw:shadow-lg tw:flex tw:flex-col">

                <form id="reservationForm" class="tw:overflow-x-auto tw:flex-grow">
                    <div>
                        <table class="tw:min-w-full tw:bg-gray-300 tw:rounded-lg tw:shadow-md tw:overflow-hidden" name="Tabla de Reservas">
                            <thead class="tw:bg-gray-400 tw:text-gray-800 tw:uppercase tw:text-sm tw:leading-normal" name="Datos de la persona">
                                <tr>
                                    <th class="tw:py-3 tw:px-6 tw:text-left">Cedula</th>
                                    <th class="tw:py-3 tw:px-6 tw:text-left">Email</th>
                                    <th class="tw:py-3 tw:px-6 tw:text-left">Cargo</th> {{-- Columna para el rol --}}
                                    <th class="tw:py-3 tw:px-6 tw:text-left">Eliminar</th>
                                </tr>
                            </thead>

                            <tbody id="personRowsContainer">
                                @foreach($users as $user)
                                <tr class="person-row">
                                    <td class="tw:text-center">
                                        <input type="text" name="persons[{{ $loop->index }}][cedula]" class="tw:w-48" value="{{ $user->cedula }}" readonly>
                                    </td>
                                    <td class="tw:text-center">
                                        <input type="text" name="persons[{{ $loop->index }}][email]" class="tw:w-48" value="{{ $user->email }}" readonly>
                                    </td>
                                    <td class="tw:text-center">
                                        <input type="text" name="persons[{{ $loop->index }}][charge]" class="tw:w-48" value="@php
                                            if ($user->isEmployee == 0) {
                                                echo 'Cliente';
                                            } elseif ($user->isEmployee == 1) {
                                                echo 'Operador';
                                            } elseif ($user->isEmployee == 2) {
                                                echo 'Supervisor';
                                            } else {
                                                echo 'Desconocido';
                                            }
                                        @endphp" readonly>
                                    </td>
                                    <td class="tw:text-center">
                                        <button type="button" class="delete-row-btn tw:text-black tw:font-bold tw:py-2 tw:px-4 tw:rounded tw:inline-flex tw:items-center"
                                                data-user-id="{{ $user->id }}">
                                            <i class="fa-solid fa-trash" style="color: #000000;"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                                @if($users->isEmpty())
                                <tr class="tw:text-center">
                                    <td colspan="4" class="tw:py-4">No hay empleados para mostrar.</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </form>

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

            </div>
        </div>
    </div>
    {{-- Script para manejar la eliminación de usuarios con SweetAlert2 --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const personRowsContainer = document.getElementById('personRowsContainer');

            personRowsContainer.addEventListener('click', function (event) {
                const deleteButton = event.target.closest('.delete-row-btn');

                if (deleteButton) {
                    const userId = deleteButton.dataset.userId;

                    // SweetAlert2 para la confirmación de eliminación
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "¡No podrás revertir esto!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33', // Color rojo para el botón de confirmar
                        cancelButtonColor: '#3085d6', // Color azul para el botón de cancelar
                        confirmButtonText: 'Sí, eliminarlo!',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Si el usuario confirma, enviar el formulario DELETE
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = `/menu/menuemployee/${userId}`;

                            const csrfToken = document.createElement('input');
                            csrfToken.type = 'hidden';
                            csrfToken.name = '_token';
                            csrfToken.value = '{{ csrf_token() }}';
                            form.appendChild(csrfToken);

                            const methodField = document.createElement('input');
                            methodField.type = 'hidden';
                            methodField.name = '_method';
                            methodField.value = 'DELETE';
                            form.appendChild(methodField);

                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                }
            });

            // SweetAlert2 para mostrar mensajes flash (éxito, error, etc.)
            @if(session('success'))
                Swal.fire({
                    title: '¡Éxito!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                });
            @endif

            @if(session('error')) {{-- Si tienes mensajes de error en el futuro --}}
                Swal.fire({
                    title: '¡Error!',
                    text: '{{ session('error') }}',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            @endif

            @if(session('warning')) {{-- Si tienes mensajes de advertencia --}}
                Swal.fire({
                    title: '¡Advertencia!',
                    text: '{{ session('warning') }}',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                });
            @endif
        });
    </script>
</body>
</html>