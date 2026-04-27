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
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold ">
                    🎯 Target Hafalan
                </h2>

                <button onclick="document.getElementById('formTarget').classList.toggle('hidden')"
                        class="hover:bg-[#1E3A5F] active:scale-95 bg-[#075F7C] text-white px-3 py-1 rounded-lg text-sm">
                    + Set Target
                </button>
            </div>

            <!-- PROGRESS -->
            <div class="mb-5">
                <div class="w-full bg-gray-200 h-2 rounded-full">
                    <div class="bg-[#075F7C] h-2 rounded-full"
                         style="width: {{ $progressTarget ?? 0 }}%">
                    </div>
                </div>
                <p class="text-sm mt-2">
                    {{ round($progressTarget ?? 0) }}%
                </p>
            </div>

            <!-- LIST -->
            <div class="space-y-2 max-h-40 overflow-y-auto">
                @forelse($targets ?? [] as $target)
                    <div class="flex justify-between items-center border-b py-2">
                        <p>Juz {{ $target->juz }} - {{ $target->surat }}</p>

                        <form method="POST" action="/santri/target/{{ $target->id }}/toggle">
                            @csrf
                            <input type="checkbox"
                                onchange="this.form.submit()"
                                class="w-4 h-4 text-[#075F7C] border-gray-300 rounded focus:ring-[#075F7C]"
                                {{ $target->status ? 'checked' : '' }}>
                        </form>
                    </div>
                @empty
                    <p class="text-gray-400">Belum ada target</p>
                @endforelse
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
    </div>

</div>


<!-- SETORAN + RIWAYAT -->
<div class="flex flex-col lg:flex-row gap-5 mt-6">

    <!-- LEFT: FORM SETORAN -->
    <div class="w-full lg:w-1/3">
        <div class="bg-white rounded-2xl shadow p-5 h-full">

            <!-- HEADER -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold ">
                    📝 Setoran Hafalan
                </h2>

                <button onclick="document.getElementById('formSetoran').classList.toggle('hidden')"
                    class="hover:bg-[#1E3A5F] active:scale-95 bg-[#075F7C] text-white px-3 py-1 rounded-lg text-sm">
                    + Tambah
                </button>
            </div>

            <!-- INFO -->
            <div class="bg-[#075F7C]/10 text-[#075F7C] p-3 rounded-lg text-sm mb-4">
                Setoran akan masuk antrean dan menunggu verifikasi penyimak
            </div>

            <!-- FORM -->
            <form method="POST" action="/santri/setoran"
                id="formSetoran"
                class="hidden space-y-3">
                @csrf

                <select name="juz" id="juzSetoran"
                    class="w-full border rounded-lg p-2">
                    <option value="">Pilih Juz</option>
                    @for($i=1; $i<=30; $i++)
                        <option value="{{ $i }}">Juz {{ $i }}</option>
                    @endfor
                </select>

                <input type="date" name="tanggal"
                    class="w-full border rounded-lg p-2">

                <select name="surat_mulai" id="suratMulai"
                    class="w-full border rounded-lg p-2">
                    <option value="">Surat Mulai</option>
                </select>

                <input type="text" name="ayat_mulai"
                    placeholder="Ayat Mulai"
                    class="w-full border rounded-lg p-2">

                <select name="surat_selesai" id="suratSelesai"
                    class="w-full border rounded-lg p-2">
                    <option value="">Surat Selesai</option>
                </select>

                <input type="text" name="ayat_selesai"
                    placeholder="Ayat Selesai"
                    class="w-full border rounded-lg p-2">

                <button
                    class="hover:bg-[#1E3A5F] active:scale-95 w-full bg-[#075F7C] text-white py-2 rounded-lg">
                    Simpan
                </button>
            </form>

        </div>
    </div>

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
                        <th class="px-4 py-2">Tanggal</th>
                        <th class="px-4 py-2">Surat</th>
                        <th class="px-4 py-2">Ayat</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Nilai</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($setorans ?? [] as $setoran)
                        <tr class="border-b hover:bg-gray-50">

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
                                    onclick="openModal(
                                        '{{ $setoran->surat_mulai }}',
                                        '{{ $setoran->ayat_mulai }}',
                                        '{{ $setoran->surat_selesai }}',
                                        '{{ $setoran->ayat_selesai }}',
                                        '{{ $setoran->juz }}',
                                        '{{ $setoran->tanggal }}',
                                        '{{ $setoran->status }}',
                                        '{{ $setoran->nilai ?? '-' }}',
                                        `{{ $setoran->catatan ?? '-' }}`
                                    )"
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

    // 🔥 DATA JUZ
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

    // 🔥 FUNCTION GLOBAL
    function isiSurat(juz, target1, target2 = null) {
        if (!target1) return;

        target1.innerHTML = '<option value="">Pilih Surat</option>';
        if (target2) target2.innerHTML = '<option value="">Pilih Surat</option>';

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

    // 🔥 TARGET
    const juzTarget = document.getElementById('juzSelect');
    const suratTarget = document.getElementById('suratSelect');

    if (juzTarget && suratTarget) {
        juzTarget.addEventListener('change', function () {
            isiSurat(this.value, suratTarget);
        });
    }

    // 🔥 SETORAN
    const juzSetoran = document.getElementById('juzSetoran');
    const suratMulai = document.getElementById('suratMulai');
    const suratSelesai = document.getElementById('suratSelesai');

    if (juzSetoran && suratMulai && suratSelesai) {
        juzSetoran.addEventListener('change', function () {
            isiSurat(this.value, suratMulai, suratSelesai);
        });
    }

});
</script>

<!-- MODAL DETAIL -->
<div id="modalDetail"
    class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white rounded-2xl shadow-lg w-full max-w-md p-6 relative animate-scaleIn">

        <!-- CLOSE -->
        <button onclick="closeModal()"
            class="absolute top-3 right-3 text-gray-400 hover:text-black text-xl">
            ✖
        </button>

        <h2 class="text-lg font-semibold text-[#1E3A5F] mb-4">
            📄 Detail Setoran
        </h2>

        <div class="space-y-2 text-sm">

            <p><b>Juz:</b> <span id="dJuz"></span></p>
            <p><b>Tanggal:</b> <span id="dTanggal"></span></p>

            <p><b>Surat:</b>
                <span id="dSurat"></span>
            </p>

            <p><b>Ayat:</b>
                <span id="dAyat"></span>
            </p>

            <p><b>Status:</b>
                <span id="dStatus" class="font-semibold"></span>
            </p>

            <p><b>Nilai:</b>
                <span id="dNilai"></span>
            </p>

            <div>
                <p><b>Catatan:</b></p>
                <div id="dCatatan"
                    class="bg-gray-100 p-3 rounded-lg text-gray-700 max-h-40 overflow-y-auto">
                </div>
            </div>

        </div>

    </div>
</div>
<script>
function openModal(suratMulai, ayatMulai, suratSelesai, ayatSelesai, juz, tanggal, status, nilai, catatan) {

    const modal = document.getElementById('modalDetail');

    modal.classList.remove('hidden');
    modal.classList.add('flex');

    document.getElementById('dJuz').innerText = juz;
    document.getElementById('dTanggal').innerText = tanggal;

    document.getElementById('dSurat').innerText =
        suratMulai + ' - ' + suratSelesai;

    document.getElementById('dAyat').innerText =
        ayatMulai + ' - ' + ayatSelesai;

    // STATUS STYLE
    let statusText = status;
    if (status === 'pending') statusText = '⏳ Pending';
    if (status === 'diterima') statusText = '✔ Terverifikasi';
    if (status === 'mengulang') statusText = '🔁 Mengulang';

    document.getElementById('dStatus').innerText = statusText;

    document.getElementById('dNilai').innerText = nilai || '-';
    document.getElementById('dCatatan').innerText = catatan || '-';
}

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