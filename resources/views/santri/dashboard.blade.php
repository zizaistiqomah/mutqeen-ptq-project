@php
    $murojaah = $murojaahTerakhir ?? null;
@endphp


<x-app-dashboard-layout>
    <div class="p-6 bg-[#F5F7FA] min-h-screen">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-6">
    
    <!-- CARD -->
<div class="bg-white rounded-xl shadow p-5 border 
            hover:shadow-lg hover:-translate-y-1 transition duration-300">

    <div class="flex items-center justify-between">
        <p class="text-sm text-gray-500">Kelompok Halaqah</p>

        <!-- ICON -->
        <div class="bg-blue-100 text-blue-600 p-2 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m10-4a4 4 0 11-8 0 4 4 0 018 0zM5 10a4 4 0 118 0 4 4 0 01-8 0z"/>
            </svg>
        </div>
    </div>

    <h2 class="text-lg font-semibold  mt-3">
        {{ $halaqah->nama ?? 'Belum ada kelompok' }}
    </h2>

    <p class="text-sm text-gray-400 mt-1">
        {{ $halaqah->musyrif ?? '-' }}
    </p>
</div>


<div class="bg-white rounded-xl shadow p-5 border 
            hover:shadow-lg hover:-translate-y-1 transition duration-300">

    <div class="flex items-center justify-between">
        <p class="text-sm text-gray-500">Target Hafalan</p>

        <div class="bg-green-100 text-green-600 p-2 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
            </svg>
        </div>
    </div>

    <h2 class="text-2xl font-bold  mt-3">
        {{ count($targets ?? []) }} Juz
    </h2>

    <p class="text-sm text-gray-400 mt-1">
        Total target hafalan
    </p>
</div>


<div class="bg-white rounded-xl shadow p-5 border 
            hover:shadow-lg hover:-translate-y-1 transition duration-300">

    <div class="flex items-center justify-between">
        <p class="text-sm text-gray-500">Streak</p>

        <div class="bg-orange-100 text-orange-500 p-2 rounded-lg">
            🔥
        </div>
    </div>

    <h2 class="text-2xl font-bold  mt-3">
        {{ $streak ?? 0 }} Hari
    </h2>

    <p class="text-sm text-gray-400 mt-1">
        Konsistensi setoran
    </p>
</div>


<div class="bg-white rounded-xl shadow p-5 border 
            hover:shadow-lg hover:-translate-y-1 transition duration-300">

    <div class="flex items-center justify-between">
        <p class="text-sm text-gray-500">Setoran Terakhir</p>

        <div class="bg-purple-100 text-purple-600 p-2 rounded-lg">
            📖
        </div>
    </div>

    @if($setoranTerakhir)
        <h2 class="text-md font-semibold  mt-3">
            {{ $setoranTerakhir->surat_mulai }} - {{ $setoranTerakhir->surat_selesai }}
        </h2>

        <p class="text-sm text-gray-400 mt-1">
            Ayat {{ $setoranTerakhir->ayat_mulai }} - {{ $setoranTerakhir->ayat_selesai }}
        </p>
    @else
        <p class="text-gray-400 mt-3">
            Belum ada setoran
        </p>
    @endif
</div>

</div>

 


<div class="flex flex-col lg:flex-row gap-5 mt-6">

    <!-- LEFT: PENCAPAIAN -->
    <div class="w-full lg:w-1/3">
        <div class="bg-white rounded-2xl shadow p-5 h-full">
            <h2 class="text-lg font-semibold  mb-4">
                📊 Pencapaian Minggu Ini
            </h2>

            <div class="space-y-4">
                <div class="flex justify-between">
                    <p class="text-gray-500 text-sm">Jumlah Setoran</p>
                    <p class="font-semibold">{{ $setoranMingguIni ?? 0 }}</p>
                </div>

                <div class="flex justify-between">
                    <p class="text-gray-500 text-sm">Juz Disetorkan</p>
                    <p class="font-semibold">{{ $juzMingguIni ?? 0 }}</p>
                </div>

                <div class="flex justify-between">
                    <p class="text-gray-500 text-sm">Streak</p>
                    <p class="font-semibold text-orange-500">
                        🔥 {{ $streak ?? 0 }} hari
                    </p>
                </div>
            </div>

            <div class="bg-[#075F7C]/10 text-[#075F7C] p-3 rounded-lg text-sm mb-4">
                Terus jaga konsistensi hafalanmu 
            </div>
        </div>
    </div>

    <!-- RIGHT: TARGET -->
    <div class="w-full lg:w-2/3">

        <div class="bg-white rounded-2xl shadow p-5">

            <!-- HEADER -->
            <div class="flex justify-between items-center mb-5">

                <div>
                    <h2 class="text-lg font-semibold">
                        🎯 Target Hafalan
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Progress target berdasarkan total halaman hafalan terverifikasi
                    </p>
                </div>

                <button
                    onclick="document.getElementById('formTarget').classList.toggle('hidden')"
                    class="hover:bg-[#1E3A5F] active:scale-95 bg-[#075F7C]
                        text-white px-4 py-2 rounded-xl text-sm font-medium transition"
                >
                    + Set Target
                </button>

            </div>

            <!-- FORM TARGET -->
            <div
                id="formTarget"
                class="hidden mb-6 border border-gray-100 rounded-2xl p-5 bg-gray-50"
            >

                <form action="{{ route('target.store') }}" method="POST">

                    @csrf

                    <div class="flex flex-col lg:flex-row gap-4 items-end">

                        <!-- DROPDOWN JUZ -->
                        <div class="flex-1">

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Pilih Target Juz
                            </label>

                            <select
                                name="target_juz"
                                required
                                class="w-full border border-gray-300 rounded-xl px-4 py-3
                                    focus:outline-none focus:ring-2
                                    focus:ring-[#075F7C] focus:border-[#075F7C]"
                            >

                                <option value="">
                                    -- Pilih Juz --
                                </option>

                                @for ($i = 1; $i <= 30; $i++)

                                    <option value="{{ $i }}">
                                        Juz {{ $i }}
                                    </option>

                                @endfor

                            </select>

                            <p class="text-xs text-gray-500 mt-2">
                                1 juz = 20 halaman
                            </p>

                        </div>

                        <!-- BUTTON -->
                        <button
                            type="submit"
                            class="bg-[#075F7C] hover:bg-[#054B63]
                                text-white px-6 py-3 rounded-xl
                                font-medium transition"
                        >
                            Simpan Target
                        </button>

                    </div>

                </form>

            </div>

            @php

                $totalTargetHalaman = $targets->sum('target_halaman');

                $totalProgressHalaman = $targets->sum('progress_halaman');

                $progressTarget = 0;

                if ($totalTargetHalaman > 0) {
                    $progressTarget =
                        ($totalProgressHalaman / $totalTargetHalaman) * 100;
                }

            @endphp

            <!-- PROGRESS UTAMA -->
@php

    $totalTargetHalaman = $targets->sum('target_halaman');

    $totalProgressHalaman = $targets->sum('progress_halaman');

    $progressTarget = 0;

    if ($totalTargetHalaman > 0) {

        $progressTarget =
            ($totalProgressHalaman / $totalTargetHalaman) * 100;
    }

@endphp

<div class="mb-7">

    <!-- HEADER -->
    <div class="flex items-start justify-between mb-4">

        <!-- LEFT -->
        <div>

            <p class="text-sm text-gray-500 font-medium">
                Total Progress Hafalan
            </p>

            <h3 class="text-2xl font-bold text-[#075F7C] mt-2 flex items-end gap-2">

                <span>
                    {{ $totalProgressHalaman }}
                </span>

                <span class="text-lg text-gray-400 font-medium">
                    /
                </span>

                <span>
                    {{ $totalTargetHalaman }}
                </span>

                <span class="text-base font-medium text-gray-500 mb-0.5">
                    halaman
                </span>

            </h3>

            <p class="text-xs text-gray-400 mt-2">
                Progress dihitung berdasarkan total halaman hafalan terverifikasi
            </p>

        </div>

        <!-- RIGHT -->
        <div class="text-right">

            <div
                class="w-16 h-16 rounded-2xl bg-[#075F7C]/10
                       flex items-center justify-center"
            >

                <span class="text-xl font-bold text-[#075F7C]">

                    {{ round(min($progressTarget, 100)) }}%

                </span>

            </div>

            <p class="text-xs text-gray-400 mt-2">
                1 Juz = 20 halaman
            </p>

        </div>

    </div>

        <!-- PROGRESS BAR -->
        <div
            class="w-full bg-gray-200 h-4 rounded-full overflow-hidden relative"
        >

            <!-- BAR -->
            <div
                class="bg-[#075F7C]
                    h-4 rounded-full
                    transition-all duration-700 ease-in-out"
                style="width: {{ min($progressTarget, 100) }}%"
            ></div>

        </div>

        <!-- FOOTER -->
        <div class="flex justify-between items-center mt-3">

            <p class="text-sm text-gray-500">
                {{ $totalProgressHalaman }} halaman selesai
            </p>

            <p class="text-sm font-semibold text-[#075F7C]">

                {{ round(min($progressTarget, 100)) }}% tercapai

            </p>

        </div>

    </div>

            <!-- LIST TARGET -->
            <div class="space-y-4">

                @forelse ($targets as $target)

                    @php

                        $persen = 0;

                        if ($target->target_halaman > 0) {
                            $persen =
                                ($target->progress_halaman / $target->target_halaman) * 100;
                        }

                    @endphp

                    <div class="border border-gray-100 rounded-2xl overflow-hidden">

                        <!-- TARGET HEADER -->
                        <button
                            onclick="document.getElementById('target-{{ $target->id }}').classList.toggle('hidden')"
                            class="w-full px-5 py-4 flex items-center justify-between hover:bg-gray-50 transition"
                        >

                            <div class="text-left">

                                <h3 class="font-semibold text-gray-800">
                                    Juz {{ $target->target_juz }}
                                </h3>

                                <p class="text-sm text-gray-500 mt-1">

                                    {{ $target->progress_halaman }}
                                    /
                                    {{ $target->target_halaman }}
                                    halaman

                                </p>

                            </div>

                            <div class="flex items-center gap-4">

                                <span class="font-bold text-[#075F7C]">
                                    {{ round($persen) }}%
                                </span>

                                <i class="fa-solid fa-chevron-down text-gray-400"></i>

                            </div>

                        </button>

                        <!-- DETAIL TARGET -->
                        <div
                            id="target-{{ $target->id }}"
                            class="hidden border-t bg-gray-50 px-5 py-5"
                        >

                            <!-- PROGRESS DETAIL -->
                            <div class="mb-4">

                                <div class="flex justify-between text-sm mb-2">

                                    <span class="font-semibold text-[#075F7C]">

                                        {{ $target->progress_halaman }}
                                        /
                                        {{ $target->target_halaman }}
                                        halaman

                                    </span>

                                    <!-- PROGRESS BAR -->
                                    <div class="w-full bg-gray-200 h-2 rounded-full mt-3 overflow-hidden">

                                        <div
                                            class="bg-[#075F7C] h-2 rounded-full transition-all duration-500"
                                            style="width: {{ min($persen, 100) }}%"
                                        ></div>

                                    </div>

                                </div>

                                <div class="w-full bg-gray-200 h-3 rounded-full overflow-hidden">

                                    <div
                                        class="bg-[#075F7C] h-3 rounded-full transition-all duration-500"
                                        style="width: {{ $persen }}%"
                                    ></div>

                                </div>

                            </div>

                            <!-- INFO -->
                            <div class="flex items-center justify-between">

                                <div>

                                    <p class="text-sm font-medium text-gray-700">
                                        Jumlah Halaman Saat Ini
                                    </p>

                                    <p class="text-xs text-gray-500 mt-1">
                                        Progress bertambah otomatis ketika setoran diverifikasi
                                    </p>

                                </div>

                                <div
                                    class="min-w-[80px] text-center px-4 py-2 rounded-xl bg-white border font-semibold text-[#075F7C]"
                                >
                                    {{ $target->progress_halaman }}
                                </div>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="text-center py-10">

                        <div class="text-5xl mb-3">
                            📖
                        </div>

                        <h3 class="font-semibold text-gray-700">
                            Belum Ada Target Hafalan
                        </h3>

                        <p class="text-sm text-gray-500 mt-2">
                            Mulai buat target hafalan semester ini
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>


            <!-- FORM -->
    <form method="POST" action="/santri/target"
      id="formTarget"
      class="mt-4 hidden space-y-2">
    @csrf

    <!-- JUZ -->
        <select name="juz" id="juzSelect"
                class="w-full border p-2 rounded">
            <option value="">Pilih Juz</option>
            @for($i=1; $i<=30; $i++)
                <option value="{{ $i }}">Juz {{ $i }}</option>
            @endfor
        </select>

        <!-- SURAT -->
        <select name="surat" id="suratSelect"
                class="w-full border p-2 rounded">
            <option value="">Pilih Surat</option>
        </select>

        <button class="hover:bg-[#1E3A5F] active:scale-95 bg-[#075F7C] text-white px-4 py-2 rounded">
            Simpan
        </button>
    </form>

<!-- 🔥 DATA SURAT (TAMBAHKAN DI SINI) -->
<script>
const juzSurat = {
    1: ["Al-Fatihah", "Al-Baqarah"],
    2: ["Al-Baqarah"],
    3: ["Al-Baqarah", "Ali Imran"],
    4: ["Ali Imran - An-Nisa"],
    5: ["An-Nisa"],
    6: ["An-Nisa'", "Al-Maidah"],
    7: ["Al-Maidah", "Al-An'am"],
    8: ["AL-An'am","Al-A'raf"],
    9: ["Al-A'raf","Al-Anfal"],
    10: ["Al-Anfal", "At-Ataubah"],
    11: ["At-Atubah","Yunus", "Hud"],
    12: ["Hud","Yusuf"],
    13: ["Yusuf", "Ar-Rad"],
    14: ["Al-Hijr","An-Nahl"],
    15: ["Al-Isra'","Al-Kahfi"],
    16: ["Al-Kahfi","Maryam", "Ta-Ha"],
    17: ["Al-Anbiya'","Al-Hajj"],
    18: ["Al-Mu'minun","An-Nur", "Al-Furqan"],
    19: ["Al-Furqan","Asy-Syu'ara", "An-Naml"],
    20: ["An-Naml","Al-Qasas", "Al-Ankabut"],
    21: ["Al-Ankabut","Ar-Rum", "Luqman", "As-Sajdah", "Al-Ahzab"],
    22: ["Al-Ahzab","Saba'", "Fatir", "Yasin"],
    23: ["Yasin","As-Saffat'", "Sad", "Az-Zumar"],
    24: ["Az-Zumar","Al-Ghafir'", "Al-Fusilat"],
    25: ["Al-Fusilat","Asy-Syura'", "Az-Zukhruf", "Ad-Dukhan", "Al-Jatsiyah"],
    26: ["Al-Jatsiyah","Al-Ahqaf", "Muhammad", "Al-Fath", "Al-Hujurat", "Qaf", "Az-Zariyat"],
    27: ["Az-Zariyat","At_Tur", "An-Najm", "Ar-Rahman", "Al-Waqi'ah", "Qaf", "Al-Hadid"],
    28: ["Al-Mujadilah","Al-Hasyr", "Al-Mumtahanah", "As-Saff", "Al-Jumu'ah", "Al-Munafiqun", "At-Tagabun", "At-Talaq", "At-Tahrim"],
    29: ["Al-Mulk","Al-Qalam", "Haqqah", "Al-Ma'arij", "Nuh", "Al-Jinn", "Al-Muzzammil", "A-Muddassir", "Al-Qiyamah", "Al-Insan", "Al-Mursalat"],
    30: ["An-Naba", "AN-Nazi'at", "At-Takwir", "Al-Infitar","Al-Muthaffifin", "Al-Insyiqaq", "AL-Buruj", "At-Tariq", "AL-A'la", "Al-Ghasyiyah", "AL-Fajr", "Al-Balad", "Asy-Syams", "Al-Lail", "Ad-Dhuha", "AL-Insyirah", "At- Tin", "Al-'Alaq", "AL-Qadr", "AL-Bayyinah","Az-Zalzalah", "Al-'Adiyat", "Al-Qari'ah", "At-Takasur", "Al-'Asr", "Al-Humazah", "Al-Fil", "Al-Quraisy", "AL-Ma'un", "Al-Kausar", "AL-Kafirun", "An-Nasr", "Al-Lahab", "Al-Ikhlas", "Al-Falaq", "An-Nas"]
};
</script>
        </div>

        <!-- SETORAN + RIWAYAT -->
        <div class="flex flex-col lg:flex-row gap-5 mt-6">

            <!-- LEFT: FORM SETORAN -->
        <div class="w-full lg:w-1/3">

            <div class="bg-white rounded-2xl shadow p-5 h-full">

                <!-- HEADER -->
                <div class="flex justify-between items-center mb-4">

                    <div>
                        <h2 class="text-lg font-semibold">
                            📝 Setoran Hafalan
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            Tambahkan setoran hafalan terbaru
                        </p>
                    </div>

                    <button
                        onclick="document.getElementById('formSetoran').classList.toggle('hidden')"
                        class="hover:bg-[#1E3A5F] active:scale-95 bg-[#075F7C]
                            text-white px-3 py-2 rounded-xl text-sm font-medium transition"
                    >
                        + Tambah
                    </button>

                </div>

                <!-- INFO -->
                <div class="bg-[#075F7C]/10 text-[#075F7C] p-4 rounded-xl text-sm mb-5">

                    <div class="flex items-start gap-3">

                        <i class="fa-solid fa-circle-info mt-0.5"></i>

                        <div>
                            Setoran akan masuk antrean dan menunggu verifikasi penyimak.
                        </div>

                    </div>

                </div>

                <!-- FORM -->
                <form
                    method="POST"
                    action="/santri/setoran"
                    id="formSetoran"
                    class="hidden space-y-4"
                >

                    @csrf

                    <!-- PILIH JUZ -->
                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Pilih Juz
                        </label>

                        <select
                            name="juz"
                            id="juzSetoran"
                            required
                            class="w-full border border-gray-300 rounded-xl px-4 py-3
                                focus:outline-none focus:ring-2
                                focus:ring-[#075F7C] focus:border-[#075F7C]"
                        >

                            <option value="">
                                -- Pilih Juz --
                            </option>

                            @for($i = 1; $i <= 30; $i++)

                                <option value="{{ $i }}">
                                    Juz {{ $i }}
                                </option>

                            @endfor

                        </select>

                    </div>

                    <!-- TANGGAL -->
                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Setoran
                        </label>

                        <input
                            type="date"
                            name="tanggal"
                            required
                            class="w-full border border-gray-300 rounded-xl px-4 py-3
                                focus:outline-none focus:ring-2
                                focus:ring-[#075F7C] focus:border-[#075F7C]"
                        >

                    </div>

                    <!-- JUMLAH HALAMAN -->
                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Jumlah Halaman
                        </label>

                        <input
                            type="number"
                            name="halaman"
                            min="1"
                            max="20"
                            required
                            placeholder="Contoh: 5"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3
                                focus:outline-none focus:ring-2
                                focus:ring-[#075F7C] focus:border-[#075F7C]"
                        >

                        <p class="text-xs text-gray-500 mt-2">
                            Maksimal 20 halaman per juz
                        </p>

                    </div>

                    <!-- SURAT MULAI -->
                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Surat Mulai
                        </label>

                        <select
                            name="surat_mulai"
                            id="suratMulai"
                            required
                            class="w-full border border-gray-300 rounded-xl px-4 py-3
                                focus:outline-none focus:ring-2
                                focus:ring-[#075F7C] focus:border-[#075F7C]"
                        >

                            <option value="">
                                -- Pilih Surat --
                            </option>

                        </select>

                    </div>

                    <!-- AYAT MULAI -->
                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Ayat Mulai
                        </label>

                        <input
                            type="number"
                            name="ayat_mulai"
                            min="1"
                            required
                            placeholder="Contoh: 1"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3
                                focus:outline-none focus:ring-2
                                focus:ring-[#075F7C] focus:border-[#075F7C]"
                        >

                    </div>

                    <!-- SURAT SELESAI -->
                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Surat Selesai
                        </label>

                        <select
                            name="surat_selesai"
                            id="suratSelesai"
                            required
                            class="w-full border border-gray-300 rounded-xl px-4 py-3
                                focus:outline-none focus:ring-2
                                focus:ring-[#075F7C] focus:border-[#075F7C]"
                        >

                            <option value="">
                                -- Pilih Surat --
                            </option>

                        </select>

                    </div>

                    <!-- AYAT SELESAI -->
                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Ayat Selesai
                        </label>

                        <input
                            type="number"
                            name="ayat_selesai"
                            min="1"
                            required
                            placeholder="Contoh: 20"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3
                                focus:outline-none focus:ring-2
                                focus:ring-[#075F7C] focus:border-[#075F7C]"
                        >

                    </div>

                    <!-- BUTTON -->
                    <button
                        class="hover:bg-[#1E3A5F] active:scale-95
                            w-full bg-[#075F7C]
                            text-white py-3 rounded-xl
                            font-medium transition"
                    >
                        Simpan Setoran
                    </button>

                </form>

            </div>

        </div>

        <!-- SCRIPT DROPDOWN SURAT -->
        <script>

            const suratPerJuz = {

                1: [
                    "Al-Fatihah",
                    "Al-Baqarah"
                ],

                2: [
                    "Al-Baqarah"
                ],

                3: [
                    "Al-Baqarah",
                    "Ali-Imran"
                ],

                4: [
                    "Ali-Imran",
                    "An-Nisa"
                ],

                5: [
                    "An-Nisa"
                ],

                6: [
                    "An-Nisa",
                    "Al-Maidah"
                ],

                7: [
                    "Al-Maidah",
                    "Al-An'am"
                ],

                8: [
                    "Al-An'am",
                    "Al-A'raf"
                ],

                9: [
                    "Al-A'raf",
                    "Al-Anfal"
                ],

                10: [
                    "Al-Anfal",
                    "At-Taubah"
                ],

                11: [
                    "At-Taubah",
                    "Yunus",
                    "Hud"
                ],

                12: [
                    "Hud",
                    "Yusuf"
                ],

                13: [
                    "Yusuf",
                    "Ar-Ra'd",
                    "Ibrahim"
                ],

                14: [
                    "Al-Hijr",
                    "An-Nahl"
                ],

                15: [
                    "Al-Isra",
                    "Al-Kahfi"
                ],

                16: [
                    "Al-Kahfi",
                    "Maryam",
                    "Ta-Ha"
                ],

                17: [
                    "Al-Anbiya",
                    "Al-Hajj"
                ],

                18: [
                    "Al-Mu'minun",
                    "An-Nur",
                    "Al-Furqan"
                ],

                19: [
                    "Al-Furqan",
                    "Asy-Syu'ara",
                    "An-Naml"
                ],

                20: [
                    "An-Naml",
                    "Al-Qasas",
                    "Al-Ankabut"
                ],

                21: [
                    "Al-Ankabut",
                    "Ar-Rum",
                    "Luqman",
                    "As-Sajdah",
                    "Al-Ahzab"
                ],

                22: [
                    "Al-Ahzab",
                    "Saba",
                    "Fatir",
                    "Yasin"
                ],

                23: [
                    "Yasin",
                    "As-Saffat",
                    "Sad",
                    "Az-Zumar"
                ],

                24: [
                    "Az-Zumar",
                    "Ghafir",
                    "Fussilat"
                ],

                25: [
                    "Fussilat",
                    "Asy-Syura",
                    "Az-Zukhruf",
                    "Ad-Dukhan",
                    "Al-Jasiyah"
                ],

                26: [
                    "Al-Ahqaf",
                    "Muhammad",
                    "Al-Fath",
                    "Al-Hujurat",
                    "Qaf",
                    "Az-Zariyat"
                ],

                27: [
                    "Az-Zariyat",
                    "At-Tur",
                    "An-Najm",
                    "Al-Qamar",
                    "Ar-Rahman",
                    "Al-Waqi'ah",
                    "Al-Hadid"
                ],

                28: [
                    "Al-Mujadilah",
                    "Al-Hasyr",
                    "Al-Mumtahanah",
                    "As-Saff",
                    "Al-Jumu'ah",
                    "Al-Munafiqun",
                    "At-Taghabun",
                    "At-Talaq",
                    "At-Tahrim"
                ],

                29: [
                    "Al-Mulk",
                    "Al-Qalam",
                    "Al-Haqqah",
                    "Al-Ma'arij",
                    "Nuh",
                    "Al-Jinn",
                    "Al-Muzzammil",
                    "Al-Muddassir",
                    "Al-Qiyamah",
                    "Al-Insan",
                    "Al-Mursalat"
                ],

                30: [
                    "An-Naba",
                    "An-Nazi'at",
                    "Abasa",
                    "At-Takwir",
                    "Al-Infitar",
                    "Al-Mutaffifin",
                    "Al-Insyiqaq",
                    "Al-Buruj",
                    "At-Tariq",
                    "Al-A'la",
                    "Al-Ghasyiyah",
                    "Al-Fajr",
                    "Al-Balad",
                    "Asy-Syams",
                    "Al-Lail",
                    "Ad-Duha",
                    "Asy-Syarh",
                    "At-Tin",
                    "Al-Alaq",
                    "Al-Qadr",
                    "Al-Bayyinah",
                    "Az-Zalzalah",
                    "Al-Adiyat",
                    "Al-Qari'ah",
                    "At-Takasur",
                    "Al-Asr",
                    "Al-Humazah",
                    "Al-Fil",
                    "Quraisy",
                    "Al-Ma'un",
                    "Al-Kausar",
                    "Al-Kafirun",
                    "An-Nasr",
                    "Al-Lahab",
                    "Al-Ikhlas",
                    "Al-Falaq",
                    "An-Nas"
                ]
            };

            const juzSelect = document.getElementById('juzSetoran');
            const suratMulai = document.getElementById('suratMulai');
            const suratSelesai = document.getElementById('suratSelesai');

            juzSelect.addEventListener('change', function () {

                const juz = this.value;

                suratMulai.innerHTML =
                    '<option value="">-- Pilih Surat --</option>';

                suratSelesai.innerHTML =
                    '<option value="">-- Pilih Surat --</option>';

                if (suratPerJuz[juz]) {

                    suratPerJuz[juz].forEach(function (surat) {

                        suratMulai.innerHTML +=
                            `<option value="${surat}">${surat}</option>`;

                        suratSelesai.innerHTML +=
                            `<option value="${surat}">${surat}</option>`;
                    });
                }
            });

        </script>

    <!-- RIGHT: RIWAYAT TABEL -->
<div class="w-full lg:w-2/3">
    <div class="bg-white rounded-2xl shadow p-5 h-full">

        <h2 class="text-lg font-semibold  mb-4">
            📋 Riwayat Setoran
        </h2>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left border rounded-lg overflow-hidden">

                <thead class="bg-[#075F7C] text-white">
                    <tr>
                        <th class="px-4 py-2">Juz</th>
                        <th class="px-4 py-2">Tanggal</th>
                        <th class="px-4 py-2">Surat</th>
                        <th class="px-4 py-2">Ayat</th>
                        <th class="px-4 py-2">Halaman</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Nilai</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($setorans ?? [] as $setoran)
                        <tr class="border-b hover:bg-gray-50">

                            <!-- JUZ -->
                            <td class="px-4 py-2">
                                {{ $setoran->juz }}
                            </td>

                            <!-- TANGGAL -->
                            <td class="px-4 py-2">
                                {{ $setoran->tanggal }}
                            </td>

                            <!-- SURAT -->
                            <td class="px-4 py-2">
                                {{ $setoran->surat_mulai }} - {{ $setoran->surat_selesai }}
                            </td>

                            <!-- AYAT -->
                            <td class="px-4 py-2">
                                {{ $setoran->ayat_mulai }} - {{ $setoran->ayat_selesai }}
                            </td>

                            <!-- HALAMAN -->
                            <td class="px-4 py-2">
                                {{ $setoran->halaman }}
                            </td>

                            <!-- STATUS -->
                            <td class="px-4 py-2">
                                @if($setoran->status == 'pending')
                                    <span class="bg-orange-100 text-orange-600 px-2 py-1 rounded-full text-xs">
                                        ⏳ Pending
                                    </span>
                                @elseif($setoran->status == 'diterima')
                                    <span class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-xs">
                                        ✔ Terverifikasi
                                    </span>
                                @else
                                    <span class="bg-blue-100 text-blue-600 px-2 py-1 rounded-full text-xs">
                                        🔁 Mengulang
                                    </span>
                                @endif
                            </td>

                            <!-- NILAI -->
                            <td class="px-4 py-2">
                                {{ $setoran->nilai ?? '-' }}
                            </td>

                            <!-- AKSI -->
                            <td class="px-4 py-2">
                                <button 
                                    onclick='openModal(@json($setoran))'
                                    class="text-[#075F7C] hover:underline text-sm">
                                    Lihat Detail
                                </button>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-400">
                                Belum ada setoran
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>
</div>
        </div>
    </div>

</div>

</div>

  
<script>
document.addEventListener('DOMContentLoaded', function () {

    //  DATA JUZ
    const juzSurat = {
        1: ["Al-Fatihah", "Al-Baqarah"],
        2: ["Al-Baqarah"],
        3: ["Al-Baqarah", "Ali Imran"],
        4: ["Ali Imran", "An-Nisa"],
        5: ["An-Nisa"],
        6: ["An-Nisa'", "Al-Maidah"],
        7: ["Al-Maidah", "Al-An'am"],
        8: ["Al-An'am","Al-A'raf"],
        9: ["Al-A'raf","Al-Anfal"],
        10: ["Al-Anfal", "At-Taubah"],
        11: ["At-Taubah","Yunus", "Hud"],
        12: ["Hud","Yusuf"],
        13: ["Yusuf", "Ar-Ra'd"],
        14: ["Al-Hijr","An-Nahl"],
        15: ["Al-Isra'","Al-Kahfi"],
        16: ["Al-Kahfi","Maryam", "Ta-Ha"],
        17: ["Al-Anbiya'","Al-Hajj"],
        18: ["Al-Mu'minun","An-Nur", "Al-Furqan"],
        19: ["Al-Furqan","Asy-Syu'ara", "An-Naml"],
        20: ["An-Naml","Al-Qasas", "Al-Ankabut"],
        21: ["Al-Ankabut","Ar-Rum", "Luqman", "As-Sajdah", "Al-Ahzab"],
        22: ["Al-Ahzab","Saba'", "Fatir", "Yasin"],
        23: ["Yasin","As-Saffat", "Sad", "Az-Zumar"],
        24: ["Az-Zumar","Ghafir", "Fussilat"],
        25: ["Fussilat","Asy-Syura", "Az-Zukhruf", "Ad-Dukhan", "Al-Jathiyah"],
        26: ["Al-Jathiyah","Al-Ahqaf", "Muhammad", "Al-Fath", "Al-Hujurat", "Qaf", "Adz-Dzariyat"],
        27: ["Adz-Dzariyat","At-Tur", "An-Najm", "Ar-Rahman", "Al-Waqi'ah", "Al-Hadid"],
        28: ["Al-Mujadilah","Al-Hasyr", "Al-Mumtahanah", "As-Saff", "Al-Jumu'ah", "Al-Munafiqun", "At-Taghabun", "At-Talaq", "At-Tahrim"],
        29: ["Al-Mulk","Al-Qalam", "Al-Haqqah", "Al-Ma'arij", "Nuh", "Al-Jinn", "Al-Muzzammil", "Al-Muddaththir", "Al-Qiyamah", "Al-Insan", "Al-Mursalat"],
        30: ["An-Naba", "An-Nazi'at", "At-Takwir", "Al-Infitar","Al-Mutaffifin", "Al-Insyiqaq", "Al-Buruj", "At-Tariq", "Al-A'la", "Al-Ghasyiyah", "Al-Fajr", "Al-Balad", "Asy-Syams", "Al-Lail", "Ad-Duha", "Al-Insyirah", "At-Tin", "Al-'Alaq", "Al-Qadr", "Al-Bayyinah","Az-Zalzalah", "Al-'Adiyat", "Al-Qari'ah", "At-Takathur", "Al-'Asr", "Al-Humazah", "Al-Fil", "Quraisy", "Al-Ma'un", "Al-Kawthar", "Al-Kafirun", "An-Nasr", "Al-Lahab", "Al-Ikhlas", "Al-Falaq", "An-Nas"]
    };

    //  FUNCTION ISI SURAT
    function isiSurat(juz, target1, target2 = null) {

        if (!target1) return;

        target1.innerHTML = '<option value="">Pilih Surat</option>';

        if (target2) {
            target2.innerHTML = '<option value="">Pilih Surat</option>';
        }

        if (juzSurat[juz]) {

            juzSurat[juz].forEach(surat => {

                let opt1 = new Option(surat, surat);
                target1.add(opt1);

                if (target2) {

                    let opt2 = new Option(surat, surat);
                    target2.add(opt2);

                }

            });

        }

    }

    //  SETORAN
    const juzSetoran = document.getElementById('juzSetoran');
    const suratMulai = document.getElementById('suratMulai');
    const suratSelesai = document.getElementById('suratSelesai');

    if (juzSetoran && suratMulai && suratSelesai) {

        juzSetoran.addEventListener('change', function () {

            isiSurat(
                this.value,
                suratMulai,
                suratSelesai
            );

        });

    }

});

function openModal(setoran) {

    document.getElementById('modalDetail').classList.remove('hidden');
    document.getElementById('modalDetail').classList.add('flex');

    // FORMAT TANGGAL
    const formatTanggal = new Date(setoran.tanggal)
        .toLocaleDateString('id-ID', {
            day: '2-digit',
            month: 'long',
            year: 'numeric'
        });

    // JUZ
    document.getElementById('dJuz').innerText =
        'Juz ' + (setoran.juz ?? '-');

    // TANGGAL
    document.getElementById('dTanggal').innerText =
        formatTanggal;

    // SURAT
    document.getElementById('dSurat').innerText =
        (setoran.surat_mulai ?? '-') +
        ' - ' +
        (setoran.surat_selesai ?? '-');

    // AYAT
    document.getElementById('dAyat').innerText =
        (setoran.ayat_mulai ?? '-') +
        ' - ' +
        (setoran.ayat_selesai ?? '-');

    // HALAMAN
    document.getElementById('dHalaman').innerText =
        (setoran.halaman ?? '-') + ' halaman';

    // STATUS (BIAR RAPI)
    let statusText = '';
    if (setoran.status === 'pending') {
        statusText = '⏳ Pending';
    } else if (setoran.status === 'diterima') {
        statusText = '✔ Terverifikasi';
    } else {
        statusText = '🔁 Mengulang';
    }

    document.getElementById('dStatus').innerText = statusText;

    // NILAI
    document.getElementById('dNilai').innerText =
        setoran.nilai ?? '-';

    // CATATAN
    document.getElementById('dCatatan').innerText =
        setoran.catatan ?? '-';
}
</script>

<!-- MODAL DETAIL -->
<div
    id="modalDetail"
    class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 px-4"
>
    <div class="bg-white rounded-2xl shadow-lg w-full max-w-md p-6 relative animate-scaleIn">


        <!-- HEADER -->
        <div class="px-5 py-4 border-b flex items-center justify-between">

            <div>

                <h2 class="text-base font-semibold text-[#075F7C]">
                    📄 Detail Setoran
                </h2>

                <p class="text-xs text-gray-500 mt-1">
                    Informasi hafalan yang disetorkan
                </p>

            </div>

            <!-- CLOSE -->
        <button onclick="closeModal()"
            class="absolute top-3 right-3 text-gray-400 hover:text-black text-xl">
            ✖
        </button>

        </div>

        <!-- CONTENT -->
        <div class="p-5 space-y-4 text-sm">

            <!-- JUZ -->
            <div class="flex justify-between items-start gap-4">

                <span class="text-gray-500">
                    Juz
                </span>

                <span
                    id="dJuz"
                    class="font-semibold text-[#075F7C] text-right"
                ></span>

            </div>

            <!-- TANGGAL -->
            <div class="flex justify-between items-start gap-4">

                <span class="text-gray-500">
                    Tanggal
                </span>

                <span
                    id="dTanggal"
                    class="font-medium text-right"
                ></span>

            </div>

            <!-- SURAT -->
            <div class="flex justify-between items-start gap-4">

                <span class="text-gray-500">
                    Surat
                </span>

                <span
                    id="dSurat"
                    class="font-medium text-right"
                ></span>

            </div>

            <!-- AYAT -->
            <div class="flex justify-between items-start gap-4">

                <span class="text-gray-500">
                    Ayat
                </span>

                <span
                    id="dAyat"
                    class="font-medium text-right"
                ></span>

            </div>

            <!-- HALAMAN -->
            <div class="flex justify-between items-start gap-4">

                <span class="text-gray-500">
                    Halaman
                </span>

                <span
                    id="dHalaman"
                    class="font-semibold text-[#075F7C] text-right"
                ></span>

            </div>

            <!-- STATUS -->
            <div class="flex justify-between items-start gap-4">

                <span class="text-gray-500">
                    Status
                </span>

                <span
                    id="dStatus"
                    class="font-semibold text-right"
                ></span>

            </div>

            <!-- NILAI -->
            <div class="flex justify-between items-start gap-4">

                <span class="text-gray-500">
                    Nilai
                </span>

                <span
                    id="dNilai"
                    class="font-semibold text-right"
                ></span>

            </div>

            <!-- CATATAN -->
            <div>

                <p class="text-gray-500 mb-2">
                    Catatan Penyimak
                </p>

                <div
                    id="dCatatan"
                    class="bg-gray-50 border rounded-xl p-3
                           text-gray-700 text-sm leading-relaxed
                           max-h-32 overflow-y-auto"
                ></div>

            </div>

        </div>

    </div>

</div>

<script>

function closeModal() {
    const modal = document.getElementById('modalDetail');
    modal.classList.add('hidden');
}

// klik luar modal = close
window.onclick = function(event) {
    const modal = document.getElementById('modalDetail');
    if (event.target === modal) {
        closeModal();
    }
}
</script>

</x-app-layout>