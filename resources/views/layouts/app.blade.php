<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title')</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="max-w-screen-xl mx-auto text-white bg-gray-900 dark">
        <header class="flex justify-between p-4">
            <span class="text-3xl font-semibold">Rental Electric</span>
            <nav>
                <ul class="flex gap-4">
                    <li><a href="{{ route('vehicles.index') }}">Veicoli</a></li>
                    <li><a href="{{ route('customers.index') }}">Clienti</a></li>
                    <li><a href="{{ route('rentals.index') }}">Noleggi</a></li>
                </ul>
            </nav>
        </header>
        <main id="main-container" class="p-4">
            @yield('content')
        </main>
    </body>

</html>
