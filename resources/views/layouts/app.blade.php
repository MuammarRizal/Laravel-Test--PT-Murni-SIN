<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'My Website')</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 text-gray-800">
  @include('partials.header')

  <main>
    @yield('content')
  </main>
  @include('partials.footer')
  @vite('resources/js/app.js')
</body>

</html>
