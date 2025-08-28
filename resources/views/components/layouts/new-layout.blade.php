<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Crackers Shop' }}</title>


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">

    <!-- Global Font Style -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>


    {{--        <!-- Scripts -->--}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <!-- Styles -->
    @livewireStyles
</head>
<body>
    <section>
        @include('components.navbar')
    </section>

    <main>
        @yield('content')
    </main>

    <section>
        @include('components.footer')
    </section>

    @livewireScripts

{{--    <div id="pageSpinner" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden space-x-2">--}}
{{--        <div class="w-6 h-6 bg-red-600 animate-spin rounded-sm"></div>--}}
{{--        <div class="w-6 h-6 bg-white animate-spin animation-delay-200 rounded-sm"></div>--}}
{{--        <div class="w-6 h-6 bg-red-600 animate-spin animation-delay-400 rounded-sm"></div>--}}
{{--    </div>--}}

{{--    <style>--}}
{{--        .animation-delay-200 { animation-delay: 0.2s; }--}}
{{--        .animation-delay-400 { animation-delay: 0.4s; }--}}
{{--    </style>--}}


    <div id="pageSpinner" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden space-x-3">
        <div class="w-5 h-5 rounded-full bg-red-600 animate-pulse"></div>
        <div class="w-5 h-5 rounded-full bg-white animate-pulse animation-delay-150"></div>
        <div class="w-5 h-5 rounded-full bg-red-600 animate-pulse animation-delay-300"></div>
    </div>

    <style>
        .animation-delay-150 { animation-delay: 0.15s; }
        .animation-delay-300 { animation-delay: 0.3s; }
    </style>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('form');
            const spinner = document.getElementById('pageSpinner');

            form.addEventListener('submit', function () {
                spinner.classList.remove('hidden');
            });
        });
    </script>
</body>

</html>
