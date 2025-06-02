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
<div class="titles h-full flex flex-col justify-center pt-40 pl-20 gap-14">

    <h2 class="title text-6xl">
        Book Your Next Travel
    </h2>

    <h4 class="title text-5xl">
    Book Now!
    </h4>
        @auth
Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate aliquam aut, corrupti eius doloribus dolore repudiandae repellendus qui nesciunt debitis veniam mollitia, cum voluptatem odit omnis, repellat nisi possimus deleniti.
    @endauth

</div>
    </div>

    </body>
</html>
