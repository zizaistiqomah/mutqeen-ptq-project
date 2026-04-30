<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengurus</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- ICON --}}
    <link rel="stylesheet"
        href="https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css">

    {{-- FONT AWESOME --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
</head>

<body class="bg-[#F5F7FB] min-h-screen">

    <div class="flex">

        {{-- SIDEBAR --}}
        <aside class="w-[270px] min-h-screen bg-white fixed left-0 top-0 px-6 py-8 border-r border-gray-100">

            {{-- LOGO --}}
            <div class="flex items-center gap-3 mb-10">

                <a href="{{ route('home') }}">
                    <img
                        src="/assets/img/Logo-PTQ.png"
                        alt="Logo PTQ"
                        class="w-12 h-auto"
                    >
                </a>

                <div>
                    <h2 class="font-bold text-2xl text-[#075F7C] leading-tight">
                        Mutqeen
                    </h2>

                    <p class="text-sm text-[#075F7C] leading-tight">
                        Dashboard Pengurus
                    </p>
                </div>

            </div>

            {{-- MENU --}}
            <nav class="space-y-3">

                {{-- DASHBOARD --}}
                <a href="#"
                    class="flex items-center gap-4 px-4 py-3 rounded-2xl bg-[#075F7C] text-white font-medium">

                    <i class="fi fi-rr-apps text-lg"></i>

                    Dashboard
                </a>

                {{-- HALAQAH --}}
                <a href="#"
                    class="flex items-center gap-4 px-4 py-3 rounded-2xl hover:bg-[#075F7C] hover:text-white text-[#075F7C] transition font-medium">

                    <i class="fi fi-rr-user text-lg"></i>

                    Halaqah
                </a>
                

                {{-- SANTRI --}}
                <a href="#"
                    class="flex items-center gap-4 px-4 py-3 rounded-2xl hover:bg-[#075F7C] hover:text-white text-[#075F7C] transition font-medium">

                    <i class="fi fi-rr-user text-lg"></i>

                    Data Santri
                </a>

                {{-- PENYIMAK --}}
                <a href="#"
                    class="flex items-center gap-4 px-4 py-3 rounded-2xl hover:bg-[#075F7C] hover:text-white text-[#075F7C] transition font-medium">

                    <i class="fi fi-rr-headphones text-lg"></i>

                    Data Penyimak
                </a>

                {{-- LAPORAN --}}
                <a href="#"
                    class="flex items-center gap-4 px-4 py-3 rounded-2xl hover:bg-[#075F7C] hover:text-white text-[#075F7C] transition font-medium">

                    <i class="fi fi-rr-chart-line-up text-lg"></i>

                    Laporan Tahfidz
                </a>

            </nav>

            {{-- LOGOUT --}}
            <div class="absolute bottom-8 left-6 right-6">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl
                               text-red-500 hover:bg-red-50 transition font-medium"
                    >
                        <i class="fi fi-rr-sign-out-alt text-lg"></i>

                        Logout
                    </button>
                </form>

            </div>

        </aside>

        {{-- MAIN CONTENT --}}
        <main class="ml-[270px] flex-1 min-h-screen">

            {{-- TOPBAR --}}
            <nav class="sticky top-0 z-40 bg-white border-b border-gray-100 shadow-sm">

                <div class="px-8 py-4 flex items-center justify-between">

                    {{-- GREETING --}}
                    <div>

                        <p class="text-lg font-medium text-gray-800">
                            Assalamualaikum,
                            <span class="font-bold">
                                {{ auth()->user()->name }}
                            </span> 
                        </p>

                        <p class="text-sm text-gray-500 mt-1">
                            Kelola halaqah dan pantau perkembangan tahfidz santri
                        </p>

                    </div>

                    {{-- RIGHT SECTION --}}
                    <div class="flex items-center gap-4">

                        {{-- PROFILE DROPDOWN --}}
                        <x-dropdown align="right" width="56">

                            <x-slot name="trigger">

                                <button
                                    class="flex items-center gap-3 px-3 py-2 rounded-2xl
                                           bg-white hover:bg-gray-50 transition border"
                                >

                                    <img
                                        src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=075F7C&color=fff"
                                        class="w-10 h-10 rounded-full"
                                    >

                                    <div class="text-start hidden md:block">

                                        <p class="font-semibold text-sm text-gray-800 m-0">
                                            {{ Auth::user()->name }}
                                        </p>

                                        <p class="capitalize text-xs text-gray-500 m-0">
                                            {{ Auth::user()->role }}
                                        </p>

                                    </div>

                                    <i class="fa-solid fa-chevron-down text-xs text-gray-400"></i>

                                </button>

                            </x-slot>

                            <x-slot name="content">

                                <x-dropdown-link :href="route('dashboard.' . Auth::user()->role)">
                                    Dashboard
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('profile.index')">
                                    Profile
                                </x-dropdown-link>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link
                                        :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                    >
                                        Logout
                                    </x-dropdown-link>

                                </form>

                            </x-slot>

                        </x-dropdown>

                    </div>

                </div>

            </nav>

            {{-- CONTENT --}}
            <div class="p-10">

                @yield('content')

            </div>

        </main>

    </div>

</body>
</html>