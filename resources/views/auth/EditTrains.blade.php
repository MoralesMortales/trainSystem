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
    <x-navbar/>
    <div id="boxContainer" class="tw:h-10/12 tw:w-full tw:flex tw:justify-center tw:items-center tw:pt-20">
        <div class="box tw:w-8/12 tw:h-11/12">

            <form action="" class="tw:h-full tw:flex tw:flex-col tw:justify-center">
                <div id="formContent" class="tw:h-auto tw:flex tw:flex-col tw:justify-around tw:px-4 tw:py-5">

                    <div class="tw:flex tw:justify-between tw:gap-x-8 tw:mb-6">
                        <div class="tw:flex tw:flex-col tw:gap-y-4 tw:w-1/2">
                            <div class="input">
                                <label class="tw:text-base tw:font-bold" style="font-size: 14px;"> Train name</label>
                                <input type="text" class="tw:w-full tw:p-4 tw:border tw:rounded tw:text-base">
                            </div>
                            <div class="input">
                                <label class="tw:text-base tw:font-bold" style="font-size: 14px;"> Type</label>
                                <input type="text" class="tw:w-full tw:p-4 tw:border tw:rounded tw:text-base">
                            </div>
                        </div>

                        <div class="tw:flex tw:flex-col tw:gap-y-4 tw:w-1/2">
                            <div class="input">
                                <label class="tw:text-base tw:font-bold" style="font-size: 14px;"> Capacity</label>
                                <input type="text" class="tw:w-full tw:p-4 tw:border tw:rounded tw:text-base">
                            </div>
                            <div class="input">
                                <label class="tw:text-base tw:font-bold" style="font-size: 14px;"> Max Velocity</label>
                                <input type="text" class="tw:w-full tw:p-4 tw:border tw:rounded tw:text-base">
                            </div>
                        </div>
                    </div>

                    <div class="tw:mb-4 tw:flex tw:flex-col tw:items-center">
                        <label class="tw:text-base tw:mb-2 tw:block tw:font-bold">
                            Classes
                        </label>
                        <div class="tw:flex tw:gap-x-8 tw:justify-center">
                            <label class="tw:flex tw:items-center tw:text-sm tw:py-0.5 tw:font-bold"> <input type="checkbox" class="tw:mr-2 tw:h-5 tw:w-5 tw:rounded"> Turist
                            </label>
                            <label class="tw:flex tw:items-center tw:text-sm tw:py-0.5 tw:font-bold">
                                <input type="checkbox" class="tw:mr-2 tw:h-5 tw:w-5 tw:rounded"> Normal
                            </label>
                            <label class="tw:flex tw:items-center tw:text-sm tw:py-0.5 tw:font-bold">
                                <input type="checkbox" class="tw:mr-2 tw:h-5 tw:w-5 tw:rounded"> VIP
                            </label>
                        </div>
                    </div>

                    <div class="tw:flex tw:justify-center tw:gap-x-8 tw:mb-2">
                        <div>
                            <label class="tw:text-base tw:font-bold" style="font-size: 14px;"> Turist Seats</label>
                            <input type="text" class="tw:mr-2 tw:h-7 tw:w-8 tw:text-base">
                        </div>
                        <div>
                            <label class="tw:text-base tw:font-bold" style="font-size: 14px;"> VIP Seats</label>
                            <input type="text" class="tw:mr-2 tw:h-7 tw:w-8 tw:text-base">
                        </div>
                        <div>
                            <label class="tw:text-base tw:font-bold" style="font-size: 14px;"> Normal Seats</label>
                            <input type="text" class="tw:mr-2 tw:h-7 tw:w-8 tw:text-base">
                        </div>
                    </div>

                </div>

                <div id="btnBottom" class="tw:h-auto tw:flex tw:justify-center tw:items-center tw:pb-5 tw:w-full">
                    <button class="tw:w-1/3 tw:h-auto tw:bg-green-500 hover:tw:bg-green-600 tw:text-black tw:text-xl tw:font-bold tw:py-2.5 tw:px-6 tw:rounded-lg">Confirm</button>
                </div>
            </form>

        </div>
    </div>
</div>

</body>
</html>