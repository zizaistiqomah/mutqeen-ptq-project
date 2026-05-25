<x-app-pengurus-layout>

@section('content')

<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

    <!-- Card 1 -->
    <div class="bg-white rounded-2xl shadow px-6 py-5 flex items-center justify-between hover:shadow-md transition duration-300 hover:shadow-md hover:-translate-y-1">
        <div>
            <p class="text-sm text-gray-500">Jumlah Kelompok Halaqah</p>
            <h2 class="text-2xl font-bold text-gray-800 mt-1">
                {{ $totalHalaqah }}
            </h2>

            <button onclick="openHalaqahModal()" class="text-blue-600 text-sm mt-2 hover:underline">
                Lihat Detail →
            </button>
        </div>

        <div class="bg-[#075F7C] p-4 rounded-full">
            <!-- Users -->
            <div class="w-6 h-6 rounded-2xl bg-[#075F7C] flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-7 h-7 text-white"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <!-- Kepala tengah -->
                    <circle cx="12" cy="8" r="3" stroke-width="2"/>

                    <!-- Badan -->
                    <path stroke-width="2" stroke-linecap="round"
                        d="M5 20c0-3 3-5 7-5s7 2 7 5"/>

                    <!-- Kepala kiri -->
                    <circle cx="5" cy="10" r="2" stroke-width="2"/>

                    <!-- Kepala kanan -->
                    <circle cx="19" cy="10" r="2" stroke-width="2"/>

                </svg>
            </div>
        </div>
    </div>

    <!-- MODAL -->
<div id="halaqahModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white w-full max-w-2xl rounded-2xl p-6 shadow-lg overflow-y-auto max-h-[80vh]">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold">Detail Halaqah</h2>
            <button onclick="closeHalaqahModal()">✖</button>
        </div>

        <!-- CONTENT -->
        <div class="space-y-4">

            @foreach($halaqahList as $halaqah)
                <div class="border rounded-xl p-4">

                    <h3 class="font-semibold text-gray-800">
                        {{ $halaqah->nama_halaqah }}
                    </h3>

                    <p class="text-sm text-gray-500">
                        Penyimak: {{ $halaqah->penyimak->name ?? '-' }}
                    </p>

                    <div class="mt-2">
                        <p class="text-sm font-medium">Santri:</p>

                        <ul class="text-sm text-gray-600 list-disc ml-5">
                            @forelse($halaqah->santris as $santri)
                                <li>{{ $santri->name }}</li>
                            @empty
                                <li class="text-gray-400">Belum ada santri</li>
                            @endforelse
                        </ul>
                    </div>

                </div>
            @endforeach

        </div>

    </div>
</div>

    <!-- Card 2 -->
    <div class="bg-white rounded-2xl shadow px-6 py-5 flex items-center justify-between hover:shadow-md transition duration-300 hover:shadow-md hover:-translate-y-1">
        <div>
            <p class="text-sm text-gray-500">Jumlah Santri</p>
            <h2 class="text-2xl font-bold text-gray-800 mt-1">
                {{ $totalSantri }}
            </h2>
            <p class="text-xs text-gray-400 mt-1">Santri Aktif</p>
        </div>

        <div class="bg-[#075F7C] p-4 rounded-full">
            <!-- Users -->
            <div class="w-6 h-6 rounded-2xl bg-[#075F7C] flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-7 h-7 text-white"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <!-- Kepala tengah -->
                    <circle cx="12" cy="8" r="3" stroke-width="2"/>

                    <!-- Badan -->
                    <path stroke-width="2" stroke-linecap="round"
                        d="M5 20c0-3 3-5 7-5s7 2 7 5"/>
                        
                    <!-- Kepala kanan -->
                    <circle cx="19" cy="10" r="2" stroke-width="2"/>

                </svg>
            </div>
        </div>
    </div>

    <!-- Card 3 -->
    <div class="bg-white rounded-2xl shadow px-6 py-5 flex items-center justify-between hover:shadow-md transition duration-300 hover:shadow-md hover:-translate-y-1">
        <div>
            <p class="text-sm text-gray-500">Setoran Terverifikasi (Hari Ini)</p>
            <h2 class="text-2xl font-bold text-gray-800 mt-1">
                {{ $setoranHariIni }}
            </h2>

            <p class="text-xs mt-1 {{ $growthHarian >= 0 ? 'text-gray-400' : 'text-red-600' }}">
                Setoran hari ini
            </p>
        </div>

            <div class="bg-[#075F7C] p-4 rounded-full">
            <!-- Users -->
            <div class="w-6 h-6 rounded-2xl bg-[#075F7C] flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-7 h-7 text-white"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <!-- Badge -->
                    <circle cx="12" cy="12" r="9" stroke-width="2"/>

                    <!-- Check -->
                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        d="M8 12l3 3 5-5"/>

                </svg>
            </div>
        </div>
    </div>

    <!-- Card 4 -->
    <div class="bg-white rounded-2xl shadow px-6 py-5 flex items-center justify-between hover:shadow-md transition duration-300 hover:shadow-md hover:-translate-y-1">
        <div>
            <p class="text-sm text-gray-500">Total Setoran (Periode)</p>
            <h2 class="text-2xl font-bold text-gray-800 mt-1">
                {{ number_format($totalSemester) }}
            </h2>
            <p class="text-xs text-gray-400 mt-1">Setoran</p>
        </div>

            <div class="bg-[#075F7C] p-4 rounded-full">
            <!-- Users -->
            <div class="w-6 h-6 rounded-2xl bg-[#075F7C] flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-7 h-7 text-white"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <!-- Axis -->
                    <path stroke-width="2" stroke-linecap="round"
                        d="M4 19V5m0 14h16"/>

                    <!-- Line naik -->
                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        d="M6 15l4-4 3 3 5-6"/>

                    <!-- Arrow -->
                    <path stroke-width="2" stroke-linecap="round"
                        d="M18 8h-3M18 8v3"/>

                </svg>
            </div>
        </div>
    </div>

</div>

<div class="grid grid-cols-1 xl:grid-cols-3 gap-4 mt-6">

    <!-- CHART -->
    <div class="xl:col-span-2 bg-white rounded-2xl shadow p-6">
        <!-- HEADER -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="font-semibold text-gray-800">
            Statistik Setoran Mingguan
                <p class="text-xs text-gray-500">
                    Berdasarkan jumlah setoran yang masuk setiap minggu
                </p>
        </h2>
        

        <!-- Dropdown Bulan -->
        <form method="GET">
            <select name="bulan" onchange="this.form.submit()"
                class="text-sm border rounded-lg px-3 py-1">
                
                @foreach(range(1,12) as $b)
                    <option value="{{ $b }}" {{ $bulan == $b ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($b)->translatedFormat('F') }}
                    </option>
                @endforeach

            </select>
        </form>
    </div>

    <!-- CANVAS -->
    <canvas id="weeklyChart" height="100"></canvas>


    </div>

    <!-- RANKING -->
<div class="bg-white rounded-2xl shadow p-6">

    <div class="mb-4">
        <h2 class="font-semibold text-gray-800 text-lg">
            Badge pencapaian minggu ini
        </h2>
        <p class="font-semibold text-xs text-gray-500 mt-1">
            Santri teraktif minggu ini:
        </p>
    </div>

    <div class="space-y-4">

        @forelse($topSantri as $index => $item)

            <div class="flex items-center gap-3">

                <!-- BADGE (EMOJI) -->
                <div class="w-10 flex justify-center text-2xl">
                    @if($index == 0)
                        🥇
                    @elseif($index == 1)
                        🥈
                    @else
                        🥉
                    @endif
                </div>

                <!-- FOTO -->
                <img src="{{ $item->user->photo ? asset('storage/' . $item->user->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($item->user->name) }}" 
                    class="w-8 h-8 rounded-full object-cover"
                    alt="foto"/>

                <!-- INFO -->
                <div class="flex-1">
                    <p class="font-semibold text-medium text-gray-800">
                        {{ $item->user->name ?? '-' }}
                    </p>

                    <p class="text-xs text-gray-500">
                        {{ $item->user->halaqah->nama_halaqah ?? '-' }}
                    </p>
                </div>

                <!-- TOTAL -->
                <div class="text-right">
                    <p class="text-sm font-semibold text-[#075F7C]">
                        {{ $item->total_setoran }}
                    </p>
                    <p class="text-xs text-gray-500">
                        setoran
                    </p>
                </div>

            </div>

        @empty
            <p class="text-sm text-gray-400">
                Belum ada data minggu ini
            </p>
        @endforelse

    </div>

</div>
</div>

<!-- Tabel Progres Santri -->
<div class="bg-white rounded-2xl shadow p-6 mt-6">

    <h2 class="font-semibold text-gray-800 mb-4">
        Data & Progress Santri
    </h2>

    <div class="overflow-x-auto rounded-xl border border-gray-100">

        <table class="w-full text-sm text-left">

            <!-- HEADER -->
            <thead>
                <tr class="bg-[#075F7C] text-white text-left">

                    <th class="py-3 px-4 rounded-tl-xl">No</th>
                    <th class="py-3 px-4">Santri Juz</th>
                    <th class="py-3 px-4">Target Juz</th>
                    <th class="py-3 px-4">Total Target</th>
                    <th class="py-3 px-4">Disetorkan</th>
                    <th class="py-3 px-4">Capaian</th>
                    <th class="py-3 px-4 rounded-tr-xl">Progres</th>
                    

                </tr>
            </thead>

            <!-- BODY -->
            <tbody>

                @forelse($santriProgress as $santri)

                <tr class="border-b hover:bg-gray-50 transition">
                    <!-- NO -->
                    <td class="py-3 px-4">
                        {{ $loop->iteration }}
                    </td>

                    <!-- SANTRI -->
                    <td class="py-3 px-4 text-left flex items-center gap-3">
                        <div>
                            <p class="font-semibold text-gray-800">
                                {{ $santri->name }}
                            </p>

                            <p class="text-xs text-gray-500">
                                {{ $santri->halaqah->nama_halaqah ?? '-' }}
                            </p>
                        </div>

                    </td>

                    <!-- TARGET -->
                    <td class="py-3 px-4 text-left">
                        {{ $santri->target_juz ?? 0 }} Juz
                    </td>

                    <!-- Total Halaman -->
                    <td class="py-3 px-4 text-left">
                        {{ $santri->target_halaman ?? 0 }} halaman
                    </td>

                    <!-- HAFALAN -->
                    <td class="py-3 px-4 text-left">
                        {{ $santri->setorans->sum('halaman_diterima') }} halaman
                    </td>

                    <!-- CAPAIAN -->
                    <td class="py-3 px-4 text-left font-semibold text-gray-700">
                        {{ $santri->progress ?? 0 }}%
                    </td>

                    <!-- PROGRESS BAR -->
                    <td class="py-3 px-4 text-left w-48">

                        <div class="w-full bg-gray-200 rounded-full h-2">

                            <div
                                class="bg-[#075F7C] h-2 rounded-full transition-all duration-300"
                                style="width: {{ $santri->progress ?? 0 }}%"
                            ></div>

                        </div>

                        <p class="text-xs text-gray-500 mt-1">
                            {{ $santri->progress ?? 0 }}%
                        </p>

                    </td>

                    

                </tr>

                @empty

                <tr>
                    <td colspan="6" class="py-6 text-center text-gray-400">
                        Tidak ada data santri
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>
</div>


    

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('weeklyChart');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
        datasets: [{
            label: 'Total Setoran',
            data: @json($weeklyData),
            borderWidth: 2,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.raw + ' setoran';
                    }
                }
            }
        }
    }
});
</script>


<script>
function openHalaqahModal() {
    document.getElementById('halaqahModal').classList.remove('hidden');
    document.getElementById('halaqahModal').classList.add('flex');
}

function closeHalaqahModal() {
    document.getElementById('halaqahModal').classList.add('hidden');
    document.getElementById('halaqahModal').classList.remove('flex');
}
</script>

@endsection

</x-app-pengurus-layout>