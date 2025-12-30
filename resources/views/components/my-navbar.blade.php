<header id="header" class="d-flex align-items-center">
    <div class="w-100 d-flex align-items-center justify-content-center">

        <a href={{ route('home') }} class="logo"><img src="/assets/img/logo_ukm.png" alt="" class="img-fluid"></a>
        <h1 class="logo me-5"><a href={{ route('home') }}>UKM Tahfidz Qur'an<br>Universitas Airlangga</a></h1>

        <nav id="navbar" class="navbar">
            <div class="mx-5">
                <ul>
                    <li><a class="nav-link scrollto {{ Route::currentRouteName() == 'home' ? 'active' : '' }}"
                            href={{ route('home') }}>Beranda</a></li>
                    <li>
                        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                            class="flex items-center justify-between font-bold w-full py-2 ml-4 !mr-0 rounded md:hover:bg-transparent md:border-0 md:p-0 md:w-auto  md:dark:hover:bg-transparent">Departemen
                            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg></button>
                        <!-- Dropdown menu -->
                        <div id="dropdownNavbar"
                            class="z-10 hidden font-normal w-fit bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="flex flex-col !divide-y justify-start items-start py-2 text-sm text-gray-700 dark:text-gray-400"
                                aria-labelledby="dropdownLargeButton">
                                <li class="w-full">
                                    <a href="{{ route('departemen.tahfidz') }}"
                                        class="block px-4 py-2 !text-start hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        Departemen Kelas Tahfidz
                                    </a>
                                </li>
                                <li class="w-full">
                                    <a href="{{ route('departemen.munaqosyah') }}"
                                        class="block px-4 py-2 !text-start hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        Departemen Munaqosyah
                                    </a>
                                </li>
                                <li class="w-full">
                                    <a href="{{ route('departemen.ukhuwah') }}"
                                        class="block px-4 py-2 !text-start hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        Departemen Ukhuwah
                                    </a>
                                </li>
                                <li class="w-full">
                                    <a href="{{ route('departemen.mudarosah') }}"
                                        class="block px-4 py-2 !text-start hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        Departemen Mudarosah
                                    </a>
                                </li>
                                <li class="w-full">
                                    <a href="{{ route('departemen.syiar') }}"
                                        class="block px-4 py-2 !text-start hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        Departemen Syiar
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </li>
                    <li><a class="nav-link scrollto {{ Route::currentRouteName() == 'program.tahfidz' ? 'active' : '' }}"
                            href="{{ route('program.tahfidz') }}">Program Tahfidz</a></li>

                    <li><a class="nav-link scrollto {{ Route::currentRouteName() == 'publikasi' ? 'active' : '' }}"
                            href={{route('publikasi')}}>Publikasi</a></li>
                    <li><a class="nav-link scrollto {{ Route::currentRouteName() == 'pengumuman' ? 'active' : '' }}"
                            href="#pengumuman">Pengumuman</a></li>

                </ul>
            </div>
            <div class="ms-5">
                <ul>
                    @if (Auth::check())
                        <div class="p-4">
                            <x-dropdown align="right" width="48" class="my-4">
                                <x-slot name="trigger" class="p-4">
                                    <button
                                        class="flex gap-3 items-center text-sm font-medium rounded-md  bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        <div class="text-start flex flex-col items-end">
                                            <p class="font-semibold text-md m-0">{{ Auth::user()->name }}</p>
                                            <p class="capitalize font-medium text-sm m-0">
                                                {{ Auth::user()->role->name }}
                                            </p>
                                        </div>

                                        <div>
                                            <i class="fa-regular fa-user text-3xl"></i>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('dashboard.' . Auth::user()->role->name)">
                                        {{ __('Dashboard') }}
                                    </x-dropdown-link>

                                    @if (Auth::user()->role_id != config('constants.ROLE_ADMIN'))
                                        <x-dropdown-link :href="route('profile.index')">
                                            {{ __('Profile') }}
                                        </x-dropdown-link>
                                    @endif


                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @else
                        <li><button data-bs-toggle="modal" data-bs-target="#modalRegister"
                                class="register scrollto">Register</button></li>
                        <li><button class="login" data-bs-toggle="modal" data-bs-target="#modalLogin">Login</button>
                        </li>
                    @endif
                </ul>
            </div>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header>


<x-modal-register />

<x-modal-login />
