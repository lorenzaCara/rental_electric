<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="text-white bg-gray-900 dark max-w-screen-xl mx-auto">
    <header class="flex justify-between p-4">
        <span class="text-3xl font-semibold">Logo</span>
        <nav>
            <ul class="flex gap-2">
                <li><a href="#">Page 1</a></li>
                <li><a href="#">Page 2</a></li>
            </ul>
        </nav>
    </header>
    <main id="main-container">
        @yield('content')
    </main>
</body>

</html>
