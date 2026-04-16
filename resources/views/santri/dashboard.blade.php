<x-app-layout>
    <div class="p-6 bg-[#F5F7FA] min-h-screen">

        <!-- Greeting -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-[#1E3A5F]">
                Dashboard Santri
            </h1>
            <p class="text-gray-600">
                Selamat datang, <span class="font-semibold">{{ auth()->user()->name }}</span>
            </p>
            <p class="text-sm text-gray-500">
                Role: {{ auth()->user()->role }}
            </p>
        </div>

        <!-- Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Target -->
            <div class="bg-white rounded-xl shadow p-5">
                <h2 class="text-gray-500">Target Hafalan</h2>
                <p class="text-2xl font-bold text-[#1E3A5F]">
                    {{ $target->jumlah_target ?? '-' }} Juz
                </p>
            </div>

            <!-- Setoran -->
            <div class="bg-white rounded-xl shadow p-5">
                <h2 class="text-gray-500">Total Setoran</h2>
                <p class="text-2xl font-bold text-[#1E3A5F]">
                    0
                </p>
            </div>

            <!-- Progress -->
            <div class="bg-white rounded-xl shadow p-5">
                <h2 class="text-gray-500 mb-2">Progress</h2>

                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-[#4A90E2] h-2 rounded-full"
                         style="width: {{ $progress ?? 0 }}%">
                    </div>
                </div>

                <p class="mt-2 text-sm text-gray-600">
                    {{ $progress ?? 0 }}% tercapai
                </p>
            </div>

        </div>
        

        <!-- Logout (opsional, biasanya sudah ada di navbar) -->
        <div class="mt-6">
            <form method="POST" action="/logout">
                @csrf
                <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                    Logout
                </button>
            </form>
        </div>

    </div>
</x-app-layout>