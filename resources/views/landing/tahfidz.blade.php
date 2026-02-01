<x-app-layout>
    <section id="dashboard" class="mt-5 pb-0">
        <div class="container">

            <p><a class="text-black" href="index.html">Beranda</a> / <a href="">Program Tahfidz</a></p>

            <div class="section-title mt-5">
                <h3>Program Tahfidz</h3>
                <h2>Pusat Tahfidz Al-QUr'an Universitas Brawijaya</h2>
            </div>

            <div class="row mb-4">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Setoran</h5>
                            <p class="card-text">Program inti di UKM-TQ yang disusun oleh Departemen Kelas Tahfidz
                                berupa
                                setoran hafalan Al-Qur'an oleh santri kepada penyimak (asatidz) yang bertempat di dua
                                masjid
                                UNAIR</p>

                            @php
                                if (Auth::user()->role_id == config('constants.ROLE_SANTRI')) {
                                    if (count(Auth::user()->santri->verifiedSetoran) > 0) {
                                        $verifiedSetoranData = Auth::user()->santri->verifiedSetoran[
                                            count(Auth::user()->santri->verifiedSetoran) - 1
                                        ];
                                    }

                                    if (count(Auth::user()->santri->verifiedUjian) > 0) {
                                        $verifiedUjian = Auth::user()->santri->verifiedUjian[
                                            count(Auth::user()->santri->verifiedUjian) - 1
                                        ];
                                    }
                                }

                            @endphp

                            @if (Auth::check() && Auth::user()->role_id == config('constants.ROLE_SANTRI'))
                                @if (count(Auth::user()->santri->verifiedSetoran) > 0)
                                    @if (Auth::user()->santri->verifiedSetoran)

                                        @if ($verifiedSetoranData->penguji_verified === 0 || $verifiedSetoranData->panitia_verified === 0)
                                            <button class="btn" data-bs-toggle="modal"
                                                data-bs-target="#modalConfirm">
                                                Daftar
                                            </button>
                                        @elseif (
                                            ($verifiedSetoranData->penguji_verified === 1 && is_null($verifiedSetoranData->panitia_verified)) ||
                                                (is_null($verifiedSetoranData->penguji_verified) && $verifiedSetoranData->panitia_verified === 1) ||
                                                (is_null($verifiedSetoranData->penguji_verified) && is_null($verifiedSetoranData->panitia_verified)))
                                            <div class="text-primary-app font-semibold"><span>Proses seleksi</span> <i
                                                    class="fa-regular fa-hourglass-half ml-1"></i> </div>
                                        @elseif ($verifiedSetoranData->penguji_verified === 1 && $verifiedSetoranData->panitia_verified === 1)
                                            <div class="text-green-500 font-semibold"><span>Sudah daftar</span> <i
                                                    class="fa-solid fa-circle-check"></i></div>
                                        @endif
                                    @else
                                        @if (Auth::user()->role_id == 3)
                                            @if (is_null(Auth::user()->santri->jumlah_hafalan))
                                                <button class="btn" data-bs-toggle="modal"
                                                    data-bs-target="#modalSetoran">
                                                    Daftar
                                                </button>
                                            @else
                                                <button class="btn" data-bs-toggle="modal"
                                                    data-bs-target="#modalConfirm">
                                                    Daftar
                                                </button>
                                            @endif
                                        @else
                                            <button class="btn" data-bs-toggle="modal"
                                                data-bs-target="#modalWarning">Daftar</button>
                                        @endif
                                    @endif
                                @else
                                    @if (Auth::user()->role_id == 3)
                                        @if (is_null(Auth::user()->santri->jumlah_hafalan))
                                            <button class="btn" data-bs-toggle="modal"
                                                data-bs-target="#modalSetoran">
                                                Daftar
                                            </button>
                                        @else
                                            <button class="btn" data-bs-toggle="modal"
                                                data-bs-target="#modalConfirm">
                                                Daftar
                                            </button>
                                        @endif
                                    @else
                                        <button class="btn" data-bs-toggle="modal"
                                            data-bs-target="#modalWarning">Daftar</button>
                                    @endif
                                @endif
                            @else
                                <button class="btn" data-bs-toggle="modal"
                                    data-bs-target="#modalWarning">Daftar</button>

                            @endif
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ujian</h5>
                            <p class="card-text">Program inti di UKM-TQ yang disusun oleh Departemen Kelas Tahfidz
                                berupa
                                setoran hafalan Al-Qur'an oleh santri kepada penyimak (asatidz) yang bertempat di dua
                                masjid
                                UNAIR</p>

                            @if (Auth::check() && Auth::user()->role_id == config('constants.ROLE_SANTRI'))
                                @if (count(Auth::user()->santri->verifiedUjian) > 0)

                                    @if (Auth::user()->santri->verifiedUjian)
                                        @if ($verifiedUjian->penguji_verified === 0 || $verifiedUjian->panitia_verified === 0)
                                            <button class="btn" data-bs-toggle="modal"
                                                data-bs-target="#modalConfirmUjian">
                                                Daftar
                                            </button>
                                        @elseif (
                                            ($verifiedUjian->penguji_verified === 1 && is_null($verifiedUjian->panitia_verified)) ||
                                                (is_null($verifiedUjian->penguji_verified) && $verifiedUjian->panitia_verified === 1) ||
                                                (is_null($verifiedUjian->penguji_verified) && is_null($verifiedUjian->panitia_verified)))
                                            <div class="text-primary-app font-semibold"><span>Proses seleksi</span> <i
                                                    class="fa-regular fa-hourglass-half ml-1"></i> </div>
                                        @elseif ($verifiedUjian->penguji_verified === 1 && $verifiedUjian->panitia_verified === 1)
                                            <div class="text-green-500 font-semibold"><span>Sudah daftar</span> <i
                                                    class="fa-solid fa-circle-check"></i></div>
                                        @endif
                                    @else
                                        @if (Auth::user()->role_id == 3)
                                            @if (is_null(Auth::user()->santri->jumlah_hafalan))
                                                <button class="btn" data-bs-toggle="modal"
                                                    data-bs-target="#modalSetoran">
                                                    Daftar
                                                </button>
                                            @else
                                                <button class="btn" data-bs-toggle="modal"
                                                    data-bs-target="#modalConfirmUjian">
                                                    Daftar
                                                </button>
                                            @endif
                                        @else
                                            <button class="btn" data-bs-toggle="modal"
                                                data-bs-target="#modalWarning">Daftar</button>
                                        @endif
                                    @endif
                                @else
                                    @if (Auth::user()->role_id == 3)
                                        @if (is_null(Auth::user()->santri->jumlah_hafalan))
                                            <button class="btn" data-bs-toggle="modal"
                                                data-bs-target="#modalSetoran">
                                                Daftar
                                            </button>
                                        @else
                                            <button class="btn" data-bs-toggle="modal"
                                                data-bs-target="#modalConfirmUjian">
                                                Daftar
                                            </button>
                                        @endif
                                    @else
                                        <button class="btn" data-bs-toggle="modal"
                                            data-bs-target="#modalWarning">Daftar</button>
                                    @endif
                                @endif
                            @else
                                <button class="btn" data-bs-toggle="modal"
                                    data-bs-target="#modalSetoran">Daftar</button>


                            @endif

                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Kajian</h5>
                            <p class="card-text">Program penyelenggaraan kajian mengenai adab penghafal Al-Qur'an baik
                                dan
                                kajian tafsir dengan tema yang mengangkat kehidupan sehari-hari dan hal-hal yang ada di
                                masyarakat</p>
                            <button class="btn" data-bs-toggle="modal" data-bs-target="#modalWarning">Daftar</button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Dauroh</h5>
                            <p class="card-text">Program karantina hafalan dalam 6 hari, yang dilaksanakan di
                                selah-selah
                                liburan atau sebelum dimulainya perkuliahan dan diwajibkan bagi penerima beasiswa
                                sertifikasi</p>
                            <button class="btn" data-bs-toggle="modal" data-bs-target="#modalWarning">Daftar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tasmi'an</h5>
                            <p class="card-text">Program lanjutan dari ujian sertifikasi. Santri penerima beasiswa akan
                                mendapatkan 1 Juz dari hafalan yang sudah disertifikasikan untuk dibaca bil ghaib pada
                                hari
                                yang telah ditentukan panitia</p>
                            <button class="btn" data-bs-toggle="modal" data-bs-target="#modalWarning">Daftar</button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ikea (Gathering)</h5>
                            <p class="card-text">Ikatan keluarga Al-Quran atau disingkat IKEA merupakan sebuah kegiatan
                                gathering yang bertujuan untuk mempererat ukhuwah antar pengurus, santri, dan asatidz
                                UKM
                                Tahfidzul Quran UNAIR</p>
                            <button class="btn" data-bs-toggle="modal"
                                data-bs-target="#modalWarning">Daftar</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</x-app-layout>


<!-- ======= Warning Modal ======= -->
<div class="modal fade" id="modalWarning" tabindex="-1">
    <div class="modal modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="flex flex-col items-center justify-center w-full text-center ">
                    <img src="/assets/img/warning.png" alt="" class="img-fluid mb-3">
                    <h2>Login Untuk Melanjutkan</h2>
                    <h3>Silahkan login untuk melanjutkan. Jika Anda belum memiliki akun, register terlebih dahulu</h3>
                </div>

                <div id="dashboard" class="flex gap-2 justify-center w-full items-center my-4">
                    <button class="btn w-full max-w-[150px]" style="width: 120px;" data-bs-toggle="modal"
                        data-bs-target="#modalRegister">Register</a>

                        <button class="btn max-w-[150px] w-full" data-bs-toggle="modal"
                            data-bs-target="#modalLogin">Login</button>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- ======= Warning Modal ======= -->
<div class="modal fade" id="modalSetoran" tabindex="-1">
    <div class="modal modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <p class="text-2xl font-bold text-center">
                    Pemberitahuan
                </p>
                <div class="text-center font-semibold">
                    Harap mengisi jumlah hafalan terlebih dahulu di halaman profile
                </div>

                <a href={{ route('profile.edit') }} class=" text-white my-2"><button
                        class="bg-green-800 text-white py-2 rounded-lg w-full mt-4">Halaman Profile</button></a>
            </div>
        </div>
    </div>
</div>


@if (Auth::check())
    @if (Auth::user()->role_id == config('constants.ROLE_SANTRI'))
        <div class="modal fade" id="modalConfirm" tabindex="-1">
            <div class="modal modal-dialog modal-dialog-centered ">
                <div class="modal-content">
                    <div class="modal-body">
                        <p class="text-2xl font-bold text-center">
                            Pemberitahuan Pendaftaran Setoran
                        </p>
                        <div class="text-center font-medium">
                            Pastikan Data Pribadi mu sudah benar
                        </div>

                        <div class="my-6">
                            <div>
                                <div class="font-semibold mb-1">
                                    Nama Lengkap
                                </div>

                                <div class="p-2 border rounded">
                                    {{ Auth::user()->name }}
                                </div>
                            </div>
                        </div>
                        <div class="my-6">
                            <div>
                                <div class="font-semibold mb-1">
                                    NIM
                                </div>

                                <div class="p-2 border rounded">
                                    {{ Auth::user()->santri->nim }}
                                </div>
                            </div>
                        </div>
                        <div class="my-6">
                            <div>
                                <div class="font-semibold mb-1">
                                    Nama Handphone (WhatsApp)
                                </div>

                                <div class="p-2 border rounded">
                                    {{ Auth::user()->phone }}
                                </div>
                            </div>
                        </div>
                        <div class="my-6">
                            <div>
                                <div class="font-semibold mb-1">
                                    Jumlah Hafalan
                                </div>

                                <div class="p-2 border rounded">
                                    {{ Auth::user()->santri->jumlah_hafalan }} Juz
                                </div>
                            </div>
                        </div>
                        <div class="my-6 flex gap-4 items-center w-full">
                            <div class="w-full">
                                <div class="font-semibold mb-1">
                                    Fakultas
                                </div>

                                <div class="p-2 border rounded w-full">
                                    {{ Auth::user()->santri->major->faculty->name }}
                                </div>
                            </div>
                            <div class="w-full">
                                <div class="font-semibold mb-1">
                                    Jurusan
                                </div>

                                <div class="p-2 border rounded w-full">
                                    {{ Auth::user()->santri->major->name }}
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('profile.edit') }}" class="text-center font-semibold mb-4">
                            <div class="border rounded py-2">
                                Ubah Data
                            </div>
                        </a>

                        <form action={{ route('santri-verified-setoran.store') }} method="post" class="mt-4">
                            @csrf
                            <button type="submit" class="!bg-primary-app text-white py-2 w-full rounded">
                                Daftar Setoran
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalConfirmUjian" tabindex="-1">
            <div class="modal modal-dialog modal-dialog-centered ">
                <div class="modal-content">
                    <div class="modal-body">
                        <p class="text-2xl font-bold text-center">
                            Pemberitahuan Pendaftaran Ujian
                        </p>
                        <div class="text-center font-medium">
                            Pastikan Data Pribadi mu sudah benar
                        </div>

                        <div class="my-6">
                            <div>
                                <div class="font-semibold mb-1">
                                    Nama Lengkap
                                </div>

                                <div class="p-2 border rounded">
                                    {{ Auth::user()->name }}
                                </div>
                            </div>
                        </div>
                        <div class="my-6">
                            <div>
                                <div class="font-semibold mb-1">
                                    NIM
                                </div>

                                <div class="p-2 border rounded">
                                    {{ Auth::user()->santri->nim }}
                                </div>
                            </div>
                        </div>
                        <div class="my-6">
                            <div>
                                <div class="font-semibold mb-1">
                                    Nama Handphone (WhatsApp)
                                </div>

                                <div class="p-2 border rounded">
                                    {{ Auth::user()->phone }}
                                </div>
                            </div>
                        </div>
                        <div class="my-6">
                            <div>
                                <div class="font-semibold mb-1">
                                    Jumlah Hafalan
                                </div>

                                <div class="p-2 border rounded">
                                    {{ Auth::user()->santri->jumlah_hafalan }} Juz
                                </div>
                            </div>
                        </div>
                        <div class="my-6 flex gap-4 items-center w-full">
                            <div class="w-full">
                                <div class="font-semibold mb-1">
                                    Fakultas
                                </div>

                                <div class="p-2 border rounded w-full">
                                    {{ Auth::user()->santri->major->faculty->name }}
                                </div>
                            </div>
                            <div class="w-full">
                                <div class="font-semibold mb-1">
                                    Jurusan
                                </div>

                                <div class="p-2 border rounded w-full">
                                    {{ Auth::user()->santri->major->name }}
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('profile.edit') }}" class="text-center font-semibold mb-4">
                            <div class="border rounded py-2">
                                Ubah Data
                            </div>
                        </a>

                        <form action={{ route('santri-verified-ujian.store') }} method="post" class="mt-4">
                            @csrf
                            <button type="submit" class="!bg-primary-app text-white py-2 w-full rounded">
                                Daftar Ujian
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif
