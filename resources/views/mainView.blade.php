<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TrainSystem</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Konkhmer+Sleokchher&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

@vite(['resources/css/app.css'])
@vite(['resources/css/mainView.css'])

    </head>

    <body>

    <div id="container">

    <x-navbar/>
<div class="titles tw:h-full tw:flex tw:flex-col tw:justify-center tw:pt-40 tw:pl-20 tw:gap-14">

    <h2 class="title" style="font-size:'32rem'">
        Book Your Next Travel
    </h2>

    <h4 class="title tw:text-5xl">
    Book Now!
    </h4>
</div>
    </div>

    </body>
</html>
