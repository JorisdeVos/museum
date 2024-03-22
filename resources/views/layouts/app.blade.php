<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Ensure this line is present -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.3/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-beige font-serif">

    <header class="bg-gray-200 p-4 bg-base-300 text-base-content">
        <div class="navbar bg-base-100">
            <a class="btn btn-ghost text-xl">daisyUI</a>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <footer class="footer footer-center p-4 bg-base-300 text-base-content">
        <aside>
          <p>Copyright © 2024 - All right reserved by ACME Industries Ltd</p>
        </aside>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts') <!-- Include additional scripts specific to each page -->
</body>
</html>
