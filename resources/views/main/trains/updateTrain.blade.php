<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrainSystem</title>
    @vite(['resources/css/app.css'])
    @vite(['resources/css/register.css'])
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
                                    <input type="text" name="type" value="{{ old('name', $train->type) }}"
                                        class="tw:w-full tw:p-2 tw:border tw:rounded">
                                </div>
                            </div>

                            <div class="tw:flex tw:flex-col tw:gap-y-4 tw:w-1/2">
                                <div class="input">
                                    <label class="tw:text-lg" style="font-size: 14px;">Capacity</label>
                                    <input type="text" name="capacity" value="{{ old('name', $train->capacity) }}"
                                        class="tw:w-full tw:p-2 tw:border tw:rounded">
                                </div>
                                <div class="input">
                                    <label class="tw:text-lg" style="font-size: 14px;">Max Velocity</label>
                                    <input type="text" value="{{ old('name', $train->maxVelocity) }}"
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
                                <input type="checkbox" class="tw:mr-2 tw:h-7 tw:w-7 tw:rounded">
                                <label class="tw:flex tw:items-center tw:font-bold" style="font-size: 14px;">
                                    Economic
                                </label>
                                <input type="checkbox" class="tw:mr-2 tw:h-7 tw:w-7 tw:rounded">
                                <label class="tw:flex tw:items-center tw:font-bold" style="font-size: 14px;">
                                    VIP
                                </label>
                                <input type="checkbox" class="tw:mr-2 tw:h-7 tw:w-7 tw:rounded">
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
                </form>

            </div>
        </div>
    </div>

</body>

</html>
