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
        <x-navbar/>
    <div id="boxContainer" class="tw:h-10/12 tw:w-full tw:flex tw:justify-center tw:items-center">
        <div class="box tw:w-8/12 tw:h-9/12">
            <div id="TopTitle" class="tw:text-4xl tw:pt-10 tw:flex tw:justify-center tw:items-center tw:h-1/6">
                <h4>Register</h4>
            </div>

            <form action="" class="tw:h-full">

                <div id="inputs" class=" tw:h-3/6 tw:pt-14 tw:flex tw:items-center tw:justify-center tw:flex-col">

                    <div id="mainInput" style="margin-top:-5em;" class="tw:flex tw:justify-around tw:h-4/6 tw:items-center tw:flex-col tw:w-full">
                        <div id="inputBox_1" class="input tw:mb-4"> <!-- Añade mb-4 (margin-bottom) -->
                            <label style="font-size: 18px;">Email</label>
                            <input type="text">
                        </div>

                        <div id="inputBox_2" class="input tw:mb-4">
                            <label style="font-size: 18px;">Cedula</label>
                            <input type="text">
                        </div>

                        <div id="inputBox_3" class="input tw:mb-4">
                            <label style="font-size: 18px;">Password</label>
                            <input type="text">
                        </div>

                        <div id="inputBox_4" class="input">
                            <label style="font-size: 18px;">Confirm Password</label>
                            <input type="text">
                        </div>
                    </div>

                </div>

                <div id="btnBottom" class="tw:h-3/6 tw:flex tw:justify-center tw:items-center tw:pb-20 tw:w-full">
                    <button class="tw:w-50 tw:h-15 tw:mb-10 tw:bg-green-200 tw:text-2xl tw:font-bold">Confirm</button>
                </div>

            </form>

        </div>

    </div>
</div>

</body>
</html>
