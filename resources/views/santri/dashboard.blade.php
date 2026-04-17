@php
    $murojaah = $murojaahTerakhir ?? null;
@endphp


<x-app-layout>
    <div class="p-6 bg-[#F5F7FA] min-h-screen">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-[#1E3A5F]">
                    Dashboard Santri
                </h1>
                <p class="text-gray-600">
                    Assalamu’alaikum,
                    <span class="font-semibold">{{ auth()->user()->name }}</span> 👋
                </p>
            </div>

            <a href="/santri/setoran/create"
               class="bg-[#4A90E2] text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition">
                + Input Setoran
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow p-5 mb-6">

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold">🎯 Target Hafalan</h2>

        <button onclick="document.getElementById('formTarget').classList.toggle('hidden')"
                class="bg-blue-500 text-white px-3 py-1 rounded">
            + Set Target
        </button>
    </div>

    <!-- PROGRESS -->
    <div class="mb-4">
        <div class="w-full bg-gray-200 h-2 rounded-full">
            <div class="bg-green-500 h-2 rounded-full"
                 style="width: {{ $progressTarget ?? 0 }}%">
            </div>
        </div>
        <p class="text-sm mt-1">{{ round($progressTarget ?? 0) }}%</p>
    </div>

    <!-- LIST -->
    @forelse($targets ?? [] as $target)
        <div class="flex justify-between items-center border-b py-2">

            <p>Juz {{ $target->juz }} - {{ $target->surat }}</p>

            <form method="POST" action="/santri/target/{{ $target->id }}/toggle">
                @csrf
                <input type="checkbox"
                       onchange="this.form.submit()"
                       {{ $target->status ? 'checked' : '' }}>
            </form>

        </div>
    @empty
        <p class="text-gray-400">Belum ada target</p>
    @endforelse

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

        <button class="bg-green-500 text-white px-4 py-2 rounded">
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

<!-- 🔥 LOGIC KAMU (JANGAN DIUBAH) -->
<script>
document.getElementById('juzSelect').addEventListener('change', function () {
    let juz = this.value;
    let suratSelect = document.getElementById('suratSelect');

    // reset
    suratSelect.innerHTML = '<option value="">Pilih Surat</option>';

    if (juzSurat[juz]) {
        juzSurat[juz].forEach(function (surat) {
            let option = document.createElement('option');
            option.value = surat;
            option.text = surat;
            suratSelect.appendChild(option);
        });
    }
});
</script>


</div>

        <!-- 🔥 SETORAN TERAKHIR -->
        <div class="bg-white rounded-2xl shadow p-5 mb-6">

            <h2 class="text-lg font-semibold text-[#1E3A5F] mb-4">
                🧾 Setoran Terakhir
            </h2>

            @if(isset($setoranTerakhir) && $setoranTerakhir)

                <p class="font-semibold text-[#1E3A5F]">
                    {{ $setoranTerakhir->surat_mulai }}
                    ({{ $setoranTerakhir->ayat_mulai }})
                    -
                    {{ $setoranTerakhir->surat_selesai }}
                    ({{ $setoranTerakhir->ayat_selesai }})
                </p>

                <p class="text-sm text-gray-500 mt-1">
                    Juz {{ $setoranTerakhir->juz }} • {{ $setoranTerakhir->tanggal }}
                </p>

                <div class="mt-3">

                    @if($setoranTerakhir->status == 'pending')
                        <span class="bg-orange-100 text-orange-600 px-3 py-1 rounded-full text-sm">
                            ⏳ Pending
                        </span>

                    @elseif($setoranTerakhir->status == 'diterima')
                        <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm">
                            ✔ Terverifikasi
                        </span>

                    @elseif($setoranTerakhir->status == 'mengulang')
                        <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm">
                            🔁 Mengulang
                        </span>

                    @endif

                </div>

            @else
                <p class="text-gray-400">
                    Belum ada setoran
                </p>
            @endif

        </div>

        <!-- 📖 MUROJAAH -->
        <div class="bg-white rounded-2xl shadow p-5 mb-6">

            <h2 class="text-lg font-semibold text-[#1E3A5F] mb-4">
                📖 Murojaah Terakhir
            </h2>

            @if($murojaah)

                <p class="font-semibold">
                    Juz {{ $murojaah->juz }}
                </p>

                <p class="text-gray-700">
                    {{ $murojaah->surat }} ({{ $murojaah->ayat }})
                </p>

                @if($murojaah->status)
                    <p class="text-green-600 font-semibold mt-2">
                        ✔ Selesai
                    </p>
                @else
                    <p class="text-yellow-600 font-semibold mt-2">
                        ⏳ Belum selesai
                    </p>
                @endif

            @else
                <p class="text-gray-400">
                    Belum ada murojaah
                </p>
            @endif

        </div>

        <!-- RIWAYAT SETORAN -->
        <div class="bg-white rounded-2xl shadow p-5">

            <h2 class="text-lg font-semibold text-[#1E3A5F] mb-4">
                Riwayat Setoran
            </h2>

            @forelse($setorans ?? [] as $setoran)
                <div class="border-b py-3 flex justify-between">

                    <div>
                        <p class="font-semibold">
                            {{ $setoran->surat_mulai }} - {{ $setoran->surat_selesai }}
                        </p>
                        <p class="text-sm text-gray-500">
                            {{ $setoran->tanggal }}
                        </p>
                    </div>

                    <div>
                        @if($setoran->status == 'pending')
                            <span class="text-orange-600">Pending</span>

                        @elseif($setoran->status == 'diterima')
                            <span class="text-green-600">Terverifikasi</span>

                        @else
                            <span class="text-red-600">Mengulang</span>
                        @endif
                    </div>

                </div>
            @empty
                <p class="text-gray-400">Belum ada setoran</p>
            @endforelse

        </div>

    </div>
</x-app-layout>