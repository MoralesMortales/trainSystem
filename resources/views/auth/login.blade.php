<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrainSystem</title>
    @vite(['resources/css/app.css'])
    @vite(['resources/css/login.css'])
</head>

<body>
    <div id="container">
        <x-navbar />
        <div id="boxContainer" class="tw:h-10/12 tw:w-full tw:flex tw:justify-center tw:items-center">
            <div class="box tw:w-8/12 tw:h-10/12">
                <div id="TopTitle" class="tw:text-4xl tw:pt-10 tw:flex tw:justify-center tw:items-center tw:h-1/6">
                    <h4>Sign In</h4>
                </div>

                <form action="{{ route('login.submit') }}" class="tw:h-full" method="post">
                    @csrf
                    <div id="inputs" class="tw:h-4/6 tw:pt-14 tw:flex tw:items-center tw:justify-center tw:flex-col">

                        <div id="mainInput" style="margin-top:-5em;"
                            class="tw:flex tw:justify-around tw:h-4/6 tw:items-center tw:flex-col tw:w-full">

                            <div id="inputBox_1" class="input">
                                <label for="">Email</label>
                                <input name="email" type="email">

                            </div>

                            <div id="inputBox_2" class="input">
                                <label for="">Password</label>
                                <input name="password" type="text">
                            </div>

                            @error('email')
                                <span class="tw:text-red-500 error">{{ $message }}</span>
                            @enderror

                        </div>

                        <div id="forgotPass" class="tw:w-full tw:flex tw:justify-end tw:pr-44">
                            <h4>
                                Forgot Password?
                            </h4>
                        </div>

                        <div id="checkEmployee" class="tw:w-full tw:flex tw:justify-start tw:pl-52 tw:gap-4">
                            <input type="checkbox">
                            <h4>
                                Im employee
                            </h4>
                        </div>
                    </div>

                    <div id="btnBottom" class="tw:h-1/6 tw:flex tw:justify-center tw:items-center tw:pb-36 tw:w-full">
                        <button class="tw:w-60  tw:h-20 tw:bg-green-200 tw:text-2xl tw:font-bold">
                            Confirm
                        </button>

                    </div>


                </form>

            </div>


        </div>
    </div>

</body>

</html>
