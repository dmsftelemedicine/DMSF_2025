<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Diabetes Teleconsultation') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Add DataTables CSS -->
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Scripts -->
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <!-- Global Preloader -->
    <div id="global-preloader" class="fixed inset-0 bg-white z-50 flex items-center justify-center">
        <div class="text-center items-center justify-center flex-col flex">
            <!-- Logo -->
            <div class="mb-6">
                <x-application-logo class="block h-16 w-auto mx-auto fill-current text-gray-800" />
            </div>

            <!-- Spinning Animation -->
            <div class="flex flex-col items-center">
                <div class="w-12 h-12 mb-4 relative">
                    <div class="absolute inset-0 border-4 border-blue-200 rounded-full"></div>
                    <div class="absolute inset-0 border-4 border-transparent border-t-blue-600 rounded-full animate-spin"></div>
                </div>
                <p class="text-gray-600 text-sm font-medium">Loading...</p>
            </div>
        </div>
    </div>

    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Global Preloader Script -->
<script>
    // Hide preloader when page is fully loaded
    window.addEventListener('load', function() {
        const preloader = document.getElementById('global-preloader');
        if (preloader) {
            // Add fade out animation
            preloader.style.transition = 'opacity 0.5s ease-out';
            preloader.style.opacity = '0';

            // Remove from DOM after animation
            setTimeout(() => {
                preloader.remove();
            }, 500);
        }
    });

    // Fallback: Hide preloader after 3 seconds if page hasn't loaded
    setTimeout(function() {
        const preloader = document.getElementById('global-preloader');
        if (preloader) {
            preloader.style.transition = 'opacity 0.5s ease-out';
            preloader.style.opacity = '0';
            setTimeout(() => {
                preloader.remove();
            }, 500);
        }
    }, 3000);
</script>

@stack('scripts')

</html>