<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Website')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">
    @include('partials.header')

    <main class="pt-20 p-4">
        @yield('content')
    </main>

    @vite('resources/js/app.js')
</body>
</html>