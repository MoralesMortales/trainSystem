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
        <div id="boxContainer" class="tw:h-10/12  tw:w-full tw:flex tw:justify-center tw:items-center">
            <div class="box tw:w-8/12">
                <div class="tw:w-full tw:flex tw:justify-center tw:items-center tw:py-10">
                    <h4 class="">Update Train {{ $train->name }} </h4>
                </div>
                <form action="{{ route('updateTrain.submit', $train->train_id) }}" method="post">

                    @csrf
                    @method('PUT')

                    <div id="formContent"
                        class="tw:h-full tw:flex tw:flex-col tw:justify-around tw:px-4 tw:py-4">

                        <div class="tw:flex tw:justify-between tw:gap-x-4 tw:mb-6">
                            <div class="tw:flex tw:flex-col tw:gap-y-4 tw:w-1/2">
                                <div class="input">

                                    <input type="text" class="tw:hidden" value="Ignora esto">

                                    <label class="tw:text-lg" style="font-size: 14px;">Train name</label>
                                    <input type="text" value="{{ old('name', $train->name) }}"
                                        name="name"class="tw:w-full tw:p-2 tw:border tw:rounded">
                                </div>
                                <div class="input">
                                    <label class="tw:text-lg" style="font-size: 14px;">Type</label>
<select name="type" class="tw-w-48 mt-4">
    <option value="" disabled @selected(!old('type', $train->type))>Seleccione tipo</option>
    @foreach($trainTypes as $key => $type)
        <option value="{{ $key }}" @selected(old('type', $train->type) == $key)>
            {{ $type }}
        </option>
    @endforeach
</select>

                                </div>
                            </div>

                            <div class="tw:flex tw:flex-col tw:gap-y-4 tw:w-1/2">
                                <div class="input">
                                    <label class="tw:text-lg" style="font-size: 14px;">Capacity</label>
                                    <input type="number" name="capacity" value="{{ old('name', $train->capacity) }}"
                                        class="tw:w-full tw:p-2 tw:border tw:rounded">
                                </div>
                                <div class="input">
                                    <label class="tw:text-lg" style="font-size: 14px;">Max Velocity</label>
                                    <input type="number" value="{{ old('name', $train->maxVelocity) }}"
                                        name="maxVelocity" class="tw:w-full tw:p-2 tw:border tw:rounded">
                                </div>
                            </div>
                        </div>

                        <div class="tw:mb-6">
                            <label class="tw:text-lg tw:mb-2 tw:w-full tw:text-center tw:pb-4 tw:font-bold"
                                style="font-size: 19px;">Classes</label>
                            <div class="tw:flex tw:gap-x-8 tw:justify-center tw:items-center tw:h-12">
                                <label class="tw:flex tw:items-center tw:font-bold" style="font-size: 14px;">
                                    Turist
                                </label>
<input type="checkbox" class="turist-checkbox tw:mr-2 tw:h-7 tw:w-7 tw:rounded"  {{ $train->turistCapacity > 0 ? 'checked' : '' }}>
                                <label class="tw:flex tw:items-center tw:font-bold" style="font-size: 14px;">
                                    VIP
                                </label>
<input type="checkbox" class="vip-checkbox tw:mr-2 tw:h-7 tw:w-7 tw:rounded"  {{ $train->vipCapacity > 0 ? 'checked' : '' }}>

                                <label class="tw:flex tw:items-center tw:font-bold" style="font-size: 14px;">
                                    Economic
                                </label>
<input type="checkbox" class="economic-checkbox tw:mr-2 tw:h-7 tw:w-7 tw:rounded"  {{ $train->economicCapacity > 0 ? 'checked' : '' }}>
                            </div>
                        </div>

                        <div class="tw:flex tw:justify-between tw:gap-x-4 tw:my-6">
                            <div class="input tw:w-1/3">
                                <label class="tw:text-lg" style="font-size: 14px;">Turist Seats</label>
                                <input type="text"name="turistCapacity"
                                    value="{{ old('name', $train->turistCapacity) }}"
                                    class="tw:w-full tw:p-2 tw:border tw:rounded">
                            </div>
                            <div class="input tw:w-1/3">
                                <label class="tw:text-lg" style="font-size: 14px;">VIP Seats</label>
                                <input type="text"name="vipCapacity"
                                    value="{{ old('name', $train->vipCapacity) }}"class="tw:w-full tw:p-2 tw:border tw:rounded">
                            </div>
                            <div class="input tw:w-1/3">
                                <label class="tw:text-lg" style="font-size: 14px;">Economic Seats</label>
                                <input type="text"
                                    name="economicCapacity"value="{{ old('name', $train->economicCapacity) }}"
                                    class="tw:w-full tw:p-2 tw:border tw:rounded">
                            </div>
                        </div>

                    </div>

                    <div id="btnBottom" class="tw:h-auto tw:flex tw:justify-center tw:items-center tw:pb-20 tw:w-full">
                        <button
                            class="tw:w-50 tw:h-15 tw:mb-10 tw:bg-green-300 hover:tw:bg-green-600 tw:text-black tw:text-2xl tw:font-bold tw:py-3 tw:px-6 tw:rounded-lg">Confirm</button>
                    </div>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mapeo de checkboxes a inputs
    const classControls = {
        // checkbox: {input: 'inputName', label: 'LabelText'}
        'turist': {input: 'turistCapacity', label: 'Turist Seats'},
        'economic': {input: 'economicCapacity', label: 'Economic Seats'},
        'vip': {input: 'vipCapacity', label: 'VIP Seats'}
    };

    // Configurar cada par checkbox-input
    Object.keys(classControls).forEach(className => {
        const checkbox = document.querySelector(`input[type="checkbox"][class*="${className}"]`);
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
});
</script>
</body>

</html>
