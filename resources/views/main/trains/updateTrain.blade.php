<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrainSystem</title>
    @vite(['resources/css/app.css'])
    @vite(['resources/css/EditTrains.css'])
</head>

<body>
    <div id="container">
        <x-navbar />
        <div id="boxContainer" class="tw:w-full tw:flex tw:justify-center tw:items-center tw:pt-28">
            <div class="box tw:w-10/12 md:tw:w-8/12 tw:h-auto tw:bg-gray-200 tw:bg-opacity-80 tw:rounded-lg tw:shadow-lg ">
                <form id="updateTrainForm" action="{{ route('updateTrain.submit', $train->train_id) }}" method="post" class="tw:h-full tw:w-full tw:flex tw:flex-col tw:justify-center tw:items-center">
                    @csrf
                    @method('PUT')

                    <table class="tw:rounded-lg tw:overflow-hidden">
                        <thead class="tw:text-gray-800 tw:uppercase tw:leading-normal">
                            <tr>
                                <th colspan="2">Update Train {{ $train->name }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <label class="tw:font-bold" style="font-size: 14px;">Train name</label>
                                    <input type="text" name="name" value="{{ old('name', $train->name) }}" class="tw:border tw:rounded">
                                </td>
                                <td>
                                    <label class="tw:font-bold" style="font-size: 14px;">Type</label>
                                    <select name="type" class="tw-w-48">
                                        <option value="" disabled @selected(!old('type', $train->type))>Seleccione tipo</option>
                                        @foreach($trainTypes as $key => $type)
                                            <option value="{{ $key }}" @selected(old('type', $train->type) == $key)>
                                                {{ $type }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="tw:font-bold" style="font-size: 14px;">Capacity</label>
                                    <input type="number" value="{{ old('capacity', $train->capacity) }}" name="capacity" class="tw:border tw:rounded" min="0" step="1">
                                </td>
                                <td>
                                    <label class="tw:font-bold" style="font-size: 14px;">Max Velocity (Km/h)</label>
                                    <input type="number" name="maxVelocity" value="{{ old('maxVelocity', $train->maxVelocity) }}" class="tw:border tw:rounded" min="0" step="1">
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="tw:mt-4 tw:rounded-lg tw:overflow-hidden">
                        <thead class="tw:text-gray-800 tw:uppercase tw:leading-normal">
                            <tr>
                                <th colspan="3">Classes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="tw:flex tw:gap-x-2 tw:justify-center tw:items-center tw:h-7">
                                        <label class="tw:items-center tw:font-bold" style="font-size: 14px;">
                                            Turist
                                        </label>
                                        <input type="checkbox" class="turist-checkbox tw:h-5 tw:w-5 tw:rounded" name="classes[]" value="turist" {{ old('turistCapacity', $train->turistCapacity) > 0 ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td>
                                    <div class="tw:flex tw:gap-x-2 tw:justify-center tw:items-center tw:h-7">
                                        <label class="tw:items-center tw:font-bold" style="font-size: 14px;">
                                            VIP
                                        </label>
                                        <input type="checkbox" class="vip-checkbox tw:h-5 tw:w-5 tw:rounded" name="classes[]" value="vip" {{ old('vipCapacity', $train->vipCapacity) > 0 ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td>
                                    <div class="tw:flex tw:gap-x-2 tw:justify-center tw:items-center tw:h-7">
                                        <label class="tw:items-center tw:font-bold" style="font-size: 14px;">
                                            Economic
                                        </label>
                                        <input type="checkbox" class="economic-checkbox tw:h-5 tw:w-5 tw:rounded" name="classes[]" value="economic" {{ old('economicCapacity', $train->economicCapacity) > 0 ? 'checked' : '' }}>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="tw:mt-4 tw:rounded-lg tw:overflow-hidden">
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
                                        <input type="number" name="turistCapacity" value="{{ old('turistCapacity', $train->turistCapacity) }}" class="tw:border tw:rounded tw:w-13" min="0" step="1">
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <label class="tw:font-bold" style="font-size: 14px;">VIP Seats</label>
                                        <input type="number" name="vipCapacity" value="{{ old('vipCapacity', $train->vipCapacity) }}" class="tw:border tw:rounded tw:w-13" min="0" step="1">
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <label class="tw:font-bold" style="font-size: 14px;">Economic Seats</label>
                                        <input type="number" name="economicCapacity" value="{{ old('economicCapacity', $train->economicCapacity) }}" class="tw:border tw:rounded tw:w-13" min="0" step="1">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div id="btnBottom" class="tw:mt-4 tw:flex tw:justify-center tw:items-center tw:w-full">
                        <button type="submit" class="tw:w-50 tw:h-15 tw:bg-green-300 hover:tw:bg-green-600 tw:text-black tw:text-2xl tw:font-bold tw:rounded-lg">Confirm</button>
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
            // No set value to 0 if unchecked on initial load for update form,
            // instead retain the old value if available or the value from $train
            if (!checkbox.checked) {
                // If it was previously checked and has a value, keep it. Otherwise, set to 0.
                if (input.value === "" || parseInt(input.value) <= 0) {
                     input.value = 0;
                }
            }


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