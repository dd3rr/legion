<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Fuente Cinzel --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased">

    {{-- Fondo --}}
    <div class="min-h-screen bg-cover bg-center bg-no-repeat relative"
         style="background-image: url('https://i1-c.pinimg.com/1200x/31/0d/46/310d46c63db719604362e80d76ed9afd.jpg');">

        {{-- Capa oscura --}}
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>

        {{-- Contenido --}}
        <div class="relative z-10 min-h-screen flex flex-col items-center justify-center px-6">
            {{ $slot }}
        </div>

    </div>

</body>
</html>