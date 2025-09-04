<div>
    @include('components.text-banner')
</div>
<div class="-mb-10">
<div>
    <header class="w-full shadow">
        <!-- Top strip: Delivery + Social -->
        <div class="bg-red-600 text-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 py-2 flex items-center justify-between text-sm">

                <!-- Delivery Section -->
                <div class="flex flex-col sm:flex-row items-center gap-2 bg-white/10 px-2 py-0.5 sm:px-3 sm:py-1 rounded-full shadow-inner -ml-4 sm:-ml-6">
                    <div class="bg-white text-red-600 p-1 rounded-full sm:p-1.5 animate-bounce">
                        <i class="fa-solid fa-truck text-xs sm:text-sm"></i>
                    </div>
                    <span class="font-semibold tracking-wide text-[8px]">Delivery Available</span>
                </div>


                <!-- Social Icons -->
                <div class="flex items-center gap-3 sm:gap-1 -mr-3">
                    <a href="https://www.instagram.com/niyaacrackersworld/"
                       target="_blank" rel="noopener"
                       aria-label="Instagram"
                       class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center rounded-full bg-white/10 hover:bg-pink-500 hover:text-white transition">
                        <i class="fa-brands fa-instagram text-xs sm:text-lg"></i>
                    </a>
                    <a href="https://www.facebook.com/people/NCW-Niyaa/61562282244774/"
                       target="_blank" rel="noopener"
                       aria-label="Facebook"
                       class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center rounded-full bg-white/10 hover:bg-blue-600 hover:text-white transition">
                        <i class="fa-brands fa-facebook-f text-xs sm:text-lg"></i>
                    </a>
                    <a href="https://www.youtube.com/@NiyaaCrackersWorldNCW"
                       target="_blank" rel="noopener"
                       aria-label="YouTube"
                       class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center rounded-full bg-white/10 hover:bg-red-600 hover:text-white transition">
                        <i class="fa-brands fa-youtube text-xs sm:text-lg"></i>
                    </a>
                </div>


            </div>
        </div>


        <!-- Logo banner with trapezoid -->
        <div class="relative bg-white">
            <div class="max-w-7xl mx-auto px-4">
                <div class="relative flex justify-center items-center py-8">
                    <!-- Logo -->
                    <div class="relative z-10 text-center select-none mt-2">
                        <img
                            src="{{ asset('logo/logo-3.png') }}"
                            alt="NCW Logo"
                            class="mx-auto -mt-20 max-w-xs sm:max-w-md lg:max-w-lg"
                        >
                    </div>
                </div>
            </div>
        </div>


    </header>

    <style>
        .clip-trapezoid {
            clip-path: polygon(0 0, 100% 0, 85% 100%, 15% 100%);
        }
    </style>
</div>

<!-- Nav Bar Starts Here  -->
    <nav class="bg-white shadow-md sticky top-0 z-50 border-t border-b border-red-200 mb-6 -mt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">

                <!-- Left: Location -->
                <a href="https://www.google.com/maps/place/Niyaa+Crackers+World+-+Exclusive+Dealer+%26+Showroom+For+%22Standard+Fireworks%22/@8.8510648,78.4369029,10z/data=!4m6!3m5!1s0x3b06cf0f68aac305:0x1181d9445524fa0b!8m2!3d9.4360389!4d77.8156284!16s%2Fg%2F11w2_dqycm?entry=ttu&g_ep=EgoyMDI1MDgxOC4wIKXMDSoASAFQAw%3D%3D"
                   target="_blank"
                   class="flex items-center space-x-2 text-red-600 font-semibold cursor-pointer hover:text-red-700 transition">
                    <i class="fa-solid fa-location-dot"></i>
                    <span class="hidden sm:inline text-gray-700">Find Store Location</span>
                </a>

                <!-- Center: Menu for md and up -->
                <div class="hidden md:flex space-x-8">
                    <a href="/"
                       class="relative pb-1 text-gray-700 hover:text-red-500 {{ request()->is('/') ? 'text-red-600 font-semibold after:w-full' : '' }}
                  after:content-[''] after:block after:h-[2px] after:bg-red-600 after:transition-all after:duration-300 after:w-0 hover:after:w-full">
                        Home
                    </a>
                    <a href="https://niyaacrackers.com/standard-fireworks-online-about-us/"
                       class="relative pb-1 text-gray-700 hover:text-red-500 {{ request()->is('about') ? 'text-red-600 font-semibold after:w-full' : '' }}
                  after:content-[''] after:block after:h-[2px] after:bg-red-600 after:transition-all after:duration-300 after:w-0 hover:after:w-full">
                        About Us
                    </a>
                    <a href="/shop"
                       class="relative pb-1 text-gray-700 hover:text-red-500 {{ request()->is('shop') ? 'text-red-600 font-semibold after:w-full' : '' }}
                  after:content-[''] after:block after:h-[2px] after:bg-red-600 after:transition-all after:duration-300 after:w-0 hover:after:w-full">
                        Shop
                    </a>
                    <a href="/quick-order"
                       class="relative pb-1 text-gray-700 hover:text-red-500 {{ request()->is('quick-order.index') ? 'text-red-600 font-semibold after:w-full' : '' }}
                  after:content-[''] after:block after:h-[2px] after:bg-red-600 after:transition-all after:duration-300 after:w-0 hover:after:w-full">
                        Quick Order
                    </a>
                    <a href="https://niyaacrackers.com/fireworks-sellers-contact-us/"
                       class="relative pb-1 text-gray-700 hover:text-red-500 {{ request()->is('contact') ? 'text-red-600 font-semibold after:w-full' : '' }}
                  after:content-[''] after:block after:h-[2px] after:bg-red-600 after:transition-all after:duration-300 after:w-0 hover:after:w-full">
                        Contact Us
                    </a>
                </div>

                <!-- Right: Phone for md+, Hamburger for mobile -->
                <div class="flex items-center">
                    <!-- Call button visible on md and up -->
                    <a href="tel:+919962201775"
                       class="hidden md:flex bg-red-600 hover:bg-red-700 transition px-4 py-2 rounded-lg flex items-center space-x-2 text-white shadow-md">
                        <i class="fa-solid fa-phone"></i>
                        <span>+91 99622 01775</span>
                    </a>

                    <!-- Hamburger button visible on mobile only -->
                    <button id="menu-btn" class="md:hidden focus:outline-none ml-0">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                             stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" y1="12" x2="21" y2="12"/>
                            <line x1="3" y1="6" x2="21" y2="6"/>
                            <line x1="3" y1="18" x2="21" y2="18"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu, hidden by default -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-b border-red-200 shadow-md">
            <div class="px-4 pt-4 pb-6 space-y-4">
                <a href="/" class="block text-red-600 font-semibold">Home</a>
                <a href="https://niyaacrackers.com/standard-fireworks-online-about-us/" class="block text-gray-700 hover:text-red-600">About Us</a>
                <a href="/shop" class="block text-gray-700 hover:text-red-600">Shop</a>
                <a href="/quick-order" class="block text-gray-700 hover:text-red-600">Quick Order</a>
                <a href="https://niyaacrackers.com/fireworks-sellers-contact-us/" class="block text-gray-700 hover:text-red-600">Contact Us</a>
            </div>
        </div>
    </nav>

    <script>
        const btn = document.getElementById('menu-btn');
        const menu = document.getElementById('mobile-menu');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>

</div>
