<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link rel="stylesheet" href="../css/app.css">

@vite(['resources/css/app.css'])

            <style>
            </style>
    </head>

    <body>
    <x-nav-bar title="Título de la tarjeta">
    Contenido principal de la tarjeta

    <x-slot name="footer">
        Pie de tarjeta
    </x-slot>
</x-nav-bar>

    <h2 class="">
        holas
    </h2>

    </body>
</html>
