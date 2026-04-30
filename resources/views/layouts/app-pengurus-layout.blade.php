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
</head>

<body class="bg-[#F5F7FB] min-h-screen">

    <div class="flex">

        {{-- SIDEBAR --}}
        <aside class="w-[270px] min-h-screen bg-[#0F2E8A] text-white fixed left-0 top-0 px-6 py-8">

            {{-- LOGO --}}
            <div class="flex items-center gap-3 mb-10">

                <div class="w-12 h-12 rounded-2xl bg-white flex items-center justify-center">

                    <span class="text-[#0F2E8A] font-bold text-xl">
                        M
                    </span>

                </div>

                <div>
                    <h2 class="font-bold text-xl">
                        Mutqeen
                    </h2>

                    <p class="text-sm text-blue-100">
                        Dashboard Pengurus
                    </p>
                </div>

            </div>

            {{-- MENU --}}
            <nav class="space-y-3">

                {{-- DASHBOARD --}}
                <a href="#"
                    class="flex items-center gap-4 px-4 py-3 rounded-2xl bg-white text-[#0F2E8A] font-medium">

                    <i class="fi fi-rr-apps text-lg"></i>

                    Dashboard
                </a>

                {{-- SANTRI --}}
                <a href="#"
                    class="flex items-center gap-4 px-4 py-3 rounded-2xl hover:bg-white/10 transition">

                    <i class="fi fi-rr-user text-lg"></i>

                    Data Santri
                </a>

                {{-- PENYIMAK --}}
                <a href="#"
                    class="flex items-center gap-4 px-4 py-3 rounded-2xl hover:bg-white/10 transition">

                    <i class="fi fi-rr-headphones text-lg"></i>

                    Data Penyimak
                </a>

                {{-- LAPORAN --}}
                <a href="#"
                    class="flex items-center gap-4 px-4 py-3 rounded-2xl hover:bg-white/10 transition">

                    <i class="fi fi-rr-chart-line-up text-lg"></i>

                    Laporan Tahfidz
                </a>

            </nav>

            {{-- FOOTER --}}
            <div class="absolute bottom-8 left-6 right-6">

                <div class="bg-white/10 rounded-2xl p-4">

                    <p class="text-sm text-blue-100">
                        Logged in as
                    </p>

                    <h3 class="font-semibold mt-1">
                        {{ auth()->user()->name }}
                    </h3>

                </div>

            </div>

        </aside>

        {{-- MAIN CONTENT --}}
        <main class="ml-[270px] flex-1 min-h-screen">

            {{-- TOPBAR --}}
            <div class="bg-white px-10 py-6 border-b border-gray-100 flex items-center justify-between">

                <div>

                    <h1 class="text-2xl font-bold text-gray-800">
                        Assalamu’alaikum,
                        {{ auth()->user()->name }}
                    </h1>

                    <p class="text-gray-500 mt-1">
                        Selamat datang di dashboard pengurus Mutqeen
                    </p>

                </div>

                {{-- PROFILE --}}
                <div class="flex items-center gap-4">

                    <button class="w-12 h-12 rounded-2xl border border-gray-200 flex items-center justify-center hover:bg-gray-50">

                        <i class="fi fi-rr-bell text-gray-600"></i>

                    </button>

                    <div class="w-12 h-12 rounded-2xl bg-[#0F2E8A] text-white flex items-center justify-center font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                </div>

            </div>

            {{-- CONTENT --}}
            <div class="p-10">

                {{ $slot }}

            </div>

        </main>

    </div>

</body>
</html>