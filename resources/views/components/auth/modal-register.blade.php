<div class="modal fade" id="modalRegister" tabindex="-1">
    <div class="modal modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">

                <div class="text-center">
                    <h2>Daftar ke UKM Tahfidz</h2>
                    <h3>Saya ingin daftar sebagai:</h3>
                </div>

                <a href={{ route('santri.create') }}>
                    <div class="card mb-2">
                        <div class="row">
                            <div class="col-3">
                                <img src="/assets/img/santri.png" alt="...">
                            </div>
                            <div class="col-9 my-auto">
                                <div class="card-body">
                                    <h3 class="card-title">Santri Penghafal</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
               
                <a href={{ route('panitia.create') }}>
                    <div class="card mb-2">
                        <div class="row">
                            <div class="col-3">
                                <img src="/assets/img/panitia.png" alt="...">
                            </div>
                            <div class="col-9 my-auto">
                                <div class="card-body">
                                    <h3 class="card-title">Panitia UKM Tahfidz</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href={{ route('penguji.create') }}>
                    <div class="card mb-2">
                        <div class="row">
                            <div class="col-3">
                                <img src="/assets/img/penguji.png" alt="...">
                            </div>
                            <div class="col-9 my-auto">
                                <div class="card-body">
                                    <h3 class="card-title">Penguji UKM Tahfidz</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
