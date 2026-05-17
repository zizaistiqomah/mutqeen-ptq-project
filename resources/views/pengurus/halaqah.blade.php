<x-app-pengurus-layout>

@section('content')

<div class="bg-white rounded-2xl shadow p-6">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold">Data Halaqah</h2>

        <button onclick="openCreateModal()"
            class="bg-[#075F7C] text-white px-4 py-2 rounded-lg text-sm hover:bg-[#064b63]">
            + Tambah Halaqah
        </button>
    </div>

    {{-- LIST HALAQAH --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        @foreach($halaqahList as $halaqah)
        <div class="bg-white rounded-2xl p-5 shadow border">

            <div class="flex justify-between items-start">
                <h3 class="font-bold text-lg">
                    {{ $halaqah->nama_halaqah }}
                </h3>

                <div class="space-x-2">
                    <button
                        onclick='openEditModal(@json($halaqah))'
                        class="text-blue-600 text-sm">
                        Edit
                    </button>

                    <button
                        onclick="openDeleteModal({{ $halaqah->id }}, '{{ $halaqah->nama_halaqah }}')"
                        class="text-red-600 text-sm">
                        Hapus
                    </button>
                </div>
            </div>

            {{-- PENYIMAK --}}
            <p class="text-sm text-gray-500 mt-2">
                Penyimak:
                {{ $halaqah->penyimak?->user?->name ?? $halaqah->penyimak?->nama ?? '-' }}
            </p>

            {{-- SANTRI --}}
            <div class="mt-3">
                <p class="text-sm font-medium mb-1">Santri:</p>

                @if($halaqah->santris->count())
                    <ul class="text-sm text-gray-600 list-disc ml-5">
                        @foreach($halaqah->santris as $santri)
                            <li>{{ $santri->name }}</li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-sm text-gray-400">
                        Belum ada santri
                    </p>
                @endif
            </div>

        </div>
        @endforeach

    </div>
</div>


{{-- ================= CREATE MODAL ================= --}}
<div id="createModal"
     class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white w-full max-w-lg rounded-2xl p-6 shadow-lg">

        <div class="flex justify-between items-center mb-5">
            <h2 class="text-lg font-bold">Tambah Halaqah</h2>

            <button onclick="closeCreateModal()"
                class="text-gray-400 hover:text-gray-600">
                ✕
            </button>
        </div>

        <form method="POST" action="/pengurus/halaqah">
            @csrf

            {{-- nama halaqah --}}
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">
                    Nama Halaqah
                </label>

                <input
                    type="text"
                    name="nama_halaqah"
                    class="w-full border rounded-lg px-3 py-2"
                    required>
            </div>

            {{-- penyimak --}}
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">
                    Penyimak
                </label>

                <select
                    name="penyimak_id"
                    class="w-full border rounded-lg px-3 py-2"
                    required>

                    <option value="">-- Pilih Penyimak --</option>

                    @foreach($penyimaks as $penyimak)
                        <option value="{{ $penyimak->id }}">
                            {{ $penyimak->user?->name ?? $penyimak->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- santri --}}
            <div class="mb-5">
                <label class="block text-sm font-medium mb-1">
                    Pilih Santri
                </label>

                <input
                    type="text"
                    id="searchSantri"
                    placeholder="Cari santri..."
                    class="w-full border rounded-lg px-3 py-2 mb-3">

                <div class="border rounded-lg p-3">

                    <label class="flex items-center gap-2 mb-3">
                        <input type="checkbox" id="checkAll">
                        <span class="text-sm font-medium">
                            Pilih Semua
                        </span>
                    </label>

                    <div id="santriList"
                         class="h-48 overflow-y-auto space-y-2">

                        @foreach($santris as $s)
                        <label class="flex items-center gap-2 santri-item hover:bg-gray-100 px-2 py-1 rounded cursor-pointer">
                            <input
                                type="checkbox"
                                name="santri_ids[]"
                                value="{{ $s->id }}">

                            <span>{{ $s->name }}</span>
                        </label>
                        @endforeach

                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-2">
                <button
                    type="button"
                    onclick="closeCreateModal()"
                    class="px-4 py-2 text-sm text-gray-600">
                    Batal
                </button>

                <button
                    type="submit"
                    class="bg-[#075F7C] text-white px-4 py-2 rounded-lg text-sm">
                    Simpan
                </button>
            </div>

        </form>
    </div>
</div>

<!-- ================= EDIT HALAQAH MODAL ================= -->
<div id="editModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white w-full max-w-lg rounded-2xl p-6 shadow-lg">

        <div class="flex justify-between items-center mb-5">
            <h2 class="text-lg font-bold">Edit Halaqah</h2>

            <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                ✕
            </button>
        </div>

        <form method="POST" id="editForm">
            @csrf
            @method('PUT')

            {{-- nama halaqah --}}
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">
                    Nama Halaqah
                </label>

                <input
                    type="text"
                    id="editNama"
                    name="nama_halaqah"
                    class="w-full border rounded-lg px-3 py-2"
                    required>
            </div>

            {{-- penyimak --}}
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">
                    Penyimak
                </label>

                <select
                    id="editPenyimak"
                    name="penyimak_id"
                    class="w-full border rounded-lg px-3 py-2"
                    required>

                    @foreach($penyimaks as $penyimak)
                        <option value="{{ $penyimak->id }}">
                            {{ $penyimak->user?->name ?? $penyimak->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- santri --}}
            <div class="mb-5">
                <label class="block text-sm font-medium mb-1">
                    Pilih Santri
                </label>

                <div class="border rounded-lg p-3 h-48 overflow-y-auto">
                    @foreach($santris as $s)
                        <label class="flex items-center gap-2 py-1">
                            <input
                                type="checkbox"
                                name="santri_ids[]"
                                value="{{ $s->id }}"
                                class="editSantri">

                            <span>{{ $s->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-end gap-2">
                <button
                    type="button"
                    onclick="closeEditModal()"
                    class="px-4 py-2 text-sm text-gray-600">
                    Batal
                </button>

                <button
                    type="submit"
                    class="bg-[#075F7C] text-white px-4 py-2 rounded-lg">
                    Update
                </button>
            </div>

        </form>
    </div>
</div>

<!-- ================= DELETE MODAL ================= -->
<div id="deleteModal"
     class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white rounded-2xl p-6 w-full max-w-md">

        <h2 class="text-lg font-bold mb-3">
            Hapus Halaqah
        </h2>

        <p class="text-gray-600 mb-5">
            Yakin ingin menghapus
            <span id="deleteNama" class="font-semibold"></span>?
        </p>

        <form method="POST" id="deleteForm">
            @csrf
            @method('DELETE')

            <div class="flex justify-end gap-2">
                <button
                    type="button"
                    onclick="closeDeleteModal()"
                    class="px-4 py-2 text-gray-600">
                    Batal
                </button>

                <button
                    type="submit"
                    class="bg-red-600 text-white px-4 py-2 rounded-lg">
                    Hapus
                </button>
            </div>
        </form>

    </div>
</div>

<script>
function openCreateModal(){
    document.getElementById('createModal').classList.remove('hidden');
    document.getElementById('createModal').classList.add('flex');
}

function closeCreateModal(){
    document.getElementById('createModal').classList.add('hidden');
    document.getElementById('createModal').classList.remove('flex');
}


// ================= EDIT =================
function openEditModal(halaqah){
    document.getElementById('editModal').classList.remove('hidden');
    document.getElementById('editModal').classList.add('flex');

    document.getElementById('editForm').action =
        `/pengurus/halaqah/${halaqah.id}`;

    document.getElementById('editNama').value =
        halaqah.nama_halaqah;

    document.getElementById('editPenyimak').value =
        halaqah.penyimak_id;

    // reset semua checkbox
    document.querySelectorAll('.editSantri')
        .forEach(cb => cb.checked = false);

    // centang santri lama
    halaqah.santris.forEach(s => {
        let cb = document.querySelector(
            `.editSantri[value="${s.id}"]`
        );
        if(cb) cb.checked = true;
    });
}

function closeEditModal(){
    document.getElementById('editModal').classList.add('hidden');
    document.getElementById('editModal').classList.remove('flex');
}


// ================= DELETE =================
function openDeleteModal(id, nama){
    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('deleteModal').classList.add('flex');

    document.getElementById('deleteForm').action =
        `/pengurus/halaqah/${id}`;

    document.getElementById('deleteNama').innerText = nama;
}

function closeDeleteModal(){
    document.getElementById('deleteModal').classList.add('hidden');
    document.getElementById('deleteModal').classList.remove('flex');
}
</script>

@endsection
</x-app-pengurus-layout>