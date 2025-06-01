<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TrainSystem</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

@vite(['resources/css/app.css'])
@vite(['resources/css/mainView.css'])

    </head>

    <body>
    <div id="container">
    <x-nav-bar/>

    <h2 class="title text-6xl">
        Book Your Next Travel
    </h2>

    <h4 class="title text-5xl">
    Title two
    </h4>

    </div>

    </body>
</html>
