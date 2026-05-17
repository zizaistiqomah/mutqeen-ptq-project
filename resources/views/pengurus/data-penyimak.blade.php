<x-app-pengurus-layout>

@section('content')

<div class="bg-white rounded-2xl shadow p-6">

    <!-- HEADER -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-xl font-bold text-gray-800">
                    Data Penyimak
                </h2>
                <p class="text-sm text-gray-500">
                    Daftar seluruh penyimak terdaftar
                </p>
            </div>

            <div class="bg-[#075F7C] text-white px-4 py-2 rounded-xl text-sm">
                Total: {{ $penyimaks->count() }} Data Penyimak
            </div>
        </div>
        
    <table class="w-full text-sm text-left">

        <thead>
            <tr class="bg-[#075F7C] text-white">
                <th class="py-3 px-4 rounded-tl-xl">No</th>
                <th class="py-3 px-4">Nama</th>
                <th class="py-3 px-4">Email</th>
                <th class="py-3 px-4">No HP</th>
                <th class="py-3 px-4">Type</th>
                <th class="py-3 px-4 rounded-tr-xl">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($penyimaks as $penyimak)

            <tr class="border-b hover:bg-gray-50">

                <!-- NO -->
                <td class="py-3 px-4">
                    {{ $loop->iteration }}
                </td>

                <!-- NAMA -->
                <td class="py-3 px-4">
                    {{ $penyimak->name }}
                </td>

                <!-- EMAIL -->
                <td class="py-3 px-4">
                    {{ $penyimak->email }}
                </td>

                <!-- NO HP -->
                <td class="py-3 px-4">
                    {{ $penyimak->penyimak->no_hp ?? '-' }}
                </td>

                <!-- TYPE -->
                <td class="py-3 px-4">
                    @if(($penyimak->penyimak->tipe ?? '') == 'pengurus')
                        <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                            Pengurus
                        </span>
                    @else
                        <span class="px-3 py-1 text-xs rounded-full bg-purple-100 text-purple-700">
                            External
                        </span>
                    @endif
                </td>

                <!-- AKSI -->
                <td class="py-3 px-4 space-x-2">
                    <button 
                        type="button"
                        onclick="openDeleteModal({{ $penyimak->id }}, '{{ $penyimak->name }}')"
                        class="text-red-600 text-sm hover:underline">
                        Hapus
                    </button>
                </td>

            </tr>

            @empty
            <tr>
                <td colspan="7" class="text-center py-6 text-gray-400">
                    Tidak ada data penyimak
                </td>
            </tr>
            @endforelse
        </tbody>

    </table>

    <div id="deleteModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

        <div class="bg-white w-full max-w-sm rounded-2xl p-6 text-center">

            <h2 class="text-lg font-bold mb-2">Hapus Penyimak</h2>
            <p class="text-sm text-gray-500 mb-4">
                Yakin ingin menghapus Penyimak <span id="deleteName" class="font-semibold text-gray-800"></span>?
            </p>

            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')

                <div class="flex justify-center gap-3">
                    <button type="button" onclick="closeDeleteModal()">Batal</button>

                    <button type="submit"
                        class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm">
                        Hapus
                    </button>
                </div>
            </form>

        </div>
    </div>

    </div>

    <script>
    function openDeleteModal(id, name) {

        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteModal').classList.add('flex');

        document.getElementById('deleteForm').action = `/pengurus/penyimak/${id}`;

        document.getElementById('deleteName').innerText = name;
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.getElementById('deleteModal').classList.remove('flex');
    }
    </script>

@endsection

</x-app-pengurus-layout>