@extends('components.layouts.admin')

@section('content')
    <!-- Top Navbar -->
    <nav class="bg-red-600 flex justify-between items-center px-6 py-4 mt-10 shadow-lg">
        <div class="flex items-center space-x-4">
            <div class="relative w-32 h-20 bg-white border-4 border-red-600 shadow-lg rounded-xl overflow-hidden flex items-center justify-center">
                <img src="{{ asset('logo/logo-3.png') }}" alt="Logo" class="object-contain w-full h-full" />
                <!-- Optional subtle overlay for brand accent -->
                <div class="absolute inset-0 bg-gradient-to-t from-red-500/20 via-transparent to-transparent"></div>
            </div>
            <span class="text-white font-extrabold text-3xl tracking-tight drop-shadow-md">
        Dashboard
    </span>
        </div>


        <div class="relative">
            <button id="profileBtn"
                    class="w-12 h-12 bg-white text-red-600 rounded-full flex items-center justify-center font-bold border-2 border-red-500 hover:shadow-lg transition-shadow focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-400">
                {{ strtoupper(substr($superUser['name'], 0, 2)) }}
            </button>
            <div id="profileDropdown"
                 class="absolute right-0 mt-3 w-64 bg-white border border-gray-300 rounded-lg shadow-xl z-50 opacity-0 invisible transform scale-95 transition-all duration-150 ease-in-out origin-top-right"><div class="flex flex-col p-4 border-b border-gray-200 space-y-1">
                    <div class="flex items-center space-x-2">
                        <i class="fa-solid fa-user text-red-600"></i>
                        <span class="text-lg font-semibold text-red-600 truncate">
                            {{ \Illuminate\Support\Str::upper($superUser['name']) }}
                        </span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-gray-700 truncate">{{ $superUser['email'] }}</span>
                    </div>
                </div>

                <form method="POST" action="{{ route('superuser.logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full px-4 py-3 text-left text-red-600 hover:bg-red-50 font-semibold transition-colors flex items-center space-x-2">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <span>Sign out</span>
                    </button>
                </form>


            </div>
        </div>
    </nav>

    <div class="flex">
        <!-- Your Sidebar HTML goes here; use your current sidebar -->

        <!-- Main dashboard area -->
        <main class="flex-1 p-10 bg-gray-50 min-h-screen">
            <h1 class="text-4xl font-bold text-red-600 mb-8">Welcome, {{ ucfirst($superUser['name']) }} <span class="text-red-500"><i class="fa-regular fa-face-smile"></i></span></h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white border border-red-100 p-8 rounded-xl shadow hover:shadow-lg transition-shadow text-red-600 font-semibold">
                    Have a Great Day!
                </div>
                <div class="bg-white border border-red-100 p-8 rounded-xl shadow hover:shadow-lg transition-shadow text-red-600 font-semibold">
                    Stay Happy!
                </div>
            </div>
        </main>
    </div>

    <script>
        const profileBtn = document.getElementById('profileBtn');
        const dropdown = document.getElementById('profileDropdown');

        profileBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            if (dropdown.classList.contains('opacity-0')) {
                dropdown.classList.remove('opacity-0', 'invisible', 'scale-95');
                dropdown.classList.add('opacity-100', 'visible', 'scale-100');
            } else {
                dropdown.classList.add('opacity-0', 'invisible', 'scale-95');
                dropdown.classList.remove('opacity-100', 'visible', 'scale-100');
            }
        });

        document.addEventListener('click', function() {
            if (!dropdown.classList.contains('opacity-0')) {
                dropdown.classList.add('opacity-0', 'invisible', 'scale-95');
                dropdown.classList.remove('opacity-100', 'visible', 'scale-100');
            }
        });
    </script>
@endsection
