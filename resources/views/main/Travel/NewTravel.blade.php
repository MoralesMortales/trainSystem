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
    <div id="boxContainer" class="tw:h-9/12 tw:w-full tw:flex tw:justify-center tw:items-center tw:pt-44">
        <div class="box">
            <form id="reservingForm" action="{{ route('CreateTravel.submit') }}" class="tw:h-full tw:w-full tw:flex tw:flex-col tw:justify-center tw:items-center" method="post">
            @csrf
            <table class="min-w-full text-left text-sm font-light text-surface dark:text-white tw:mr-10px">
                <thead class="border-b border-neutral-200 font-medium dark:border-white/10">
                    <tr>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Train</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Department Day</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Department Hour</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td class="tw:text-center">
   <select name="train_id" class="tw-w-48 tw-bg-white tw-border tw-border-gray-300 tw-rounded tw-py-2 tw-px-3">
        @foreach($trains as $train)
            <option value="{{ $train->train_id }}">{{ $train->name }}</option>
        @endforeach
    </select>
                        </td>
                        <td class="tw:text-center">
    <input type="date" value="{{ old('DepartmentDay',  date('Y-m-d')) }}" name="DepartmentDay" class="tw-w-48 tw-p-2 tw-border tw-rounded">
                        </td>
                        <td class="tw:text-center">
    <input type="time" value="{{ old('DepartmentHour') }}" name="DepartmentHour" class="tw-w-48 tw-p-2 tw-border tw-rounded" step="any">
                        </td>
                    </tr>
                </tbody>
            </table>

            <table class="min-w-full text-left text-sm font-light text-surface dark:text-white tw:mr-10px">
                <thead class="border-b border-neutral-200 font-medium dark:border-white/10">
                    <tr>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">City Origin</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">City Destiny</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td class="tw:text-center">
                               <select name="originCity" required class="tw-w-48 tw-bg-white tw-border tw-border-gray-300 tw-rounded tw-py-2 tw-px-3">
        @foreach($cities as $city)
 <option value="{{ $city->name }}" {{ old('originCity') == $city->name ? 'selected' : '' }}>
            {{ $city->name }}
        </option>
        @endforeach
    </select>

                        </td>
                        <td class="tw:text-center">
                               <select name="destinyCity"required class="tw-w-48 tw-bg-white tw-border tw-border-gray-300 tw-rounded tw-py-2 tw-px-3">
        @foreach($cities as $city)
 <option value="{{ $city->name }}" {{ old('destinyCity') == $city->name ? 'selected' : '' }}>
            {{ $city->name }}
        @endforeach
    </select>
                    </tr>
                </tbody>
            <table>

            <table class="min-w-full text-left text-sm font-light text-surface dark:text-white tw:mr-10px">
                <thead class="border-b border-neutral-200 font-medium dark:border-white/10">
                    <tr>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Cost VIP</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Cost Normal</th>
                        <th class="tw:text-center tw:py-2 tw:text-xl tw:font-bold">Cost Turists</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td class="tw:text-center">
                            <input type="number" value="{{ old('CostVIP') }}"  name="CostVIP" class="tw:w-48"required>
                        </td>
                        <td class="tw:text-center">
                            <input type="number" name="CostNormal" value="{{ old('CostNormal') }}"  class="tw:w-48"required>
                        </td>
                        <td class="tw:text-center">
                            <input type="number" name="CostTurists" value="{{ old('CostTurists') }}"  class="tw:w-48" required>
                        </td>
                    </tr>
                </tbody>
            </table>

            <table>
                <tbody>
                    <tr>
                        <td colspan="6" class="tw:text-center">
                            <div id="btnBottom" class="tw:flex tw:justify-center tw:items-center tw:pt-2 tw:pb-2 tw:w-full">
                                <button id="confirmRedirectButton" type="submit" class="tw:w-54 tw:h-13 tw:bg-green-200 tw:text-2xl tw:font-bold tw:rounded-lg hover:tw:bg-green-300">
                                    Confirm
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
