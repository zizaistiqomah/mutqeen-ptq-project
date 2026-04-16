<x-app-layout>
<div class="p-6">

    <h1 class="text-xl font-bold mb-4">Edit Target</h1>

    <form method="POST" action="{{ route('santri.target.update', $target->id) }}">
        @csrf
        @method('PUT')

        <input type="text" name="jenis_target" value="{{ $target->jenis_target }}" class="border p-2 w-full mb-2">
        <input type="number" name="jumlah_target" value="{{ $target->jumlah_target }}" class="border p-2 w-full mb-2">
        <input type="date" name="tanggal_mulai" value="{{ $target->tanggal_mulai }}" class="border p-2 w-full mb-2">
        <input type="date" name="tanggal_selesai" value="{{ $target->tanggal_selesai }}" class="border p-2 w-full mb-2">

        <button class="bg-blue-500 text-white px-4 py-2 rounded">
            Update
        </button>
    </form>

</div>
</x-app-layout>