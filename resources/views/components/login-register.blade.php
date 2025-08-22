<header class="w-full text-sm **fixed top-0 right-0** z-10 p-6 lg:p-8 -mb-5">
    @if (Route::has('login'))
        <nav class="flex items-center justify-end gap-4">
            @auth
                <a
                    href="{{ url('/quick-purchase') }}"
                    class="inline-block px-5 py-1.5 rounded-sm text-sm font-medium leading-normal text-white
           bg-gradient-to-r from-purple-500 via-blue-500 to-pink-500
           hover:brightness-110 transition duration-300"
                >
                    Quick Purchase
                </a>

            @else
                <a
                    href="{{ route('login') }}"
                    class="inline-block px-5 py-1.5 text-[#1b1b18] border border-transparent hover:border-[#19140035] rounded-sm text-sm leading-normal"
                >
                    Log in
                </a>

                @if (Route::has('register'))
                    <a
                        href="{{ route('register') }}"
                        class="inline-block px-5 py-1.5 border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] rounded-sm text-sm leading-normal">
                        Register
                    </a>
                @endif
            @endauth
        </nav>
    @endif
</header>
