<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrainSystem - My Trains</title>
    @vite(['resources/css/app.css'])
    <!-- Puedes crear un CSS específico para MyTrains si lo necesitas, similar a CreateTrain.css -->
    @vite(['resources/css/MyTrains.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div id="container" class="tw:min-h-screen tw:bg-cover tw:bg-center tw:bg-no-repeat tw:fixed tw:inset-0">
        <x-navbar />
        <div id="boxContainer" class="tw:h-full tw:w-full tw:flex tw:justify-center tw:items-center tw:pt-20">
            <div class="box tw:w-10/12 md:tw:w-8/12 tw:h-auto tw:min-h-[70vh] tw:bg-gray-200 tw:bg-opacity-80 tw:rounded-lg tw:p-6 tw:shadow-lg tw:flex tw:flex-col">

                <!-- Tabla de trenes -->
                <div class="tw:overflow-x-auto tw:flex-grow">
                <table class="tw:min-w-full tw:bg-gray-300 tw:rounded-lg tw:shadow-md tw:overflow-hidden" name="Tabla de Reservas">
                    <thead class="tw:bg-gray-400 tw:text-gray-800 tw:uppercase tw:text-sm tw:leading-normal">
                        <tr>
                            <th colspan="7" class="tw:text-center tw:py-2 tw:text-xl">Ohio - Train (A113)</th>
                            
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
                                <input type="text" name="persons[0][fullname]" class="tw:w-48">
                            </td>
                            <td class="tw:text-center">
                                <select id="genderSelect" name="persons[0][gender]"> <!-- Cambiado id para ser más específico -->
                                    <option value=""></option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                    <option value="O">Otro</option>
                                </select>
                            </td> 
                            <td class="tw:text-center">
                                <input type="number" name="persons[0][age]" class="tw:w-16">
                            </td>
                            <td class="tw:text-center">
                                <select name="persons[0][class]"> 
                                    <option value=""></option>
                                    <option value="Turist">Turist</option>
                                    <option value="Normal">Normal</option>
                                    <option value="VIP">VIP</option>
                                </select>
                            </td>
                            <td class="tw:text-center">
                                <input type="number" name="persons[0][age]" class="tw:w-16">
                            </td>
                            <td class="tw:text-center">
                                <input type="text" name="persons[0][seat_cost]" class="tw:w-40 text-center" placeholder="0" readonly>
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
                        <th colspan="7" class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">
                            Total a pagar:
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

</body>
</html>