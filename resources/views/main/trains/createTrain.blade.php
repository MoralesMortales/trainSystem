<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrainSystem</title>
@vite(['resources/css/app.css'])
@vite(['resources/css/MyTrains.css'])
</head>

<body>
<div id="container">
    <x-navbar/>
    <div id="boxContainer" class="tw:w-full tw:flex tw:justify-center tw:items-center tw:pt-28"> {{-- Added tw:pb-8 for bottom spacing if needed --}}
        <div class="box tw:w-10/12 md:tw:w-8/12 tw:h-auto tw:bg-gray-200 tw:bg-opacity-80 tw:rounded-lg tw:shadow-lg ">
            <form id="createTrainForm" action="{{ route('createTrain.submit') }}" method="post" class="tw:h-full tw:w-full tw:flex tw:flex-col tw:justify-center tw:items-center">
            @csrf
            <table class="tw:rounded-lg tw:overflow-hidden">
                <thead class="tw:text-gray-800 tw:uppercase tw:leading-normal">
                    <tr>
                        <th colspan="2">Create Train</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <label class="tw:font-bold" style="font-size: 14px;">Train name</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="tw:border tw:rounded">
                        </td>
                        <td>
                            <label class="tw:font-bold" style="font-size: 14px;">Type</label>
                                <select name="type" class="tw-w-48">
                                    <option value="" disabled @selected(!old('type'))>Seleccione tipo</option>
                                    @foreach($trainTypes as $key => $type)
                                        <option value="{{ $key }}" @selected(old('type') == $key)>
                                            {{ $type }}
                                        </option>
                                    @endforeach
                                </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="tw:font-bold" style="font-size: 14px;">Capacity</label>
                            {{-- Added min="0" and step="1" --}}
                                <input type="number" value="{{ old('capacity') }}" name="capacity" class="tw:border tw:rounded" min="0" step="1">
                        </td>
                        <td>
                            <label class="tw:font-bold" style="font-size: 14px;">Max Velocity (Km/h)</label>
                            {{-- Added min="0" and step="1" --}}
                            <input type="number" name="maxVelocity" value="{{ old('maxVelocity') }}" class="tw:border tw:rounded" min="0" step="1">
                        </td>
                    </tr>
                </tbody>
                
            </table>
            <table class="tw:rounded-lg tw:overflow-hidden"> {{-- Added tw:mt-4 for spacing between tables --}}
                <thead class="tw:text-gray-800 tw:uppercase tw:leading-normal">
                    <tr>
                        <th colspan="3">Classes</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="tw:flex tw:gap-x-2 tw:justify-center tw:items-center tw:h-7">
                                <label class=" tw:items-center tw:font-bold" style="font-size: 14px;">
                                    Turist
                                </label>
                                <input type="checkbox" class="turist-checkbox tw:h-5 tw:w-5 tw:rounded" name="classes[]" value="turist" @checked(in_array('turist', old('classes', [])))>
                            </div>
                        </td>
                        <td>
                            <div class="tw:flex tw:gap-x-2 tw:justify-center tw:items-center tw:h-7">
                                <label class=" tw:items-center tw:font-bold" style="font-size: 14px;">
                                    VIP
                                </label>
                                <input type="checkbox" class="vip-checkbox tw:h-5 tw:w-5 tw:rounded" name="classes[]" value="vip" @checked(in_array('vip', old('classes', [])))>
                            </div>
                        </td>
                        <td>
                            <div class="tw:flex tw:gap-x-2 tw:justify-center tw:items-center tw:h-7">
                                <label class=" tw:items-center tw:font-bold" style="font-size: 14px;">
                                    Economic
                                </label>
                                <input type="checkbox" class="economic-checkbox tw:h-5 tw:w-5 tw:rounded" name="classes[]" value="economic" @checked(in_array('economic', old('classes', [])))></div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="tw:rounded-lg tw:overflow-hidden"> {{-- Added tw:mt-4 for spacing between tables --}}
                <thead class="tw:text-gray-800 tw:uppercase tw:leading-normal">
                    <tr>
                        <th colspan="3">Type Seats</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div>
                                <label class="tw:font-bold" style="font-size: 14px;">Turist Seats</label>
                                {{-- Added min="0" and step="1" --}}
                                <input type="number"name="turistCapacity" value="{{ old('turistCapacity') }}" class="tw:border tw:rounded tw:w-13" min="0" step="1">
                            </div>
                        </td>
                        <td>
                            <div>
                                <label class="tw:font-bold" style="font-size: 14px;">VIP Seats</label>
                                {{-- Added min="0" and step="1" --}}
                                <input type="number"name="vipCapacity" value="{{ old('vipCapacity') }}" class="tw:border tw:rounded tw:w-13" min="0" step="1">
                            </div>
                        </td>
                        <td>
                            <div>
                                <label class="tw:font-bold" style="font-size: 14px;">Economic Seats</label>
                                {{-- Added min="0" and step="1" --}}
                                <input type="number" name="economicCapacity" value="{{ old('economicCapacity') }}" class="tw:border tw:rounded tw:w-13" min="0" step="1">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div id="btnBottom" class="tw:mt-4 tw:flex tw:justify-center tw:items-center tw:w-full">
                <button type="submit" class="tw:w-45 tw:h-15 tw:bg-green-300 hover:tw:bg-green-600 tw:text-black tw:text-2xl tw:font-bold tw:rounded-lg">Confirm</button>
            </div>
            </form>

        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mapeo de checkboxes a inputs
    const classControls = {
        'turist': {checkbox: '.turist-checkbox', input: 'turistCapacity'},
        'economic': {checkbox: '.economic-checkbox', input: 'economicCapacity'},
        'vip': {checkbox: '.vip-checkbox', input: 'vipCapacity'}
    };

    // Configurar cada par checkbox-input
    Object.keys(classControls).forEach(className => {
        const checkbox = document.querySelector(classControls[className].checkbox);
        const input = document.querySelector(`input[name="${classControls[className].input}"]`);

        if (checkbox && input) {
            // Estado inicial
            input.disabled = !checkbox.checked;
            if (!checkbox.checked) input.value = 0;

            // Event listener para cambios
            checkbox.addEventListener('change', function() {
                input.disabled = !this.checked;
                if (!this.checked) {
                    input.value = 0;
                }
            });
        }
    });

    // Manejo de errores con SweetAlert2
    @if ($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Validation Error!', // Título en español
            html: `
                <p>Please correct the following errors:</p>
                <ul class="tw:list-disc tw:list-inside tw:text-left">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            `,
            confirmButtonText: 'Entendido' // Botón de confirmación en español
        });
    @endif
});
</script>
</body>
</html>