<x-app-layout>
    <div class="mt-32 flex flex-col gap-6 max-w-6xl mx-auto w-full">
        <div class="flex items-center gap-2 font-medium">
            <a href="{{ route('home') }}" class="m-0 cursor-pointer text-gray-900 hover:text-gray-800">Beranda</a>
            <span>/</span>
            <p class="text-primary-app font-semibold m-0">Profile Saya</p>
        </div>

        <div class="max-w-4xl flex w-full justify-start mx-auto">
            <div class="text-xl font-bold text-center ml-28">Data Pribadi</div>
        </div>

        <div class="flex flex-col max-w-2xl w-full mx-auto gap-12 justify-center shadow-md rounded-md border p-5">
            <i class="fa-regular fa-user text-center text-7xl"></i>

            <div class="flex flex-col justify-center items-start w-full gap-4">
                <div>
                    <span class="font-bold">Nama Lengkap : </span> <span>{{ $user->name }}</span>
                </div>
                <div>
                    <span class="font-bold">Email : </span> <span>{{ $user->email }}</span>
                </div>
                <div>
                    <span class="font-bold">Nomor Handphone : </span> <span>{{ $user->phone }}</span>
                </div>
                <div>
                    <span class="font-bold">Jenis Kelamin : </span> <span>-</span>
                </div>
                <div>
                    <span class="font-bold">Tanggal Lahir : </span> <span>-</span>
                </div>
            </div>
        </div>

        @if ($user->role_id == config('constants.ROLE_SANTRI'))
            <div class="max-w-4xl flex w-full justify-start mx-auto mt-4">
                <div class="text-xl font-bold text-center ml-28">Data Institusi</div>
            </div>

            <div class="max-w-2xl w-full mx-auto gap-12 justify-center shadow-md rounded-md border p-5">
                <div class="flex flex-col justify-center items-start w-full gap-4">
                    <div>
                        <span class="font-bold">Fakultas : </span>
                        <span>{{ $user->santri->major->faculty->name }}</span>
                    </div>
                    <div>
                        <span class="font-bold">Jurusan : </span> <span>{{ $user->santri->major->name }}</span>
                    </div>
                    <div>
                        <span class="font-bold">Nomor Induk Mahasiswa : </span> <span>{{ $user->santri->nim }}</span>
                    </div>
                </div>
            </div>

            <div class="max-w-4xl flex w-full justify-start mx-auto mt-4">
                <div class="text-xl font-bold text-center ml-28">Data Hafalan</div>
            </div>

            <div class="max-w-2xl w-full mx-auto gap-12 justify-center shadow-md rounded-md border p-5">
                <div class="flex flex-col justify-center items-start w-full gap-4">
                    <div>
                        <span class="font-bold">Jumlah Hafalan : </span> <span>{{ $user->santri->jumlah_hafalan }}
                            Juz</span>
                    </div>
                    <div>
                        <span class="font-bold">Informasi Hafalan : </span>
                        <div class="flex gap-2 flex-wrap items-center mt-2">
                            @if ($user->santri->informasi_hafalan)
                                @foreach ($user->santri->informasi_hafalan as $item)
                                    <div class="bg-primary-app text-white rounded-xl px-4">
                                        Juz {{ $item }}
                                    </div>
                                @endforeach
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        @endif




        <div class="flex justify-center items-center w-full max-w-2xl mx-auto">
            <a href={{ route('profile.edit') }} class="w-full"> <button
                    class="text-white bg-primary-app py-2 rounded-md w-full">
                    Ubah Profile
                </button></a>
        </div>



    </div>
</x-app-layout>
