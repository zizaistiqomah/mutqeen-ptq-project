<x-app-dashboard-layout>

{{-- HEADER CARDS --}}
<div class="grid grid-cols-4 gap-5 mt-6">

    {{-- CARD 1 --}}
    <div class="bg-white border border-gray-100 rounded-3xl p-5 flex items-start justify-between shadow-sm">

        <div class="flex gap-4">

            <div class="w-14 h-14 rounded-2xl bg-[#075F7C] flex items-center justify-center">
                <i class="fi fi-rr-users text-white text-2xl"></i>
            </div>

            <div>
                <p class="text-sm text-gray-500">
                    Kelompok Halaqah
                </p>

                <h3 class="text-xl font-bold text-gray-800 mt-1">
                    {{ $halaqah?->nama_halaqah ?? 'Belum ada halaqah' }}
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    Penyimak: {{ $user->name }}
                </p>
            </div>

        </div>

        <button
            type="button"
            onclick="openHalaqahModal()"
            class="text-sm text-[#075F7C] font-medium hover:underline"
        >
            Detail
        </button>

    </div>

    {{-- CARD 2 --}}
    <div class="bg-white border border-gray-100 rounded-3xl p-5 shadow-sm">

        <div class="flex items-center gap-4">

            <div class="w-14 h-14 rounded-2xl bg-[#075F7C] flex items-center justify-center">
                <i class="fi fi-rr-time-check text-white text-2xl"></i>
            </div>

            <div>
                <p class="text-sm text-gray-500">
                    Antrean Setoran Hari Ini
                </p>

                <h3 class="text-3xl font-bold text-gray-800 mt-1">
                    {{ $antrianHariIni }} Santri
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    Menunggu verifikasi
                </p>
            </div>

        </div>

    </div>

    {{-- CARD 3 --}}
    <div class="bg-white border border-gray-100 rounded-3xl p-5 shadow-sm">

        <div class="flex items-center gap-4">

            <div class="w-14 h-14 rounded-2xl bg-[#075F7C] flex items-center justify-center">
                <i class="fi fi-rr-badge-check text-white text-2xl"></i>
            </div>

            <div>
                <p class="text-sm text-gray-500">
                    Total Verifikasi
                </p>

                <h3 class="text-3xl font-bold text-gray-800 mt-1">
                    {{ $totalVerifikasi }} Setoran
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    Semua verifikasi
                </p>
            </div>

        </div>

    </div>

    {{-- CARD 4 --}}
    <div class="bg-white border border-gray-100 rounded-3xl p-5 shadow-sm">

        <div class="flex items-center gap-4">

            <div class="w-14 h-14 rounded-2xl bg-[#075F7C] flex items-center justify-center">
                <i class="fi fi-rr-chart-histogram text-white text-2xl"></i>
            </div>

            <div>
                <p class="text-sm text-gray-500">
                    Total Setoran Minggu Ini
                </p>

                <h3 class="text-3xl font-bold text-gray-800 mt-1">
                    {{ $totalSetoranMingguIni }} Setoran
                </h3>

                @if($persentaseMingguan >= 0)

                    <p class="text-sm text-green-500 mt-1">
                        Naik {{ $persentaseMingguan }}% dari minggu lalu ↗
                    </p>

                @else

                    <p class="text-sm text-red-500 mt-1">
                        Turun {{ abs($persentaseMingguan) }}% dari minggu lalu ↘
                    </p>

                @endif

            </div>

        </div>

    </div>

</div>

{{-- TABLE --}}
<div class="bg-white rounded-3xl p-6 mt-6 border border-gray-100">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">

        <div>
            <h2 class="text-xl font-bold text-gray-800">
                Antrean Setoran Hafalan
            </h2>

            <p class="text-gray-500 text-sm mt-1">
                Daftar santri yang menunggu verifikasi setoran
            </p>
        </div>

        <input
            type="text"
            id="searchInput"
            placeholder="Cari santri..."
            class="border border-gray-200 rounded-2xl px-4 py-3 w-72 focus:outline-none focus:ring-2 focus:ring-[#075F7C]"
        >
    </div>

    {{-- TABLE --}}
    <div class="overflow-x-auto">

        <table class="w-full">

            <thead>
                <tr class="text-left border-b border-gray-100 text-gray-500 text-sm">

                    <th class="pb-4">Santri</th>
                    <th class="pb-4">Tanggal</th>
                    <th class="pb-4">Juz</th>
                    <th class="pb-4">Rentang Ayat</th>
                    <th class="pb-4">Status</th>
                    <th class="pb-4 text-center">Aksi</th>

                </tr>
            </thead>

            <tbody>

                @forelse($setoranPending as $setoran)

                    <tr
                        class="border-b border-gray-50 table-row"
                        data-name="{{ strtolower($setoran->santri->name) }}"
                    >

                        {{-- SANTRI --}}
                        <td class="py-5">

                            <div>
                                <h3 class="font-semibold text-gray-800">
                                    {{ $setoran->santri->name }}
                                </h3>

                                <p class="text-sm text-gray-500 mt-1">
                                    Setoran Hafalan
                                </p>
                            </div>

                        </td>

                        {{-- TANGGAL --}}
                        <td class="py-5 text-gray-600">
                            {{ \Carbon\Carbon::parse($setoran->tanggal)->format('d M Y') }}
                        </td>

                        {{-- JUZ --}}
                        <td class="py-5 text-gray-600">
                            Juz {{ $setoran->juz }}
                        </td>

                        {{-- AYAT --}}
                        <td class="py-5 text-gray-600">
                            {{ $setoran->surat_mulai }}
                            : {{ $setoran->ayat_mulai }}

                            -

                            {{ $setoran->surat_selesai }}
                            : {{ $setoran->ayat_selesai }}
                        </td>

                        {{-- STATUS --}}
                        <td class="py-5">

                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-medium">
                                Pending
                            </span>

                        </td>

                        {{-- BUTTON --}}
                        <td class="py-5 text-center">

                            <button
                                type="button"
                                onclick="openModal({{ $setoran->id }})"
                                class="bg-[#075F7C] text-white px-5 py-2 rounded-xl hover:opacity-90 transition"
                            >
                                Verifikasi
                            </button>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="py-10 text-center text-gray-400">

                            Belum ada antrean setoran

                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

{{-- MODAL VERIFIKASI --}}
<div
    id="verifikasiModal"
    class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50"
>

    <div class="bg-white w-full max-w-2xl rounded-3xl p-8 relative">

        {{-- CLOSE --}}
        <button
            onclick="closeModal()"
            class="absolute top-5 right-5 text-gray-400 hover:text-gray-600 text-2xl"
        >
            ×
        </button>

        {{-- TITLE --}}
        <div class="mb-6">

            <h2 class="text-2xl font-bold text-gray-800">
                Verifikasi Setoran
            </h2>

            <p class="text-gray-500 mt-1">
                Periksa dan validasi hafalan santri
            </p>

        </div>

        {{-- FORM --}}
        <form method="POST" id="verifikasiForm">

            @csrf
            @method('PUT')

            {{-- STATUS --}}
            <div class="mb-5">

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Status Verifikasi
                </label>

                <select
                    name="status"
                    class="w-full border border-gray-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#075F7C]"
                >
                    <option value="diterima">Diterima</option>
                    <option value="revisi">Perlu Revisi</option>
                </select>

            </div>

            {{-- NILAI --}}
            <div class="mb-5">

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Nilai
                </label>

                <select
                    name="nilai"
                    class="w-full border border-gray-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#075F7C]"
                >
                    <option value="mumtaz">Mumtaz</option>
                    <option value="jayyid_jiddan">Jayyid Jiddan</option>
                    <option value="jayyid">Jayyid</option>
                    <option value="hasbuk">Hasbuk</option>
                </select>

            </div>

            {{-- CATATAN --}}
            <div class="mb-6">

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Catatan Penyimak
                </label>

                <textarea
                    name="catatan"
                    rows="4"
                    class="w-full border border-gray-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#075F7C]"
                    placeholder="Tambahkan catatan verifikasi..."
                ></textarea>

            </div>

            {{-- BUTTON --}}
            <div class="flex justify-end gap-3">

                <button
                    type="button"
                    onclick="closeModal()"
                    class="px-5 py-3 rounded-2xl border border-gray-200 text-gray-600 hover:bg-gray-50"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    class="px-5 py-3 rounded-2xl bg-[#075F7C] text-white hover:opacity-90"
                >
                    Simpan Verifikasi
                </button>

            </div>

        </form>

    </div>

</div>

{{-- MODAL HALAQAH --}}
<div
    id="halaqahModal"
    class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50"
>

    <div class="bg-white w-full max-w-2xl rounded-3xl p-8 relative">

        {{-- CLOSE --}}
        <button
            onclick="closeHalaqahModal()"
            class="absolute top-5 right-5 text-gray-400 hover:text-gray-600 text-2xl"
        >
            ×
        </button>

        {{-- HEADER --}}
        <div class="mb-6">

            <h2 class="text-2xl font-bold text-gray-800">
                Daftar Santri Halaqah
            </h2>

            <p class="text-gray-500 mt-1">
                {{ $halaqah?->nama_halaqah }}
            </p>

        </div>

        {{-- LIST --}}
        <div class="space-y-4 max-h-[450px] overflow-y-auto">

            @forelse($anggotaHalaqah as $santri)

                <div class="flex items-center justify-between border border-gray-100 rounded-2xl p-4">

                    <div class="flex items-center gap-4">

                        <div class="w-12 h-12 rounded-full bg-[#075F7C]/10 flex items-center justify-center text-[#075F7C] font-bold">
                            {{ strtoupper(substr($santri->user->name, 0, 1)) }}
                        </div>

                        <div>

                            <div class="flex items-center gap-2">

                                <h3 class="font-semibold text-gray-800">
                                    {{ $santri->user->name }}
                                </h3>

                                @if($loop->iteration == 1)

                                    <span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded-full">
                                        Teraktif
                                    </span>

                                @endif

                            </div>

                            <p class="text-sm text-gray-500 mt-1">
                                {{ $santri->total_setoran }} setoran hafalan semester ini
                            </p>

                        </div>

                    </div>

                    <div class="text-right">

                        <h4 class="text-lg font-bold text-[#075F7C]">
                            {{ $santri->total_setoran }}
                        </h4>

                        <p class="text-xs text-gray-400">
                            Total Setoran
                        </p>

                    </div>

                </div>

            @empty

                <div class="text-center text-gray-400 py-10">

                    Belum ada anggota halaqah

                </div>

            @endforelse

        </div>

    </div>

</div>

{{-- SCRIPT --}}
<script>

    function openModal(id)
    {
        const modal = document.getElementById('verifikasiModal');

        const form = document.getElementById('verifikasiForm');

        form.action = `/penyimak/setoran/${id}/verifikasi`;

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal()
    {
        const modal = document.getElementById('verifikasiModal');

        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }

    function openHalaqahModal()
    {
        const modal = document.getElementById('halaqahModal');

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeHalaqahModal()
    {
        const modal = document.getElementById('halaqahModal');

        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }

    // SEARCH SANTRI
    const searchInput = document.getElementById('searchInput');

    const rows = document.querySelectorAll('.table-row');

    searchInput.addEventListener('keyup', function () {

        const keyword = this.value.toLowerCase();

        rows.forEach(row => {

            const name = row.dataset.name;

            if (name.includes(keyword)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }

        });

    });

</script>

</x-app-dashboard-layout>