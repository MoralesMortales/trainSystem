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
    <x-nav-bar/>
<div id="boxContainer" class="h-10/12 w-full flex justify-center items-center">
<div class="box w-8/12 h-9/12">
<div id="TopTitle" class="text-4xl pt-10 flex justify-center items-center h-1/6">
<h4>Sign In</h4>
</div>

<form action="{{ url('/login') }}" class="h-full" method="post">
@csrf
<div id="inputs" class="h-4/6 pt-14 flex items-center justify-center flex-col">

<div id="mainInput" style="margin-top:-5em;" class="flex justify-around h-4/6 items-center flex-col w-full">

<div id="inputBox_1" class="input">
<label for="">Email</label>
<input name="login" type="text">
</div>

<div id="inputBox_2" class="input">
<label for="">Password</label>
<input name="password" type="text">
</div>

</div>

<div id="forgotPass" class="w-full flex justify-end pr-44">
<h4>
Forgot Password?
</h4>
</div>

<div id="checkEmployee" class="w-full flex justify-start pl-52 gap-4">
<input type="checkbox">
<h4>
Im employee
</h4>
</div>
</div>

<div id="btnBottom" class="h-1/6 flex justify-center items-center w-full">
<button class="w-60 h-20 mb-20 bg-green-200 text-2xl font-bold">Confirm</button>

</div>


</form>

</div>


</div>
</div>

</body>
</html>
