<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   trains
   @foreach ($trains as $train)
            <li>
                <a href="/trains/{{ $train->id }}">{{ $train->type }} (Capacidad: {{ $train->capacity }})</a>
            </li>
        @endforeach
</body>
</html>
