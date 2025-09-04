<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SuperUser Login</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-white flex items-center justify-center min-h-screen font-sans">
<div class="max-w-md w-full bg-white shadow-lg rounded-2xl overflow-hidden">
    <div class="bg-red-700 p-8 flex flex-col items-center rounded-t-2xl">
        <img src="{{ asset('logo/logo-3.png') }}" alt="Logo" class="w-50 h-auto mb-4" />  <!-- bigger logo width -->
        <h1 class="text-gray-200 text-center text-4xl font-extrabold mb-4 tracking-wide">
            LOGIN
        </h1>
    </div>

    <form method="POST" action="{{ route('superuser.login') }}" class="p-8 space-y-6">
        @csrf
        <div>
            <label for="email" class="block text-red-700 font-semibold mb-2">Email</label>
            <input type="email" name="email" id="email" required autofocus
                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-600" />
        </div>
        <div class="relative">
            <label for="password" class="block text-red-700 font-semibold mb-2">Password</label>
            <input type="password" name="password" id="password" required
                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-600 pr-10" />
            <button type="button" id="togglePassword" tabindex="-1"
                    class="absolute top-11 right-3 text-red-600 hover:text-red-800 focus:outline-none">
                <i class="fa-solid fa-eye" id="eyeIcon"></i>
            </button>
        </div>

        <!-- For Password Icon Show-->
        <script>
            const passwordInput = document.getElementById('password');
            const togglePasswordBtn = document.getElementById('togglePassword');
            const eyeIcon = document.getElementById('eyeIcon');

            togglePasswordBtn.addEventListener('click', () => {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                // Toggle eye / eye slash icon
                eyeIcon.classList.toggle('fa-eye');
                eyeIcon.classList.toggle('fa-eye-slash');
            });
        </script>

        <button type="submit" class="w-full bg-red-700 hover:bg-red-800 transition-colors text-white py-3 rounded-lg font-semibold text-lg">
            Login
        </button>
        @if($errors->any())
            <div class="text-red-600 mt-3 font-semibold text-center">
                {{ $errors->first() }}
            </div>
        @endif
    </form>
</div>

<!--Spinner Section-->
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
