<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-beige font-serif">

    <header class="bg-gray-200 border-b-2 border-gray-300 p-4">
        <!-- Your header content here -->
    </header>

    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <footer class="bg-gray-200 border-t-2 border-gray-300 p-4">
        <!-- Your footer content here -->
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts') <!-- Include additional scripts specific to each page -->
</body>
</html>
