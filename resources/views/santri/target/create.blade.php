<x-app-layout>
<div class="p-6">

    <h1 class="text-xl font-bold mb-4">Tambah Target</h1>

    <form method="POST" action="{{ route('santri.target.store') }}">
        @csrf

        <input type="number" name="juz" placeholder="Juz (1-30)" class="border p-2 w-full mb-2">

        <input type="text" name="surah" placeholder="Nama Surah" class="border p-2 w-full mb-2">

        <input type="number" name="ayat_mulai" placeholder="Ayat Mulai" class="border p-2 w-full mb-2">

        <input type="number" name="ayat_selesai" placeholder="Ayat Selesai" class="border p-2 w-full mb-2">

        <input type="date" name="tanggal_setor" class="border p-2 w-full mb-2">

        <button class="bg-blue-500 text-white px-4 py-2 rounded">
            Simpan
        </button>
    </form>

</div>
</x-app-layout>