<x-app-layout>
<div class="p-6 bg-[#F5F7FA] min-h-screen">

    <!-- 🔹 Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-[#1E3A5F]">
            Target Hafalan
        </h1>

        @if(!$target)
            <a href="{{ route('santri.target.create') }}"
               class="bg-[#4A90E2] text-white px-4 py-2 rounded-lg hover:bg-[#357ABD]">
                + Tambah Target
            </a>
        @endif
    </div>

    <!-- 🔹 Content -->
    @if($target)
        <div class="bg-white p-6 rounded-xl shadow">

            <!-- Info Target -->
            <div class="mb-4 space-y-2">
                <p><span class="font-semibold">Jenis:</span> {{ ucfirst($target->jenis_target) }}</p>
                <p><span class="font-semibold">Jumlah:</span> {{ $target->jumlah_target }}</p>
                <p><span class="font-semibold">Periode:</span> 
                    {{ $target->tanggal_mulai }} - {{ $target->tanggal_selesai }}
                </p>
            </div>

            <!-- Action -->
            <div class="flex gap-3 mt-4">

                <a href="{{ route('santri.target.edit', $target->id) }}"
                   class="bg-yellow-400 text-white px-4 py-2 rounded-lg hover:bg-yellow-500">
                    Edit
                </a>

                <form action="{{ route('santri.target.destroy', $target->id) }}" method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus target?')">
                    @csrf 
                    @method('DELETE')

                    <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                        Hapus
                    </button>
                </form>

            </div>

        </div>
    @else
        <div class="bg-white p-6 rounded-xl shadow text-center">

            <p class="text-gray-400 mb-4">
                Belum ada target hafalan
            </p>

            <a href="{{ route('santri.target.create') }}"
               class="bg-[#4A90E2] text-white px-4 py-2 rounded-lg hover:bg-[#357ABD]">
                + Tambah Target
            </a>

        </div>
    @endif

</div>
</x-app-layout>