<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrainSystem</title>
@vite(['resources/css/app.css'])
@vite(['resources/css/OnlyMe.css'])
</head>

<body>
<div id="container">
    <x-navbar/>
    <div id="boxContainer" class="tw:h-9/12 tw:w-full tw:flex tw:justify-center tw:items-center tw:pt-28">
        <div class="box">
            <form action="{{ route('register.submit') }}" class="tw:h-full tw:w-full tw:flex tw:flex-col tw:justify-center tw:items-center" method="post">
            @csrf
            <table class="min-w-full text-left text-sm font-light text-surface dark:text-white tw:mr-10px" name="Tabla de Reservas">
                <thead>
                    <tr>
                        <th colspan="6" class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Ohio - Train (A113)</th>
                        
                    </tr>
                </thead>
                <thead class="border-b border-neutral-200 font-medium dark:border-white/10" name="Datos de la persona">
                    <tr>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Fullname</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Gender</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Age</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Class</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Seat</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Seat Cost</th>
                    </tr>
                </thead>

                <tbody id="personRowsContainer">
                    <tr class="person-row tw:opacity-60"> <td class="tw:text-center">
                                <input type="text" name="persons[0][fullname]" class="tw:w-48 tw:text-white" readonly> </td>
                        <td class="tw:text-center">
                            <input type="text" name="persons[0][gender]" class="tw:w-48 tw:text-white" readonly>
                        </td>
                        <td class="tw:text-center">
                            <input type="number" name="persons[0][age]" class="tw:w-40 tw:text-white" readonly>
                        </td>
                        <td class="tw:text-center">
                            <select name="persons[0][class]" class="tw:text-white" disabled> <option value="Turist">Turist</option>
                                <option value="Normal">Normal</option>
                                <option value="VIP">VIP</option>
                            </select>
                        </td>
                        <td class="tw:text-center">
                            <select name="persons[0][seat]" class="tw:bg-gray-800 tw:text-white" disabled>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </td>
                        <td class="tw:text-center">
                            <input type="text" name="persons[0][seat_cost]" class="tw:w-40 tw:bg-gray-800 tw:text-white" readonly>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table>
                <tbody>
                    <tr>
                        <td colspan="6" class="tw:text-center"> <div class="tw:flex tw:justify-center tw:items-center tw:pt-2 tw:pb-2 tw:w-full tw:space-x-4">
                                <button type="button" id="addAnotherPerson" class="tw:w-54 tw:h-13 tw:bg-green-200 tw:text-2xl tw:font-bold tw:rounded-lg hover:tw:bg-green-300">
                                    Agregar otro
                                </button>
                                <button type="button" id="removeLastPerson" class="tw:w-54 tw:h-13 tw:bg-red-200 tw:text-2xl tw:font-bold tw:rounded-lg hover:tw:bg-red-300">
                                    Eliminar último
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="6" class="tw:text-center tw:py-2 tw:text-xl tw:font-bold"> Total a pagar:
                        </th>
                    </tr>
                    <tr>
                        <td colspan="6" class="tw:text-center"> <div id="btnBottom" class="tw:flex tw:justify-center tw:items-center tw:pt-2 tw:pb-2 tw:w-full">
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
        const addAnotherBtn = document.getElementById('addAnotherPerson');
        const removeLastBtn = document.getElementById('removeLastPerson'); // Nuevo botón
        const personRowsContainer = document.getElementById('personRowsContainer');
        let personIndex = 0; // Para llevar la cuenta de las personas (empezamos en 0 para la primera)

        // Inicializa personIndex si ya hay filas precargadas (aunque en tu caso solo hay una)
        if (personRowsContainer.children.length > 0) {
            personIndex = personRowsContainer.children.length - 1;
        }

        // Función para actualizar el estado del botón "Eliminar último"
        function updateRemoveButtonState() {
            // Deshabilita el botón si solo queda la fila original (para evitar eliminar la primera persona)
            if (personRowsContainer.children.length <= 1) {
                removeLastBtn.disabled = true;
                removeLastBtn.classList.add('tw:opacity-50', 'tw:cursor-not-allowed'); // Estilo de deshabilitado
            } else {
                removeLastBtn.disabled = false;
                removeLastBtn.classList.remove('tw:opacity-50', 'tw:cursor-not-allowed'); // Quita estilo de deshabilitado
            }
        }

        // Llamar al inicio para establecer el estado inicial del botón
        updateRemoveButtonState();

        addAnotherBtn.addEventListener('click', function() {
            personIndex++; // Incrementa el índice para la nueva persona

            // Clona la primera fila como plantilla (sin las clases de opacidad/color para los campos clonados)
            const templateRow = personRowsContainer.children[0]; // Siempre clonar la primera fila
            const newRow = templateRow.cloneNode(true); // Clonar en profundidad (con todos sus hijos)

            // Eliminar las clases de estilo "deshabilitado" de la fila clonada y de sus inputs/selects
            newRow.classList.remove('tw:opacity-60', 'tw:bg-gray-700');
            newRow.querySelectorAll('input, select').forEach(input => {
                input.classList.remove('tw:bg-gray-800', 'tw:text-white');
                // Keep readonly for seat_cost inputs, but enable others
                if (input.name.includes('[seat_cost]')) {
                    input.setAttribute('readonly', 'true'); // Ensure it remains readonly
                } else {
                    input.removeAttribute('readonly'); // Habilitar la edición de los inputs
                }
                input.removeAttribute('disabled'); // Habilitar los selects
                
                input.value = (input.tagName === 'SELECT' ? input.options[0].value : ''); // Limpiar selectores a la primera opción
                const currentName = input.getAttribute('name');
                if (currentName) {
                    input.setAttribute('name', currentName.replace(/\[\d+\]/, '[' + personIndex + ']'));
                }
            });

            personRowsContainer.appendChild(newRow); // Añadir la nueva fila al contenedor
            updateRemoveButtonState(); // Actualizar el estado del botón después de añadir una fila
        });

        // Event listener para el botón "Eliminar último"
        removeLastBtn.addEventListener('click', function() {
            // Asegurarse de que haya más de una fila antes de eliminar (para no eliminar la fila original)
            if (personRowsContainer.children.length > 1) {
                personRowsContainer.lastElementChild.remove(); // Elimina el último elemento hijo (la última fila)
                personIndex--; // Decrementa el índice
                updateRemoveButtonState(); // Actualizar el estado del botón después de eliminar una fila
            }
        });
    });
</script>

</body>
</html>