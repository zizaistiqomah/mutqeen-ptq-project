<nav class="sticky top-0 z-50 bg-white border-b shadow-sm">

    <div class="px-6 py-3 flex items-center justify-between">

        <!-- LEFT: LOGO -->
        <div class="flex items-center gap-3">

            <a href={{ route('home') }} class="logo"><img src="/assets/img/Logo-PTQ.png" alt="" class="w-12 h-17"></a>
        <h1 class="logo me-5 ms-2 font-bold  " style="font-size: 16px;"><a href={{ route('home') }}>Mutqeen<br>Pusat Tahfidz Al-Qur'an</a></h1>


        </div>

        <!-- CENTER: GREETING -->
        <div class="hidden md:block text-center" style="font-size: 22px;">
            <p class="text-sm md:text-lg">
                Assalamualaikum, 
                <span class="font-bold">{{ auth()->user()->name }}</span>!
            </p>
            <p class="text-xs text-gray-500">
                    Terus melangkah walau hanya satu ayat, karena langkah kecilmu sangat berarti
                </p>
        </div>

        <!-- RIGHT: PROFILE -->
        <div class="flex items-center gap-3 bg-white border border-[#075f7c] px-4 py-2 rounded-xl shadow-sm">

            <!-- Avatar -->
            <img 
                src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=075f7c&color=ffffff"
                class="w-9 h-9 rounded-full">

            <!-- Dropdown -->
            @if (Auth::check())
                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">
                        <button class="flex items-center gap-2 text-sm font-medium text-gray-800">

                            <div class="text-left hidden sm:block">
                                <p class="font-semibold leading-tight">
                                    {{ Auth::user()->name }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    {{ Auth::user()->role }}
                                </p>
                            </div>

                            <i class="fa-solid fa-chevron-down text-xs text-gray-500"></i>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('dashboard.' . Auth::user()->role)">
                            Dashboard
                        </x-dropdown-link>

                        @if (Auth::user()->role_id != config('constants.ROLE_ADMIN'))
                            <x-dropdown-link :href="route('profile.index')">
                                Profile
                            </x-dropdown-link>
                        @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>

                </x-dropdown>
            @endif

        </div>

    </div>

</nav>