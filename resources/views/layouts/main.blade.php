<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BBRSEKP</title>

    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-800">

    @include('components.navbar')

    <main class="min-h-screen">
        @yield('content')
    </main>

    @include('components.footer')

</body>
</html>