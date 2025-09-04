{{-- Mobile Top Navbar (visible only on small screens) --}}
<nav class="bg-white border-b border-gray-200 shadow fixed top-0 left-0 right-0 z-50 md:hidden mb-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex justify-between items-center h-16 space-x-4">
            <!-- Admin Panel Label -->
            <a href="{{ route('superuser.dashboard') }}">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-cogs text-red-600 animate-pulse"></i>
                    <span class="text-red-600 font-extrabold uppercase tracking-wide select-none text-lg">
                        Admin Panel
                    </span>
                </div>
            </a>

            <!-- Menu Links -->
            <div class="flex  flex-shrink-0">
                <a href="{{ route('admin1.categories.index') }}"
                   class="flex items-center whitespace-nowrap font-semibold px-3 py-2
       {{ request()->routeIs('admin1.categories.index') ? 'text-red-600' : 'text-gray-700 hover:text-red-600' }}">
                    <i class="fas fa-tags mr-1"></i> Categories
                </a>
                <a href="{{ route('admin1.products.index') }}"
                   class="flex items-center whitespace-nowrap font-semibold px-3 py-2
       {{ request()->routeIs('admin1.products.index') ? 'text-red-600' : 'text-gray-700 hover:text-red-600' }}">
                    <i class="fas fa-boxes mr-1"></i> Products
                </a>
                <a href="{{ route('admin1.orders.index') }}"
                   class="flex items-center whitespace-nowrap font-semibold px-3 py-2
       {{ request()->routeIs('admin1.orders.index') ? 'text-red-600' : 'text-gray-700 hover:text-red-600' }}">
                    <i class="fas fa-shopping-cart mr-1"></i> Orders
                </a>
            </div>

        </div>
    </div>
</nav>



{{-- Sidebar for desktop (hidden on mobile) --}}
<aside class="hidden md:flex w-64 bg-white shadow-xl p-6 flex flex-col select-none h-[1003px] flex-shrink-0">

    <h1 class="flex items-center text-xl font-extrabold mb-10 tracking-wide border-b border-gray-300 pb-5 select-none">

        <i class="fas fa-cogs mr-4 text-red-600 text-5xl animate-pulse drop-shadow-md"></i>

        <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-600 via-red-500 to-red-700 uppercase tracking-widest">
            Admin Panel
        </span>

        <span class="ml-4 h-10 w-1 bg-red-600 rounded-full"></span>
    </h1>

    @php
        $currentRoute = Route::currentRouteName();
    @endphp

    <nav class="flex-1 overflow-y-auto">
        <ul class="space-y-6">

            <li>
                <a href="{{ route('superuser.dashboard') }}"
                   class="flex items-center rounded-lg px-4 py-3 font-semibold group focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-1 focus:ring-offset-white
                    {{ $currentRoute === 'superuser.dashboard'
                        ? 'bg-red-50 text-red-700'
                        : 'text-gray-700 hover:text-red-600 hover:bg-red-50' }}">
                    <i class="fa-solid fa-chart-line mr-3 text-lg w-6 text-center
                    {{ $currentRoute === 'superuser.dashboard' ? 'text-red-700' : 'text-red-500 group-hover:text-red-700' }}"></i>
                    <span class="text-base">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin1.categories.index') }}"
                   class="flex items-center rounded-lg px-4 py-3 font-semibold group focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-1 focus:ring-offset-white
                    {{ $currentRoute === 'admin1.categories.index'
                        ? 'bg-red-50 text-red-700'
                        : 'text-gray-700 hover:text-red-600 hover:bg-red-50' }}">
                    <i class="fas fa-tags mr-3 text-lg w-6 text-center
                    {{ $currentRoute === 'admin1.categories.index' ? 'text-red-700' : 'text-red-500 group-hover:text-red-700' }}"></i>
                    <span class="text-base">Categories</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin1.products.index') }}"
                   class="flex items-center rounded-lg px-4 py-3 font-semibold group focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-1 focus:ring-offset-white
                    {{ $currentRoute === 'admin1.products.index'
                        ? 'bg-red-50 text-red-700'
                        : 'text-gray-700 hover:text-red-600 hover:bg-red-50' }}">
                    <i class="fas fa-boxes mr-3 text-lg w-6 text-center
                    {{ $currentRoute === 'admin1.products.index' ? 'text-red-700' : 'text-red-500 group-hover:text-red-700' }}"></i>
                    <span class="text-base">Products</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin1.orders.index') }}"
                   class="flex items-center rounded-lg px-4 py-3 font-semibold group focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-1 focus:ring-offset-white
                    {{ $currentRoute === 'admin1.orders.index'
                        ? 'bg-red-50 text-red-700'
                        : 'text-gray-700 hover:text-red-600 hover:bg-red-50' }}">
                    <i class="fa-solid fa-cart-shopping mr-3 text-lg w-6 text-center
                    {{ $currentRoute === 'admin1.orders.index' ? 'text-red-700' : 'text-red-500 group-hover:text-red-700' }}"></i>
                    <span class="text-base">Orders</span>
                </a>
            </li>
        </ul>
    </nav>


    <footer class="mt-10 pt-6 border-t border-gray-200 text-sm text-gray-400 text-center select-text">
        &copy; {{ date('Y') }} Niyaa Crackers
    </footer>
</aside>

{{-- Main content area, add padding on mobile for sticky top nav --}}
<div class="md:ml-64 pt-16 md:pt-8">
    @yield('page-content')
</div>
