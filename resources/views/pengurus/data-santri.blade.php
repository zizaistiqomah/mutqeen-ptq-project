<x-app-pengurus-layout>

@section('content')

<div class="bg-white rounded-2xl shadow p-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-xl font-bold text-gray-800">
                Data Santri
            </h2>
            <p class="text-sm text-gray-500">
                Daftar seluruh santri terdaftar
            </p>
        </div>

        <div class="bg-[#075F7C] text-white px-4 py-2 rounded-xl text-sm">
            Total: {{ $santris->count() }} Data Santri
        </div>
    </div>

    <!-- TABLE -->
    <div class="overflow-x-auto rounded-xl border border-gray-100">

        <table class="w-full text-sm text-left">

            <thead>
                <tr class="bg-[#075F7C] text-white">
                    <th class="py-3 px-4 rounded-tl-xl">No</th>
                    <th class="py-3 px-4">Nama</th>
                    <th class="py-3 px-4">Email</th>
                    <th class="py-3 px-4">No Handphone</th>
                    <th class="py-3 px-4">Halaqah</th>
                    <th class="py-3 px-4">Status</th>
                    <th class="py-3 px-4 rounded-tr-xl">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($santris as $santri)

                <tr class="border-b hover:bg-gray-50 transition">

                    <td class="py-3 px-4 text-gray-700">
                        {{ $loop->iteration }}
                    </td>

                    <!-- NAMA -->
                    <td class="py-3 px-4 font-semibold text-gray-800">
                        {{ $santri->name }}
                    </td>

                    <!-- EMAIL -->
                    <td class="py-3 px-4">
                        {{ $santri->email }}
                    </td>

                    <!-- NO HP -->
                    <td class="py-3 px-4">
                        {{ $santri->santri->no_hp ?? '-' }}
                    </td>

                    <!-- HALAQAH -->
                    <td class="py-3 px-4">
                        {{ $santri->halaqah->nama_halaqah ?? '-' }}
                    </td>

                    <!-- STATUS -->
                    <td class="py-3 px-4">
                        @if($santri->halaqah)
                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-300 text-green-700">
                                Terkelompok
                            </span>
                        @else
                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-yellow-300 text-gray-700">
                                Pending
                            </span>
                        @endif
                    </td>

                    <!-- AKSI -->
                    <td class="py-3 px-4 space-x-2">

                        <!-- EDIT -->
                        <button 
                            type="button"
                            onclick='openEditModal(@json($santri))'
                            class="text-blue-600 text-sm hover:underline">
                            Edit
                        </button>

                        <!-- HAPUS -->
                        <button 
                            type="button"
                            onclick="openDeleteModal({{ $santri->id }}, @js($santri->name))"
                            class="text-red-600 text-sm hover:underline">
                            Hapus
                        </button>

                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="7" class="py-6 text-center text-gray-400">
                        Tidak ada data santri
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>

    </div>

</div>

<!-- ================= EDIT MODAL ================= -->
<div id="editModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white w-full max-w-md rounded-2xl p-6">

        <h2 class="text-lg font-bold mb-4">Edit Pengelompokan</h2>

        <form method="POST" id="editForm">
            @csrf
            @method('PUT')

            <input type="hidden" name="id" id="edit_id">

            <!-- NAMA -->
            <div class="mb-3">
                <label class="text-sm">Nama Santri</label>
                <input type="text" id="edit_name"
                    class="w-full border rounded-lg px-3 py-2 mt-1 bg-gray-100"
                    readonly>
            </div>

            <!-- HALAQAH -->
            <div class="mb-4">
                <label class="text-sm">Pilih Halaqah</label>
                <select name="halaqah_id" id="edit_halaqah"
                    class="w-full border rounded-lg px-3 py-2 mt-1">

                    <option value="">-- Belum Dikelompokkan --</option>

                    @foreach($halaqahList as $halaqah)
                        <option value="{{ $halaqah->id }}">
                            {{ $halaqah->nama_halaqah }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeEditModal()">Batal</button>

                <button type="submit"
                    class="bg-[#075F7C] text-white px-4 py-2 rounded-lg text-sm">
                    Simpan
                </button>
            </div>

        </form>

    </div>
</div>

<!-- ================= DELETE MODAL ================= -->
<div id="deleteModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white w-full max-w-sm rounded-2xl p-6 text-center">

        <h2 class="text-lg font-bold mb-2">Hapus Santri</h2>

        <p class="text-sm text-gray-500 mb-4">
            Yakin ingin menghapus santri 
            <span id="deleteName" class="font-semibold text-gray-800"></span>?
        </p>

        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')

            <div class="flex justify-center gap-3">
                <button type="button" onclick="closeDeleteModal()"
                    class="px-4 py-2 text-sm">
                    Batal
                </button>

                <button type="submit"
                    class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm">
                    Hapus
                </button>
            </div>
        </form>

    </div>
</div>

<!-- ================= SCRIPT ================= -->
<script>
function openEditModal(data) {
    document.getElementById('editModal').classList.remove('hidden');
    document.getElementById('editModal').classList.add('flex');

    document.getElementById('edit_id').value = data.id;
    document.getElementById('edit_name').value = data.name;
    document.getElementById('edit_halaqah').value = data.halaqah_id ?? "";

    document.getElementById('editForm').action = `/pengurus/santri/${data.id}/update-halaqah`;
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
    document.getElementById('editModal').classList.remove('flex');
}

function openDeleteModal(id, name) {
    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('deleteModal').classList.add('flex');

    document.getElementById('deleteForm').action = `/pengurus/santri/${id}`;
    document.getElementById('deleteName').innerText = name;
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    document.getElementById('deleteModal').classList.remove('flex');
}
</script>

@endsection

</x-app-pengurus-layout>