<x-app-layout>
    <div class="py-5" style="background-color: #f8fbff; min-height: 80vh;">
        <div class="container">

            <div class="text-center mb-5">
                <h2 style="font-weight: 700;">Login Akun</h2>
                <p style="color: #6c757d;">
                    Silakan pilih jenis akun untuk login
                </p>
            </div>

            <div class="row justify-content-center">

                <!-- Santri -->
                <div class="col-md-4 mb-4">
                    <a href="{{ route('login.santri') }}" class="text-decoration-none">
                        <div class="card role-card text-center p-4">
                            <img src="{{ asset('assets/img/santri.png') }}" width="80" class="mb-3 mx-auto">
                            <h4>Santri</h4>
                            <p class="text-muted">Login sebagai Santri</p>
                        </div>
                    </a>
                </div>

                <!-- Pengurus -->
                <div class="col-md-4 mb-4">
                    <a href="{{ route('login.pengurus') }}" class="text-decoration-none">
                        <div class="card role-card text-center p-4">
                            <img src="{{ asset('assets/img/admin.png') }}" width="80" class="mb-3 mx-auto">
                            <h4>Pengurus</h4>
                            <p class="text-muted">Login sebagai Pengurus</p>
                        </div>
                    </a>
                </div>

                <!-- Penyimak -->
                <div class="col-md-4 mb-4">
                    <a href="{{ route('login.penyimak') }}" class="text-decoration-none">
                        <div class="card role-card text-center p-4">
                            <img src="{{ asset('assets/img/penguji.png') }}" width="80" class="mb-3 mx-auto">
                            <h4>Penyimak</h4>
                            <p class="text-muted">Login sebagai Penyimak</p>
                        </div>
                    </a>
                </div>

            </div>

            <div class="text-center mt-4">
                <a href="/" class="btn btn-register">Kembali ke Beranda</a>
            </div>

        </div>
    </div>

    <style>
        .role-card {
            border-radius: 15px;
            transition: 0.3s;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        .role-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
    </style>
</x-app-layout>