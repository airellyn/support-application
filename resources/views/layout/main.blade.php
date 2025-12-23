<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-gray-100">

    <div class="flex">

        {{-- Sidebar --}}
        @include('layout.sidebar')

        {{-- Main Content --}}
        <main class="ml-52 p-6 transition-all duration-300">
            @yield('content')
        </main>
    </div>

</body>
</html>
