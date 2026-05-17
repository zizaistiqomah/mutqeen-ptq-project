<x-app-pengurus-layout>

@section('content')

<div class="bg-white rounded-2xl shadow p-6">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold">
            Laporan Tahfidz
        </h2>

        <a href="{{ route('laporan-tahfidz.export') }}"
        class="bg-[#075F7C] text-white px-4 py-2 rounded-lg text-sm inline-block hover:bg-[#064b62] transition">
            Export Excel
        </a>
    </div>


    {{-- FILTER --}}
    <form method="GET" action="{{ route('pengurus.laporan-tahfidz') }}"
      class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">

    {{-- tanggal awal --}}
    <input
        type="date"
        name="tanggal_awal"
        value="{{ request('tanggal_awal') }}"
        class="border rounded-lg px-3 py-2">

    {{-- tanggal akhir --}}
    <input
        type="date"
        name="tanggal_akhir"
        value="{{ request('tanggal_akhir') }}"
        class="border rounded-lg px-3 py-2">

    {{-- semua halaqah --}}
    <select name="halaqah" class="border rounded-lg px-3 py-2">
        <option value="">Semua Halaqah</option>
        @foreach($halaqahList as $halaqah)
            <option value="{{ $halaqah->id }}"
                {{ request('halaqah') == $halaqah->id ? 'selected' : '' }}>
                {{ $halaqah->nama_halaqah }}
            </option>
        @endforeach
    </select>

    {{-- semua penyimak --}}
    <select name="penyimak" class="border rounded-lg px-3 py-2">
        <option value="">Semua Penyimak</option>
        @foreach($penyimakList as $penyimak)
            <option value="{{ $penyimak->id }}"
                {{ request('penyimak') == $penyimak->id ? 'selected' : '' }}>
                {{ $penyimak->user->name ?? '-' }}
            </option>
        @endforeach
    </select>

    <button type="submit"
        class="bg-[#075F7C] text-white rounded-lg px-4 py-2">
        Filter
    </button>
</form>

        {{-- RoW TABEL --}}
    @forelse($laporan as $setoran)

        <div class="bg-gray-50 rounded-2xl border p-5 mb-4">

            <div class="flex justify-between items-start">

                <h3 class="text-lg font-bold text-[#075F7C]">
                    {{ $setoran->user->name ?? '-' }}
                </h3>

                <span class="text-sm text-gray-500 font-medium">
                    {{ $setoran->user->halaqah->nama_halaqah ?? '-' }}
                </span>

            </div>

            <p class="text-sm text-gray-500 mt-1">
                Penyimak :
                {{ $setoran->penyimak->user->name ?? '-' }}
            </p>

            <div class="flex flex-wrap gap-6 mt-4 text-sm text-gray-700">

                <p>
                    <b>Juz:</b>
                    {{ $setoran->juz ?? '-' }}
                </p>

                <p>
                    <b>Surat:</b>
                    {{ $setoran->surat_selesai ?? '-' }}
                </p>

                <p>
                    <b>Status:</b>
                    {{ ucfirst($setoran->status ?? '-') }}
                </p>

            </div>

            <p class="text-sm text-gray-400 mt-3">
                Tanggal :
                {{ $setoran->tanggal
                    ? \Carbon\Carbon::parse($setoran->tanggal)->format('d M Y')
                    : '-' }}
            </p>

        </div>

    @empty

        <div class="text-center text-gray-400 py-10">
            Belum ada data laporan
        </div>

    @endforelse

    {{-- pagination --}}
    <div class="mt-6">
        {{ $laporan->withQueryString()->links() }}
    </div>

</div>

@endsection
</x-app-pengurus-layout>